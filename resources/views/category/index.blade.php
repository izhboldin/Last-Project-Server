@extends('layout.adminPanel')
@section('content')
    <div class="container mt-5">
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-1">Создать</a>
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
    </div>
@endsection
