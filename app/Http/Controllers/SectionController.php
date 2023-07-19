<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    private $relationships = [
        'schoolYear',
        'department',
        'course',
        'students',
    ];


    public function index(Request $request)
    {
        $filters = $request->only(['school_year_id', 'department_id', 'course_id']);

        $query = Section::query();

        foreach ($filters as $filter => $value) {
            if (isset($value)) {
                $query->where($filter, $value);
            }
        }

        $sections = $query->with($this->relationships)->get();
        return response()->json($sections);
    }

    public function store(Request $request)
    {
        $payload = $request->all();

        $section = Section::create($payload);
        $section->load($this->relationships);

        return response()->json($section, 201);
    }

    public function show(Section $section)
    {
        $section->load($this->relationships);

        return response()->json($section);
    }

    public function update(Request $request, Section $section)
    {
        $section->fill($request->all())->save();
        $section->load($this->relationships);

        return response()->json($section);
    }

    public function destroy(Section $section)
    {
        $section->delete();

        return response()->json(['message' => 'Section deleted successfully']);
    }
}
