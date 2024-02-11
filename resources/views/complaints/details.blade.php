@extends('layout.adminPanel')
@section('content')
    <div class="container">
        {{-- <div class="row d-flex justify-content-between py-2">
            <h4>Сортировка по статусу:</h4>
            <a href="{{ route('products.index', 'str=wait') }}" class="btn border col-3 btn-outline-dark">Ожидающие</a>
            <a href="{{ route('products.index', 'str=active') }}" class="btn border col-3 btn-outline-dark">Активные</a>
            <a href="{{ route('products.index', 'str=reject') }}" class="btn border col-3 btn-outline-dark">Отклоненные</a>
        </div> --}}
        {{-- <pre>
            {{$complaint}}
        </pre> --}}


        <a href="{{ route('complaints.index') }}" class="btn border col-3 btn-outline-info mb-3">Назад</a>
        <div class="border border-danger rounded p-3 mb-3 w-100">
            <div class="">
                <h6 class=>Описание жалобы: {{ $complaint->text ?? 'пусто' }}</h6>
                <p class="pb-0 mb-2">Причина жалобы: {{ $complaint->reason }}</p>
                <p class="pb-0 mb-2">
                    <small class="text-muted">Status: {{ $complaint->status }}</small>
                </p>
                {{-- <p> Жалоба от пользователя:{{ optional($complaint->complainant_user)->name }}, на пользователя:{{$complaint->reported_user}}</p> --}}
                {{-- <div class="d-flex justify-content-between">
                    <small class="text-muted">type: {{ $complaint->type }}</small>
                </div> --}}

            </div>
        </div>
        <p>Введите время {{ $complaint->type == 'chat' ? 'бана в чате' : 'запрета на создание объявлений' }}, или забаньте
            пользователя навсегда</p>
        <form action="{{ route('complaints.createBan', $complaint->id) }}" method="POST">
            @csrf
            {{-- <input type="hidden" value="{{ $complaint->id }}" name="complaint_id">
            <input type="hidden" value="{{ $complaint->id }}" name="user_id"> --}}
            <input type="date" class="form-control mb-3" placeholder="Выберите дату" name="expiry_time" autocomplete="off" value="2024-03-11">
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Забанить навсегда:</span>
                <div class="input-group-text">
                    <input class="form-check-input mt-0" type="checkbox" name="is_permanent_ban"
                        aria-label="Checkbox for following text input" value="1" >
                </div>
            </div>
            <button type="submit" class="btn border col-3 btn-outline-info mb-3">Забанить</button>
        </form>
        <button type="submit" class="btn border col-3 btn-outline-info mb-3">Отклонить</button>

    </div>
@endsection
