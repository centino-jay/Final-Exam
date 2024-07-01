<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    protected $model = Subject::class;

    public function definition()
    {
        $prelims = $this->faker->randomFloat(2, 1.0, 5.0);
        $midterms = $this->faker->randomFloat(2, 1.0, 5.0);
        $pre_finals = $this->faker->randomFloat(2, 1.0, 5.0);
        $finals = $this->faker->randomFloat(2, 1.0, 5.0);
        $average_grade = ($prelims + $midterms + $pre_finals + $finals) / 4;
        $remarks = $average_grade >= 3.0 ? 'PASSED' : 'FAILED';

        return [
            'student_id' => \App\Models\Student::factory(),
            'subject_code' => $this->faker->regexify('[A-Z]{3}-[0-9]{3}'),
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'instructor' => $this->faker->name,
            'schedule' => $this->faker->randomElement(['MW 7AM-12PM', 'TTh 1PM-4PM', 'F 9AM-12PM']),
            'prelims' => $prelims,
            'midterms' => $midterms,
            'pre_finals' => $pre_finals,
            'finals' => $finals,
            'average_grade' => $average_grade,
            'remarks' => $remarks,
            'date_taken' => $this->faker->date('Y-m-d'),
        ];
    }
}

