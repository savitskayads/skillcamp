@extends('layout')
@section('content')
    <div class="cabinet">
        <h1>Личный кабинет</h1>
        <p>
            <a href="{{web_url()}}/user" type="button" class="btn btn-default">Личные данные</a>
            <a href="{{web_url()}}/user/childrens" type="button" class="btn btn-default">Данные детей</a>
            <a href="{{web_url()}}/user/proposales" type="button" class="btn btn-default">Заявки</a>
        </p>
        <hr>
        <form  method="POST" action="{{web_url()}}/user/childrens/save" role="form" class = "data-form">
            <h3>Изменение данных ребенка</h3>
            <div class="form-group">
                <input type="hidden" name="id" value="{{$children->id}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="surname">Фамилия</label>
                <input type="text" name="surname" class="form-control" value="{{$children->surname}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" name="name" class="form-control" value="{{$children->name}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="patronymic">Отчество</label>
                <input type="text" name="patronymic" class="form-control" value="{{$children->patronymic}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="sex">Пол</label>
                <input type="text" name="sex" class="form-control" value="{{$children->sex}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="birthday_date">Дата рождения</label>
                <input type="text" name="birthday_date" class="form-control" value="{{$children->birthday_date}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="document">Документ</label>
                <input type="text" name="document" class="form-control" value="{{$children->document}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="document_number">Серия  номер документа</label>
                <input type="text" name="document_number" class="form-control" value="{{$children->document_number}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="adress">Фактический адрес</label>
                <input type="text" name="adress" class="form-control" value="{{$children->adress}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            @if($members->count()!=0)
                <input type="hidden" name="reference" class="form-control" value="{{$children->reference}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="form-group">
                    <label for="name">Учавствовал(a)</label>
                    <br>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Программа</th>
                            <th>Сезон</th>
                            <th>Время участия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                        <tr>
                            <td>{{$member->program_title}}</td>
                            <td>Зима</td>
                            <td>с {{$member->program_start}} по {{$member->program_finish}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="form-group">
                    <label for="name">Откуда узнали о нас?</label>
                    <input type="text" name="reference" class="form-control" value="{{$children->reference}}">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                </div>
            @endif

            <div class="inline-block">
                <input class="btn btn-success" type="submit" value="Сохранить">
                <a href="{{web_url()}}/user/childs" class="btn btn-danger">Отмена</a>
            </div>
            <br>
        </form>
        {{--{!! Form::close() !!}--}}
    </div>
@stop