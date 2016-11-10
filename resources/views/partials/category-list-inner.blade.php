<option value="{{ $category->id }}">{{ str_repeat('-',(Category::level($category))*4) . $category->name }}</option>

@foreach ($category->where('parent_id', '=', $category->id)->get() as $category)
    @include('partials.category-list-inner', $category)
@endforeach