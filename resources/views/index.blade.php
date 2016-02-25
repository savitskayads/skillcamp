@extends('layout')
@section('content')

<div class="block events clear">
    <div class="head wrap"><span>Зимние программы</span></div>
    <div class="content wrap">
        <div class="content-list clear">
            @foreach($programs as $program)
            <div class="item">
                <div class="top">
                    <div class="image">
                        @if($program->image == '')
                            <img src="{!! web_url() !!}/uploads/medium/default.png" alt="{{ $program->title }}" width="378" height="236">
                        @else
                            <img src="{!! web_url() !!}/uploads/medium/{{ $program->image }}" alt="{{ $program->title }}" width="378" height="236">
                        @endif
                    </div>
                    <div class="overlay">
                        <div class="category"><a href=""><span>Зимние каникулы</span></a></div>
                    </div>
                </div>
                <div class="information">
                    <div class="date"><span><i class="fa pull-left fa-calendar"></i>c {{date('d/m/Y'($program->start_date)}} по {{date('d/m/Y'($program->finish_date)}}</span></div>
                    <div class="members"><span><i class="fa pull-left fa-users"></i>{{$program->places}}</span></div>
                </div>
                <div class="main">
                    <div class="title"><a href="{{web_url()}}/program/{{$program->id}}"><span>{{$program->title}}</span></a></div>
                    <div class="text"><span>{{ mb_substr($program->description, 0, 65) }}...</span></div>
                </div>
                <div class="price clear">
                    <div class="text"><span>Цена: {{$program->price}}</span></div>
                    <div class="order"><i class="fa pull-left fa-shopping-cart"></i><span><a href="{{web_url()}}/user/proposale/{{$program->id}}">Заказать</a></span></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@stop