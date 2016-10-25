<?php

namespace App\Http\Controllers;

use App\Option;
use App\Question;
use App\Http\Requests;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    public function store($exam_id, $question_id, Request $request)
    {
        //$exam = Exam::findOrFail($exam_id);
        $question = Question::findOrFail($question_id);
        //dd($request->all());
        $question->options()->save(new Option($request->all()));
        return back();
        //$request->all();
        //$option = new Option($request->all())
        //dd("Exam ID: " . $exam_id . ", Question ID: " . $question_id);
        //
        
        dd($request);
        // $exam = new Exam($request->all());
        // $exam->save();
        // return redirect("exam/{$exam->id}");
    }
}
