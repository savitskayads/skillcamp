@extends('admin.layout')
@section('content')

    {!! Form::open(array('url'=>"/admin/programs/vacation/save",'method'=>'POST', 'files'=>true)) !!}
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="program_id" value="{{$program_id}}">
        <input type="hidden" name="id" value="{{$vacation->id}}">
        <div class="add-event">
            <div class="inline-block">
                <div class="line-title"><span>Опубликована</span></div>
                {!! Form::checkbox('active', $vacation->active, $vacation->active) !!}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Год проведения</span></div><div class="line-value">
                    {!!  Form::text('year', $vacation->year, ['placeholder' => 'Год проведения', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Сезон</span></div>
                <label class="radio-inline"><input type="radio" name="season" value="Зима" @if($vacation->season=='Зима')checked="checked"@endif>Зима</label>
                <label class="radio-inline"><input type="radio" name="season" value="Весна" @if($vacation->season=='Весна')checked="checked"@endif>Весна</label>
                <label class="radio-inline"><input type="radio" name="season" value="Лето" @if($vacation->season=='Лето')checked="checked"@endif>Лето</label>
                <label class="radio-inline"><input type="radio" name="season" value="Осень" @if($vacation->season=='Осень')checked="checked"@endif>Осень</label>
                <label class="radio-inline"><input type="radio" name="season" value="Выходной день" @if($vacation->season=='Выходной день')checked="checked"@endif>Выходной день</label>
                <label class="radio-inline"><input type="radio" name="season" value="Фестиваль" @if($vacation->season=='Фестиваль')checked="checked"@endif>Фестиваль</label>
                <label class="radio-inline"><input type="radio" name="season" value="Все сезоны" @if($vacation->season=='Все сезоны')checked="checked"@endif>Все сезоны</label>
            </div>

            <div class="inline-block">
                <div class="line-title"><span>Начало программы </span></div><div class="line-value">
                    @if($vacation->start_date=='0000-00-00 00:00:00'||!isset($vacation->start_date))
                        {!! Form::text('start_date','', ['placeholder' => 'Начало', 'class'=>'inputbox','class'=>'datepicker']) !!}
                    @else
                        {!! Form::text('start_date', date('m/d/Y',strtotime($vacation->start_date)), ['placeholder' => 'Начало', 'class'=>'inputbox','class'=>'datepicker']) !!}
                    @endif
                </div>
            </div>

            <div class="inline-block">
                <div class="line-title"><span>Окончание программы </span></div><div class="line-value">
                    @if($vacation->finish_date=='0000-00-00 00:00:00'||!isset($vacation->finish_date))
                        {!! Form::text('finish_date','', ['placeholder' => 'Окончание', 'class'=>'inputbox','class'=>'datepicker']) !!}
                    @else
                        {!! Form::text('finish_date',date('m/d/Y',strtotime($vacation->finish_date)), ['placeholder' => 'Окончание', 'class'=>'inputbox','class'=>'datepicker']) !!}
                    @endif
                </div>
            </div>
            <div class="add-event">
                <div class="inline-block">
                    <div class="btn-group">
                        <button class="btn add add-vacation" type="submit"><i class="fa pull-left fa-floppy-o"></i>Сохранить</button>
                        <a href="{{web_url()}}/admin/programs/{{$program_id}}/edit" class="btn cancel"><i class="fa pull-left fa-times-circle"></i>Отмена</a>
                        <a href="{{web_url()}}/admin/programs/vacation/{{$vacation->id}}/delete" class="btn cancel"><i class="fa pull-left fa-times-circle"></i>Удалить</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            <br>
            <h3 >Смены</h3>
            @if(!isset($vacation->id))
                Чтобы добавить смену, сначала добавьте и сохраните время проведения программы
            @else
            <a href="{{web_url()}}/admin/programs/{{$vacation->id}}/session/create" class="btn add" style="margin-top: 1%; margin-bottom: 1%;">Добавить</a>
            <br>
                @if($sessions->count()!=0)
                    <table class="table-list">
                        <tr>
                            <th>Время проведения</th>
                        </tr>
                        @foreach($sessions as $session)
                            <tr class='session' id={{$session->id}}>
                                <td><a href="{{web_url()}}/admin/programs/session/{{$session->id}}/edit">
                                        с {{$session->start_date}} по {{$session->finish_date}}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <br>
                    <div class="inline-block">
                        <div class="line-title"><span>Смены еще не добавлены</span></div>
                    </div>
                @endif
            @endif



        </div>


    <script type="text/javascript">
        $('input[name=active]').on('click',function(){
            var v=Math.abs(this.value-1);
            this.value=v;
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $( ".datepicker" ).datepicker();
        });
    </script>
@stop
