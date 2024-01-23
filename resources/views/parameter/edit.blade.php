@extends('layout.adminPanel')
@section('content')
<div class="container mt-5">
    <form action="{{ route('parameters.update', ['parameter' => $parameter->id, 'category' => $category_id]) }}"
        method="POST">
        @csrf
        @method('patch')
        {{$parameter}}
        <div class="form-group">
            <label for="name">Название:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$parameter->name}}" required>
        </div>
        <div class="form-group">
            <label for="type">Тип:</label>
            {{-- <input type="text" class="form-control" id="type" name="type" value="{{$parameter->type}}" required> --}}
            <select class="form-control" name="type" id="">
                <option>select</option>
                <option>multiselect</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Изменить</button>
    </form>
</div>
@endsection
