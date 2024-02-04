@extends('layout.adminPanel')
@section('content')
    <div class="container mt-5">
        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('patch')
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="form-group mb-2">
                <label for="name">Имя (логин): </label>
                <input class="form-control" type="text" name="name" value="{{$user->name}}">
            </div>
            <div class="form-group mb-2">
                <label for="role">Роль: </label>
                <select class="form-select" id="role" name="role">
                    <option {{ $user->role === 'user' ? 'selected' : '' }}>user</option>
                    <option {{ $user->role === 'moderator' ? 'selected' : '' }}>moderator</option>
                    <option {{ $user->role === 'admin' ? 'selected' : '' }}>admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('user.index') }}" type="button" class="btn btn-success">back</a>

        </form>
    </div>
@endsection
