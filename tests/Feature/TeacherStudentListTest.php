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
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TeacherStudentListTest extends TestCase
{
    use RefreshDatabase;

    public function test_teacher_can_get_student_details_json(): void
    {
        $studentUser = User::factory()->create(['role' => UserRoleEnum::STUDENT->value]);
        $teacherUser = User::factory()->create(['role' => UserRoleEnum::TEACHER->value]);
        Sanctum::actingAs($teacherUser);

        $country = Country::factory()->create();
        $userAttribute = UserAttribute::factory()->create(['user_id' => $studentUser->id, 'country_id' => $country->id]);
        $subject = Subject::factory()->create();
        $activity = Activity::factory()->create(['subject_id' => $subject->id]);
        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id]);
        $class = ClassRoom::factory()->create(['teacher_id' => $teacher->id]);
        $student = Student::factory()->create(['user_id' => $studentUser->id, 'class_id' => $class->id]);

        StudentActivity::factory()->create(['student_id' => $student->id, 'activity_id' => $activity->id]);

        $response = $this->getJson('/api/student-list');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJsonStructure(['data' => []]);
        $responseData = $response->json('data');
        $this->assertNotEmpty($responseData, 'No data returned');

        foreach ($responseData as $student) {
            $this->assertArrayHasKey('registration_number', $student);
            $this->assertArrayHasKey('class', $student);
            $this->assertArrayHasKey('name', $student);
            $this->assertArrayHasKey('street1', $userAttribute);
            $this->assertArrayHasKey('street2', $userAttribute);
            $this->assertArrayHasKey('city', $userAttribute);
            $this->assertArrayHasKey('postal_code', $userAttribute);
            $this->assertArrayHasKey('country_id', $userAttribute);
            $this->assertArrayHasKey('activities', $student);
            $this->assertIsArray($student['activities']);

            foreach ($student['activities'] as $activity) {
                $this->assertArrayHasKey('name', $activity);
                $this->assertArrayHasKey('score', $activity);
                $this->assertArrayHasKey('subject', $activity);
                $this->assertArrayHasKey('max_score', $activity);
            }
        }
    }
}
