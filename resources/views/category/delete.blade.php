@extends('layout.adminPanel')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title">ID: {{ $category->id }}</h4>
                        <p class="card-text">Parent Category ID: {{ $category->parent_category_id }}</p>
                        <p class="card-text">Name: {{ $category->name }}</p>
                        <p class="card-text">Description: {{ $category->description }}</p>
                        <p class="card-text">is_main_category: {{ $category->is_main_category }}</p>
                        <p class="card-text">Created At: {{ $category->created_at->format('Y-m-d H:i:s') }}</p>
                        <p class="card-text">Updated At: {{ $category->updated_at->format('Y-m-d H:i:s') }}</p>
                        <a href="{{ route('categories.index') }}" type="button" class="btn btn-success">back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
