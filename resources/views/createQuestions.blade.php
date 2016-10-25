@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form method="POST" name="Select" action="createQuestions">
                {{ csrf_field() }}
                <input type="hidden" name="exam" value="selected">
                <select name="exams" onchange="this.form.submit()">
                @foreach ($exams as $exam)
                 <option value="{{ $exam->id }}" {{ ($exam->id==$exam_id) ? 'selected' : ''}}>{{ $exam->exam_name }}</option>
                @endforeach
                </select>
            </form>
            <form method="POST" name="Question" action="createQuestions">
                {{ csrf_field() }}
                <div class="form-group">
                        <label for="questionText">Question:</label>
                        <input type="text" name="questionText" id="questionText" class="form-control" value="{{ old('questionText') }}">
                </div>
                <div clas="form-group">
                        <button type="submit" class="btn btn-default">Add</button>
                </div>
                <select size="10" name="questions">
                    @foreach ($questions as $question)
                        <option value="{{$question->id }}">{{ $question->questionText }}</option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>
</div>
@stop