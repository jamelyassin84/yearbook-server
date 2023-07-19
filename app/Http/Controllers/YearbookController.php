<?php

namespace App\Http\Controllers;

use App\Models\Yearbook;

class YearbookController extends Controller
{

    public function index(string $schoolYearId)
    {
        $yearbook = Yearbook::with(
            'schoolYear',

            'schoolYear.students',
            'schoolYear.students.information',
            'schoolYear.students.information.picture',

            'schoolYear.staffs',
            'schoolYear.staffs.information',
            'schoolYear.staffs.information.picture',

            'schoolYear.schoolAdmin',
            'schoolYear.schoolAdmin.information',
            'schoolYear.schoolAdmin.information.picture',

            'schoolYear.faculty',
            'schoolYear.faculty.department',
            'schoolYear.faculty.information',
            'schoolYear.faculty.information.picture',

            'schoolYear.events',
        )
            ->where('school_year_id', $schoolYearId)
            ->first();

        return response()->json($yearbook);
    }
}
