<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    function create()
    {

        return view('student.create');
    }

    function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required'
            ]);

            $studentData = $request->only(['name', 'email', 'phone','address','image','gender','dob']);
            $record = Student::create($studentData);

            if ($record) {
                foreach ($request->educations as $educationData) {
                    $educationData['student_id'] = $record->id;
                    Education::create($educationData);
                }

                $request->session()->flash('success', 'Student created successfully');
            } else {
                $request->session()->flash('error', 'Student creation failed');
            }
        } catch (\Exception $exception) {
            request()->session()->flash('error', "Error: " . $exception->getMessage());
        }
        return redirect()->route('student.create');
    }

}
