@extends('layouts.app')
@section('content')

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

    @include('partials.nav-button-group')

    <div class="col-md-4">
        Available Questions
        <select size="20" style="width: 100%">
        </select>
    </div>
    
    @include('partials.add-edit-delete-group')
</div>

<div class="row">
    <div clas="form-group">
        <button type="button" class="btn btn-lg btn-primary" style="margin: 10px">
            Save
        </button>
    </div>
</div>
@stop