<?php

namespace App\Http\Controllers;

use App\Models\StudentModel;
use Illuminate\Http\Request;

class StudentModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = StudentModel::all();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'matricNo' => 'required|unique:students,matricNo',
        ]);

        StudentModel::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentModel $studentModel)
    {
        return view('students.show', compact('studentModel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentModel $studentModel)
    {
        return view('students.edit', compact('studentModel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentModel $studentModel)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $studentModel->id,
            'matricNo' => 'required|unique:students,matricNo,' . $studentModel->id,
        ]);

        $studentModel->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentModel $studentModel)
    {
        $studentModel->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

        // Show form to manage courses for a student
    public function manageCourses(StudentModel $studentModel)
    {
        $courses = \App\Models\Course::all(); // get all available courses
        return view('students.manage_courses', compact('studentModel', 'courses'));
    }

    // Update the courses assigned to a student
    public function updateCourses(Request $request, StudentModel $studentModel)
    {
        $selectedCourses = $request->input('courses', []); // array of selected course IDs

        // Sync courses (attach new, detach removed)
        $studentModel->courses()->sync($selectedCourses);

        return redirect()->route('students.index')->with('success', 'Courses updated successfully.');
    }

}
