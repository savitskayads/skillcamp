@extends('layout')
@section('content')

    <div class = "login-form">
        Ваша заявка принята. Для участия в программе прилагается заполнить анкету.
        <a href="{{web_url()}}/user/childrens/{{$children->id}}/edit">Перейти к заполнению</a>
    </div>

@stop