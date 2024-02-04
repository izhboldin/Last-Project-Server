@extends('layout.adminPanel')
@section('content')
    <div class="container mt-5">
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('patch')
            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="form-group mb-2">
                <label for="name">Название: </label>
                <input class="form-control" type="text" name="title" value="{{$product->title}}">
            </div>
            <div class="form-group mb-2">
                <label for="name">Описание: </label>
                <input class="form-control" type="text" name="description" value="{{$product->description}}">
            </div>
            <div class="form-group mb-2">
                <label for="price">Цена: </label>
                <input class="form-control" type="text" name="price" value="{{$product->price}}">
            </div>
            <div class="form-group mb-2">
                <label for="role">Статус: </label>
                <select class="form-select" id="status" name="status">
                    <option {{ $product->status === 'active' ? 'selected' : '' }}>active</option>
                    <option {{ $product->status === 'wait' ? 'selected' : '' }}>wait</option>
                    <option {{ $product->status === 'notActive' ? 'selected' : '' }}>notActive</option>
                    <option {{ $product->status === 'reject' ? 'selected' : '' }}>reject</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('products.index') }}" type="button" class="btn btn-success">back</a>

        </form>
    </div>
@endsection
