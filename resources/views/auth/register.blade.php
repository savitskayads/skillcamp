@extends('layout')
@section('content')

    <form  method="POST" action="/skillcamp/public/auth/register" role="form" class = "login-form">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label for="email">ФИО</label>
            <input type="text" name="name" class="form-control" placeholder="Иванов Иван Иванович">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" name="email" class="form-control">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" name="password" class="form-control">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>
        <div class="form-group">
            <label for="password">Повторите пароль</label>
            <input type="password" name="password_confirmation" class="form-control">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>
        @if(isset($message))
            <div class=" message" style="color: red;">
                {{$message}}
            </div>
        @endif
        <div class="inline-block">
            <input class="btn btn-success" type="submit" name="login" value="Регистрация">
        </div>
    </form>
@stop

