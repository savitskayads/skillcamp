@extends('layout')
@section('content')

    <form  method="POST" action="{{web_url()}}/user/proposale/create" role="form" class = "login-form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h3>Оформление заявки - шаг 1, выбор программы</h3>
        <br>
        <div class="form-group">
            <label for="sel1">Программа</label>
            <select class="form-control" id="sel1" name="program_id">
                @foreach($programs as $program)
                <option value="{{$program->id}}" {{ $program->id == $selected_program_id ? "selected" : ""}}>{{$program->title}}</option>
               @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="sel1">Смена</label>
            <select class="form-control" id="sel1" name="session">
                    <option value="1">Первая</option>
                    <option value="2">Вторая</option>
                    <option value="3">Третья</option>
            </select>
        </div>
        <div class="form-group">
            <label for="transfer">Трансфер</label>
            <div class="radio">
                <label><input type="radio" name="transfer" value="да">Да</label>
                <label><input type="radio" name="transfer" value="нет">Нет</label>
            </div>
        </div>
        <div class="form-group">
            <label for="registration_date">Дата оформления</label>
            <input type="text" name="registration_date" class="form-control" value="{{date("d.m.Y")}}" disabled >
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>

        <div class="inline-block">
            <input class="btn btn-default" type="submit" name="login" value="Отправить">
        </div>
    </form>

@stop