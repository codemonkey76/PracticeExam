@extends('layouts.app')

@section('content')
<h1>Welcome to the dashboard</h1>

<div class="container">

    <div class="row">
            @include('your-exams')
            @include('all-exams')
    </div>
    <a class="btn btn-primary" href="/category/create">Create Category</a>
</div>
@stop
