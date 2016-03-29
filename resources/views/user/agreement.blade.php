@extends('layout')
@section('content')
    <div class="cabinet">
        <h1>Личный кабинет</h1>
        <p>
            <a href="{{web_url()}}/user" type="button" class="btn btn-default">Личные данные</a>
            <a href="{{web_url()}}/user/childrens" type="button" class="btn btn-default">Данные детей</a>
            <a href="{{web_url()}}/user/proposales" type="button" class="btn btn-default">Заявки</a>
        </p>
        <hr>
        {!! Form::open(array('url'=>"user/proposale/save_agreement" ,'method'=>'POST', 'files'=>true)) !!}
        <input type="hidden" name="id" value="{{$proposale->id}}">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <h3>Соглашение</h3>
        <div class="upload-group">
            <div class="inline-block">
                <div class="title"><span><b>Соглашение</b></span></div>
                <br>
                @if($proposale->agreement == '')
                    Сначала Вам нужно <a href="{{web_url()}}/user/proposale/{{$proposale->id}}/agreement/print" >распечатать соглашение</a><br>
                    @else
                    Соглашение уже прикреплено<br>
                    <a href="{{web_url()}}/user/proposale/{{$proposale->id}}/agreement/print" >Повторно распечатать соглашение</a>
                @endif
                <br>
                <div class="inline-title"><br><span>Прикрепить</span></div>
                <div class="line-value"> {!! Form::file('agreement', null, [ 'class' => 'inputbox img-form']) !!}</div>
                <input type="hidden" name="path" value="">
            </div>
            <div class="inline-block">
                <div class="inline-info"><span>Загрузка файла (максимальный размер: 10 MB)</span></div>
            </div>
        </div>
        <br>
        <div class="inline-block">
            <input class="btn btn-success" type="submit" value="Сохранить">
            <a href="{{web_url()}}/user/proposales" class="btn btn-danger">Отмена</a>
        </div>
        {!! Form::close() !!}
    </div>
    <script type="text/javascript">
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