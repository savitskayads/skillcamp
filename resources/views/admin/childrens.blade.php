@extends('admin.layout')
@section('content')



    <div class="wrap">
        <div class="header">
            <div class="clear">
                <div class="title"><span>Пользователи</span></div>
                <div class="controls">
                    <div class="btn-group"><a href="{{web_url()}}/admin/children/create" class="btn add"><i class="fa pull-left fa-plus"></i>Добавить</a></div>
                </div>
            </div>
        </div>
        <div class="content users">
            <div class="clear">
                <table class="table-list">
                    <tr>
                        <th class="center col-2">ID</th>
                        <th>ФИО</th>
                        <th class="center col-btn"><i class="fa fa-th-list"></i></th>
                    </tr>
                    @foreach($childrens as $children)
                        <tr class='user' id={{$children->id}}>
                            <td class="center col-2">{{$children->id}}</td>
                            <td>{{$children->surname}} {{$children->name}}  {{$children->patronymic}}</td>
                            <td class="center col-btn">
                                <div class="droplist-group">
                                    <i class="fa fa-ellipsis-v"></i>
                                    <div class="droplist" style="display: none">
                                        <div>
                                            <ul>
                                                <li><a href="{{web_url()}}/admin/children/show/{{$children->id}}" class="accept"><i class="fa pull-left fa-chevron-down"></i>Посмотреть</a></li>
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