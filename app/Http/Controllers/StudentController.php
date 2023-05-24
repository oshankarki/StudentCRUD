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
                'phone' => 'required',
                'image' => 'required|image|max:2048', // Validation rule for the image
            ]);

            $studentData = $request->only(['name', 'email', 'phone', 'address', 'gender', 'dob']);

            // Store the image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->storeAs('public/images', $imageName);
                $studentData['image'] = $imageName;
            }

            $student = Student::create($studentData);
            if ($student) {
                foreach ($request['level'] as $key => $educationData) {
                    $education = new Education();
                    $education->student_id = $student->id;
                    $education->level = $request->level[$key];
                    $education->college = $request->college[$key];
                    $education->university = $request->university[$key];
                    $education->start_date = $request->start_date[$key];
                    $education->end_date = $request->end_date[$key];
                    $education->save();
                    $request->session()->flash('success', 'Student created successfully');
                }
            } else {
                $request->session()->flash('error', 'Student creation failed');
            }
        } catch (\Exception $exception) {
            request()->session()->flash('error', "Error: " . $exception->getMessage());
        }

        return redirect()->route('student.index');
    }



    public function index()
    {

        $data['records'] = Student::all();
        return view('student.index', compact('data'));
    }
    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();

            session()->flash('success', 'Student deleted successfully');
        } catch (\Exception $exception) {
            session()->flash('error', 'Error: ' . $exception->getMessage());
        }

        return redirect()->route('student.index');
    }
    public function show($id)
    {
        $data['record'] = Student::find($id);
        if(!$data['record' ]){
            request()->session()->flash('error',"Error:Invalid Request");
            return redirect()->route('student.index');

        }
        return view(('student.show'),compact('data'));
    }
    public function edit($id)
    {
        $data['record'] = Student::find($id);
        if(!$data['record' ]){
            request()->session()->flash('error',"Error:Invalid Request");
            return redirect()->route('student.index');

        }
        return view(('student.edit '),compact('data'));
    }
    function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'image' => 'image|max:2048', // Updated validation rule for the image (optional)
            ]);

            $student = Student::findOrFail($id);

            // Update student data
            $student->name = $request->input('name');
            $student->email = $request->input('email');
            $student->phone = $request->input('phone');
            $student->address = $request->input('address');
            $student->gender = $request->input('gender');
            $student->dob = $request->input('dob');


            if ($request->hasFile('image')) {
                // Delete previous image
                $previousImagePath = public_path('images/' . $student->image);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }

                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $imageName);
                $student->image = $imageName;
            }

            $student->save();

            $student->educations()->delete();

            if ($student) {
                foreach ($request['level'] as $key => $educationData) {
                    $education = new Education();
                    $education->student_id = $student->id;
                    $education->level = $request->level[$key];
                    $education->college = $request->college[$key];
                    $education->university = $request->university[$key];
                    $education->start_date = $request->start_date[$key];
                    $education->end_date = $request->end_date[$key];
                    $education->save();
                    $request->session()->flash('success', 'Student Updated successfully');
                }
            } else {
                $request->session()->flash('error', 'Student Updation failed');
            }

            $request->session()->flash('success', 'Student updated successfully');
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
        }

        return redirect()->route('student.index');
    }



}
