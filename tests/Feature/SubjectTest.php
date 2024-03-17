<?php

namespace Tests\Feature;

use App\Enums\UserRoleEnum;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SubjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_subjects_with_user()
    {
        $user = User::factory()->create(['role' => UserRoleEnum::STUDENT->value]);
        Sanctum::actingAs($user);
        $response = $this->getJson('/api/subjects');
        $response->assertStatus(401);
    }

    public function test_get_subjects_with_admin(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);
        $response = $this->getJson('/api/subjects');
        $response->assertStatus(200);
    }

    public function test_create_subject(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);
        $response = $this->postJson('/api/subjects', ['code' => 'ABC', 'name' => 'Maths']);
        $response->assertStatus(201);
        $this->assertEquals(1, Subject::count());
        $this->assertEquals('Maths', Subject::first()->name);
    }

    public function test_create_subject_empty_code(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);
        $response = $this->postJson('/api/subjects', ['name' => 'Maths']);
        $response->assertStatus(422);
    }

    public function test_update_subject(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);
        $subject = Subject::factory()->create(['name' => 'Maths']);
        $response = $this->putJson('/api/subjects/' . $subject->id, ['code' => 'ABC', 'name' => 'Science']);
        $response->assertStatus(200);
        $subject->refresh();
        $this->assertEquals('Science', $subject->name);
    }

    public function test_delete_class_room(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);
        $subject = Subject::factory()->create();
        $response = $this->deleteJson('/api/subjects/' . $subject->id);
        $response->assertStatus(204);
        $this->assertDatabaseMissing('subjects', ['id' => $subject->id]);
    }
}
