@extends('admin.layout')
@section('content')

    {!! Form::open(array('url'=>"#", 'files'=>true)) !!}
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="id" value="{{$children->id}}">
        <div class="add-event">
            <h3>Анкетные данные</h3>
            <a href="{{web_url()}}/admin/children/edit/{{$children->id}}">Изменить</a>
            <br>
            @if($children->image == '')
                <div class="image"><img src="{!! web_url() !!}/uploads/small/default.png" class="img-upload" alt="" height="200px" width="100px" ></div>
            @else
                <div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $children->image }}" alt="" class="img-upload"  width="100px" height="200px"></div>
            @endif
            <div class="inline-block">
                <div class="line-title"><span>ФИО</span></div><div class="line-value"></div>
                {{$children->surname}} {{$children->name}}  {{$children->patronymic}}
            </div>

            <div class="inline-block">
                <div class="line-title"><span>Пол</span></div><div class="line-value"></div>
                {{$children->sex}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Дата рождения</span></div><div class="line-value"></div>
                {{$children->birthday_date}}
            </div>

            <div class="inline-block">
                <div class="line-title"><span>Документ</span></div><div class="line-value"></div>
                {{$children->document}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Серия номер документа</span></div><div class="line-value"></div>
                {{$children->document_number}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Прописка</span></div><div class="line-value"></div>
                {{$children->registration}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Адрес места жительства</span></div><div class="line-value"></div>
                {{$children->adress}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Рост</span></div><div class="line-value"></div>
                {{$children->height}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Вес</span></div><div class="line-value"></div>
                {{$children->weight}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Размер одежды</span></div><div class="line-value"></div>
                {{$children->clothing_size}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Состав семьи</span></div><div class="line-value"></div>
                {{$children->family}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Школа</span></div><div class="line-value"></div>
                {{$children->school_number}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Класс</span></div><div class="line-value"></div>
                {{$children->school_class}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Выезжал ли ребенок в лагеря ранее(на 7 и более дней)?</span></div><div class="line-value"></div>
                {{$children->sea}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Сколько раз?</span></div><div class="line-value"></div>
                {{$children->sea_item}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Начиная с какого возраста?</span></div><div class="line-value"></div>
                {{$children->sea_years}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>виды спорта, которыми занимается ребенок</span></div><div class="line-value"></div>
                {{$children->sport}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>5 наиболее выраженных черт характера, присущих ребенку</span></div><div class="line-value"></div>
                {{$children->trait}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>занимается с удовольствием</span></div><div class="line-value"></div>
                {{$children->pleasure}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>не любит заниматься</span></div><div class="line-value"></div>
                {{$children->not_pleasure}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>трудная, стрессовая ситуация</span></div><div class="line-value"></div>
                {{$children->stress}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Отношение к вещам</span></div><div class="line-value"></div>
                {{$children->things}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Способность к самообслуживанию</span></div><div class="line-value"></div>
                {{$children->self}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>действия,которые нужно проконтролировать</span></div><div class="line-value"></div>
                {{$children->control}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>предпочитает общаться</span></div><div class="line-value"></div>
                {{$children->communication}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>трудности в общении</span></div><div class="line-value"></div>
                {{$children->communication_discomfort}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Отношение к курению и употреблению спиртных напитковз</span></div><div class="line-value"></div>
                {{$children->bad_baby}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Хронические заболевания</span></div><div class="line-value"></div>
                {{$children->chronic}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Склонность к простудным заболеваниям</span></div><div class="line-value"></div>
                {{$children->cold}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>переносит солнце</span></div><div class="line-value"></div>
                {{$children->sun}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>диеты</span></div><div class="line-value"></div>
                {{$children->diet}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Аллергические реакции</span></div><div class="line-value"></div>
                {{$children->allergy}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>средства для снятия аллергии</span></div><div class="line-value"></div>
                {{$children->not_allergy}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>аллергические реакции на лекарственные препараты</span></div><div class="line-value"></div>
                {{$children->medicine_allergy}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Реакции на укусы насекомых</span></div><div class="line-value"></div>
                {{$children->insects_allergy}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Укачивает ли в транспорте</span></div><div class="line-value"></div>
                {{$children->train}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>С какими болезнями лежал в больнице</span></div><div class="line-value"></div>
                {{$children->ills}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Операции</span></div><div class="line-value"></div>
                {{$children->operations}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Переломы</span></div><div class="line-value"></div>
                {{$children->rupture}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Сотрясения мозга</span></div><div class="line-value"></div>
                {{$children->concussion}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>прививка против клещевого энцефалита</span></div><div class="line-value"></div>
                {{$children->bad_bug}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Другие особенности(по медицинским данным)</span></div><div class="line-value"></div>
                {{$children->another_medicine}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Группа физподготовки</span></div><div class="line-value"></div>
                {{$children->physics}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Умение плавать</span></div><div class="line-value"></div>
                {{$children->swim}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Боязнь высоты</span></div><div class="line-value"></div>
                {{$children->fear_height}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Боязнь темноты</span></div><div class="line-value"></div>
                {{$children->fear_dark}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Боязнь животных</span></div><div class="line-value"></div>
                {{$children->fear_animals}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Реакция на физическую нагрузку</span></div><div class="line-value"></div>
                {{$children->physics_reaction}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Быстрая утомляемость</span></div><div class="line-value"></div>
                {{$children->fatiguability}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Зрение, ношение очков</span></div><div class="line-value"></div>
                {{$children->vision}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Другие особенности(по физическому состоянию)</span></div><div class="line-value"></div>
                {{$children->health}}
            </div>
            <br>
            <h3>Данные о родителе</h3>
            <br>
            <div class="inline-block">
                <div class="line-title"><span>ФИО</span></div><div class="line-value"></div>
                {{$parent->name}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Паспорт</span></div><div class="line-value"></div>
                серия и номер {{$parent->passport}} выдан {{$parent->passport_date}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Согласие на обработку данных</span></div><div class="line-value"></div>
                @if($parent->data_processing==1)Да
                @elseНет
                @endif
            </div>
            <div class="inline-block">
                <div class="line-title"><span>email</span></div><div class="line-value"></div>
                {{$parent->email}}
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Телефон</span></div><div class="line-value"></div>
                {{$parent->phone}}
            </div>
            <br>
            <h3>Участник программ</h3>
            <br>
            <table class="table-list">
                <tr>
                    <th>Дата заявки</th>
                    <th>Сезон</th>
                    <th>Название программы</th>
                    <th>Смена</th>
                </tr>
                @foreach($proposales as $proposale)
                    <tr class='proposale' id={{$proposale->id}}>
                        <td>{{$proposale->registration_date}}</td>
                        <td>Зима</td>
                        <td>{{$proposale->program_name}}</td>
                        <td>{{$proposale->part}}</td>
                    </tr>
                @endforeach
            </table>



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
@stop
