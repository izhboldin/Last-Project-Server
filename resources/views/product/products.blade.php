<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .sticky-top {
            position: -webkit-sticky;
            position: sticky;
            height: 100vh;
            top: 0;
            z-index: 1020;
        }
    </style>
    <title> </title>
</head>

<body>

    <div class="container mt-5">
        <a href="{{route('product.create')}}" class="btn btn-primary mb-1">Создать</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>user_id</th>
                    <th>title</th>
                    <th>description</th>
                    <th>price</th>
                    <th>category_id</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>Action</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->user_id }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category_id }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->updated_at }}</td>
                        <td>
                            <a href="{{route('product.show', $product->id)}}" type="button" class="btn btn-primary">watch</a>
                            <a href="{{route('product.edit', $product->id)}}" type="button" class="btn btn-success">edit</a>
                        </td>
                        <td>
                            <form action="{{route('product.destroy', $product->id)}}" method="POST">
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

</body>

</html>
