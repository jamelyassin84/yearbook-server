<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    private $relationships = [
        'schoolYear',
        'courses',
    ];

    public function index(Request $request)
    {
        $filters = $request->only(['school_year_id']);
        $query = Department::query();
        foreach ($filters as $filter => $value) {
            if (isset($value)) {
                $query->where($filter, $value);
            }
        }
        $departments = $query->with($this->relationships)->get();
        return response()->json($departments);
    }

    public function store(Request $request)
    {
        $payload = $request->all();
        $department = Department::create($payload);
        $department->load($this->relationships);
        return response()->json($department->refresh(), 201);
    }

    public function show(Department $department)
    {
        $department->load($this->relationships);
        return response()->json($department);
    }

    public function update(Request $request, Department $department)
    {
        $department->fill($request->all())->save();
        $department->refresh()->load($this->relationships);

        return response()->json($department, 200);
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json(['message' => 'Department deleted successfully']);
    }
}
