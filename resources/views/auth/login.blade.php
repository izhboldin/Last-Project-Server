<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Test</title>
</head>

<body class="antialiased">
    <div class="background">
        <div class="container" style=" padding-top: 28vh">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class=" w-100 d-flex">
                            <h2 class="py-3 border-bottom  w-100 text-center">Авторизация</h2>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('auth.login') }}" method="post">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Enter your email">
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="password">Пароль:</label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Enter your password">
                                    <span class="text-danger"></span>

                                </div>
                                <button type="submit" class="btn btn-primary">Войти</button>
                                {{-- <button type="button" class="btn btn-secondary ms-3">Назад</button> --}}
                            </form>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- text-decoration-line-through -->
    </div>

</body>

</html>
