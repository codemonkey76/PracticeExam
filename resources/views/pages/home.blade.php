@extends('layouts.app')

@section('content')
<h1>Welcome to the dashboard</h1>

<div class="container">

    <div class="row">
            @include('your-exams')
            @include('all-exams')
    </div>
    
</div>
@stop
