@extends('layout.adminPanel')
@section('content')
    <div class="container mt-5">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group mb-2">
                <label for="parent_category_id">parent_category_name</label>
                <select class="form-control" id="parent_category_id" name="parent_category_id">
                    <option value="">empty</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="name">name*</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
            </div>
            <div class="form-group mb-2">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Description"></textarea>
            </div>
            <label for="">is_main_category*</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="1" name="is_main_category"
                    id="is_main_category1">
                <label class="form-check-label" for="is_main_category1">
                    Yes
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="0" name="is_main_category" id="is_main_category2"
                    checked>
                <label class="form-check-label" for="is_main_category2">
                    No
                </label>
            </div>
            {{-- <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="is_main_category"
                    name="is_main_category">
                <label class="form-check-label" for="is_main_category">
                    Checked checkbox
                </label>
            </div> --}}
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('categories.index') }}" type="button" class="btn btn-success">back</a>

        </form>
    </div>
@endsection
