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

        <h3>Данные детей</h3>
        @if($user->data_processing==1)
           <p><a href="{{web_url()}}/user/childrens/create" type="button" class="btn btn-success">
                   @if(!$childrens)
                   + добавить данные еще одного ребенка
                   @else
                   + добавить данные ребенка
                   @endif
               </a>
           </p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Дата рождения</th>
                        <th>Анкета</th>
                        <th>Документы</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($childrens as $children)
                        <tr>
                            <td>{{$children->name}}</td>
                            <td>{{$children->surname}}</td>
                            <td>{{$children->birthday_date}}</td>
                            <td>
                                @if($children->application_form!="")
                                    <span class="badge bg-green">{{$children->application_form}}</span>
                                    <a href="{{web_url()}}/user/childrens/{{$children->id}}/edit_application_form"> редактировать</a>
                                @else
                                    <span class="badge bg-red">заполнена не полностью</span>
                                    <a href="{{web_url()}}/user/childrens/{{$children->id}}/edit_application_form"> заполнить</a>
                                @endif
                            </td>
                            <td><a href="{{web_url()}}/user/childrens/{{$children->id}}/documents" >Просмотр</a></td>
                            <td><a href="{{web_url()}}/user/childrens/{{$children->id}}/edit" >Изменить основные данные</a></td>
                            <td><a href="{{web_url()}}/user/childrens/{{$children->id}}/delete" >Удалить</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else <p> Не получено согласие на обработку персональных данных </p>
        @endif

    </div>
@stop
