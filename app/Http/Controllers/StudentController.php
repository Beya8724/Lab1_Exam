<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Show all students
    public function index()
    {
        $students = Student::all();
        return view('students', compact('students'));
    }

    // Store new student
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'course' => 'required',
        ]);

        Student::create($request->all());

        return redirect('/')->with('success', 'Student added successfully!');
    }

    // Show form to edit student
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students_edit', compact('student'));
    }

    // Update existing student
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'course' => 'required',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect('/')->with('success', 'Student updated successfully!');
    }

    // Delete student
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect('/')->with('success', 'Student deleted successfully!');
    }
}
