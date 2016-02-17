@extends('layout')
@section('content')
    <div class="cabinet">

        <form  method="POST" action="{{web_url()}}/user/proposale/children_data" role="form" class = "login-form">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <h3>Оформление заявки - данные о ребенке </h3>
            <div class="form-group">
                <input type="hidden" name="id" value="{{$user->id}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" name="proposale_id" value="{{$proposale_id}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" name="children_id" value="{{$children->id}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="surname">Фамилия ребенка</label>
                <input type="text" name="surname" class="form-control" value="{{$children->surname}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="name">Имя ребенка</label>
                <input type="text" name="name" class="form-control" value="{{$children->name}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="patronymic">Отчество ребенка</label>
                <input type="text" name="patronymic" class="form-control" value="{{$children->patronymic}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="birthday_date">Дата рождения ребенка</label>
                <input type="text" name="birthday_date" class="form-control" value="{{$children->birthday_date}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="document">Документ ребенка</label>
                <input type="text" name="document" class="form-control" value="{{$children->document}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="document_number">Серия номер документа ребенка</label>
                <input type="text" name="document_number" class="form-control" value="{{$children->document_number}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="radio">
                <label><input type="radio" name="member" value="1">Старый участник</label>
                <label><input type="radio" name="member" value="0">Новый участник</label>
            </div>
            <div class="form-group">
                <label for="registration">Прописка</label>
                <textarea class="form-control" rows="3" id="comment" name="registration">{{$children->registration}}</textarea>
            </div>

            <div class="inline-block">
                <input class="btn btn-success" type="submit" value="Сохранить">
                <a href="{{web_url()}}/user/proposale/{{$proposale_id}}/delete" class="btn btn-danger">Отмена</a>
            </div>
            <br>
        </form>
        {{--{!! Form::close() !!}--}}
    </div>
@stop