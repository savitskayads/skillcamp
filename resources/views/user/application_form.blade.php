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
        {!! Form::open(array('url'=>"user/childrens/save_application_form" ,'method'=>'POST', 'files'=>true)) !!}
        {{--<form  method="POST" action="{{web_url()}}/user/childrens/save_application_form" role="form" class = "data-form">--}}
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <h3>Данные ребенка</h3>

            {{--<div class="form-group">--}}
                {{--<div class="inline-block">--}}
                    {{--<label for="name">И</label>--}}
                    {{--<div class="inline-title"><span>Выберите файл</span></div>--}}

                    {{--<div class="line-value"> {!! Form::file('img', null, [ 'class' => 'inputbox img-form']) !!}</div>--}}

                    {{--<input type="hidden" name="path" value="">--}}
                {{--</div>--}}
                {{--<div class="inline-block">--}}
                    {{--<div class="inline-info"><span>Загрузка файла (максимальный размер: 10 MB)</span></div>--}}
                {{--</div>--}}
                {{--@if('' == '')--}}
                    {{--<div class="image"><img src="{!! web_url() !!}/uploads/small/default.png" class="img-upload" alt="" width="168" height="119"></div>--}}
                {{--@else--}}
                    {{--<div class="image"><img src="{!! web_url() !!}/uploads/small/" alt="" class="img-upload" width="168" height="119"></div>--}}
                {{--@endif--}}
            {{--</div>--}}

            <div class="form-group">
                <input type="hidden" name="id" value="{{$children->id}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <label for="name">Имя</label>
                <input type="text" name="name" class="form-control" value="{{$children->name}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="surname">Фамилия</label>
                <input type="text" name="surname" class="form-control" value="{{$children->surname}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
        <div class="form-group">
            <label for="surname">Отчество</label>
            <input type="text" name="patronymic" class="form-control" value="{{$children->patronymic}}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>
            <div class="upload-group">
                <div class="inline-block">
                    <div class="title"><span>Фото ребенка</span></div>
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

            </div>

            <div class="form-group">
                <label for="sex">Пол</label>
                <label class="radio-inline"><input type="radio" name="sex" value="мужской" @if($children->sex=="мужской") checked @endif  >мужской</label>
                <label class="radio-inline"><input type="radio" name="sex" value="женский" @if($children->sex=="женский") checked @endif>женский</label>
            </div>

            <div class="form-group">
                <label for="birthday_date">Дата рождения</label>
                <input type="text" name="birthday_date" class="form-control" value="{{$children->birthday_date}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <h5><b>Документ ребенка</b></h5>
            <div class="form-group">
                <label for="document">Вид документа</label>
                <input type="text" name="document" class="form-control" value="{{$children->document}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="document_number">Серия и номер документа</label>
                <input type="text" name="document_number" class="form-control" value="{{$children->document_number}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <br>
            <div class="form-group">
                <label for="registration">Прописка</label>
                <textarea class="form-control" rows="3" id="comment" name="registration">{{$children->registration}}</textarea>
            </div>

            <div class="form-group">
                <label for="adress">Фактическое место жительства</label>
                <textarea class="form-control" rows="3" id="adress" name="adress">{{$children->adress}}</textarea>
            </div>

            <div class="form-group">
                <label for="school_number">Номер школы</label>
                <input type="text" name="school_number" class="form-control" value="{{$children->school_number}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="school_class">Класс</label>
                <input type="text" name="school_class" class="form-control" value="{{$children->school_class}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="sea">Выезжал ли Ваш ребенок в лагеря ранее(на 7 и более дней)?</label>
                <label class="radio-inline"><input type="radio" name="sea" value="1" @if($children->sea=="1") checked @endif  >Да</label>
                <label class="radio-inline"><input type="radio" name="sea" value="0" @if($children->sea=="0") checked @endif>Нет</label>
            </div>

            <div class="form-group">
                <label for="sea_item">Сколько раз?</label>
                <input type="text" name="sea_item" class="form-control" value="{{$children->sea_item}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="sea_years">Начиная с какого возраста?</label>
                <input type="text" name="sea_years" class="form-control" value="{{$children->sea_years}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="sport">Какими видами спорта занимался(занимается) Ваш ребенок?</label>
                <input type="text" name="sport" class="form-control" value="{{$children->sport}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <br>
            <h4><b>Индивидуальные особенности</b></h4>
            <br>
            <div class="form-group">
                <label for="trait">Перечислите 5 наиболее выраженных черт характера, присущих Вашему ребенку</label>
                <textarea class="form-control" rows="2" id="comment" name="trait">{{$children->trait}}</textarea>
            </div>

            <div class="form-group">
                <label for="pleasure">Чем занимается с удовольствием?</label>
                <textarea class="form-control" rows="2" id="comment" name="pleasure">{{$children->pleasure}}</textarea>
            </div>

            <div class="form-group">
                <label for="not_pleasure">Чем не любит заниматься?</label>
                <textarea class="form-control" rows="2" id="comment" name="not_pleasure">{{$children->not_pleasure}}</textarea>
            </div>


            <div class="form-group">
                <label for="stress">Какая ситуация может оказаться трудной, стрессовой?</label>
                <textarea class="form-control" rows="2" id="comment" name="stress">{{$children->stress}}</textarea>
            </div>

            <div class="form-group">
                <label for="things">Отношение к вещам(узнает ли свои вещи)</label>
                <textarea class="form-control" rows="2" id="comment" name="things">{{$children->things}}</textarea>
            </div>

            <div class="form-group">
                <label for="self">Способность к самообслуживанию( по 10-бальной шкале)</label>
                <label class="radio-inline"><input type="radio" name="self" value="1" @if($children->self=="1") checked @endif  >1</label>
                <label class="radio-inline"><input type="radio" name="self" value="2" @if($children->self=="2") checked @endif >2</label>
                <label class="radio-inline"><input type="radio" name="self" value="3" @if($children->self=="3") checked @endif>3</label>
                <label class="radio-inline"><input type="radio" name="self" value="4" @if($children->self=="4") checked @endif>4</label>
                <label class="radio-inline"><input type="radio" name="self" value="5" @if($children->self=="5") checked @endif>5</label>
                <label class="radio-inline"><input type="radio" name="self" value="6" @if($children->self=="6") checked @endif>6</label>
                <label class="radio-inline"><input type="radio" name="self" value="7" @if($children->self=="7") checked @endif>7</label>
                <label class="radio-inline"><input type="radio" name="self" value="8" @if($children->self=="8") checked @endif>8</label>
                <label class="radio-inline"><input type="radio" name="self" value="9" @if($children->self=="9") checked @endif>9</label>
                <label class="radio-inline"><input type="radio" name="self" value="10" @if($children->self=="10") checked @endif>10</label>
            </div>

            <div class="form-group">
                <label for="control">Какие действия нужно проконтролировать(личная гигиена, переодеться, сушка и уход за вещами, поход в баню)?</label>
                <input type="text" name="control" class="form-control" value="{{$children->control}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="communication">С кем предпочитает общаться Ваш ребенок(с младшими, с ровесниками, со старшими)?</label>
                <input type="text" name="communication" class="form-control" value="{{$children->communication}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="communication_discomfort">Есть ли трудности в общении?</label>
                <textarea class="form-control" rows="2" id="comment" name="communication_discomfort">{{$children->communication_discomfort}}</textarea>
            </div>


            <div class="form-group">
                <label for="conviction">Каким образом можно убедить Вашего ребенка соблюдать правила и договоренности?</label>
                <textarea class="form-control" rows="2" id="comment" name="conviction">{{$children->conviction}}</textarea>
            </div>

            <div class="form-group">
                <label for="bad_baby">Отношение к курению и употреблению спиртных напитков</label>
                <input type="text" name="bad_baby" class="form-control" value="{{$children->bad_baby}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
        <div class="form-group">
            <label for="height">Рост</label>
            <input type="text" name="height" class="form-control" value="{{$children->height}}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>

        <div class="form-group">
            <label for="weight">Вес</label>
            <input type="text" name="weight" class="form-control" value="{{$children->weight}}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>

        <div class="form-group">
            <label for="clothing_size">Размер одежды</label>
            <input type="text" name="clothing_size" class="form-control" value="{{$children->clothing_size}}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>

        <br>
        <h4><b>Медицинские данные</b></h4>
        <br>

            <div class="form-group">
                <label for="chronic">Хронические заболевания</label>
                <textarea class="form-control" rows="2" id="comment" name="chronic">{{$children->chronic}}</textarea>
            </div>

            <div class="form-group">
                <label for="cold">Склонность к простудным заболеваниям</label>
                <input type="text" name="cold" class="form-control" value="{{$children->cold}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="sun">Как переносит солнце?</label>
                <label class="radio-inline"><input type="radio" name="sun" value="хорошо" @if($children->sun=="хорошо") checked @endif>Хорошо</label>
                <label class="radio-inline"><input type="radio" name="sun" value="плохо" @if($children->sun=="плохо") checked @endif>Плохо</label>
            </div>

            <div class="form-group">
                <label for="diet">Необходимость диеты(указать какая)</label>
                <input type="text" name="diet" class="form-control" value="{{$children->diet}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="allergy">Аллергические реакции</label>
                <textarea class="form-control" rows="3" id="comment" name="allergy">{{$children->allergy}}</textarea>
            </div>

            <div class="form-group">
                <label for="not_allergy">Какие необходимы средства для снятия аллергии?</label>
                <textarea class="form-control" rows="2" id="comment" name="not_allergy">{{$children->not_allergy}}</textarea>
            </div>

            <div class="form-group">
                <label for="medicine_allergy">Есть ли аллергические реакции на лекарственные препараты( какие)?</label>
                <textarea class="form-control" rows="3" id="comment" name="medicine_allergy">{{$children->medicine_allergy}}</textarea>
            </div>

            <div class="form-group">
                <label for="insects_allergy">Реакции на укусы насекомых</label>
                <textarea class="form-control" rows="3" id="comment" name="insects_allergy">{{$children->insects_allergy}}</textarea>
            </div>

            <div class="form-group">
                <label for="train">Укачивает ли в транспорте?</label>
                <input type="text" name="train" class="form-control" value="{{$children->train}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="ills">С какими болезнями лежал в больнице</label>
                <textarea class="form-control" rows="3" id="comment" name="ills">{{$children->ills}}</textarea>
            </div>

            <div class="form-group">
                <label for="operations">Операции(какие, когда)</label>
                <textarea class="form-control" rows="4" id="comment" name="operations">{{$children->operations}}</textarea>
            </div>


            <div class="form-group">
                <label for="rupture">Переломы(какие, когда)</label>
                <textarea class="form-control" rows="2" id="comment" name="rupture">{{$children->rupture}}</textarea>
            </div>

            <div class="form-group">
                <label for="concussion">Сотрясения мозга(степень, когда)</label>
                <textarea class="form-control" rows="2" id="comment" name="concussion">{{$children->concussion}}</textarea>
            </div>

            <div class="form-group">
                <label for="bad_bug">Делали ли прививку против клещевого энцефалита?</label>
                <input type="text" name="bad_bug" class="form-control" value="{{$children->bad_bug}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="another_medicine">Другие особенности(по медицинским данным)</label>
                <textarea class="form-control" rows="2" id="comment" name="another_medicine">{{$children->another_medicine}}</textarea>
            </div>
            <br>
            <h4><b>Физическое состояние</b></h4>
            <br>
            <div class="form-group">
                <label for="physics">Группа физподготовки</label>
                <label class="radio-inline"><input type="radio" name="physics" value="основная" @if($children->physics=="плохо") checked @endif>основная</label>
                <label class="radio-inline"><input type="radio" name="physics" value="подготовительная" @if($children->physics=="подготовительная") checked @endif>подготовительная</label>
                <label class="radio-inline"><input type="radio" name="physics" value="ЛФК" @if($children->physics=="ЛФК") checked @endif>ЛФК</label>
            </div>

            <div class="form-group">
                <label for="swim">Умение плавать</label>
                <input type="text" name="swim" class="form-control" value="{{$children->swim}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="fear_height">Боязнь высоты</label>
                <input type="text" name="fear_height" class="form-control" value="{{$children->fear_height}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="fear_dark">Боязнь темноты</label>
                <input type="text" name="fear_dark" class="form-control" value="{{$children->fear_dark}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="fear_animals">Боязнь животных</label>
                <input type="text" name="fear_animals" class="form-control" value="{{$children->fear_animals}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="physics_reaction">Реакция на физическую нагрузку</label>
                <textarea class="form-control" rows="2" id="comment" name="physics_reaction">{{$children->physics_reaction}}</textarea>
            </div>

            <div class="form-group">
                <label for="fatiguability">Быстрая утомляемость</label>
                <input type="text" name="fatiguability" class="form-control" value="{{$children->fatiguability}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="vision">Зрение, ношение очков</label>
                <input type="text" name="vision" class="form-control" value="{{$children->vision}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            <div class="form-group">
                <label for="health">Другие особенности(по физическому состоянию)</label>
                <textarea class="form-control" rows="4" id="comment" name="health">{{$children->health}}</textarea>
            </div>

            <div class="form-group">
                <label for="family">Состав семьи</label>
                <input type="text" name="family" class="form-control" value="{{$children->family}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>

            @if(isset($message))
                <div class=" message" style="color: red;">
                    {{$message}}
                </div>
            @endif
            <div class="inline-block">
                <input class="btn btn-success" type="submit" value="Сохранить">
                <a href="{{web_url()}}/user/childrens" class="btn btn-danger">Отмена</a>
            </div>
            <br>
        {{--</form>--}}
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