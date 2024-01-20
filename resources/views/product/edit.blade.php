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
        <form action="{{ route('product.update', $product->id)}}" method="POST">
            @csrf
            @method('patch')
            <input type="hidden" name="id" value="{{$product->id}}">
            <div class="form-group mb-2">
                <label for="user_id">User ID</label>
                <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter User ID" value="{{ $product->user_id }}">
            </div>
            <div class="form-group mb-2">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="{{ $product->title }}">
            </div>
            <div class="form-group mb-2">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Description">{{ $product->description }}</textarea>
            </div>
            <div class="form-group mb-2">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" value="{{ $product->price }}">
            </div>
            <div class="form-group mb-3">
                <label for="category_id">Category ID</label>
                <input type="text" class="form-control" id="category_id" name="category_id"
                    placeholder="Enter Category ID" value="{{ $product->category_id }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{route('product.index')}}" type="button" class="btn btn-success">back</a>

        </form>
    </div>

</body>

</html>
