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

        <h3>Данные детей</h3>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Дата рождения</th>
                    <th>Документ ребенка</th>
                    <th>Документ родителя</th>
                    <th>Прописка</th>
                    <th></th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Анна</td>
                    <td>Иванова</td>
                    <td>19.02.2001</td>
                    <td>Свидетельство о рождении</td>
                    <td>Паспорт</td>
                    <td>Москва, ул Кирова, д 15</td>
                    <td><a href="{{web_url()}}/user/child" >Изменить</a></td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
@stop