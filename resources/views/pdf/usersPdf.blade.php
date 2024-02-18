<!DOCTYPE html>
<html>

<head>
    <title>Generate PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body,
        * {
            font-family: 'DejaVu Sans', sans-serif;
        }
    </style>
</head>

<body>

    <p style=" font-size: 28px;">Отчет</p>
    <p>Для: {{ $user->name }}</p>
    <p>{{ $date }}</p>
    <br />
    <br />

    {{-- <p style=" font-size: 20px;">Ваши объявления:</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Цена</th>
                <th>Дата</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}

    <p><span>Количество Пользователей: </span>{{ $quantityUsers }}</p>
    <p><span>Количество Пользователей за последний месяц: </span>{{ $quantityUsersInThisMonth }}</p>

    <p><span>Количество Админов: </span>{{ $quantityAdmin }}</p>
    <p><span>Количество Админов за последний месяц: </span>{{ $quantityAdminInThisMonth }}</p>

    <p><span>Количество Модераторов: </span>{{ $quantityModer }}</p>
    <p><span>Количество Модераторов за последний месяц: </span>{{ $quantityModerInThisMonth }}</p>

    <p><span>Количество Банов: </span>{{ $quantityBan }}</p>
    <p><span>Количество Банов за последний месяц: </span>{{ $quantityBanInThisMonth }}</p>

    <p><span>Количество Объявлений: </span>{{ $quantityProduct }}</p>
    <p><span>Количество Объявлений за последний месяц: </span>{{ $quantityProductInThisMonth }}</p>

    <p><span>Количество Категорий: </span>{{ $quantityCategory }}</p>
    <p><span>Количество Категорий за последний месяц: </span>{{ $quantityCategoryInThisMonth }}</p>

    <p><span>Количество Чатов: </span>{{ $quantityChat }}</p>
    <p><span>Количество Чатов за последний месяц: </span>{{ $quantityChatInThisMonth }}</p>

</body>

</html>
