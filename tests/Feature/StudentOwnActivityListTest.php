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

class StudentOwnActivityListTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_get_activity_details_json(): void
    {
        $studentUser = User::factory()->create(['role' => UserRoleEnum::STUDENT->value]);
        $teacherUser = User::factory()->create(['role' => UserRoleEnum::TEACHER->value]);
        Sanctum::actingAs($studentUser);

        $country = Country::factory()->create();
        $userAttribute = UserAttribute::factory()->create(['user_id' => $studentUser->id, 'country_id' => $country->id]);
        $subject = Subject::factory()->create();
        $activity1 = Activity::factory()->create(['subject_id' => $subject->id]);
        $activity2 = Activity::factory()->create(['subject_id' => $subject->id]);
        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id]);
        $class = ClassRoom::factory()->create(['teacher_id' => $teacher->id]);
        $student = Student::factory()->create(['user_id' => $studentUser->id, 'class_id' => $class->id]);

        StudentActivity::factory()->create(['student_id' => $student->id, 'activity_id' => $activity1->id]);
        StudentActivity::factory()->create(['student_id' => $student->id, 'activity_id' => $activity2->id]);

        $response = $this->getJson('/api/activity-list');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJsonStructure(['data' => []]);
        $responseData = $response->json('data');
        $this->assertNotEmpty($responseData, 'No data returned');

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'subject',
                    'activity',
                    'score',
                    'max_score',
                    'grade',
                ],
            ],
        ]);
    }
}
