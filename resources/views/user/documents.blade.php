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
        {!! Form::open(array('url'=>"user/childrens/save_documents" ,'method'=>'POST', 'files'=>true)) !!}
        <input type="hidden" name="id" value="{{$children->id}}">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <h3>Документы</h3>
            <div class="upload-group">
                <div class="inline-block">
                    <div class="title"><span><b>Документ</b></span></div>
                    <div class="inline-title"><span>Выберите файл</span></div>
                    <div class="line-value"> {!! Form::file('document_1', null, [ 'class' => 'inputbox img-form']) !!}</div>
                    <input type="hidden" name="path" value="">
                </div>
                <div class="inline-block">
                    <div class="inline-info"><span>Загрузка файла (максимальный размер: 10 MB)</span></div>
                </div>
                @if($children->document_1 == '')
                @else
                    <div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $children->document_1}}" alt="" class="img-upload" width="168" height="119"></div>
                @endif
            </div>
        <br>
        <div class="upload-group">
            <div class="inline-block">
                <div class="title"><span><b>Полис</b></span></div>
                <div class="inline-title"><span>Выберите файл</span></div>

                <div class="line-value"> {!! Form::file('document_2', null, [ 'class' => 'inputbox img-form']) !!}</div>
                <input type="hidden" name="path" value="">
            </div>
            <div class="inline-block">
                <div class="inline-info"><span>Загрузка файла (максимальный размер: 10 MB)</span></div>
            </div>
            @if($children->document_2 == '')
            @else
                <div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $children->document_2}}" alt="" class="img-upload" width="168" height="119"></div>
            @endif
        </div>
        <br>
        <div class="upload-group">
            <div class="inline-block">
                <div class="title"><span><b>Справка 79</b></span></div>
                <div class="inline-title"><span>Выберите файл</span></div>
                <div class="line-value"> {!! Form::file('document_3', null, [ 'class' => 'inputbox img-form']) !!}</div>
                <input type="hidden" name="path" value="">
            </div>
            <div class="inline-block">
                <div class="inline-info"><span>Загрузка файла (максимальный размер: 10 MB)</span></div>
            </div>
            @if($children->document_3 == '')
            @else
                <div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $children->document_3}}" alt="" class="img-upload" width="168" height="119"></div>
            @endif
        </div>
        <br>
        <div class="upload-group">
            <div class="inline-block">
                <div class="title"><span><b>Справка СЭС</b></span></div>
                <div class="inline-title"><span>Выберите файл</span></div>
                <div class="line-value"> {!! Form::file('document_4', null, [ 'class' => 'inputbox img-form']) !!}</div>
                <input type="hidden" name="path" value="">
            </div>
            <div class="inline-block">
                <div class="inline-info"><span>Загрузка файла (максимальный размер: 10 MB)</span></div>
            </div>
            @if($children->document_4 == '')
            @else
                <div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $children->document_4}}" alt="" class="img-upload" width="168" height="119"></div>
            @endif
        </div>
        <br>
        <div class="upload-group">
            <div class="inline-block">
                <div class="title"><span><b>Согласие</b></span></div>
                <div class="inline-title"><span>Выберите файл</span></div>
                <div class="line-value"> {!! Form::file('document_5', null, [ 'class' => 'inputbox img-form']) !!}</div>
                <input type="hidden" name="path" value="">
            </div>
            <div class="inline-block">
                <div class="inline-info"><span>Загрузка файла (максимальный размер: 10 MB)</span></div>
            </div>
            @if($children->document_5 == '')
            @else
                <div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $children->document_5 }}" alt="" class="img-upload" width="168" height="119"></div>
            @endif
        </div>
        <br>
        <div class="upload-group">
            <div class="inline-block">
                <div class="title"><span><b>Справка  о нагрузках</b></span></div>
                <div class="inline-title"><span>Выберите файл</span></div>
                <div class="line-value"> {!! Form::file('document_6', null, [ 'class' => 'inputbox img-form']) !!}</div>
                <input type="hidden" name="path" value="">
            </div>
            <div class="inline-block">
                <div class="inline-info"><span>Загрузка файла (максимальный размер: 10 MB)</span></div>
            </div>
            @if($children->document_6 == '')
            @else
                <div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $children->document_6}}" alt="" class="img-upload" width="168" height="119"></div>
            @endif
        </div>
        <br>
        <div class="upload-group">
            <div class="inline-block">
                <div class="title"><span><b>Справка школьника</b></span></div>
                <div class="inline-title"><span>Выберите файл</span></div>
                <div class="line-value"> {!! Form::file('document_7', null, [ 'class' => 'inputbox img-form']) !!}</div>
                <input type="hidden" name="path" value="">
            </div>
            <div class="inline-block">
                <div class="inline-info"><span>Загрузка файла (максимальный размер: 10 MB)</span></div>
            </div>
            @if($children->document_7 == '')
            @else
                <div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $children->document_7 }}" alt="" class="img-upload" width="168" height="119"></div>
            @endif
        </div>
        <br>
        <div class="upload-group">
            <div class="inline-block">
                <div class="title"><span><b>Справка в бассейн</b></span></div>
                <div class="inline-title"><span>Выберите файл</span></div>
                <div class="line-value"> {!! Form::file('document_8', null, [ 'class' => 'inputbox img-form']) !!}</div>
                <input type="hidden" name="path" value="">
            </div>
            <div class="inline-block">
                <div class="inline-info"><span>Загрузка файла (максимальный размер: 10 MB)</span></div>
            </div>
            @if($children->document_8 == '')
            @else
            <div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $children->document_8 }}" alt="" class="img-upload" width="168" height="119"></div>
            @endif
        </div>
        <br>
        <div class="inline-block">
            <input class="btn btn-success" type="submit" value="Сохранить">
            <a href="{{web_url()}}/user/childrens" class="btn btn-danger">Отмена</a>
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