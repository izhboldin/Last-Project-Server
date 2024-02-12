@extends('layout.adminPanel')
@section('content')
    <div class="container">
        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn border col-3 btn-secondary mb-3">Назад</a>
        <div class="p-3 mb-3 w-100">
            <div class="">
                <img src="..." class="img-fluid" alt="...">
                <h3 class=>{{ $product->title }}</h3>
                <p class="pb-0 mb-2">Описание: {{ $product->description }}</p>
                <p class="pb-0 mb-2">Стоимость: {{ $product->price }}</p>
                <p class="pb-0 mb-2">Состояние: {{ $product->state == 'second-hand' ? 'Б/у' : 'Новое' }}</p>
                <p class="py-2">Категория: {{ $product->category->name }}</p>
                <p>Опции:</p>
                <div class="d-flex align-items-center bg-light p-2 me-2 mb-2">
                    @foreach ($product->options as $option)
                        <span class="material-symbols-outlined">chevron_right</span>
                        <small class="text-muted me-3">{{ $option->parameter->name }}: {{ $option->name }}. </small>
                    @endforeach
                </div>
                <p class="pb-0 mb-2">
                    <small class="text-muted"></small>
                </p>

                <div class="row d-flex justify-content-between py-2">
                    <div class="col-2">
                        <form action="{{ route('products.editStatus', $product->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" value="active" name="status">
                            <button class="btn border w-100 btn-outline-success">Одобрить</button>
                        </form>
                    </div>
                    <div class="col-2">
                        <form action="{{ route('products.editStatus', $product->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" value="reject" name="status">
                            <button type="submit" class="btn border w-100 btn-outline-danger">Забанить</button>
                        </form>
                    </div>
                </div>
                {{-- <p> Жалоба от пользователя:{{ optional($complaint->complainant_user)->name }}, на пользователя:{{$complaint->reported_user}}</p> --}}
                {{-- <div class="d-flex justify-content-between">
                    <small class="text-muted">type: {{ $complaint->type }}</small>
                </div> --}}

            </div>
        </div>


    </div>
@endsection
