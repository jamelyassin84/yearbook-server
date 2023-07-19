<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolAdmin;

class SchoolAdminController extends Controller
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

        $query = SchoolAdmin::query();

        foreach ($filters as $filter => $value) {
            if (isset($value)) {
                $query->where('school_admins.' . $filter, $value);
            }
        }

        $schoolAdmins = $query->with($this->relationships)
            ->join('information', 'school_admins.information_id', '=', 'information.id')
            ->orderBy('information.last_name')
            ->paginate(9);
        return response()->json($schoolAdmins);
    }

    public function index(Request $request)
    {
        $filters = $request->only(['school_year_id']);
        $query = SchoolAdmin::query();
        foreach ($filters as $filter => $value) {
            if (isset($value)) {
                $query->where($filter, $value);
            }
        }
        $schoolAdmins = $query->with($this->relationships)->get();
        return response()->json($schoolAdmins);
    }

    public function store(Request $request)
    {
        $payload = $request->all();
        $schoolAdmin =  SchoolAdmin::create(array_merge($payload));
        $schoolAdmin->load($this->relationships);
        return response()->json($schoolAdmin, 201);
    }

    public function show(SchoolAdmin $schoolAdmin)
    {
        $schoolAdmin->load($this->relationships);
        return response()->json($schoolAdmin);
    }

    public function update(Request $request, string $id)
    {
        $schoolAdmin = SchoolAdmin::find($id);
        $schoolAdmin->fill($request->all())->save();
        $schoolAdmin->load($this->relationships);
        return response()->json($schoolAdmin);
    }

    public function destroy(SchoolAdmin $schoolAdmin)
    {
        $schoolAdmin->delete();
        return response()->json(['message' => 'School admin deleted successfully']);
    }
}
