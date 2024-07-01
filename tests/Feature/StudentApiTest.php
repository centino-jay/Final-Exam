<?php
namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_student()
    {
        $studentData = [
            'firstname' => 'Alden jay',
            'lastname' => 'Centino',
            'birthdate' => '1999-10-27',
            'sex' => 'MALE',
            'address' => 'Tacloban',
            'year' => 3,
            'course' => 'BSIT',
            'section' => 'A',
        ];

        $response = $this->postJson('/api/students', $studentData);
        $response->assertStatus(201)->assertJson($studentData);
    }

    public function test_can_update_student()
    {
        $student = Student::factory()->create();

        $updatedData = [
            'firstname' => 'Jane',
            'lastname' => 'Doe',
            'address' => 'Cebu City',
        ];

        $response = $this->patchJson("/api/students/{$student->id}", $updatedData);
        $response->assertStatus(200)->assertJson($updatedData);
    }

    public function test_can_retrieve_student()
    {
        $student = Student::factory()->create();

        $response = $this->getJson("/api/students/{$student->id}");
        $response->assertStatus(200)->assertJson($student->toArray());
    }

    public function test_can_retrieve_students_with_filters()
    {
        Student::factory()->count(10)->create(['course' => 'BSIT']);

        $response = $this->getJson('/api/students?course=BSIT');
        $response->assertStatus(200)->assertJsonStructure([
            'metadata' => [
                'count', 'search', 'limit', 'offset', 'fields'
            ],
            'students'
        ]);
    }
}
