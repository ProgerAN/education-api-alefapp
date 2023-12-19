<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LectureRequest;
use App\Models\Lecture;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Lecture::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LectureRequest $request)
    {
        $lecture = Lecture::create($request->validated());
        return $lecture;
    }

    /**
     * Display the specified resource.
     */
    public function show(Lecture $lecture)
    {
        $data = [
            'topic' => $lecture->topic,
            'description' => $lecture->description,
            'classrooms' => $lecture->classrooms->pluck('name', 'id'),
            'students' => $lecture->students->makeHidden('pivot'),
        ];

        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LectureRequest $request, Lecture $lecture)
    {
        $lecture->update($request->validated());
        return $lecture;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecture $lecture)
    {
        $lecture->delete();
        return 'success';
    }
}
