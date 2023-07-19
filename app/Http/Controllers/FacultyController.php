<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;

class FacultyController extends Controller
{

    private $relationships = [
        'schoolYear',
        'department',

        'information',
    ];

    public function getYearbook(Request $request)
    {
        $filters = $request->only([
            'school_year_id',
            'department_id',
        ]);

        $query = Faculty::query();

        foreach ($filters as $filter => $value) {
            if (isset($value)) {
                $query->where('faculties.' . $filter, $value);
            }
        }

        $faculties = $query->with($this->relationships)
            ->join('information', 'faculties.information_id', '=', 'information.id')
            ->orderBy('information.last_name')
            ->paginate(9);

        return response()->json($faculties);
    }

    public function index(Request $request)
    {
        $filters = $request->only(['school_year_id', 'department_id']);

        $query = Faculty::query();

        foreach ($filters as $filter => $value) {
            if (isset($value)) {
                $query->where($filter, $value);
            }
        }

        $faculties = $query->with($this->relationships)->get();
        return response()->json($faculties);
    }

    public function store(Request $request)
    {
        $payload = $request->all();
        $faculty =  Faculty::create(array_merge($payload,));
        $faculty->load($this->relationships);
        return response()->json($faculty, 201);
    }

    public function show(Faculty $faculty)
    {
        $faculty->load($this->relationships);
        return response()->json($faculty);
    }

    public function update(Request $request, string $id)
    {
        $faculty = Faculty::find($id);
        $faculty->fill($request->all())->save();
        $faculty->load($this->relationships);
        return response()->json($faculty);
    }
    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
        return response()->json(['message' => 'Faculty member deleted successfully']);
    }
}
