@extends('admin.layout')
@section('content')
    {!! Form::open(array('url'=>"admin/programs/save",'method'=>'POST', 'files'=>true)) !!}
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="id" value="{{$program->id}}">
        <div class="add-event">
            <div class="inline-block">
                <div class="line-title"><span>Название</span></div><div class="line-value">{!!  Form::text('title', $program->title, ['placeholder' => 'Название', 'class'=>'inputbox']) !!}</div>
            </div>
        </div>
        <div class="upload-group">
            <div class="inline-block">
                <div class="title"><span>Изображение</span></div>
                <div class="inline-title"><span>Выберите файл</span></div>

                <div class="line-value"> {!! Form::file('img', null,[ 'class'=>'inputbox']) !!}</div>
                {{--<div class="btn-group">--}}
                    {{--<button class="btn upload uploadpreview"><i class="fa pull-left fa-upload"></i>Загрузить</button>--}}
                {{--</div>--}}
                <input type="hidden" name="path" value="">
            </div>
            <div class="inline-block">
                <div class="inline-info"><span>Загрузка файла (максимальный размер: 10 MB)</span></div>
            </div>
            <div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $program->image }}" alt="" width="168" height="119"></div>
        </div>
        <div class="view-group viewuploadpreview">
            {preview}
        </div>
        <div class="add-event">

            <div class="inline-block">
                <div class="line-title"><span>Адрес лагеря</span></div><div class="line-value">{!!  Form::text('address', $program->address, ['placeholder' => 'Адрес лагеря', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Телефон лагеря</span></div><div class="line-value">{!! Form::text('telephone', $program->telephone, ['placeholder' => 'Телефон для связи', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Цена программы</span></div><div class="line-value">{!! Form::text('price', $program->price, ['placeholder' => 'Цена', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Количество мест</span></div><div class="line-value">{!! Form::text('places', $program->places, ['placeholder' => 'Количество мест', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Сезон</span></div>
                    @foreach($vacations as $vacation)
                        {!! Form::label('vacation',$vacation->title) !!}
                        @if($vacation->id == $program->vacation)
                            {!! Form::checkbox('vacation', $vacation->id, true) !!}
                        @else
                            {!! Form::checkbox('vacation', $vacation->id, false) !!}
                        @endif
                    @endforeach
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Возраст участников</span></div><div class="line-value">{!! Form::text('age', $program->age, ['placeholder' => 'Возраст участников', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Начало программы (формат гггг-мм-дд)</span></div><div class="line-value">
                    @if($program->start_date!='0000-00-00 00:00:00')
                    {!! Form::text('start_date', date("Y-m-d", strtotime($program->start_date)), ['placeholder' => 'Начало', 'class'=>'inputbox']) !!}
                    @else
                    {!! Form::text('start_date','', ['placeholder' => 'Начало', 'class'=>'inputbox']) !!}
                    @endif
                </div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Окончание программы (формат гггг-мм-дд)</span></div><div class="line-value">
                    @if($program->finish_date!='0000-00-00 00:00:00')
                        {!! Form::text('finish_date', date("Y-m-d", strtotime($program->finish_date)), ['placeholder' => 'Окончание', 'class'=>'inputbox']) !!}
                    @else
                        {!! Form::text('finish_date','', ['placeholder' => 'Окончание', 'class'=>'inputbox']) !!}
                    @endif
                   </div>
            </div>



            <div class="inline-block">
                <div class="title"><span>Описание</span></div><div class="value"><textarea class="textbox" type="text" name="description" placeholder="Описание программы">{{ $program->description }}</textarea></div>
            </div>
        </div>
        <div class="add-event">
            <div class="inline-block">
                <div class="btn-group">
                    {{--{!! Form::submit('Сохранить', array('class'=>'btn add addevent', 'id' => 'edit_programs')) !!}--}}
                    <button class="btn add add-program" type="submit"><i class="fa pull-left fa-floppy-o"></i>Сохранить</button>
                    <a href="?do=events" class="btn cancel"><i class="fa pull-left fa-times-circle"></i>Отмена</a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
@stop

<script type="text/javascript">

</script>