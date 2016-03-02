@extends('layout')
@section('content')

    <form  method="POST" action="{{web_url()}}/user/proposale/create" role="form" class = "login-form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h3>Оформление заявки - шаг 1, выбор программы</h3>
        <br>
        <div class="form-group">
            <label for="sel1">Программа</label>
            <select class="form-control program" id="sel1" name="program_id">
                @foreach($programs as $program)
                <option value="{{$program->id}}" {{ $program->id == $selected_program_id ? "selected" : ""}}>{{$program->title}}</option>
               @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="sel1">Период проведения</label>
            <select class="form-control vacations" id="sel1" name="vacation_id">
                @if($vacations->count()==0)
                    <option value="0">даты проведения программы еще не добавлены</option>
                @else
                    @foreach($vacations as $vacation)
                        <option value="{{$vacation->id}}"> c {{$vacation->start_date}} по {{$vacation->finish_date}}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="form-group">
            <label for="sel1">Смена</label>
            <select class="form-control parts" id="sel1" name="part_id">
                @if($parts->count()==0)
                    <option value="0">даты смен не добавлены</option>
                @else
                    @foreach($parts as $part)
                        <option value="{{$part->id}}">c {{$part->start_date}} по {{$part->finish_date}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group">
            <label for="transfer">Трансфер</label>
            <div class="radio">
                <label><input type="radio" name="transfer" value="только на программу">только на программу</label>
                <label><input type="radio" name="transfer" value="только с программы">только с программы</label>
                <label><input type="radio" name="transfer" value="в обе стороны">в обе стороны</label>
                <label><input type="radio" name="transfer" value="самостоятельная доставка в обе стороны">самостоятельная доставка в обе стороны</label>
            </div>
        </div>
        <div class="form-group">
            <label for="registration_date">Дата оформления</label>
            <input type="text" name="registration_date" class="form-control" value="{{date("d.m.Y")}}" disabled >
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>

        <div class="inline-block">
            <input class="btn btn-default" type="submit" name="login" value="Отправить">
            <a href="{{web_url()}}" class="btn btn-danger">Отмена</a>
        </div>
    </form>

    <script type="text/javascript">
        $('.program').on('change',function(){
            var program_id = $(this).val();
//            console.log(program_id);
            $.ajax({ url: "{{ web_url() }}/programs/get_program/"+program_id,
                type: 'get',
                dataType: 'json',
                success:
                        function(data) {
                            $.each(data, function(i, v){
                                console.log(v.start_date);
                                console.log(v.finish_date);
                            });
                        }
            });
        });

        $('.vacations').on('change',function(){
            var vacation_id = $(this).val();
            $.ajax({ url: "{{ web_url() }}/programs/get_vacation/"+vacation_id,
                type: 'get',
                dataType: 'json',
                success:
                        function(data) {
                            $.each(data, function(i, v){
                                console.log(v.start_date);
                                console.log(v.finish_date);
                            });
                        }
            });
        })
    </script>

@stop