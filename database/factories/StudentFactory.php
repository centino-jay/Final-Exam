<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'birthdate' => $this->faker->date('Y-m-d'),
            'sex' => $this->faker->randomElement(['MALE', 'FEMALE']),
           // ...
           'address' => $this->faker->address,
           'year' => $this->faker->numberBetween(1, 4),
           'course' => $this->faker->randomElement(['BSIT', 'BSCS', 'BSIS']),
           'section' => $this->faker->randomElement(['A', 'B', 'C']),
       ];
   }
}
