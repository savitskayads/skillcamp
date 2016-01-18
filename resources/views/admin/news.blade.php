@extends('admin.layout')
@section('content')



    <div class="wrap">
        <div class="header">
            <div class="clear">
                <div class="title"><span>Новости</span></div>
                <div class="controls">
                    <div class="controls">
                        <div class="btn-group publish"><a href="#" class="btn add"><i class="fa pull-left "></i>Опубликовать</a></div>
                        <div class="btn-group unpublish"><a href="#" class="btn add"><i class="fa pull-left "></i>Снять с публикации</a></div>
                        <div class="btn-group delete"><a href="#" class="btn add"><i class="fa pull-left "></i>Удалить</a></div>
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
                        <th>Опубликована</th>
                        <th class="center col-btn"><i class="fa fa-th-list"></i></th>
                    </tr>
                    @foreach($all_news as $news)
                        <tr class ='news' id={{$news->id}}>
                            <td class="center col-2">{{$news->id}}</td>
                            <td><a href="{!! web_url() !!}/admin/news/{!! $news->id !!}/edit">{{  $news->title }}</a></td>
                            <td>{{$news->date}}</td>
                            @if($news->active == 1)
                                <td>Да</td>
                            @else
                                <td>Нет</td>
                            @endif
                            <td class="center col-btn">
                                <div class="droplist-group">
                                    <i class="fa fa-ellipsis-v"></i>
                                    <div class="droplist" style="display: none">
                                        <div>
                                            <ul>
                                                <li><a href="{{web_url()}}/admin/news/{{$news->id}}/edit" class="accept"><i class="fa pull-left fa-chevron-down"></i>Изменить</a></li>
                                                <li><a href="{{web_url()}}/admin/news/{{$news->id}}/delete"><i class="fa pull-left fa-times"></i>Удалить</a></li>
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
    <script type="text/javascript">
        $('tr.news').on ('click',  function(){
            $.each($('tr'), function(i,v){
                $(v).removeClass('active');
            });
            $(this).addClass('active');
        });

        $('.publish').on ('click', function(){
            var id = $('.table-list').find('tr.active').attr('id');
            $.ajax({ url: "{{ web_url() }}/admin/news/publish/"+id,
                type: 'get',
                success:
                        function() {
                            $('.table-list').find('tr.active').find('td:eq(3)').text('Да');
                        }
            });
        });

        $('.unpublish').on ('click', function(){
            var id = $('.table-list').find('tr.active').attr('id');
            $.ajax({ url: "{{ web_url() }}/admin/news/unpublish/"+id,
                type: 'get',
                success:
                        function() {
                            $('.table-list').find('tr.active').find('td:eq(3)').text('Нет');
                        }
            });
        });

        $('.delete').on ('click', function(){
            var id = $('.table-list').find('tr.active').attr('id');
            $.ajax({ url: "{{ web_url() }}/admin/news/"+id+"/delete",
                type: 'get',
                success:
                        function() {
                            $('.table-list').find('tr.active').remove();
                        }

            });
        });
    </script>
@stop
