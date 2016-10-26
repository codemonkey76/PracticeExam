@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <a class="btn btn-lg btn-primary" href="/exam" role="button">&lt;&lt; Back</a>
            <h3>{{ $exam->exam_name }}</h3>
            <form method="POST" action="getOptions">
                {{ csrf_field() }}
                <select name="questions" size="10" style="width: 100%">
                    @foreach ($exam->questions()->get() as $question)
                        <option value="{{ $question->id }}">{{ $question->questionText }}</option>
                    @endforeach
                </select>
                <br><br>
                <div clas="form-group">
                        <button type="submit" class="btn btn-default">Add Options</button>
                </div>
            </form>
            <form method="POST" action="/exam/{{ $exam->id }}/question">
                {{ csrf_field() }}
                <div class="form-group">
                        <label for="questionText">Question:</label>
                        <input type="text" name="questionText" id="questionText" class="form-control" value="{{ old('questionText') }}" autofocus>
                </div>
                <div clas="form-group">
                        <button type="submit" class="btn btn-default">Add Question</button>
                </div>
                <a href="/exam/{{ $exam->id }}/practice" class="btn btn-lg btn-primary">Practice Exam</a>
            </form>

        </div>

    </div>
</div>
@stop