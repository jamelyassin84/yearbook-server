<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    private $relationships = [
        'schoolYear',
        'department',
        'sections'
    ];

    public function index(Request $request)
    {
        $filters = $request->only(['school_year_id', 'department_id']);
        $query = Course::query();
        foreach ($filters as $filter => $value) {
            if (isset($value)) {
                $query->where($filter, $value);
            }
        }
        $courses = $query->with($this->relationships)->get();
        return response()->json($courses);
    }

    public function store(Request $request)
    {
        $payload = $request->all();
        $course = Course::create($payload);
        $course->load($this->relationships);
        return response()->json($course, 201);
    }

    public function show(Course $course)
    {
        $course->load($this->relationships);
        return response()->json($course);
    }

    public function update(Request $request, Course $course)
    {
        $course->fill($request->all())->save();
        $course->load($this->relationships);
        return response()->json($course);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(['message' => 'Course deleted successfully']);
    }
}
