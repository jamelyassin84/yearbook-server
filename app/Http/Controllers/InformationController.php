<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;

class InformationController extends Controller
{
    public function store(Request $request)
    {
        $payload = $request->all();
        $information = Information::create($payload);

        $newPayload = array_merge(['information_id' => $information->id], $payload);

        if ($payload['type'] === 'Student') {
            $studentController = new StudentController();
            return $studentController->store($request->merge($newPayload));
        }

        if ($payload['type'] === 'Faculty') {
            $facultyController = new FacultyController();
            return $facultyController->store($request->merge($newPayload));
        }

        if ($payload['type'] === 'Staff') {
            $staffController = new StaffController();
            return $staffController->store($request->merge($newPayload));
        }

        if ($payload['type'] === 'School Admin') {
            $schoolAdminController = new SchoolAdminController();
            return $schoolAdminController->store($request->merge($newPayload));
        }

        return $information;
    }


    public function update(Request $request,)
    {
        $payload = $request->all();
        $information = Information::where('id', $payload['information_id'])->first();
        $information->fill($payload)->save();


        if ($payload['type'] === 'Student') {
            $studentController = new StudentController();
            return $studentController->update($request->merge($payload), $payload['id']);
        }

        if ($payload['type'] === 'Faculty') {
            $facultyController = new FacultyController();
            return $facultyController->update($request->merge($payload), $payload['id']);
        }

        if ($payload['type'] === 'Staff') {
            $staffController = new StaffController();
            return $staffController->update(
                $request->merge($payload),
                $payload['id']
            );
        }

        if ($payload['type'] === 'School Admin') {
            $schoolAdminController = new SchoolAdminController();
            return $schoolAdminController->update($request->merge($payload), $payload['id']);
        }
    }
}
