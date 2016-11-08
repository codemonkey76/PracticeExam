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
            <div class="row"><button class="form-control">&uarr;</button></div>
            <div class="row"><button class="form-control">&darr;</button></div>
            <div class="row"><button class="form-control">&larr;</button></div>
            <div class="row"><button class="form-control">&rarr;</button></div>
            <div class="row"><button class="form-control">&#8677;</button></div>
        </div>
        <div class="col-md-4">
            Available Questions
            <select size="20" style="width: 100%">
            </select>
        </div>
        <div class="col-md-1">
            <div class="row">&nbsp;</div>
            <div class="row"><button class="form-control">Add</button></div>
            <div class="row"><button class="form-control">Edit</button></div>
            <div class="row"><button class="form-control">Delete</button></div>
        </div>
    </div>
</div>
@stop