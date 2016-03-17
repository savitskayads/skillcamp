@extends('layout')
@section('content')

    <p class="cabinet">
        <h1>Личный кабинет</h1>
        <p>
            <a href="{{web_url()}}/user" type="button" class="btn btn-default">Личные данные</a>
            <a href="{{web_url()}}/user/childrens" type="button" class="btn btn-default">Данные детей</a>
            <a href="{{web_url()}}/user/proposales" type="button" class="btn btn-default">Заявки</a>
        </p>
        <hr>

        <div class="inline-block">
            {{--<div class="col-xs-2">--}}
                {{--<label for="season">Выбрать год</label>--}}
                {{--<select class="form-control year select-program" id="sel1" name="year">--}}
                    {{--<option value="*" selected>Все года</option>--}}
                    {{--<option value="2016" >2016</option>--}}
                    {{--<option value="2017" >2017</option>--}}
                    {{--<option value="2018" >2018</option>--}}
                {{--</select>--}}
            {{--</div>--}}
            <div class="col-xs-2">
                <label for="season">Выбрать сезон</label>
                <select class="form-control season select-program" id="sel1" name="season">
                    <option value="*" selected>Все сезоны</option>
                    <option value="winter" >Зима</option>
                    <option value="spring" >Весна</option>
                    <option value="summer" >Лето</option>
                    <option value="autumn" >Осень</option>
                    <option value="weekend" >Выходной день</option>
                    <option value="festival" >Фестиваль</option>
                </select>
            </div>
            <div class="col-xs-2">
                <label for="season">Выбрать программу</label>
                <select class="form-control program select-program" id="sel1" name="program">
                    <option value="*" >Все программы</option>
                    @foreach($all_programs as $program)
                        <option value="{{$program->id}}" >{{$program->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <p>
            <a href="#" class="btn btn-success show-all" style="margin-top: 5px;">Показать все активные программы</a>
        </p>

        <br>
        <div class="table-responsive" style="display: block; margin-top: 10px;">
            <table class="table">
                <thead>
                <tr>
                    <th>Программа</th>
                    <th>Время проведения</th>
                    <th>Смена</th>
                </tr>
                </thead>
                <tbody>
                @foreach($programs as $program)
                    <tr class = 'programs'>
                        <td><a href="{{web_url()}}/program/{{$program->id}}"> {{$program->title}} </a></td>
                        <td> c {{date('d/m/Y',strtotime($program->vacation_start))}} по {{date('d/m/Y',strtotime($program->vacation_finish))}}</td>
                        <td> c {{date('d/m/Y',strtotime($program->part_start))}} по {{date('d/m/Y',strtotime($program->part_finish))}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        $('.show-all').on('click',function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ web_url() }}/public/user/all_programs/",
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    $('.programs').remove();
                    $.each(data, function (i, v) {
                        if(v.vacation_start == null){
                            var vacation = "Даты проведения программы не определены";
                        } else{
                            var vacation_start_date= new Date(v.vacation_start);
                            var vacation_start_day = vacation_start_date.getDate();
                            var vacation_start_month= vacation_start_date.getMonth();
                            var vacation_start_year = vacation_start_date.getFullYear();
                            var vacation_finish_date= new Date(v.vacation_finish);
                            var vacation_finish_day = vacation_finish_date.getDate();
                            var vacation_finish_month= vacation_finish_date.getMonth();
                            var vacation_finish_year = vacation_finish_date.getFullYear();
                            var vacation = "c " + vacation_start_day+"/"+vacation_start_month+"/"+vacation_start_year  + " по "
                                    + vacation_finish_day+"/"+vacation_finish_month+"/"+vacation_finish_year;
                        }
                        if(v.part_start == null){
                            var part = "Даты смены не определены"
                        } else {
                            var part_start_date= new Date(v.part_start);
                            var part_start_day = part_start_date.getDate();
                            var part_start_month= part_start_date.getMonth();
                            var part_start_year = part_start_date.getFullYear();
                            var part_finish_date= new Date(v.part_finish);
                            var part_finish_day = part_finish_date.getDate();
                            var part_finish_month= part_finish_date.getMonth();
                            var part_finish_year = part_finish_date.getFullYear();

                            var part = "c " +part_start_day+"/"+part_start_month+"/"+part_start_year  + " по "
                                    + part_finish_day+"/"+part_finish_month+"/"+part_finish_year;
                        }
                        var t = "<tr class = 'programs'>" +
                                "<td>"+ "<a href='/public/program/"+v.id+"'>" + v.title +"</a>"+ "</td>" +
                                "<td>" +vacation+ "</td>" +
                                "<td>"+part+ "</td>" +
                                "</tr>";
                        $(t).prependTo('tbody');
                    });
                }
            });
        });

        $('.select-program').on('change', function() {
            var year = $('.year').val();
            var season = $('.season').val();
            var program = $('.program').val();
            $.ajax({
                url: "{{ web_url() }}/public/user/select_programs/",
                type: 'get',
                data: {year: year, season: season, program: program},
                dataType: 'json',
                success: function (data) {
                    $('.programs').remove();
                    $.each(data, function (i, v) {
                        if (v.vacation_start == null) {
                            var vacation = "Даты проведения программы не  определены";
                        } else {
                            var vacation_start_date= new Date(v.vacation_start);
                            var vacation_start_day = vacation_start_date.getDate();
                            var vacation_start_month= vacation_start_date.getMonth();
                            var vacation_start_year = vacation_start_date.getFullYear();
                            var vacation_finish_date= new Date(v.vacation_finish);
                            var vacation_finish_day = vacation_finish_date.getDate();
                            var vacation_finish_month= vacation_finish_date.getMonth();
                            var vacation_finish_year = vacation_finish_date.getFullYear();
                            var vacation = "c " + vacation_start_day+"/"+vacation_start_month+"/"+vacation_start_year  + " по "
                                    + vacation_finish_day+"/"+vacation_finish_month+"/"+vacation_finish_year;
                        }
                        if (v.part_start  == null) {
                            var part = "Даты смены не определены"
                        } else {
                            var part_start_date= new Date(v.part_start);
                            var part_start_day = part_start_date.getDate();
                            var part_start_month= part_start_date.getMonth();
                            var part_start_year = part_start_date.getFullYear();
                            var part_finish_date= new Date(v.part_finish);
                            var part_finish_day = part_finish_date.getDate();
                            var part_finish_month= part_finish_date.getMonth();
                            var part_finish_year = part_finish_date.getFullYear();

                            var part = "c " +part_start_day+"/"+part_start_month+"/"+part_start_year  + " по "
                                    + part_finish_day+"/"+part_finish_month+"/"+part_finish_year;
                        }
                        var t = "<tr class = 'programs'>" +
                                "<td>"+ "<a href='/public/program/"+v.id+"'>" + v.title +"</a>"+ "</td>" +
                                "<td>" + vacation + "</td>" +
                                "<td>" + part + "</td>" +
                                "</tr>";
                        $(t).prependTo('tbody');
                    });
                }
            });
        });
    </script>

@stop
