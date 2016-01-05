@extends('admin.layout')
@section('content')



    <div class="wrap">
        <div class="header">
            <div class="clear">
                <div class="title"><span>Программы лагеря</span></div>
                <div class="controls">
                    <div class="btn-group"><a href="{{web_url()}}/admin/programs/create" class="btn add"><i class="fa pull-left fa-plus"></i>Добавить</a></div>
                </div>
            </div>
        </div>
        <div class="content {pagetag}">
            <div class="clear">
                <table class="table-list">
                    <tr>
                        <th class="center col-2">ID</th>
                        <th>Название</th>
                        <th>Сезон</th>
                        <th>Количество мест</th>
                        <th>Цена</th>
                        <th class="col-4">Время проведения</th>
                        <th class="center col-btn"><i class="fa fa-th-list"></i></th>
                    </tr>
                    @foreach($programs as $program)
                        <tr id={{$program->id}}>
                            <td class="center col-2">{{$program->id}}</td>
                            <td>{{$program->title}}</td>
                            <td>{{$program->vacation_title}}</td>
                            <td>{{$program->places}}</td>
                            <td>{{$program->price}}</td>
                            <td>{{date('d.m', strtotime($program->start_date)) }} - {{date('d.m', strtotime($program->finish_date))}}</td>
                            <td class="center col-btn">
                                <div class="droplist-group">
                                    <i class="fa fa-ellipsis-v"></i>
                                    <div class="droplist" style="display: none">
                                        <div>
                                            <ul>
                                                <li><a href="{{web_url()}}/admin/programs/{{$program->id}}/edit" class="accept"><i class="fa pull-left fa-chevron-down"></i>Изменить</a></li>
                                                <li><a onclick="r_delete({{$program->id}})" class="deny"><i class="fa pull-left fa-times"></i>Удалить</a></li>
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