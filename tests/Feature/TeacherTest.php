<?php

namespace Tests\Feature;

use App\Enums\UserRoleEnum;
use App\Models\ClassRoom;
use App\Models\Country;
use App\Models\Teacher;
use App\Models\User;
use App\Models\UserAttribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TeacherTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_teachers_with_user()
    {
        $user = User::factory()->create(['role' => UserRoleEnum::STUDENT->value]);
        Sanctum::actingAs($user);
        $response = $this->getJson('/api/teachers');
        $response->assertStatus(401);
    }

    public function test_get_teachers_with_admin(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user, ['*']);
        $response = $this->getJson('/api/teachers');
        $response->assertStatus(200);
    }

    public function test_create_teacher_success(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);

        $class = ClassRoom::factory()->create();
        $country = Country::factory()->create();

        $response = $this->postJson('/api/teachers', [
            'employee_id' => '123456',
            'name' => 'Ane',
            'email' => 'ane@mail.com',
            'password' => 'ane@123',
            'class_ids' => [$class->id],
            'street1' => 'Main Street',
            'street2' => 'Upper Junction',
            'city' => 'Francisco',
            'postal_code' => 'SAN123',
            'country_id' => $country->id,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['email' => 'ane@mail.com']);

        $teacherData = $response->json();
        $teacherId = $teacherData['data']['id'];
        $this->assertDatabaseHas('teachers', ['employee_id' => '123456']);
        $this->assertDatabaseHas('classes', ['teacher_id' => $teacherId]);
    }

    public function test_create_teacher_invalid_email(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);

        $class = ClassRoom::factory()->create();
        $country = Country::factory()->create();

        $response = $this->postJson('/api/teachers', [
            'employee_id' => '123456',
            'name' => 'Ane',
            'email' => 'ane',
            'password' => 'ane@123',
            'class_ids' => [$class->id],
            'street1' => 'Main Street',
            'street2' => 'Upper Junction',
            'city' => 'Francisco',
            'postal_code' => 'SAN123',
            'country_id' => $country->id,
        ]);

        $response->assertStatus(422);
    }

    public function test_delete_teacher(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);

        $teacherUser = User::factory()->create(['role' => UserRoleEnum::TEACHER->value]);
        Country::factory()->create();
        UserAttribute::factory()->create(['user_id' => $teacherUser->id]);
        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id]);
        ClassRoom::factory()->create(['teacher_id' => $teacher->id]);

        $response = $this->deleteJson('/api/teachers/' . $teacher->id);
        $response->assertStatus(204);

        $this->assertDatabaseMissing('users', ['id' => $teacherUser->id]);
        $this->assertDatabaseMissing('user_attributes', ['user_id' => $teacherUser->id]);
        $this->assertDatabaseMissing('classes', ['teacher_id' => $teacher->id]);
        $this->assertDatabaseMissing('teachers', ['id' => $teacher->id]);
    }
}
