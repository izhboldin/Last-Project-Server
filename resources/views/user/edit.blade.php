@extends('layout.adminPanel')
@section('content')
    <div class="container mt-5">
        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('patch')
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="form-group mb-2">
                <label for="parent_category_id">Role: </label>
                <select class="form-select" id="parent_category_id" name="role">
                    <option {{ $user->role === 'user' ? 'selected' : '' }}>user</option>
                    <option {{ $user->role === 'moderator' ? 'selected' : '' }}>moderator</option>
                    <option {{ $user->role === 'admin' ? 'selected' : '' }}>admin</option>
                </select>
            </div>
            {{-- <div class="form-group mb-2">
                <label for="name">name*</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                    value="{{ $category->name }}">
            </div>
            <div class="form-group mb-2">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Description">{{ $category->description }}</textarea>
            </div>
            <label for="">is_main_category*</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="1" name="is_main_category"
                    id="is_main_category1">
                <label class="form-check-label" for="is_main_category1">Yes</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="0" name="is_main_category" id="is_main_category2"
                    checked>
                <label class="form-check-label" for="is_main_category2">No</label>
            </div> --}}
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('user.index') }}" type="button" class="btn btn-success">back</a>

        </form>
    </div>
@endsection
