@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome to the dashboard</h1>

    <div class="container">

        <div class="row">
                @include('your-exams')
                @include('all-exams')
        </div>
        
    </div>
</div>
@stop
