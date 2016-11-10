@extends('layouts.app')
@section('content')
@can('create', App\Category::class)
<form method="POST" action="/category">
    <div class="col-md-6">
        {{ csrf_field() }}

        <div class="row">
            <h2>Create new category</h2>

            <div class="form-group">
                    <label for="name">Category Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="parent">Choose Parent Category:</label>
                @include('partials.category-list-outer')
            </div>
        </div>
        <div class="row">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="row">
            <button type="submit" class="btn btn-lrg btn-primary">
                Save Category
            </button>
        </div>

    </div>
</form>
@endcan
@stop