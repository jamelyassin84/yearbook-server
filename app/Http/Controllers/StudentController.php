<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    private $relationships = [
        'schoolYear',
        'department',
        'course',
        'section',
        'information',
    ];

    public function getYearbook(Request $request)
    {
        $filters = $request->only([
            'school_year_id',
            'course_id',
        ]);

        $query = Student::query();

        foreach ($filters as $filter => $value) {
            if (isset($value)) {
                $query->where('students.' . $filter, $value);
            }
        }

        $students = $query->with($this->relationships)
            ->join('information', 'students.information_id', '=', 'information.id')
            ->orderBy('information.last_name')
            ->paginate(9);
        return response()->json($students);
    }

    public function index(Request $request)
    {
        $filters = $request->only([
            'school_year_id',
            'department_id',
            'course_id',
            'section_id',
        ]);

        $query = Student::query();

        foreach ($filters as $filter => $value) {
            if (isset($value)) {
                $query->where($filter, $value);
            }
        }

        $students = $query->with($this->relationships)->get();
        return response()->json($students);
    }

    public function store(Request $request)
    {
        $payload = $request->all();
        $student =  Student::create(array_merge($payload));
        $student->load($this->relationships);
        return response()->json($student, 201);
    }

    public function show(Student $student)
    {
        $student->load($this->relationships);
        return response()->json($student);
    }

    public function update(Request $request, string $id)
    {
        $student = Student::find($id);
        $student->fill($request->all())->save();
        $student->load($this->relationships);
        return response()->json($student);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
}
