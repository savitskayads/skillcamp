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
        <div class="content proposales">
            <div class="clear">
                <table class="table-list">
                    <tr>
                        <th>Программа</th>
                        <th class="col-4">Время проведения</th>
                        <th>От кого</th>
                        <th>Ребенок</th>
                        <th class="center col-btn"><i class="fa fa-th-list"></i></th>
                    </tr>
                        <tr class='program' >
                            <td class="center col-2">Зимняя сказка</td>
                            <td>C 01.01.2016 по 12.01.2028</td>
                            <td>Иванов Петр Петрович</td>
                            <td>Иванова Мария Петровна</td>
                            <td class="center col-btn">
                                <div class="droplist-group">
                                    <i class="fa fa-ellipsis-v"></i>
                                    <div class="droplist" style="display: none">
                                        <div>
                                            <ul>
                                                <li><a href="{{web_url()}}/admin/programs/edit" class="accept"><i class="fa pull-left fa-chevron-down"></i>Изменить</a></li>
                                                <li><a href="{{web_url()}}/admin/programs/delete"><i class="fa pull-left fa-times"></i>Удалить</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
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