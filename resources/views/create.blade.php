@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Exam</h2>
                <form action="create" METHOD="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                            <label for="exam_name">Exam Name:</label>
                            <input type="text" name="exam_name" id="exam_name" class="form-control" value="{{ old('exam_name') }}">
                    </div>
                    <div clas="form-group">
                            <button type="submit" class="btn btn-default">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop