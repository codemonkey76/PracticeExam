@extends('layouts.app')
@section('content')
<div class="container">
    <div class="form-group">
            <label for="examname">Exam Name:</label>
            <input type="text" name="examname" id="examname" class="form-control" value="{{ old('examname') }}">
    </div>
    <div class="row">
        <div class="col-md-4">
            Questions for exam
            <select size="20" style="width: 100%">
            </select>
        </div>
        <div class="col-md-1">
            <div class="row">&nbsp;</div>
            <div class="row"><button class="btn btn-default" style="width: 50px">&uarr;</button></div>
            <div class="row"><button class="btn btn-default" style="width: 50px">&darr;</button></div>
            <div class="row"><button class="btn btn-default" style="width: 50px">&larr;</button></div>
            <div class="row"><button class="btn btn-default" style="width: 50px">&rarr;</button></div>
            <div class="row"><button class="btn btn-default" style="width: 50px">&#8677;</button></div>
        </div>
        <div class="col-md-4">
            Available Questions
            <select size="20" style="width: 100%">
            </select>
        </div>
        <div class="col-md-1">
            <div class="row">&nbsp;</div>
            <div class="row"><a class="btn btn-default" style="width: 80px" href="exam/1/create">Add</a></div>
            <div class="row"><button class="btn btn-default" style="width: 80px">Edit</button></div>
            <div class="row"><a class="btn btn-default" style="width: 80px">Delete</a></div>
        </div>
    </div>
    <div class="row">
        <div clas="form-group">
            <button type="button" class="btn btn-lg btn-primary" style="margin: 10px">
                Save
            </button>
        </div>
    </div>
</div>
@stop