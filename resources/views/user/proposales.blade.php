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
        <h3>Ваши заявки</h3>
       <p><a href="{{web_url()}}/user/all_programs" type="button" class="btn btn-success">Создать новую заявку</a></p>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Программа</th>
                    <th>Ребенок</th>
                    <th>Время проведения</th>
                    <th>Анкета</th>
                    <th>Соглашение</th>
                    <th>Документы</th>
                    <th>Оплата</th>
                </tr>
                </thead>
                <tbody>
                @foreach($proposales as $proposale)
                    <tr>
                        <td>{{$proposale->program_name}}</td>
                        <td>{{$proposale->children_name}}</td>
                        <td> c {{date('d/m/Y',strtotime($proposale->part_start))}} по {{date('d/m/Y',strtotime($proposale->part_finish))}}</td>
                        <td>
                            @if($proposale->application_form!="")
                                {{$proposale->application_form}} <br><a href="{{web_url()}}/user/childrens/{{$proposale->children_id}}/edit_application_form"> редактировать</a>
                            @else
                                <br><a href="{{web_url()}}/user/childrens/{{$proposale->children_id}}/edit_application_form"> заполнить</a>
                            @endif
                        </td>
                        <td>
                            @if($proposale->agreement=="")
                                не прикреплено <br><a href="{{web_url()}}/user/proposale/{{$proposale->id}}/agreement"> распечатать и прикрепить</a>
                            @else
                                прикреплено <br><a href="{{web_url()}}/user/proposale/{{$proposale->id}}/agreement"> распечатать повторно </a>
                            @endif
                        </td>

                        <td>
                            @if($proposale->documents=="")
                                Для этой программы должны быть прикреплены:
                                @if($proposale->program_doc_1!=0)<br> документ ребенка @endif
                                @if($proposale->program_doc_2!=0)<br> полис @endif
                                @if($proposale->program_doc_3!=0)<br> справка СЭС @endif
                                @if($proposale->program_doc_3!=0)<br> справка 79 @endif
                                @if($proposale->program_doc_4!=0)<br> согласие @endif
                                @if($proposale->program_doc_5!=0)<br> справка  о нагрузках @endif
                                @if($proposale->program_doc_6!=0)<br> справка школьника @endif
                                @if($proposale->program_doc_7!=0)<br> справка в бассейн @endif
                                <br>
                                <a href="{{web_url()}}/user/childrens/{{$proposale->children_id}}/documents" >прикрепить</a>
                            @else
                                все документы прикреплены
                                <br><a href="{{web_url()}}/user/childrens/{{$proposale->children_id}}/documents" >просмотр</a>
                            @endif
                        </td>

                        <td>
                            @if($proposale->payment=="")
                                не подтверждена
                            @else
                                подтверждена
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@stop
