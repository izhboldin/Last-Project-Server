@extends('layout.adminPanel')
@section('content')
    <header class="navbar navbar-expand-lg navbar-light border-bottom">
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

    {{-- <div class="container mt-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>parent_category_id</th>
                    <th>name</th>
                    <th>description</th>
                    <th>is_main_category</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>Action</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->parent_category_id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->is_main_category ? 'true' : 'false' }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td>
                            <a href="{{ route('categories.show', $category->id) }}" type="button"
                                class="btn btn-primary">watch</a>
                            <a href="{{ route('categories.edit', $category->id) }}" type="button"
                                class="btn btn-success">edit</a>
                            <a href="{{ route('categories.more', $category->id) }}" type="button"
                                class="btn btn-success">more</a>
                        </td>
                        <td>
                            <form action="{{ route('categories.delete', $category->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div> --}}

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
    </div>
@endsection
