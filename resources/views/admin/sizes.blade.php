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
                    @foreach($proposales as $proposale)
                        <tr class='children' id={{$proposale->id}}>
                            <td class="center col-2">{{$proposale->id}}</td>
                            <td>{{$proposale->name}} {{$proposale->surname}}</td>
                            <td>{{$proposale->sex}}</td>
                            <td>{{$proposale->birthday_date}}</td>
                            <td>{{$proposale->height}}</td>
                            <td>{{$proposale->weight}}</td>
                            <td>{{$proposale->clothing_size}}</td>
                            <td>{{$proposale->registration_date}}</td>
                            <td>Зима</td>
                            <td>{{$proposale->program_name}}</td>
                            <td>{{$proposale->session}}</td>
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

    <script type="text/javascript">
        $('.children').dblclick(function(){
            if ($(this).hasClass('active-row')){
                return;
            } else {
                if($('tr').is('.active-row')){
                    var c = $('.active-row').find('td').not(':first');
                    $.each(c, function(i, v) {
                        var text = $(v).find('input').val();
                        $(v).find('input').remove();
                        $(v).text(text);
                    });
                    $('.active-row').removeClass('active-row');
                }
                $(this).addClass('active-row');
                var proposale_id = $(this).attr('id');
                var cells = $(this).find('td').not(':first');
                $.each(cells, function(i, v) {
                    var val = $(v).text();
                    var input = '<input type = "text" value = "'+val+'">';
                    $(v).text('');
                    $(input).prependTo($(v));
                });
            }
        });
    </script>
@stop