@extends('admin.layout')
@section('content')



    <div class="wrap">
        <div class="header">
            <div class="clear">
                <div class="title"><span>Программы лагеря</span></div>
                <div class="controls">
                    <div class="btn-group publish"><a href="#" class="btn add"><i class="fa pull-left "></i>Опубликовать</a></div>
                    <div class="btn-group unpublish"><a href="#" class="btn add"><i class="fa pull-left "></i>Снять с публикации</a></div>
                    <div class="btn-group delete"><a href="#" class="btn add"><i class="fa pull-left "></i>Удалить</a></div>
                    <div class="btn-group"><a href="{{web_url()}}/admin/programs/create" class="btn add"><i class="fa pull-left fa-plus"></i>Добавить</a></div>
                </div>
            </div>
        </div>
        <div class="content programs">
            <div class="clear">
                <table class="table-list">
                    <tr>
                        <th class="center col-2">ID</th>
                        <th>Название</th>
                        <th>Количество мест</th>
                        <th>Цена</th>
                        <th class="col-4">Время проведения</th>
                        <th>Опубликована</th>
                        <th class="center col-btn"><i class="fa fa-th-list"></i></th>
                    </tr>
                    @foreach($programs as $program)
                        <tr class='program' id={{$program->id}}>
                            <td class="center col-2">{{$program->id}}</td>
                            <td><a href="{!! web_url() !!}/admin/programs/{!! $program->id !!}/edit">{{  $program->title }}</a></td>
                            <td>{{$program->places}}</td>
                            <td>{{$program->price}}</td>
                            <td>{{date('d.m', strtotime($program->start_date)) }} - {{date('d.m', strtotime($program->finish_date))}}</td>
                            @if($program->active == 1)
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
                                                <li><a href="{{web_url()}}/admin/programs/{{$program->id}}/edit" class="accept"><i class="fa pull-left fa-chevron-down"></i>Изменить</a></li>
                                                <li><a href="{{web_url()}}/admin/programs/{{$program->id}}/delete"><i class="fa pull-left fa-times"></i>Удалить</a></li>
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
        $('tr.program').on ('click',  function(){
            var id = this.id;
            $.each($('tr'), function(i,v){
                $(v).removeClass('active');
            });
            $(this).addClass('active');
        });

        $('.publish').on ('click', function(){
            var id = $('.table-list').find('tr.active').attr('id');
            $.ajax({ url: "{{ web_url() }}/admin/programs/publish/"+id,
                type: 'get',
                success:
                    function() {
                        $('.table-list').find('tr.active').find('td:eq(5)').text('Да');
                    }
            });
        });

        $('.unpublish').on ('click', function(){
            var id = $('.table-list').find('tr.active').attr('id');
            $.ajax({ url: "{{ web_url() }}/admin/programs/unpublish/"+id,
                type: 'get',
                success:
                    function() {
                        $('.table-list').find('tr.active').find('td:eq(5)').text('Нет');
                    }
            });
        });

        $('.delete').on ('click', function(){
            var id = $('.table-list').find('tr.active').attr('id');
            $.ajax({ url: "{{ web_url() }}/programs/"+id+"/delete",
                type: 'get',
                success:
                        function() {
                            $('.table-list').find('tr.active').remove();
                        }

            });
        });
    </script>



@stop