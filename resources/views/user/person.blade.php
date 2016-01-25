@extends('layout')
@section('content')
    <div class="cabinet">
        <h1>Личный кабинет</h1>
        <p>
            <a href="{{web_url()}}/user" type="button" class="btn btn-default">Личные данные</a>
            <a href="{{web_url()}}/user/childs" type="button" class="btn btn-default">Данные детей</a>
            <a href="#" type="button" class="btn btn-default">Заявки</a>
        </p>
        <hr>
        <form  method="POST" action="/skillcamp/public/auth/register" role="form" class = "data-form">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <h3>Ваши данные</h3>
            <div class="form-group">
                <label for="email">ФИО</label>
                <p>Иванов Иван Иванович  <a href="#">Изменить</a>
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <p>name@mail.ru  <a href="#">Изменить</a>
                {{--<input type="text" name="email" class="form-control">--}}
                {{--<input type="hidden" name="_token" value="{!! csrf_token() !!}">--}}
            </div>
            <div class="form-group">
                <label for="phone">Телефон</label>
                <p>+79865478552  <a href="#">Изменить</a>
                {{--<input type="text" name="email" class="form-control">--}}
                {{--<input type="hidden" name="_token" value="{!! csrf_token() !!}">--}}
            </div>

            @if(isset($message))
                <div class=" message" style="color: red;">
                    {{$message}}
                </div>
            @endif
        </form>
    </div>
@stop