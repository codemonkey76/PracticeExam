@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h1>Display all exams here</h1>
            <form method="POST" action="/getQuestions">
                {{ csrf_field() }}
                <select name="exams" size="10" style="width: 100%">
                    @foreach ($exams as $exam)
                        <option value="{{ $exam->id }}">{{ $exam->exam_name }}</option>
                    @endforeach
                </select>
                <br><br>
                <div clas="form-group">
                        <button type="submit" class="btn btn-default">Add Questions</button>
                </div>
            </form>
            <form method="POST" action="/exam">
                {{ csrf_field() }}
                <div class="form-group">
                        <label for="exam_name">Exam Name:</label>
                        <input type="text" name="exam_name" id="exam_name" class="form-control" value="{{ old('exam_name') }}" autofocus>
                </div>
                <div clas="form-group">
                        <button type="submit" class="btn btn-default">Add Exam</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop