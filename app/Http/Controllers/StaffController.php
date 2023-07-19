<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class StaffController extends Controller
{
    private $relationships = [
        'schoolYear',
        'information',
    ];

    public function getYearbook(Request $request)
    {
        $filters = $request->only([
            'school_year_id',
        ]);
        $query = Staff::query();
        foreach ($filters as $filter => $value) {
            if (isset($value)) {
                $query->where('staff.' . $filter, $value);
            }
        }
        $staffs = $query->with($this->relationships)
            ->join('information', 'staff.information_id', '=', 'information.id')
            ->orderBy('information.last_name')
            ->paginate(9);
        return response()->json($staffs);
    }


    public function index(Request $request)
    {
        $filters = $request->only(['school_year_id']);
        $query = Staff::query();
        foreach ($filters as $filter => $value) {
            if (isset($value)) {
                $query->where($filter, $value);
            }
        }
        $staffs = $query->with($this->relationships)->get();
        return response()->json($staffs);
    }

    public function store(Request $request)
    {
        $payload = $request->all();
        $staff = Staff::create($payload);
        $staff->load($this->relationships);
        return response()->json($staff, 201);
    }

    public function show(Staff $staff)
    {
        $staff->load($this->relationships);
        return response()->json($staff);
    }

    public function update(Request $request, string $id)
    {
        $staff = Staff::findOrFail($id);
        $staff->fill($request->all())->save();
        $staff->load($this->relationships);
        return response()->json($staff);
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();
        return response()->json(['message' => 'Staff deleted successfully']);
    }
}
