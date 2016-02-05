@extends('layout')
@section('content')
    <div class="cabinet">

        <form  method="POST" action="{{web_url()}}/user/proposale/parent_data" role="form" class = "login-form">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <h3>Оформление заявки - шаг 2, Ваши данные</h3>
            <div class="form-group">
                <input type="hidden" name="id" value="{{$user->id}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" name="proposale_id" value="{{$proposale_id}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="name">ФИО</label>
                <input type="text" name="name" class="form-control" value="{{$user->name}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input type="text" name="email" class="form-control" value="{{$user->email}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="text" name="phone" class="form-control" value="{{$user->phone}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>



            <div class="inline-block">
                <input class="btn btn-success" type="submit" value="Сохранить">
                <a href="{{web_url()}}/proposale" class="btn btn-danger">Отмена</a>
            </div>
            <br>
        </form>
        {{--{!! Form::close() !!}--}}
    </div>
@stop