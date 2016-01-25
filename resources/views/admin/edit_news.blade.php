@extends('admin.layout')
@section('content')
    {!! Form::open(array('url'=>"admin/news/save",'method'=>'POST', 'files'=>true)) !!}
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="id" value="{{$news->id}}">
        <div class="add-event">
            <div class="inline-block">
                <div class="line-title"><span>Заголовок</span></div><div class="line-value">
                    {!!  Form::text('title', $news->title, ['placeholder' => 'Заголовок', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Опубликована</span></div>
                    {!! Form::checkbox('active', $news->active, $news->active) !!}
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
            @if($news->image == '')
                <div class="image"><img src="{!! web_url() !!}/uploads/small/default.png" class="img-upload" alt="" width="168" height="119"></div>
            @else
                <div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $news->image }}" alt="" class="img-upload" width="340" height="127"></div>
            @endif
        </div>
        <div class="view-group viewuploadpreview">
            {preview}
        </div>
        <div class="add-event">

            <div class="inline-block">
                <div class="line-title"><span>Дата (формат гггг-мм-дд)</span></div>
                <div class="line-value">
                    @if($news->date!='0000-00-00 00:00:00')
                    {!! Form::text('date', date("Y-m-d", strtotime($news->date)), ['placeholder' => 'Дата', 'class'=>'inputbox']) !!}
                    @else
                    {!! Form::text('date','', ['placeholder' => 'Дата', 'class'=>'inputbox']) !!}
                    @endif
                </div>
            </div>
            <div class="inline-block">
                <div class="title"><span>Содержание</span></div><div class="value"><textarea class="textbox" type="text" name="description" placeholder="Содержание ">{{ $news->description }}</textarea></div>
            </div>
        </div>
        <div class="add-event">
            <div class="inline-block">
                <div class="btn-group">
                    {{--{!! Form::submit('Сохранить', array('class'=>'btn add addevent', 'id' => 'edit_programs')) !!}--}}
                    <button class="btn add add-program" type="submit"><i class="fa pull-left fa-floppy-o"></i>Сохранить</button>
                    <a href="{{web_url()}}/admin/news" class="btn cancel"><i class="fa pull-left fa-times-circle"></i>Отмена</a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    <script type="text/javascript">
        $('input[name=active]').on('click',function(){
            var v=Math.abs(this.value-1);
            this.value=v;
        })

        $('input[name=img]').on('change', function(fileInput){

            var file = fileInput.target.files[0];

                var imageType = /image.*/;

                if (file.type.match(imageType)) {

                    var img = $('.img-upload');

                    img.attr('src', URL.createObjectURL(file))

                }

        })
    </script>
@stop
