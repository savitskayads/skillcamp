@extends('layout')
@section('content')
    <div class="cabinet">
        <h1>Личный кабинет</h1>
        <p>
            <a href="{{web_url()}}/user" type="button" class="btn btn-default">Личные данные</a>
            <a href="{{web_url()}}/user/childrens" type="button" class="btn btn-default">Данные детей</a>
            <a href="#" type="button" class="btn btn-default">Заявки</a>
        </p>
        <hr>
        <form  method="POST" action="{{web_url()}}/user/childrens/save" role="form" class = "data-form">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <h3>Анкета</h3>
            <div class="form-group">
                <input type="hidden" name="id" value="">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="name">Номер школы</label>
                <input type="text" name="school_number" class="form-control" value="">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="surname">Класс</label>
                <input type="text" name="school_class" class="form-control" value="">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="birthday">Выезжал ли Ваш ребенок в лагеря ранее(на 7 и более дней)?</label>
                <label class="radio-inline"><input type="radio" name="optradio">Да</label>
                <label class="radio-inline"><input type="radio" name="optradio">Нет</label>
            </div>

            <div class="form-group">
                <label for="birthday">Как переносит солнце?</label>
                <label class="radio-inline"><input type="radio" name="optradio">Хорошо</label>
                <label class="radio-inline"><input type="radio" name="optradio">Плохо</label>
            </div>

            <div class="form-group">
                <label for="surname">Необходимость диеты(указать какая)</label>
                <input type="text" name="diet" class="form-control" value="">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="surname">Есть ли необходимость в приеме каких-либо лекарств?</label>
                <input type="text" name="diet" class="form-control" value="">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="surname">Другие особенности(по физическому состоянию)</label>
                <input type="text" name="diet" class="form-control" value="">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="surname">Рост</label>
                <input type="text" name="diet" class="form-control" value="">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="surname">Вес</label>
                <input type="text" name="diet" class="form-control" value="">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="surname">Размер одежды</label>
                <input type="text" name="diet" class="form-control" value="">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="surname">Состав семьи</label>
                <input type="text" name="diet" class="form-control" value="">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            @if(isset($message))
                <div class=" message" style="color: red;">
                    {{$message}}
                </div>
            @endif
            <div class="inline-block">
                <input class="btn btn-success" type="submit" value="Сохранить">
                <a href="{{web_url()}}/user/childs" class="btn btn-danger">Отмена</a>
            </div>
            <br>
            <div class="inline-block">
                <a href="{{web_url()}}/user/childs" class="btn btn-primary">Заполнить анкету</a>
            </div>
        </form>
    </div>
@stop