<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Classroom;
use App\Models\Lecture;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Создаем 10 классов
        $classes = Classroom::factory(10)->create();

        // Создаем 20 лекций
        $lectures = Lecture::factory(10)->create();

        // Проходим по каждой лекции
        $lectures->each(function ($lecture) use ($classes) {
            // Получаем список классов
            $availableClasses = $classes->shuffle();

            // Проходим по каждому классу
            $availableClasses->each(function ($class, $order) use ($lecture) {
                // Связываем каждую лекцию с классом с указанием порядка
                $lecture->classrooms()->attach($class, ['order' => $order + 1]);
            });
        });

        // Создаем 50 студентов
        $students = Student::factory(50)->create();

        // Проходим по каждому студенту
        $students->each(function ($student) use ($classes) {
            // Связываем каждого студента с рандомным классом
            $student->classroom()->associate($classes->random())->save();
        });
    }
}
