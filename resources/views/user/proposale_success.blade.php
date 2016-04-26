@extends('layout')
@section('content')

    <div class = "login-form">
        Ваша заявка принята. Для участия в программе прилагается заполнить анкету.
        <a href="{{web_url()}}/user/childrens/{{$proposale->id}}/edit_application_form">Перейти к заполнению</a>
    </div>

@stop