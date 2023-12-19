<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;

class ClassroomController extends Controller
{

    public function index()
    {
        return Classroom::all();
    }

    public function showInfo(Classroom $classroom)
    {
        $data = [
            'classroom' => $classroom->name,
            'students' => $classroom->students,
        ];

        return $data;
    }

    public function showLectures(Classroom $classroom)
    {
        $data = [
            'classroom' => $classroom->name,
            'lectures' => $classroom->lectures->all(),
        ];

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassroomRequest $request)
    {
        $classroom = Classroom::create($request->validated());
        return $classroom;
    }

    public function updatePlan(ClassroomRequest $request, Classroom $classroom)
    {

        $validatedData = $request->validated();
        $lecturePlanData = $validatedData['lectures'];
        foreach ($lecturePlanData as $lectureData) {
            $lectureId = $lectureData['id'];
            $order = $lectureData['order'];

            $classroom->lectures()->sync([$lectureId => ['order' => $order]], false);
        }

        $updatedStudyPlan = $classroom->lectures;
        return $updatedStudyPlan;
    }

    public function updateName(ClassroomRequest $request, Classroom $classroom)
    {
        $classroom->update($request->validated());
        return $classroom;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return 'success';
    }
}
