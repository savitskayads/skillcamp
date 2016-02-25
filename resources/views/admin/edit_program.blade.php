@extends('admin.layout')
@section('content')

    {!! Form::open(array('url'=>"admin/programs/save",'method'=>'POST', 'files'=>true)) !!}
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="id" value="{{$program->id}}">
        <div class="add-event">
            <div class="inline-block">
                <div class="line-title"><span>Название</span></div><div class="line-value">
                    {!!  Form::text('title', $program->title, ['placeholder' => 'Название', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Опубликована</span></div>
                    {!! Form::checkbox('active', $program->active, $program->active) !!}
            </div>
        </div>
        <div class="upload-group">
            <div class="inline-block">
                <div class="title"><span>Изображение</span></div>
                <div class="inline-title"><span>Выберите файл</span></div>

                <div class="line-value"> {!! Form::file('img', null, [ 'class' => 'inputbox img-form']) !!}</div>

                <input type="hidden" name="path" value="">
            </div>
            <div class="inline-block">
                <div class="inline-info"><span>Загрузка файла (максимальный размер: 10 MB)</span></div>
            </div>
            @if($program->image == '')
                <div class="image"><img src="{!! web_url() !!}/uploads/small/default.png" class="img-upload" alt="" width="168" height="119"></div>
            @else
                <div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $program->image }}" alt="" class="img-upload" width="168" height="119"></div>
            @endif
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
                <div class="line-title"><span>Цена по акции</span></div><div class="line-value">{!! Form::text('action_price', $program->action_price, ['placeholder' => 'Цена по акции', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Описание акции</span></div><div class="line-value">{!! Form::text('action_description', $program->action_description, ['placeholder' => 'Описание акции', 'class'=>'inputbox']) !!}</div>
            </div>

            <div class="inline-block">
                <div class="line-title"><span>Количество мест</span></div><div class="line-value">{!! Form::text('places', $program->places, ['placeholder' => 'Количество мест', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Сезон</span></div>
                <label class="radio-inline"><input type="radio" name="vacation" value="Зима" @if($program->vacation=='Зима')checked="checked"@endif>Зима</label>
                <label class="radio-inline"><input type="radio" name="vacation" value="Весна" @if($program->vacation=='Весна')checked="checked"@endif>Весна</label>
                <label class="radio-inline"><input type="radio" name="vacation" value="Лето" @if($program->vacation=='Лето')checked="checked"@endif>Лето</label>
                <label class="radio-inline"><input type="radio" name="vacation" value="Осень" @if($program->vacation=='Осень')checked="checked"@endif>Осень</label>
                <label class="radio-inline"><input type="radio" name="vacation" value="Выходной день" @if($program->vacation=='Выходной день')checked="checked"@endif>Выходной день</label>
                <label class="radio-inline"><input type="radio" name="vacation" value="Фестиваль" @if($program->vacation=='Фестиваль')checked="checked"@endif>Фестиваль</label>
                <label class="radio-inline"><input type="radio" name="vacation" value="Все сезоны" @if($program->vacation=='Все сезоны')checked="checked"@endif>Все сезоны</label>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Возраст участников</span></div><div class="line-value">{!! Form::text('age', $program->age, ['placeholder' => 'Возраст участников', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Пол участников</span></div>
                <label class="radio-inline"><input type="radio" name="sex" value="mens" @if($program->sex=='mens')checked="checked"@endif>мальчики</label>
                <label class="radio-inline"><input type="radio" name="sex" value="womens" @if($program->sex=='womens')checked="checked"@endif>девочки</label>
                <label class="radio-inline"><input type="radio" name="sex" value="all"  @if($program->sex=='all')checked="checked"@endif>все</label>
            </div>

            <div class="inline-block">
                <div class="line-title"><span>Начало программы </span></div><div class="line-value">
                    @if($program->start_date!='')
                    {!! Form::text('start_date', date('d/m/Y',$program->start_date), ['placeholder' => 'Начало', 'class'=>'inputbox','class'=>'datepicker']) !!}
                    @else
                    {!! Form::text('start_date','', ['placeholder' => 'Начало', 'class'=>'inputbox','class'=>'datepicker']) !!}
                    @endif
                </div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Окончание программы </span></div><div class="line-value">
                    @if($program->finish_date!='')
                        {!! Form::text('finish_date',date('d/m/Y',$program->finish_date), ['placeholder' => 'Окончание', 'class'=>'inputbox','class'=>'datepicker']) !!}
                    @else
                        {!! Form::text('finish_date','', ['placeholder' => 'Окончание', 'class'=>'inputbox','class'=>'datepicker']) !!}
                    @endif
                </div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Смена 1 </span></div><div class="line-value">
                    начало
                    @if($program->session_1_start!='')
                        {!! Form::text('session_1_start', date('d/m/Y',$program->session_1_start), ['class'=>'inputbox','class'=>'datepicker']) !!}
                    @else
                        {!! Form::text('session_1_start', '', ['class'=>'inputbox','class'=>'datepicker']) !!}
                    @endif
                    окончание
                    @if($program->session_1_finish!='')
                        {!! Form::text('session_1_finish', date('d/m/Y',$program->session_1_finish), ['class'=>'inputbox','class'=>'datepicker']) !!}
                    @else
                        {!! Form::text('session_1_finish', '', ['class'=>'inputbox','class'=>'datepicker']) !!}
                    @endif
                   </div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Смена 2 </span></div><div class="line-value">
                    начало
                    @if($program->session_2_start!='')
                        {!! Form::text('session_2_start', date('d/m/Y',$program->session_2_start), ['class'=>'inputbox','class'=>'datepicker']) !!}
                    @else
                        {!! Form::text('session_2_start', '', ['class'=>'inputbox','class'=>'datepicker']) !!}
                    @endif
                    окончание
                    @if($program->session_2_finish!='')
                        {!! Form::text('session_2_finish', date('d/m/Y',$program->session_2_finish), ['class'=>'inputbox','class'=>'datepicker']) !!}
                    @else
                        {!! Form::text('session_2_finish', '', ['class'=>'inputbox','class'=>'datepicker']) !!}
                    @endif
                </div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Смена 3 </span></div><div class="line-value">
                    начало
                    @if($program->session_3_start!='')
                        {!! Form::text('session_3_start', date('d/m/Y',$program->session_3_start), ['class'=>'inputbox','class'=>'datepicker']) !!}
                    @else
                        {!! Form::text('session_3_start', '', ['class'=>'inputbox','class'=>'datepicker']) !!}
                    @endif
                    окончание
                    @if($program->session_3_finish!='')
                        {!! Form::text('session_3_finish', date('d/m/Y',$program->session_3_finish), ['class'=>'inputbox','class'=>'datepicker']) !!}
                    @else
                        {!! Form::text('session_3_finish', '', ['class'=>'inputbox','class'=>'datepicker']) !!}
                    @endif
                </div>
            </div>

            <div class="inline-block">
                <div class="title"><span>Описание</span></div><div class="value"><textarea class="textbox" type="text" name="description" placeholder="Описание программы">{{ $program->description }}</textarea></div>
            </div>
            <div class="inline-block">
                <div class="line-title">Документы, которые необходимо прикрепить:</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Документ 1</span></div>
                {!! Form::checkbox('document_1', $program->document_1, $program->document_1) !!}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Документ 2</span></div>
                {!! Form::checkbox('document_2', $program->document_2, $program->document_2) !!}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Документ 3</span></div>
                {!! Form::checkbox('document_3', $program->document_3, $program->document_3) !!}
            </div>
        </div>
        <div class="add-event">
            <div class="inline-block">
                <div class="btn-group">
                    {{--{!! Form::submit('Сохранить', array('class'=>'btn add addevent', 'id' => 'edit_programs')) !!}--}}
                    <button class="btn add add-program" type="submit"><i class="fa pull-left fa-floppy-o"></i>Сохранить</button>
                    <a href="{{web_url()}}/admin/programs" class="btn cancel"><i class="fa pull-left fa-times-circle"></i>Отмена</a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    <script type="text/javascript">
        $('input[name=active]').on('click',function(){
            var v=Math.abs(this.value-1);
            this.value=v;
        });
        $('input[name=document_1]').on('click',function(){
            var v=Math.abs(this.value-1);
            this.value=v;
        });
        $('input[name=document_2]').on('click',function(){
            var v=Math.abs(this.value-1);
            this.value=v;
        });
        $('input[name=document_3]').on('click',function(){
            var v=Math.abs(this.value-1);
            this.value=v;
        });

        $('input[name=img]').on('change', function(fileInput){

            var file = fileInput.target.files[0];

                var imageType = /image.*/;

                if (file.type.match(imageType)) {

                    var img = $('.img-upload');

                    img.attr('src', URL.createObjectURL(file))

                }

        })


    </script>
    <script type="text/javascript">
        $(function() {
            $( ".datepicker" ).datepicker();
        });
    </script>
@stop
