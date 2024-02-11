@extends('layout.adminPanel')
@section('content')
    <div class="container mt-5">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group mb-2">
                <label for="parent_category_id">Имя родительской категории</label>
                <select class="form-control" id="parent_category_id" name="parent_category_id">
                    <option value="">Пусто</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="name">Название*</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Введите название">
            </div>
            <div class="form-group mb-2">
                <label for="description">Описание</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Введите описание"></textarea>
            </div>
            <input class="form-check-input" type="hidden" value="1" name="is_main_category"
                id="is_main_category1">
            {{-- <label for="">is_main_category*</label>
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
            </div> --}}
            <button type="submit" class="btn btn-primary">Создать</button>
            <a href="{{ route('categories.index') }}" type="button" class="btn btn-success">Назад</a>

        </form>
    </div>
@endsection
