@extends('admin.layout')
@section('content')



    <div class="wrap">
        <div class="header">
            <div class="clear">
                <div class="title"><span>Новости</span></div>
                <div class="controls">
                    <div class="btn-group"><a href="{{web_url()}}/admin/news/create" class="btn add"><i class="fa pull-left fa-plus"></i>Добавить</a></div>
                </div>
            </div>
        </div>
        <div class="content news">
            <div class="clear">
                <table class="table-list">
                    <tr>
                        <th class="center col-2">ID</th>
                        <th>Заголовок</th>
                        <th>Дата</th>
                        <th class="center col-btn"><i class="fa fa-th-list"></i></th>
                    </tr>
                    @foreach($news as $new)
                        <tr id={{$new->id}}>
                            <td class="center col-2">{{$new->id}}</td>
                            <td>{{$new->title}}</td>
                            <td>{{$new->date}}</td>
                            <td class="center col-btn">
                                <div class="droplist-group">
                                    <i class="fa fa-ellipsis-v"></i>
                                    <div class="droplist" style="display: none">
                                        <div>
                                            <ul>
                                                <li><a onclick="accept({{$new->id}})" class="accept"><i class="fa pull-left fa-chevron-down"></i>Принять</a></li>
                                                <li><a onclick="deny({{$new->id}})" class="deny"><i class="fa pull-left fa-times"></i>Отказать</a></li>
                                                <li><a onclick="r_delete({{$new->id}})" class="deny"><i class="fa pull-left fa-times"></i>Удалить</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@stop