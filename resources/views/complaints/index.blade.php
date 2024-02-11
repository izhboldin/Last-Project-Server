@extends('layout.adminPanel')
@section('content')
    <div class="container">
        {{-- <div class="row d-flex justify-content-between py-2">
            <h4>Сортировка по статусу:</h4>
            <a href="{{ route('products.index', 'str=wait') }}" class="btn border col-3 btn-outline-dark">Ожидающие</a>
            <a href="{{ route('products.index', 'str=active') }}" class="btn border col-3 btn-outline-dark">Активные</a>
            <a href="{{ route('products.index', 'str=reject') }}" class="btn border col-3 btn-outline-dark">Отклоненные</a>
        </div> --}}
        @foreach ($complaints as $complaint)
            <div class="border border-danger rounded p-3 mb-3 w-100">
                <div class="">
                    <h6 class=>Описание жалобы: {{ $complaint->text ?? 'пусто' }}</h6>
                    <p class="pb-0 mb-2">Причина жалобы: {{ $complaint->reason }}</p>
                    <p class="pb-0 mb-2">
                        <small class="text-muted">Status: {{ $complaint->status }}</small>
                    </p>
                    <a href="{{ route('complaints.get', $complaint->id) }}" class="btn border col-3 btn-outline-info">Подробнее</a>
                    {{-- <div class="d-flex justify-content-between">
                        <small class="text-muted">type: {{ $complaint->type }}</small>
                    </div> --}}

                </div>
            </div>
        @endforeach

    </div>
@endsection
