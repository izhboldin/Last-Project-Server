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
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title">ID: {{ $product->id }}</h4>
                        <p class="card-text">User ID: {{ $product->user_id }}</p>
                        <p class="card-text">Title: {{ $product->title }}</p>
                        <p class="card-text">Description: {{ $product->description }}</p>
                        <p class="card-text">Price: ${{ $product->price }}</p>
                        <p class="card-text">Category ID: {{ $product->category_id }}</p>
                        <p class="card-text">Created At: {{ $product->created_at->format('Y-m-d H:i:s') }}</p>
                        <p class="card-text">Updated At: {{ $product->updated_at->format('Y-m-d H:i:s') }}</p>
                        <a href="{{route('product.index')}}" type="button" class="btn btn-success">back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
