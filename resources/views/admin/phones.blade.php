@extends('admin.layout')
@section('content')



    <div class="wrap">
        <div class="header">
            <div class="clear">
                <div class="title"><span>Вед. тел. родителей</span></div>
                <div class="controls">
                </div>
            </div>
        </div>
        <div class="content users">
            <div class="clear">
                <table class="table-list">
                    <tr>
                        <th>ФИО родителя</th>
                        <th>Телефон (регистрация)</th>
                        <th>Телефон</th>
                        <th>Телефон</th>
                        <th>Телефон</th>
                        <th>Имя ребенка</th>
                        <th>Год</th>
                        <th>Сезон</th>
                        <th>Программа</th>
                        <th>Смена</th>
                        <th class="center col-btn"><i class="fa fa-th-list"></i></th>
                    </tr>
                    @foreach($users as $user)
                        <tr class='children' id={{$user->id}}>
                            <td>{{$user->name}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->phone_1}}</td>
                            <td>{{$user->phone_2}}</td>
                            <td>{{$user->phone_3}}</td>
                            <td>{{$user->children_name}} {{$user->children_surname}}</td>
                            <td>??</td>
                            <td>??</td>
                            <td>??</td>
                            <td>??</td>
                            {{--<td class="center col-btn">--}}
                                {{--<div class="droplist-group">--}}
                                    {{--<i class="fa fa-ellipsis-v"></i>--}}
                                    {{--<div class="droplist" style="display: none">--}}
                                        {{--<div>--}}
                                            {{--<ul>--}}
                                                {{--<li><a href="{{web_url()}}/admin/users/{{$user->id}}/edit" class="accept"><i class="fa pull-left fa-chevron-down"></i>Изменить</a></li>--}}
                                                {{--<li><a href="{{web_url()}}/admin/users/{{$user->id}}/delete"><i class="fa pull-left fa-times"></i>Удалить</a></li>--}}
                                            {{--</ul>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</td>--}}
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@stop