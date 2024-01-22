<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
           font-family: 'Cabin', sans-serif;
        }

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

<body class="antialiased">

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar sticky-top">
                <div class="sidebar-sticky mt-5">
                    <ul class="nav flex-column">
                        <li class="nav-item mb-3">
                            <h2 class="text-white text-center">BUE-SALE</h2>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-center" href="{{ route('home') }}">
                                HOME
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-center" href="{{ route('user.index') }}">
                                USERS
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-center" href="{{ route('categories.index') }}">
                                CATEGORIES
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 mt-3">
                @yield('content')
            </main>
        </div>
    </div>


</body>

</html>
