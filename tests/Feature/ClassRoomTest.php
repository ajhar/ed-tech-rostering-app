<?php

namespace Tests\Feature;

use App\Enums\UserRoleEnum;
use App\Models\ClassRoom;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClassRoomTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_class_rooms_with_user()
    {
        $user = User::factory()->create(['role' => UserRoleEnum::STUDENT->value]);
        Sanctum::actingAs($user);
        $response = $this->getJson('/api/classes');
        $response->assertStatus(401);
    }

    public function test_get_class_rooms_with_admin(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user, ['*']);
        $response = $this->getJson('/api/classes');
        $response->assertStatus(200);
    }

    public function test_create_class_room(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);
        $response = $this->postJson('/api/classes', ['name' => 'Math Class']);
        $response->assertStatus(201);
        $this->assertEquals(1, ClassRoom::count());
        $this->assertEquals('Math Class', ClassRoom::first()->name);
    }

    public function test_create_class_room_empty_name(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);
        $response = $this->postJson('/api/classes');
        $response->assertStatus(422);
    }

    public function test_update_class_room(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);
        $classRoom = ClassRoom::factory()->create(['name' => 'Old Name']);
        $response = $this->putJson('/api/classes/' . $classRoom->id, ['name' => 'New Name']);
        $response->assertStatus(200);
        $classRoom->refresh();
        $this->assertEquals('New Name', $classRoom->name);
    }

    public function test_delete_class_room(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::ADMIN->value]);
        Sanctum::actingAs($user);
        $classRoom = ClassRoom::factory()->create();
        $response = $this->deleteJson('/api/classes/' . $classRoom->id);
        $response->assertStatus(204);
    }
}
