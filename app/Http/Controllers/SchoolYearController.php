<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    private $relationships = [
        'faculties',
        'students',
        'staffs',
        'schoolAdmins',
        'schoolEvents',
    ];

    public function index()
    {
        $schoolYears = SchoolYear::withCount($this->relationships)->get();
        return response()->json($schoolYears);
    }

    public function store(Request $request)
    {
        $payload = $request->all();
        $schoolYear = SchoolYear::create($payload);
        $schoolYear->loadCount($this->relationships);
        return response()->json($schoolYear, 201);
    }

    public function show(SchoolYear $schoolYear)
    {
        $schoolYear->loadCount($this->relationships);
        return response()->json($schoolYear);
    }

    public function update(Request $request, SchoolYear $schoolYear)
    {
        $schoolYear->fill($request->all())->save();
        $schoolYear->refresh()->loadCount($this->relationships);

        return response()->json($schoolYear, 200);
    }

    public function destroy(SchoolYear $schoolYear)
    {
        $data = $schoolYear;
        $schoolYear->delete();
        return response()->json($data);
    }
}
