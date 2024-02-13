@extends('layout.adminPanel')
@section('content')
    <div class="container mt-5">
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <input type="hidden" name="id" value="{{ $category->id }}">
            <div class="form-group mb-2">
                <label for="parent_category_id">Имя родительской категории:</label>
                <select class="form-select" id="parent_category_id" name="parent_category_id">
                    <option value="" {{ $category->parent_category_id ? '' : 'selected' }}>No parent</option>
                    @foreach ($categories->where('id', '!=', $category->id) as $item)
                        <option {{ $category->parent_category_id === $item->id ? 'selected' : '' }}
                            value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="name">Название*</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Введите название"
                    value="{{ $category->name }}">
            </div>
            <div class="form-group mb-2">
                <label for="description">Описание</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Введите описание">{{ $category->description }}</textarea>
            </div>
            <div class="form-group mb-2">
                <label for="description">Изображение:</label>
                <input type="file" class="form-control" id="images" name="images[0][file]"
                    placeholder="Введите название">
            </div>
            <input class="form-check-input" type="hidden" value="1" name="is_main_category" id="is_main_category1">
            {{-- <label for="">is_main_category*</label>
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
            <button type="submit" class="btn btn-primary">обновить</button>
            <a href="{{ route('categories.index') }}" type="button" class="btn btn-success">назад</a>

        </form>
    </div>
@endsection
