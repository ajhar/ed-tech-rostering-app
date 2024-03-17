<?php

namespace Tests\Feature;

use App\Enums\UserRoleEnum;
use App\Models\Activity;
use App\Models\ClassRoom;
use App\Models\Country;
use App\Models\Student;
use App\Models\StudentActivity;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use App\Models\UserAttribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_students_with_user()
    {
        $user = User::factory()->create(['role' => UserRoleEnum::STUDENT->value]);
        Sanctum::actingAs($user);
        $response = $this->getJson('/api/students');
        $response->assertStatus(401);
    }

    public function test_get_students_with_admin(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user, ['*']);
        $response = $this->getJson('/api/students');
        $response->assertStatus(200);
    }

    public function test_create_student_success(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);

        $teacherUser = User::factory()->create(['role' => UserRoleEnum::TEACHER->value]);
        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id]);
        $class = ClassRoom::factory()->create(['teacher_id' => $teacher->id]);
        $subject = Subject::factory()->create();
        $activity = Activity::factory()->create(['subject_id' => $subject->id]);
        $country = Country::factory()->create();

        $response = $this->postJson('/api/students', [
            'registration_number' => '123456',
            'name' => 'Tom',
            'email' => 'tom@mail.com',
            'password' => 'tom@123',
            'class_id' => $class->id,
            'street1' => 'Main Street',
            'street2' => 'Upper Junction',
            'city' => 'Francisco',
            'postal_code' => 'SAN123',
            'country_id' => $country->id,
            'activity_ids' => [$activity->id]
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['email' => 'tom@mail.com']);

        $userData = $response->json();
        $userId = $userData['data']['id'];
        $this->assertDatabaseHas('student_activities', ['student_id' => $userId, 'activity_id' => $activity->id]);

    }

    public function test_create_student_invalid_email(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);

        $teacherUser = User::factory()->create(['role' => UserRoleEnum::TEACHER->value]);
        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id]);
        $class = ClassRoom::factory()->create(['teacher_id' => $teacher->id]);
        $subject = Subject::factory()->create();
        $activity = Activity::factory()->create(['subject_id' => $subject->id]);
        $country = Country::factory()->create();

        $response = $this->postJson('/api/students', [
            'registration_number' => '123456',
            'name' => 'Tom',
            'email' => 'tom',
            'password' => 'tom@123',
            'class_id' => $class->id,
            'street1' => 'Main Street',
            'street2' => 'Upper Junction',
            'city' => 'Francisco',
            'postal_code' => 'SAN123',
            'country_id' => $country->id,
            'activity_ids' => [$activity->id]
        ]);

        $response->assertStatus(422);
    }

    public function test_delete_student(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);

        $teacherUser = User::factory()->create(['role' => UserRoleEnum::TEACHER->value]);
        $studentUser = User::factory()->create(['role' => UserRoleEnum::STUDENT->value]);

        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id]);

        $class = ClassRoom::factory()->create(['teacher_id' => $teacher->id]);
        $subject = Subject::factory()->create();
        $activity = Activity::factory()->create(['subject_id' => $subject->id]);
        Country::factory()->create();
        UserAttribute::factory()->create(['user_id' => $studentUser->id]);
        $student = Student::factory()->create(['user_id' => $studentUser->id, 'class_id' => $class->id]);
        StudentActivity::factory()->create(['student_id' => $student->id, 'activity_id' => $activity->id]);

        $response = $this->deleteJson('/api/students/' . $student->id);
        $response->assertStatus(204);

        $this->assertDatabaseMissing('users', ['id' => $studentUser->id]);
        $this->assertDatabaseMissing('user_attributes', ['user_id' => $studentUser->id]);
        $this->assertDatabaseMissing('student_activities', ['student_id' => $student->id, 'activity_id' => $activity->id]);
        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }
}
