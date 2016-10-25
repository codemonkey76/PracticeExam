@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h2><a href="/exam/{{ $exam->id }}/question">{{ $exam->exam_name }}</a></h2>
            <h3>{{ $question->questionText }}</h3>
            <form method="POST" action="/exam/{{ $exam->id }}/question/{{ $question->id }}/option">
                {{ csrf_field() }}
                <select name="options" size="10" style="width: 100%">
                    @foreach ($question->options()->get() as $option)
                        <option value="{{ $option->id }}">{{ $option->option_text }}</option>
                    @endforeach
                </select>
                <br><br>
                <div class="form-group">
                        <label for="option_text">Option:</label>
                        <input type="text" name="option_text" id="option_text" class="form-control" value="{{ old('option_text') }}" autofocus>
                </div>
                <div clas="form-group">
                        <button type="submit" class="btn btn-default">Add Option</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop