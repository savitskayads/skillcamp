@extends('layout')
@section('content')

    <form  method="POST" action="#" role="form" class = "login-form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="sel1">Программа</label>
            <select class="form-control" id="sel1">
                @foreach($programs as $program)
                <option value="{{$program->id}}" {{ $program->id == $selected_program_id ? "selected" : ""}}>{{$program->title}}</option>
               @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="password">Трансфер</label>
            <div class="radio">
                <label><input type="radio" name="optradio" value="да">Да</label>
                <label><input type="radio" name="optradio" value="нет">Нет</label>
            </div>
        </div>
        <div class="form-group">
            <label for="password">Дата оформления</label>
            <input type="text" name="password" class="form-control" value="{{date("d.m.Y")}}" disabled>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>

        <div class="inline-block">
            <input class="btn btn-default" type="submit" name="login" value="Отправить">
        </div>
    </form>

@stop