@extends('admin.layout')
@section('content')

    <form action="save" method="POST" class="uploadpreviewform">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="id" value="{id}">
        <div class="add-event">
            <div class="inline-block">
                <div class="line-title"><span>Заголовок</span></div><div class="line-value"><input class="inputbox" type="text" name="title" value="" placeholder="Название программы"></div>
            </div>
        </div>
        <div class="upload-group">
            <div class="inline-block">
                <div class="title"><span>Превью</span></div>
                <div class="inline-title"><span>Выберите файл</span></div>
                <div class="line-value"><input type="file" class="inputbox" name="preview"></div>
                <div class="btn-group">
                    <button class="btn upload uploadpreview"><i class="fa pull-left fa-upload"></i>Загрузить</button>
                </div>
                <input type="hidden" name="path" value="">
            </div>
            <div class="inline-block">
                <div class="inline-info"><span>Загрузка файла (максимальный размер: 10 MB)</span></div>
            </div>
        </div>
        <div class="view-group viewuploadpreview">
            {preview}
        </div>
        <div class="add-event">
            <div class="inline-block">
                <div class="title"><span>Содержание</span></div><div class="value"><textarea class="textbox" type="text" name="description" placeholder="Описание программы"></textarea></div>
            </div>
        </div>
        <div class="inline-block">
            <div class="btn-group">
                <button class="btn add addevent" type="submit"><i class="fa pull-left fa-floppy-o"></i>Сохранить</button>
                <a href="?do=events" class="btn cancel"><i class="fa pull-left fa-times-circle"></i>Отмена</a>
            </div>
        </div>
    </form>
    <div class="upload-group">
        <div class="inline-block">
            <div class="title"><span>Изображения</span></div>
            <form action="" method="POST" enctype="multipart/form-data" class='uploadspreviewform'>
                <div class="inline-title"><span>Выберите файлы</span></div>
                <div class="line-value"><input type="file" class="inputbox" name="spreview[]" multiple></div>
                <div class="btn-group">
                    <button class="btn upload uploadspreview"><i class="fa pull-left fa-upload"></i>Загрузить</button>
                </div>
            </form>
        </div>
        <div class="inline-block">
            <div class="inline-info"><span>Загрузка файлов (максимальный размер: 10 MB)</span></div>
        </div>
    </div>
    <div class="view-group viewuploadspreview">
        <form class='pathsform'>
            <div class="images-list clear">
                {spreview}
            </div>
        </form>
    </div>
    <div class="add-event">
        <div class="inline-block">
            <div class="btn-group">
                <a href="" class="btn add addevent"><i class="fa pull-left fa-floppy-o"></i>Сохранить</a>
                <a href="?do=events" class="btn cancel"><i class="fa pull-left fa-times-circle"></i>Отмена</a>
            </div>
        </div>
    </div>

@stop