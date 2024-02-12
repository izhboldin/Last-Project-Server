<div>
    @if ($ban->is_permanent_ban == 1)
        <p>Вы получили бан навсегда</p>
    @else
        <p>Вы получили бан который продлиться до {{ $ban->expiry_time }}</p>
    @endif
    {{-- {{ $ban }} --}}
    @if ($ban->complaint->type == 'chat')
        <p>Бан распостраняеться только на чат</p>
    @else
        <p>Бан распостраняеться только на создание объявлений</p>
    @endif
</div>
