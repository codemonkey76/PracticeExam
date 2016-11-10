<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function store(Request $request)
    {
        $exam = new Exam($request->all('exam_name'));
        $exam->save();
    }
    public function about()
    {
        return view('pages.about');
    }
    public function home()
    {
        $exams = Exam::all();
        
        return view('pages.home', compact('exams'));
    }
    public function contact()
    {
        return view('pages.contact');
    }
    public function create()
    {
        return view('create');
    }
    
}
