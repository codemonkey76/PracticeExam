<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    public function index()
    {
        $exams = Exam::all();
        return view('exam.index', compact('exams'));
    }
    public function getQuestions(Request $request)
    {
        $exam_id = $request['exams'];
        
        if ($exam_id == null)
            return back();
        try {
            $exam = Exam::findOrFail($exam_id);
        } catch (ModelNotFoundException $e) {
            return back();
        }
        
        return redirect("exam/" . $exam->id . "/question");
    }
    public function show()
    {
        
    }
    public function create()
    {
    }

    public function store(Request $request)
    {
        $exam = new Exam($request->all());
        $exam->save();
        return back();
    }

    public function destroy($id)
    {
        Exam::findOrFail($id)->delete();
        return back();
    }
    public function update()
    {
        
    }
    public function edit()
    {
        
    }
}
