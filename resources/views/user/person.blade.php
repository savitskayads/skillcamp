@extends('layout')
@section('content')
    <div class="cabinet">
        <h1>Личный кабинет</h1>
        <p>
            <a href="{{web_url()}}/user" type="button" class="btn btn-default">Личные данные</a>
            <a href="{{web_url()}}/user/childrens" type="button" class="btn btn-default">Данные детей</a>
        </p>
        <hr>
        <form  method="POST" action="/skillcamp/public/auth/register" role="form" class = "data-form">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <h3>Ваши данные</h3>
            <div class="form-group">
                <label for="email">ФИО</label>
                <br>{{$user->name}}
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <br>{{$user->email}}
                {{--<input type="text" name="email" class="form-control">--}}
                {{--<input type="hidden" name="_token" value="{!! csrf_token() !!}">--}}
            </div>
            <div class="form-group">
                <label for="phone">Телефон</label>
                {{$user->phone}}
                {{--<input type="text" name="email" class="form-control">--}}
                {{--<input type="hidden" name="_token" value="{!! csrf_token() !!}">--}}
            </div>

            {{--<div class="form-group">--}}
                {{--<label for="phone">Паспорт</label>--}}
                {{--<p>{{$user->phone}}--}}
                    {{--<input type="text" name="email" class="form-control">--}}
                    {{--<input type="hidden" name="_token" value="{!! csrf_token() !!}">--}}
            {{--</div>--}}
            <a href="{{web_url()}}/user/{{$user->id}}/edit">Изменить</a>

            @if(isset($message))
                <div class=" message" style="color: red;">
                    {{$message}}
                </div>
            @endif
        </form>
    </div>
@stop