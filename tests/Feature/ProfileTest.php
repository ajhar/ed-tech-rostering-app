<?php

namespace Tests\Feature;

use App\Enums\UserRoleEnum;
use App\Models\Activity;
use App\Models\ClassRoom;
use App\Models\Country;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use App\Models\UserAttribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_profile(): void
    {
        $user = User::factory()->create(['role' => UserRoleEnum::STUDENT->value]);
        Sanctum::actingAs($user);

        Country::factory()->create();
        UserAttribute::factory()->create(['user_id' => $user->id]);

        $response = $this->getJson('/api/profile');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'name',
                'email',
                'street1',
                'street2',
                'city',
                'postal_code',
                'country_id',
            ],
        ]);
    }

    public function test_update_profile()
    {
        $user = User::factory()->create(['role' => UserRoleEnum::STUDENT->value]);
        Sanctum::actingAs($user);

        $country = Country::factory()->create();
        $userAttribute = UserAttribute::factory()->create(['user_id' => $user->id]);

        $response = $this->putJson('/api/profile', [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'street1' => 'Updated Street',
            'street2' => 'Updated Street 2',
            'city' => 'Updated City',
            'postal_code' => '12345',
            'country_id' => $country->id,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'name',
                'email',
                'street1',
                'street2',
                'city',
                'postal_code',
                'country_id',
            ],
        ]);

        $response->assertJson([
            'data' => [
                'name' => 'Updated Name',
                'email' => 'updated@example.com',
                'street1' => 'Updated Street',
                'street2' => 'Updated Street 2',
                'city' => 'Updated City',
                'postal_code' => '12345',
                'country_id' => $country->id,
            ],
        ]);

        $this->assertDatabaseHas('user_attributes', [
            'user_id' => $user->id,
            'street1' => 'Updated Street',
        ]);
    }
}
