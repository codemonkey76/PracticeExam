@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <a class="btn btn-lg btn-primary" href="/exam" role="button">&lt;&lt; Back</a>
            <h3>{{ $exam->exam_name }}</h3>
            @if (Auth::check() && Auth::user()->id==$exam->user_id)
                <form method="POST" action="getOptions">
                    {{ csrf_field() }}
                    <select name="questions" size="10" style="width: 100%">
                        @foreach ($exam->questions()->get() as $question)
                            <option value="{{ $question->id }}">{{ $question->questionText }}</option>
                        @endforeach
                    </select>
                    <br><br>
                    <div clas="form-group">
                        <button type="submit" class="btn btn-default">Options</button>
                    </div>
                </form>
            @else
                <ul>
                <?php
                    $index = 1;
                    foreach ($exam->questions()->get() as $question)
                    {
                        echo sprintf("<li>Q%s. %s", $index, $question->questionText);
                        $index+=1;
                    }
                ?>
                </ul>
            @endif
            <form method="POST" action="/exam/{{ $exam->id }}/question">
                {{ csrf_field() }}
                @if (Auth::check() && Auth::user()->id==$exam->user_id)
                    <div class="form-group">
                        <label for="questionText">Question:</label>
                        <input type="text" name="questionText" id="questionText" class="form-control" value="{{ old('questionText') }}" autofocus>
                    </div>
                    <div clas="form-group">
                            <button type="submit" class="btn btn-default">Add Question</button>
                    </div>
                @endif
            </form>
            <br><br>
            @if (Auth::check()) :
                <a href="/exam/{{ $exam->id }}/practice" class="btn btn-lg btn-primary">Practice Exam</a>

                <br><br>
                <a href="/exam/{{ $exam->id }}/model" class="btn btn-lg btn-primary">Submit Model Answers</a>
            @endif
        </div>

    </div>
</div>
@stop