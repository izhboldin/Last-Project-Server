@extends('layout.adminPanel')
@section('content')
    <div class="container mt-5">
        <div class="my-3">
            <form action="{{ route('user.search') }}" method="get">
                @csrf
                <div class="row ms-5">
                    <div class="col-8">
                        <input type="text" class="form-control" name="search" value="" placeholder="Введите текст">
                    </div>
                    <div class="col-4">
                        <a href="{{route('user.index')}}" class="btn btn-danger">X</a>
                        <button type="submit" class="btn btn-primary">Нажмите</button>
                    </div>
                </div>
            </form>
        </div>
        {{-- <a href="{{ route('categories.create') }}" class="btn btn-primary mb-1">Создать</a> --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>role</th>
                    <th>updated_at</th>
                    <th>created_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        {{-- <td>{{ $user->email_verified_at }}</td> --}}
                        <td> {{ $user->role }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}"
                                class="btn border me-1 p-0  material-symbols-outlined">edit</a>
                            {{-- <a href="{{ route('categories.show', $users->id) }}" type="button"
                                class="btn btn-primary">watch</a>
                            <a href="{{ route('categories.edit', $users->id) }}" type="button"
                                class="btn btn-success">edit</a> --}}
                        </td>
                    </tr>
                @endforeach
                <!-- Add more rows as needed -->
            </tbody>
        </table>

        <div>{{ $users->links() }}</div>
    </div>
@endsection
