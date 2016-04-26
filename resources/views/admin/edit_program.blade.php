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
                <div class="line-title"><span>Цена по акции №1</span></div><div class="line-value">{!! Form::text('action_price', $program->action_price, ['placeholder' => 'Цена по акции', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Описание акции</span></div><div class="line-value">{!! Form::text('action_description', $program->action_description, ['placeholder' => 'Описание акции', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Цена по акции №2</span></div><div class="line-value">{!! Form::text('action_price_2', $program->action_price_2, ['placeholder' => 'Цена по акции', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Описание акции</span></div><div class="line-value">{!! Form::text('action_description_2', $program->action_description_2, ['placeholder' => 'Описание акции', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Цена для старого участника </span></div><div class="line-value">{!! Form::text('member_discount', $program->member_discount, ['class'=>'inputbox']) !!} </div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Цена для того, кто привел друга</span></div><div class="line-value">{!! Form::text('friend_discount', $program->friend_discount, ['class'=>'inputbox']) !!} </div>
            </div>


            <div class="inline-block">
                <div class="line-title"><span>Количество мест</span></div><div class="line-value">{!! Form::text('places', $program->places, ['placeholder' => 'Количество мест', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Сезон</span></div>
                <label class="radio-inline"><input type="radio" name="season" value="Зима" @if($program->season=='Зима')checked="checked"@endif>Зима</label>
                <label class="radio-inline"><input type="radio" name="season" value="Весна" @if($program->season=='Весна')checked="checked"@endif>Весна</label>
                <label class="radio-inline"><input type="radio" name="season" value="Лето" @if($program->season=='Лето')checked="checked"@endif>Лето</label>
                <label class="radio-inline"><input type="radio" name="season" value="Осень" @if($program->season=='Осень')checked="checked"@endif>Осень</label>
                <label class="radio-inline"><input type="radio" name="season" value="Выходной день" @if($program->season=='Выходной день')checked="checked"@endif>Выходной день</label>
                <label class="radio-inline"><input type="radio" name="season" value="Фестиваль" @if($program->season=='Фестиваль')checked="checked"@endif>Фестиваль</label>
                <label class="radio-inline"><input type="radio" name="season" value="Все сезоны" @if($program->season=='Все сезоны')checked="checked"@endif>Все сезоны</label>
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
                <div class="title"><span>Описание</span></div><div class="value"><textarea class="textbox" type="text" name="description" placeholder="Описание программы">{{ $program->description }}</textarea></div>
            </div>
            <div class="inline-block">
                <div class="line-title">Документы, которые необходимо прикрепить:</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Документ</span></div>
                {!! Form::checkbox('document_1', $program->document_1, $program->document_1) !!}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Полис</span></div>
                {!! Form::checkbox('document_2', $program->document_2, $program->document_2) !!}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Справка о контактах</span></div>
                {!! Form::checkbox('document_3', $program->document_3, $program->document_3) !!}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Справка о прививках</span></div>
                {!! Form::checkbox('document_4', $program->document_4, $program->document_4) !!}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Справка в бассейн</span></div>
                {!! Form::checkbox('document_5', $program->document_5, $program->document_5) !!}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Справка о нагрузках</span></div>
                {!! Form::checkbox('document_6', $program->document_6, $program->document_6) !!}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Согласие о пересечении границы</span></div>
                {!! Form::checkbox('document_7', $program->document_7, $program->document_7) !!}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Справка из школы</span></div>
                {!! Form::checkbox('document_8', $program->document_8, $program->document_8) !!}
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

    <br>
    <h3 style="margin-left: 15%;">Время проведения программы</h3>
        <br>
    @if(!isset($program->id))
        <span style="margin-left: 15%; margin-bottom: 15%">Чтобы добавить время проведения программы, сначала сохраните текущую программу</span>
        <br>
    @else
        <a href="{{web_url()}}/admin/programs/{{$program->id}}/vacation/create" class="btn add" style="margin-left: 15%; margin-top: 1%; margin-bottom: 1%;">Добавить</a>
        @if($vacations->count()!=0)
            <table class="table-list" style="margin-left: 15%;">
                <tr>
                    <th>Год</th>
                    <th>Сезон</th>
                    <th>Время проведения</th>
                </tr>
                @foreach($vacations as $vacation)
                    <tr class='vacation' id={{$vacation->id}}>
                        <td><a href="{{web_url()}}/admin/programs/vacation/{{$vacation->id}}/edit">{{$vacation->year}}</a></td>
                        <td><a href="{{web_url()}}/admin/programs/vacation/{{$vacation->id}}/edit">{{$vacation->season}}</a></td>
                        <td><a href="{{web_url()}}/admin/programs/vacation/{{$vacation->id}}/edit">
                                с {{$vacation->start_date}} по {{$vacation->finish_date}}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <br>
            <div class="inline-block" style="margin-left: 15%;">
                <div class="line-title"><span>Время проведения еще не добавлено</span></div>
            </div>
        @endif
    @endif

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
        $('input[name=document_4]').on('click',function(){
            var v=Math.abs(this.value-1);
            this.value=v;
        });
        $('input[name=document_5]').on('click',function(){
            var v=Math.abs(this.value-1);
            this.value=v;
        });
        $('input[name=document_6]').on('click',function(){
            var v=Math.abs(this.value-1);
            this.value=v;
        });
        $('input[name=document_7]').on('click',function(){
            var v=Math.abs(this.value-1);
            this.value=v;
        });
        $('input[name=document_8]').on('click',function(){
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
