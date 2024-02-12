@extends('layout.adminPanel')
@section('content')
    <div class="container">

        {{-- {{ $complaint }}; --}}

        <a href="{{ route('complaints.index') }}" class="btn border col-3 btn-secondary mb-3">Назад</a>

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
        @if ($complaint->chat && $complaint->chat->messages)
            <div class="d-flex justify-content-between mb-2">
                <div>
                    Пользователь на которого поступила жалоба
                    <span class="material-symbols-outlined">arrow_downward</span>
                </div>
                <div>
                    Пользователь который отправил жалобу
                    <span class="material-symbols-outlined">arrow_downward</span>
                </div>
            </div>

            <div class="w-100 bg-white border p-3 flex-column-reverse mb-3 overflow-auto"
                style="min-height: calc(70vh - 56px); max-height: calc(70vh - 55px)">
                @foreach ($complaint->chat->messages as $message)
                    <div class="row h-100 justify-content-between">

                        @if ($message->user_id != $complaint->complainant_user_id)
                            <div v-if="message.user.id != getUser.id" class="row justify-content-start">

                                <div class="d-flex mb-2">
                                    <div class="col-md-7 bg-secondary p-2 rounded">
                                        <h6 class="m-0">{{ $message->message }}</h6>
                                        <p class="my-0 d-flex justify-content-end fw-light ">{{ $message->created_at }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($message->user_id == $complaint->complainant_user_id)
                            <div class="d-flex justify-content-end mb-2">
                                <div class="col-md-7 bg-primary p-2 rounded">
                                    <h6 class="m-0">{{ $message->message }}</h6>
                                    <p class="my-0 d-flex justify-content-end fw-light ">{{ $message->created_at }}</p>

                                </div>

                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        @if ($complaint->product)
            <h3>Объявление на которое пришла жалоба:</h3>
            <div class="border p-3 mb-2">
                <img src="..." class="img-fluid" alt="...">
                <h3 class=>{{ $complaint->product->title }}</h3>
                <p class="pb-0 mb-2">Описание: {{ $complaint->product->description }}</p>
                <p class="pb-0 mb-2">Стоимость: {{ $complaint->product->price }}</p>
                <p class="pb-0 mb-2">Состояние: {{ $complaint->product->state == 'second-hand' ? 'Б/у' : 'Новое' }}</p>
                <p class="py-2">Категория: {{ $complaint->product->category->name }}</p>
                <p>Опции:</p>
                <div class="d-flex align-items-center bg-light p-2 me-2 mb-2">
                    @foreach ($complaint->product->options as $option)
                        <span class="material-symbols-outlined">chevron_right</span>
                        <small class="text-muted me-3">{{ $option->parameter->name }}: {{ $option->name }}. </small>
                    @endforeach
                </div>
                <p class="pb-0 mb-2">
                    <small class="text-muted"></small>
                </p>
            </div>
        @endif


        <p>Введите время {{ $complaint->type == 'chat' ? 'бана в чате' : 'запрета на создание объявлений' }}, или забаньте
            пользователя навсегда</p>
        <form action="{{ route('complaints.createBan', $complaint->id) }}" method="POST">
            @csrf
            {{-- <input type="hidden" value="{{ $complaint->id }}" name="complaint_id">
            <input type="hidden" value="{{ $complaint->id }}" name="user_id"> --}}
            <input type="date" class="form-control mb-3" placeholder="Выберите дату" name="expiry_time"
                autocomplete="off" value="2024-03-11">
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Забанить навсегда:</span>
                <div class="input-group-text">
                    <input class="form-check-input mt-0" type="checkbox" name="is_permanent_ban"
                        aria-label="Checkbox for following text input" value="1">
                </div>
            </div>
            <button type="submit" class="btn border col-3 btn-primary mb-3">Забанить</button>
        </form>
        <form action="{{ route('complaints.dismissBan', $complaint->id) }}" method="POST">
            @csrf

            <button type="submit" class="btn border col-3 btn-info mb-3">Отклонить</button>
        </form>

    </div>
@endsection
