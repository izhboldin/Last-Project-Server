@extends('layout.adminPanel')
@section('content')
<div>
   <p><span>Количество Пользователей: </span>{{$quantityUsers}}</p>
   <p><span>Количество Продуктов: </span>{{$quantityProduct}}</p>
   <p><span>Количество Категорий: </span>{{$quantityCategory}}</p>
</div>
@endsection
