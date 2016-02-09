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
        <h3>Ваши заявки</h3>
       <p><a href="{{web_url()}}/user/proposale/1" type="button" class="btn btn-success">Создать новую заявку</a></p>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Программа</th>
                    <th>Ребенок</th>
                    <th>Время проведения</th>
                    <th>Анкета</th>
                </tr>
                </thead>
                <tbody>
                @foreach($proposales as $proposale)
                    <tr>
                        <td>{{$proposale->program_name}}</td>
                        <td>{{$proposale->children_name}}</td>
                        <td>c {{$proposale->program_start}} по {{$proposale->program_finish}}</td>
                        <td>??</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@stop
