<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::query();

        // Filtering
        if ($request->has('year')) {
            $students->where('year', $request->year);
        }
        if ($request->has('course')) {
            $students->where('course', $request->course);
        }
        if ($request->has('section')) {
            $students->where('section', $request->section);
        }
        // Add other filters as needed...

        return response()->json([
            'metadata' => [
                'count' => $students->count(),
                'search' => $request->query(),
                'limit' => $request->limit,
                'offset' => $request->offset,
                'fields' => $request->fields,
            ],
            'students' => $students->get()
        ]);
    }

    public function store(Request $request)
    {
        $student = Student::create($request->all());
        return response()->json($student, 201);
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        return response()->json($student);
    }
}
