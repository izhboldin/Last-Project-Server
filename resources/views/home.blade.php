@extends('layout.adminPanel')
@section('content')
    <div class="d-flex justify-content-end">
        @if (auth()->check())
            <p class="pt-2 pe-3 m-0">Привет, {{ auth()->user()->name }}!</p>
            <a href="{{ route('auth.logout') }}" class="btn border">выход</a>
        @endif
    </div>
    <div class="container mt-5">
        <div class="row g-2 mt-5">
            <div class="col-4 mt-5">
                <div class="p-3 border border-dark bg-light">
                    <p><span>Количество Пользователей: </span>{{ $quantityUsers }}</p>
                    <p><span>Количество Пользователей за последний месяц: </span>{{ $quantityUsersInThisMonth }}</p>
                    {{-- <p><span>Количество Пользователей за последний месяц в %:</span>{{ ($quantityUsersInThisMonth / $quantityUsers) * 100 }}</p> --}}
                </div>
            </div>
            <div class="col-4 mt-5">
                <div class="p-3 border border-dark bg-light">
                    <p><span>Количество Админов: </span>{{ $quantityAdmin }}</p>
                    <p><span>Количество Админов за последний месяц: </span>{{ $quantityAdminInThisMonth }}</p>
                </div>
            </div>
            <div class="col-4 mt-5">
                <div class="p-3 border border-dark bg-light">
                    <p><span>Количество Модераторов: </span>{{ $quantityModer }}</p>
                    <p><span>Количество Модераторов за последний месяц: </span>{{ $quantityModerInThisMonth }}</p>
                </div>
            </div>
            <div class="col-4">
                <div class="p-3 border border-dark bg-light">
                    <p><span>Количество Банов: </span>{{ $quantityBan }}</p>
                    <p><span>Количество Банов за последний месяц: </span>{{ $quantityBanInThisMonth }}</p>
                </div>
            </div>
            <div class="col-4">
                <div class="p-3 border border-dark bg-light">
                    <p><span>Количество Объявлений: </span>{{ $quantityProduct }}</p>
                    <p><span>Количество Объявлений за последний месяц: </span>{{ $quantityProductInThisMonth }}</p>
                </div>
            </div>
            <div class="col-4">
                <div class="p-3 border border-dark bg-light">
                    <p><span>Количество Категорий: </span>{{ $quantityCategory }}</p>
                    <p><span>Количество Категорий за последний месяц: </span>{{ $quantityCategoryInThisMonth }}</p>
                </div>
            </div>
            {{-- <span class="material-symbols-outlined">add</span> --}}
        @endsection
