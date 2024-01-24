@extends('layout.adminPanel')
@section('content')
    <div class="container mt-5">
        <form action="{{ route('options.update', ['option' => $option->id, 'parameter' => $parameter_id]) }}"
            method="POST">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="name">Название:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $option->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Изменить</button>
        </form>
    </div>
@endsection
