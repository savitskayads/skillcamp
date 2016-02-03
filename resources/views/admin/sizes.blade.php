@extends('admin.layout')
@section('content')



    <div class="wrap">
        <div class="header">
            <div class="clear">
                <div class="title"><span>Вед. размеров</span></div>
                <div class="controls">
                </div>
            </div>
        </div>
        <div class="content users">
            <div class="clear">
                <table class="table-list">
                    <tr>
                        <th class="center col-2">ID</th>
                        <th>Имя ребенка</th>
                        <th>Пол</th>
                        <th>Дата рождения</th>
                        <th>Рост</th>
                        <th>Вес</th>
                        <th>Размер одежды</th>
                        <th>Год</th>
                        <th>Сезон</th>
                        <th>Программа</th>
                        <th>Смена</th>
                        <th class="center col-btn"><i class="fa fa-th-list"></i></th>
                    </tr>
                    @foreach($childrens as $children)
                        <tr class='children' id={{$children->id}}>
                            <td class="center col-2">{{$children->id}}</td>
                            <td>{{$children->name}} {{$children->surname}}</td>
                            <td>{{$children->sex}}</td>
                            <td>{{$children->birthday_date}}</td>
                            <td>{{$children->height}}</td>
                            <td>{{$children->weight}}</td>
                            <td>{{$children->clothing_size}}</td>
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