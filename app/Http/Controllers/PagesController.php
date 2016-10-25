<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests;
use Illuminate\Http\Request;

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
        return view('pages.home');
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
