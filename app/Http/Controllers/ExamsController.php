<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Answer;
use App\Results;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamsController extends Controller
{
    public function index()
    {
        $exams = Exam::all();
        return view('exam.index', compact('exams'));
    }
    public function practiceExam(Request $request)
    {
        $exam_id = $request['exams'];

        if ($exam_id == null)
            return back();
        
        return redirect("/exam/" . $exam_id . "/practice");
    }
    public function getQuestions(Request $request)
    {
        $exam_id = $request['exams'];
        return redirect("/exam/" . $exam_id . "/question");
    }
    public function show()
    {
        
    }
    public function create()
    {
        return view('exam.create');
    }

    public function store(Request $request)
    {
        Auth::user()->exams()->save(new Exam($request->all()));
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
    public function practice($exam_id)
    {
        try
        {
            $exam = Exam::findOrFail($exam_id);
            return view('exam.practice', compact('exam'));
        } catch (Exception $e)
        {
            return back();
        }
    }

    public function model($exam_id)
    {
        $exam = Exam::findOrFail($exam_id);
        return view('exam.model', compact('exam'));
    }
    
    public function results($exam_id, Request $request)
    {
        $results = [];
        try
        {
            $exam = Exam::findOrFail($exam_id);
            $user_id = -1;

            if (Auth::check())
            {
                $user_id = Auth::user()->id;
            }

            foreach($exam->questions()->get() as $question)
            {
                $result = null;

                if ($user_id>=0)
                {
                    $result = Results::where('user_id','=',$user_id)
                        ->where('question_id','=', $question->id)
                        ->first();
                }

                if ($result==null)
                {
                    $result = new Results;
                    $result->user_id = $user_id;
                    $result->question_id = $question->id;
                }

                if ($request[$question->id]!=null)
                {
                    if ($question->options()->count()==0)
                        $result->model_text = $request[$question->id];
                    else
                        $result->option_id = $request[$question->id];
                }

                if ($result->user_id>=0)
                    $result->save();

                $results[$question->id] = $result;
            }
            //var_dump($results);
            flash()->success('Success!', 'Submitted Results');
            return view('exam.results', compact('results','exam'));
        } catch (Exception $e)
        {
            return back();
        }
    }

    public function answers($exam_id, Request $request)
    {
        $exam = Exam::findOrFail($exam_id);
        $questions = $exam->questions()->get();
        foreach ($questions as $question)
        {
            if ($question->options()->get()->count()==0)
            {
                // Store model text answer.
                $question->model_text = $request[$question->id];
            }
            else
            {
                // Store correct option.
                $question->option_id =  $request[$question->id];
            }
            $question->save();
        }

        flash()->success('Success!', 'Your answers have been submitted.');
        
        return redirect("/exam/$exam_id/question");
    }
}
