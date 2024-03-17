<?php

namespace Tests\Feature;

use App\Enums\UserRoleEnum;
use App\Models\Activity;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_activities_with_user()
    {
        $user = User::factory()->create(['role' => UserRoleEnum::STUDENT->value]);
        Sanctum::actingAs($user);
        $response = $this->getJson('/api/activities');
        $response->assertStatus(401);
    }

    public function test_get_activities_with_admin(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user, ['*']);
        $response = $this->getJson('/api/activities');
        $response->assertStatus(200);
    }

    public function test_create_activity(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        $subject = Subject::factory()->create();
        Sanctum::actingAs($user);
        $response = $this->postJson('/api/activities', [
            'subject_id' => $subject->id,
            'name' => 'Maths Assignments',
            'max_score' => 85
        ]);
        $response->assertStatus(201);
        $this->assertEquals(1, Activity::count());
        $this->assertEquals('Maths Assignments', Activity::first()->name);
    }

    public function test_create_activity_with_invalid_subject_id(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);
        $response = $this->postJson('/api/activities', [
            'subject_id' => 100,
            'name' => 'Maths Assignments',
            'max_score' => 85
        ]);
        $response->assertStatus(422);
    }

    public function test_create_activity_empty_name(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);
        $response = $this->postJson('/api/activities');
        $response->assertStatus(422);
    }

    public function test_update_activity(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);
        $subject = Subject::factory()->create();
        $Activity = Activity::factory()->create(['name' => 'Old Name']);
        $response = $this->putJson('/api/activities/' . $Activity->id, [
            'subject_id' => $subject->id,
            'name' => 'New Name',
            'max_score' => 85
        ]);
        $response->assertStatus(200);
        $Activity->refresh();
        $this->assertEquals('New Name', $Activity->name);
    }

    public function test_delete_activity(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);
        Subject::factory()->create();
        $activity = Activity::factory()->create();
        $response = $this->deleteJson('/api/activities/' . $activity->id);
        $response->assertStatus(204);
        $this->assertDatabaseMissing('activities', ['id' => $activity->id]);
    }
}
