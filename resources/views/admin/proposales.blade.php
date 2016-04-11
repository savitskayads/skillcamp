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
                        <th>ID</th>
                        <th>Программа</th>
                        <th class="col-4">Время проведения</th>
                        <th>От кого</th>
                        <th>Ребенок</th>
                        <th>Анкета</th>
                    </tr>
                    @foreach($proposales as $proposale)
                    <tr class='proposale' >
                        <td>{{$proposale->id}}</td>
                        <td class="center col-2">{{$proposale->program_name}}</td>
                        <td>C {{date('d/m/Y',strtotime($proposale->program_start))}} по {{date('d/m/Y',strtotime($proposale->program_finish))}}</td>
                        <td>{{$proposale->user_name}}</td>
                        <td>{{$proposale->children_name}} {{$proposale->children_surname}}</td>
                        <td>{{$proposale->application_form}}</td>
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