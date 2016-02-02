@extends('layout')
@section('content')
    <form  method="POST" action="{{web_url()}}/password/email" role="form" class = "login-form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="email">Ваш e-mail</label>
                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

        <div class="inline-block">
            <input class="btn btn-default" type="submit" name="login" value="Отправить">
        </div>
    </form>
@stop