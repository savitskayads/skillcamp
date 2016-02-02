@extends('layout')
@section('content')
    <form  method="POST" action="{{web_url()}}/password/reset" role="form" class = "login-form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
                <label for="email">Ваш e-mail</label>
                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" name="password" class="form-control">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>
        <div class="form-group">
            <label for="password">Подтверждение пароля</label>
            <input type="password" name="password_confirmation" class="form-control">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>
        <div class="inline-block">
            <input class="btn btn-default" type="submit" value="Сбросить пароль">
        </div>
    </form>
@stop