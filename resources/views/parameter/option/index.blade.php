@extends('layout.adminPanel')
@section('content')
    <div class="container mt-5">
        <a href="{{ route('options.back', $id) }}">Вернуться назад</a>
        {{-- <a href="{{ route('categories.create') }}" class="btn btn-primary mb-1">Создать</a> --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>name</th>
                    <th>buttons</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="{{ route('options.create', $id) }}" method="POST">
                        @csrf
                        <td><input class="form-control" type="text" name="name"></td>
                        <input class="form-control" type="hidden" value="{{ $id }}" name="parameter_id">
                        <td><button type="submit" class="btn btn-primary">Создать</button></td>
                    </form>
                    @foreach ($options as $option)
                <tr>
                    <td>{{ $option->name }}</td>
                    <td>
                        {{-- <a href="{{ route('categories.show', $users->id) }}" type="button"
                                class="btn btn-primary">watch</a>
                            <a href="{{ route('categories.edit', $users->id) }}" type="button"
                                class="btn btn-success">edit</a> --}}
                        <a href="{{ route('options.edit', ['option' => $option->id, 'parameter' => $id]) }}" type="button" class="btn btn-success">edit</a>
                        <form class="d-inline" action="{{ route('parameters.delete', ['parameter' => $option->id, 'category' => $id]) }}"
                            method="POST">
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
