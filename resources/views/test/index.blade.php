<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    <title>Test</title>
</head>

<body class="antialiased">

    <div class="container mt-4">
        <div class="row">

            <!-- Карточка 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://cdnb.artstation.com/p/assets/images/images/046/141/937/large/ryo-tanino-bk-rh016.jpg?1644400686" class="card-img-top" alt="Dark Souls Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Dark Souls 1</h5>
                        <p class="card-text">Разработчик: FromSoftware</p>
                        <p class="card-text">Основная информация: Это первая часть популярной серии Dark Souls.</p>
                    </div>
                </div>
            </div>

            <!-- Карточка 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{Vite::asset('resources/assets/ds2.jpg')}}" class="card-img-top" alt="Dark Souls Image 2">
                    <div class="card-body">
                        <h5 class="card-title">Dark Souls 2</h5>
                        <p class="card-text">Разработчик: FromSoftware</p>
                        <p class="card-text">Основная информация: Вторая часть знаменитой серии Dark Souls.</p>
                    </div>
                </div>
            </div>

            <!-- Карточка 3 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://cdnb.artstation.com/p/assets/images/images/041/667/269/large/fotis-mint-render.jpg?1632340420" class="card-img-top" alt="Dark Souls Image 3">
                    <div class="card-body">
                        <h5 class="card-title">Dark Souls 3</h5>
                        <p class="card-text">Разработчик: FromSoftware</p>
                        <p class="card-text">Основная информация: Третья часть легендарной серии Dark Souls.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
