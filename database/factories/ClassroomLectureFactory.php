<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\Lecture;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassroomLecture>
 */
class ClassroomLectureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'classroom_id' => function () {
                return Classroom::factory()->create()->id;
            },
            'lecture_id' => function () {
                return Lecture::factory()->create()->id;
            },
            'order' => fake()->randomNumber(2),
        ];
    }
}
