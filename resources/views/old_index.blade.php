@extends('layout')
@section('content')

<div id="slider" class="slider clear">
    <div class="content-list clear">
        <div class="item">
            <div class="image"></div>
            <div class="content">
                <div class="wrap">
                    <div class="text">
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="block type-1">
    <div class="content wrap">
        <div class="content-list seasons clear">
            @foreach($vacations as $vacation)
                <div class="item {{ $vacation->item }}"><span>{{$vacation->title}}</span></div>
            @endforeach
        </div>
    </div>
</div>
<div class="stock">
    <div class="bg"></div>
    <div class="content wrap">

    </div>
</div>
<div class="wrapper block type-1 clear">
    <div class="wrap">
        <div class="head"><span></span></div>
        <div class="content">
            <div class="content-list events clear">
                @foreach($programs as $program)
                    <div class="item">
                        <div class="cat">
                            <span>{{  $program->vacation_title }}</span>
                        </div>
                        <div class="content">
                            <div class="title">
                                <span>
                                    {{  $program->title }}
                                </span></div>
                            <div class="image">
                                @if($program->image == '')
                                    <div class="image"><img src="{!! web_url() !!}/uploads/small/default.png" alt="" width="168" height="119"></div>
                                @else
                                    <div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $program->image }}" alt="" width="168" height="119"></div>
                                @endif
                            </div>
                            <div class="information">
                                <span class="title">Дата проведения:</span>
                                <span class="value">C {{ date("m", $program->start_date) }} {{$monthes[(date('n', $program->start_date))]}}
                                    {{ date("Y", $program->start_date) }} по {{ date("m", $program->finish_date) }} {{$monthes[(date('n', $program->finish_date))]}}
                                    {{ date("Y", strtotime($program->finish_date)) }}</span>
                                <span class="title">Количество мест:</span>
                                <span class="value">{{ $program->plaсes }}</span>
                            </div>
                        </div>
                        <div class="more clear">
                            <div class="text"><span>{{ mb_substr($program->description, 0, 100) }}...</span></div>
                            <div class="button"><span>Подробнее</span></div>
                        </div>
                        <div class="price clear">
                            <div class="text"><span>Цена: {{ $program->price }} руб.</span></div>
                            <div class="button"><span class="white"><a href="{{web_url()}}/user/proposale/{{$program->id}}" style="color: white">Заказать</a></span></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="news block type-2 clear">
    <div class="wrap">
        <div class="head"><span>Новости</span></div>
        <div class="content">
            <div class="content-list news clear">
                @foreach($all_news as $news)
                <div class="item">
                    <div class="information">
                        <span>{{ $news->date }}</span>
                    </div>
                    <div class="head"><span>{{ $news->title }}</span></div>
                    <div class="image">
                        @if($news->image == '')
                            <div class="image"><img src="{!! web_url() !!}/uploads/small/default.png" alt="" width="340" height="127"></div>
                        @else
                            <div class="image"><img src="{!! web_url() !!}/uploads/small/{{ $news->image }}" alt="" width="340" height="127"></div>
                        @endif
                    </div>
                    <div class="text">
                        <span>{{ $news->description }}</span>
                    </div>
                    <div class="more"><a href="#" class="button"><span>Подробнее</span></a></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop