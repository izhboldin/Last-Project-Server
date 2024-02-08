@extends('layout.adminPanel')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-between py-2">
            <h4>Сортировка по статусу:</h4>
            <a href="{{route('products.index', 'str=wait')}}" class="btn border col-3 btn-outline-dark">Ожидающие</a>
            <a href="{{route('products.index', 'str=active')}}" class="btn border col-3 btn-outline-dark">Активные</a>
            <a href="{{route('products.index', 'str=reject')}}" class="btn border col-3 btn-outline-dark">Отклоненные</a>
        </div>
        @foreach ($products as $product)
            <div class="card mb-3 w-100">
                <div class="row g-0 justify-content-center">
                    <div class="col-md-4">
                        <img src="https://ireland.apollo.olxcdn.com:443/v1/files/zo9y2rkxi8941-UA/image;s=1000x700"
                            class="img-fluid rounded object-fit-cover m-2" style="width: 35vh; height: 20vh" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">{{ $product->title }}</h4>
                                <h6 class="card-title">Цена: {{ $product->price }}</h6>
                            </div>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><small class="text-muted">Status: {{ $product->status }}</small></p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between py-2">

                        <div class="col-2">
                            <form action="{{ route('products.editStatus', $product->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <input type="hidden" value="active" name="status">
                                <button class="btn border w-100 btn-outline-success">Одобрить</button>
                            </form>
                        </div>
                        <div class="col-2">
                            <form action="{{ route('products.editStatus', $product->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <input type="hidden" value="reject" name="status">
                                <button type="submit" class="btn border w-100 btn-outline-danger">Забанить</button>
                            </form>
                        </div>
                        <a href="{{route('products.edit', $product->id)}}" class="btn border col-3 btn-outline-info">Изменить</a>
                        <button class="btn border col-3 btn-outline-info">Подробнее</button>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    {{-- <header class="navbar navbar-expand-lg navbar-light border-bottom">
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-1 me-5">Создать</a>

        <form action="{{ route('categories.search') }}" method="post">
            @csrf
            <div class="row ms-5">
                <div class="col-8">
                    <input type="text" class="form-control" name="search" placeholder="Введите текст">
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary">Нажмите</button>
                </div>
            </div>
        </form>
    </header>
    <div class="container mt-3">
        <div class="row justify-content-start">
            @if ($id)
                <span>Поиск за {{ $id }} id</span>
            @endif

            @if (count($categories) === 0)
                <h1 class="text-center mt-5">Категории отсутствуют</h1>
            @else
                <span>всего {{ $allQuantityCategory }} категорий, на данной странице {{ $quantityCategory }}</span>
            @endif

            @foreach ($categories as $category)
                <div class="card col-md-3 mb-4 p-2 me-5">
                    <img src="https://i.ucrazy.ru/files/pics/2023.10/2023-10-17-21-53-072.webp" class="card-img-top"
                        alt="..." style="max-height: 30vh; object-fit: cover">
                    <div class="card-body p-2">
                        <h4 class="card-title text-center">{{ $category->name }}</h4>
                        <p class="card-text">description: {{ $category->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Категория самостоятельная:
                            {{ $category->is_main_category ? 'Да' : 'Нет' }}</li>
                        <li class="list-group-item">Дата создания: {{ $category->created_at }}</li>
                    </ul>
                    <div class="card-body d-flex justify-content-between p-2">
                        <a href="{{ route('categories.show', $category->id) }}" type="button"
                            class="btn btn-info btn-sm">info</a>
                        <a href="{{ route('categories.edit', $category->id) }}" type="button"
                            class="btn btn-warning btn-sm">edit</a>
                        <a href="{{ route('categories.more', $category->id) }}" type="button"
                            class="btn btn-success btn-sm">more</a>
                        <a href="{{ route('parameters.show', $category->id) }}" type="button"
                            class="btn btn-success btn-sm">parameter</a>
                    </div>
                </div>
            @endforeach


        </div>
    </div> --}}
@endsection
