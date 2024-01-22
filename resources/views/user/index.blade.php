@extends('layout.adminPanel')
@section('content')
    <div class="container mt-5">
        {{-- <a href="{{ route('categories.create') }}" class="btn btn-primary mb-1">Создать</a> --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>email_verified_at</th>
                    <th>role</th>
                    <th>updated_at</th>
                    <th>created_at</th>
                    <th>Action</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->email_verified_at }}</td>
                        <td>{{ $user->role}}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            {{-- <a href="{{ route('categories.show', $users->id) }}" type="button"
                                class="btn btn-primary">watch</a>
                            <a href="{{ route('categories.edit', $users->id) }}" type="button"
                                class="btn btn-success">edit</a> --}}
                        </td>
                        <td>
                            {{-- <form action="{{ route('categories.delete', $users->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">delete</button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
@endsection
