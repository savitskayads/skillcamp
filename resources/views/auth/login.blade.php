@extends('layout')
@section('content')
    <form  method="POST" action="login" role="form" class = "login-form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                @if(isset($message))
                    <label for="email">Ваш e-mail</label>
                    <input type="text" name="email" class="form-control" value="{{$email}}">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                @else
                    <label for="email">Ваш e-mail</label>
                    <input type="text" name="email" class="form-control">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                @endif
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" name="password" class="form-control">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            @if(isset($message))
                <div class=" message" style="color: red;">
                    {{$message}}
                </div>
                @if($message_type == 'not_confirmed')
                    <div class="confirm" style="color: red;">
                        <a href="confirmation_code/{{$id}}">Заново выслать подтвержение</a>
                    </div>
                @endif
            @endif

        <div class="inline-block">
            <input class="btn btn-default" type="submit" name="login" value="Войти">
        </div>
    </form>
@stop