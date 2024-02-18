@extends('layout.adminPanel')
@section('content')
    <div class="container mt-5">
        <a href="{{ route('parameters.back', $id) }}">Вернуться назад</a>
        {{-- <a href="{{ route('categories.create') }}" class="btn btn-primary mb-1">Создать</a> --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>name</th>
                    <th>type</th>
                    <th>visual</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="{{ route('parameters.create', $id) }}" method="POST">
                        @csrf
                        <td><input class="form-control" type="text" name="name"></td>
                        <td><select class="form-control" name="type">
                                <option>select</option>
                                <option>multiselect</option>
                            </select></td>
                        <input class="form-control" type="hidden" value="{{ $id }}" name="category_id">
                        <td><button type="submit" class="btn btn-primary">Создать</button></td>
                        <td></td>
                    </form>
                    @foreach ($parameters as $parameter)
                <tr>
                    <td>{{ $parameter->name }}</td>
                    <td>{{ $parameter->type }}</td>
                    <td class="input-group flex-nowrap">
                        <select class="form-control" name="" id="">
                            @foreach ($parameter->options as $option)
                                <option value="">{{ $option->name }}</option>
                            @endforeach
                        </select>
                        <a href="{{ route('options.index', ['parameter' => $parameter->id]) }}"
                            class="btn btn btn-outline-secondary py-0"><span
                                class="material-symbols-outlined pt-1">settings</span></a>
                    </td>
                    <td>
                        <form class="d-inline" action="{{ route('parameters.delete', ['parameter' => $parameter->id, 'category' => $id]) }}"
                            method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены?')">delete</button>
                        </form>
                        <a href="{{ route('parameters.edit', ['parameter' => $parameter->id, 'category' => $id]) }}"
                            class="btn btn-success">edit</a>

                    </td>

                </tr>
                @endforeach
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
@endsection
