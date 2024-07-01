<?php
namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index($studentId, Request $request)
    {
        $subjects = Subject::where('student_id', $studentId);

        // Filtering
        if ($request->has('remarks')) {
            $subjects->where('remarks', $request->remarks);
        }
        // Add other filters as needed...

        return response()->json([
            'metadata' => [
                'count' => $subjects->count(),
                'search' => $request->query(),
                'limit' => $request->limit,
                'offset' => $request->offset,
                'fields' => $request->fields,
            ],
            'subjects' => $subjects->get()
        ]);
    }

    public function store($studentId, Request $request)
    {
        $subject = new Subject($request->all());
        $subject->student_id = $studentId;
        $subject->average_grade = ($subject->prelims + $subject->midterms + $subject->pre_finals + $subject->finals) / 4;
        $subject->remarks = $subject->average_grade >= 3.0 ? 'PASSED' : 'FAILED';
        $subject->save();

        return response()->json($subject, 201);
    }

    public function show($studentId, $subjectId)
    {
        $subject = Subject::where('student_id', $studentId)->findOrFail($subjectId);
        return response()->json($subject);
    }

    public function update(Request $request, $studentId, $subjectId)
    {
        $subject = Subject::where('student_id', $studentId)->findOrFail($subjectId);
        $subject->update($request->all());
        $subject->average_grade = ($subject->prelims + $subject->midterms + $subject->pre_finals + $subject->finals) / 4;
        $subject->remarks = $subject->average_grade >= 3.0 ? 'PASSED' : 'FAILED';
        $subject->save();

        return response()->json($subject);
    }
}
