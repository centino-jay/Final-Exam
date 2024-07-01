<?php
namespace Tests\Feature;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubjectApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_subject()
    {
        $student = Student::factory()->create();

        $subjectData = [
            'subject_code' => 'T3B-123',
            'name' => 'Application Lifecycle Management',
            'description' => 'Lorem ipsum dolor sit amet.',
            'instructor' => 'Mr. John Doe',
            'schedule' => 'MW 7AM-12PM',
            'prelims' => 2.75,
            'midterms' => 2.0,
            'pre_finals' => 1.75,
            'finals' => 1.0,
            'average_grade' => 1.87,
            'remarks' => 'PASSED',
            'date_taken' => '2024-01-01',
        ];

        $response = $this->postJson("/api/students/{$student->id}/subjects", $subjectData);
        $response->assertStatus(201)->assertJson($subjectData);
    }

    public function test_can_update_subject()
    {
        $student = Student::factory()->create();
        $subject = Subject::factory()->create(['student_id' => $student->id]);

        $updatedData = [
            'name' => 'Updated Subject Name',
            'instructor' => 'Dr. Jane Doe',
        ];

        $response = $this->patchJson("/api/students/{$student->id}/subjects/{$subject->id}", $updatedData);
        $response->assertStatus(200)->assertJson($updatedData);
    }

    public function test_can_retrieve_subject()
    {
        $student = Student::factory()->create();
        $subject = Subject::factory()->create(['student_id' => $student->id]);

        $response = $this->getJson("/api/students/{$student->id}/subjects/{$subject->id}");
        $response->assertStatus(200)->assertJson($subject->toArray());
    }

    public function test_can_retrieve_subjects_with_filters()
    {
        $student = Student::factory()->create();
        Subject::factory()->count(10)->create(['student_id' => $student->id, 'remarks' => 'PASSED']);

        $response = $this->getJson("/api/students/{$student->id}/subjects?remarks=PASSED");
        $response->assertStatus(200)->assertJsonStructure([
            'metadata' => [
                'count', 'search', 'limit', 'offset', 'fields'
            ],
            'subjects'
        ]);
    }
}
