<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class StudentController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getStudents()
    {
        try {
            // Fetch all students data from the model
            $students = Student::all();

            // Return the list of students
            return response()->json($students);
        } catch (\Exception $e) {
            // Handle errors
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function showStudents(){
        $students = Student::all();
        return view('students',compact('students'));
    }

    public function getStudentById($id)
    {
        try {
            // Fetch the student data from the database by ID
            $student = Student::find($id);

            // If student with the given ID is found, return the data
            if ($student) {
                return response()->json($student);
            } else {
                // If student with the given ID is not found, return "Student not found" message
                return response()->json(['error' => 'Student not found'], 404);
            }
        } catch (\Exception $e) {
            // Handle errors
            // For simplicity, just return an error message
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

}
