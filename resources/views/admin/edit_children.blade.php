@extends('admin.layout')
@section('content')
{!! Form::open(array('url'=>"admin/children/save",'method'=>'POST', 'files'=>true)) !!}
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <input type="hidden" name="id" value="{{$children->id}}">

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
        @if($children->image == '')
            <div class="image"><img src="{!! web_url() !!}/uploads/small/default.png" class="img-upload" alt="" width="200" height="150"></div>
        @else
            <div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $children->image }}" alt="" class="img-upload" width="168" height="119"></div>
        @endif
    </div>
    <div class="view-group viewuploadpreview">
        {preview}
    </div>
    <div class="add-event">
        <div class="inline-block">
            <div class="line-title"><span>Фамилия</span></div><div class="line-value">{!!  Form::text('surname', $children->surname, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Имя</span></div><div class="line-value">{!!  Form::text('name', $children->name, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Отчество</span></div><div class="line-value">{!!  Form::text('patronymic', $children->patronymic, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Дата рождения</span></div><div class="line-value">{!!  Form::text('birthday_date', $children->birthday_date, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Документ</span></div><div class="line-value">{!!  Form::text('document', $children->document, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Серия номер документа</span></div><div class="line-value">{!!  Form::text('document_number', $children->document_number, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="title"><span>Прописка</span></div><div class="value"><textarea class="textbox" type="text" name="registration">{{ $children->registration }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="title"><span>Фактическое место жительства</span></div><div class="value"><textarea class="textbox" type="text" name="adress">{{ $children->adress }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Рост</span></div><div class="line-value">{!!  Form::text('height', $children->height, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Вес</span></div><div class="line-value">{!!  Form::text('weight', $children->weight, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Размер одежды</span></div><div class="line-value">{!!  Form::text('clothing_size', $children->clothing_size, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Состав семьи</span></div><div class="line-value">{!!  Form::text('family', $children->family, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Номер школы</span></div><div class="line-value">{!!  Form::text('school_number', $children->school_number, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Класс</span></div><div class="line-value">{!!  Form::text('school_class', $children->school_class, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Выезжал ли ребенок в лагеря ранее(на 7 и более дней)?</span></div><div class="line-value">{!!  Form::text('sea', $children->sea, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Сколько раз?</span></div><div class="line-value">{!!  Form::text('sea_item', $children->sea_item, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Начиная с какого возраста?</span></div><div class="line-value">{!!  Form::text('sea_years', $children->sea_years, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>виды спорта, которыми занимается ребенок</span></div><div class="line-value">{!!  Form::text('sport', $children->sport, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="title"><span>5 наиболее выраженных черт характера, присущих ребенку</span></div><div class="value"><textarea class="textbox" type="text" name="trait">{{ $children->trait }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Чем занимается с удовольствием?</span></div><div class="line-value"><textarea class="textbox" type="text" name="pleasure">{{ $children->pleasure }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Чем не любит заниматься?</span></div><div class="line-value"><textarea class="textbox" type="text" name="not_pleasure">{{ $children->not_pleasure }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Какая ситуация может оказаться трудной, стрессовой?</span></div><div class="line-value"><textarea class="textbox" type="text" name="stress">{{ $children->stress }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Отношение к вещам(узнает ли свои вещи)</span></div><div class="line-value"><textarea class="textbox" type="text" name="things">{{ $children->things }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Способность к самообслуживанию( по 10-бальной шкале) </span></div><div class="line-value">{!!  Form::text('birthday_date', $children->birthday_date, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Какие действия нужно проконтролировать(личная гигиена, переодеться, сушка и уход за вещами, поход в баню)?</span></div><div class="line-value">{!!  Form::text('control', $children->control, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>С кем предпочитает общаться?</span></div><div class="line-value">{!!  Form::text('communication', $children->communication, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Есть ли трудности в общении?</span></div><div class="line-value"><textarea class="textbox" type="text" name="communication_discomfort">{{ $children->communication_discomfort }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Отношение к курению и употреблению спиртных напитков</span></div><div class="line-value">{!!  Form::text('bad_baby', $children->bad_baby, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Хронические заболевания</span></div><div class="line-value"><textarea class="textbox" type="text" name="chronic">{{ $children->chronic }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Склонность к простудным заболеваниям</span></div><div class="line-value">{!!  Form::text('cold', $children->cold, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Как переносит солнце? </span></div><div class="line-value">{!!  Form::text('sun', $children->sun, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Необходимость диеты(указать какая)</span></div><div class="line-value">{!!  Form::text('diet', $children->diet, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Аллергические реакции</span></div><div class="line-value"><textarea class="textbox" type="text" name="allergy">{{ $children->allergy }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Какие необходимы средства для снятия аллергии?</span></div><div class="line-value"><textarea class="textbox" type="text" name="not_allergy">{{ $children->not_allergy }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Есть ли аллергические реакции на лекарственные препараты( какие)?</span></div><div class="line-value"><textarea class="textbox" type="text" name="medicine_allergy">{{ $children->medicine_allergy }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Реакции на укусы насекомых</span></div><div class="line-value"><textarea class="textbox" type="text" name="insects_allergy">{{ $children->insects_allergy }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Укачивает ли в транспорте?</span></div><div class="line-value">{!!  Form::text('train', $children->train, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>С какими болезнями лежал в больнице</span></div><div class="line-value"><textarea class="textbox" type="text" name="ills">{{ $children->ills }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Операции(какие, когда)</span></div><div class="line-value"><textarea class="textbox" type="text" name="operations">{{ $children->operations }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Переломы(какие, когда)</span></div><div class="line-value"><textarea class="textbox" type="text" name="rupture">{{ $children->rupture }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Сотрясения мозга(степень, когда)</span></div><div class="line-value"><textarea class="textbox" type="text" name="concussion">{{ $children->concussion }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Делали ли прививку против клещевого энцефалита?</span></div><div class="line-value">{!!  Form::text('bad_bug', $children->bad_bug, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Другие особенности(по медицинским данным)</span></div><div class="line-value"><textarea class="textbox" type="text" name="another_medicine">{{ $children->another_medicine }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Группа физподготовки </span></div><div class="line-value">{!!  Form::text('physics', $children->physics, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Умение плавать</span></div><div class="line-value">{!!  Form::text('swim', $children->swim, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Боязнь высоты</span></div><div class="line-value">{!!  Form::text('fear_height', $children->fear_height, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Боязнь темноты</span></div><div class="line-value">{!!  Form::text('fear_dark', $children->fear_dark, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Боязнь животных</span></div><div class="line-value">{!!  Form::text('fear_animals', $children->fear_animals, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Реакция на физическую нагрузку</span></div><div class="line-value"><textarea class="textbox" type="text" name="physics_reaction">{{ $children->physics_reaction }}</textarea></div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Быстрая утомляемость</span></div><div class="line-value">{!!  Form::text('fatiguability', $children->fatiguability, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Зрение, ношение очков</span></div><div class="line-value">{!!  Form::text('vision', $children->vision, ['class'=>'inputbox']) !!}</div>
        </div>
        <div class="inline-block">
            <div class="line-title"><span>Другие особенности(по физическому состоянию)</span></div><div class="line-value"><textarea class="textbox" type="text" name="health">{{ $children->health }}</textarea></div>
        </div>
    </div>

    <div class="add-event">
        <div class="inline-block">
            <div class="btn-group">
                {{--{!! Form::submit('Сохранить', array('class'=>'btn add addevent', 'id' => 'edit_programs')) !!}--}}
                <button class="btn add add-program" type="submit"><i class="fa pull-left fa-floppy-o"></i>Сохранить</button>
                <a href="{{web_url()}}/admin/childrens" class="btn cancel"><i class="fa pull-left fa-times-circle"></i>Отмена</a>
            </div>
        </div>
    </div>
{!! Form::close() !!}
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
