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
            <h3>Данные ребенка</h3>
            <div class="form-group">
                <label for="email">ФИО</label>
                <input type="text" name="name" class="form-control" placeholder="Иванов Иван Иванович">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="email">Дата рождения</label>
                <input type="text" name="name" class="form-control">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <h5><b>Документ ребенка</b></h5>
            <div class="form-group col-xs-6">
                <label for="email">Вид документа</label>
                <input type="text" name="email" class="form-control">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group col-xs-6">
                <label for="email">Серия и номер документа</label>
                <input type="text" name="email" class="form-control">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <br>
            <h5><b>Документ родителя</b></h5>
            <div class="form-group col-xs-6">
                <label for="email">Паспорт родителя</label>
                <input type="text" name="email" class="form-control">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group col-xs-6">
                <label for="email">Выдан</label>
                <input type="text" name="email" class="form-control">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <br>
            <div class="form-group">
                <label for="comment">Прописка</label>
                <textarea class="form-control" rows="3" id="comment"></textarea>
            </div>

            @if(isset($message))
                <div class=" message" style="color: red;">
                    {{$message}}
                </div>
            @endif
            <div class="inline-block">
                <input class="btn btn-success" type="submit" name="login" value="Сохранить">
            </div>
        </form>
    </div>
@stop