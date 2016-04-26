@extends('layout')
@section('content')
    <div class="cabinet">

        <form  method="POST" action="{{web_url()}}/user/proposale/children_data" role="form" class = "login-form">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <h3>Оформление заявки - данные о ребенке </h3>
            <div class="form-group">
                <input type="hidden" name="id" value="{{$user->id}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" name="proposale_id" value="{{$proposale_id}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" name="children_id" value="{{$children->id}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="surname">Фамилия ребенка</label>
                <input type="text" name="surname" class="form-control" value="{{$children->surname}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="name">Имя ребенка</label>
                <input type="text" name="name" class="form-control" value="{{$children->name}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="patronymic">Отчество ребенка</label>
                <input type="text" name="patronymic" class="form-control" value="{{$children->patronymic}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="birthday_date">Дата рождения ребенка</label>
                <input type="text" name="birthday_date" class="form-control" value="{{$children->birthday_date}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="document">Документ ребенка</label>
                <input type="text" name="document" class="form-control" value="{{$children->document}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="document_number">Серия номер документа ребенка</label>
                <input type="text" name="document_number" class="form-control" value="{{$children->document_number}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="radio member-form">
                <label><input type="radio" name="member" value="1" @if($children->member==1) checked @endif>Старый участник</label>
                <label><input type="radio" name="member" value="0" @if($children->member==0) checked @endif>Новый участник</label>
            </div>
            <div class="form-group marketing-form" @if($children->member==1) style="display: none" @endif>
                <label for="marketing">Откуда узнали о нас</label>
                <label class="radio-inline"><input type="radio" name="marketing" value="реклама в интернете">реклама в интернете</label>
                <label class="radio-inline"><input type="radio" name="marketing" value="рекомендации знакомых">рекомендации знакомых</label>
                <label class="radio-inline"><input type="radio" name="marketing" value="другое">другое</label>
            </div>

            <div class="form-group">
                <label for="registration">Прописка</label>
                <textarea class="form-control" rows="3" id="comment" name="registration">{{$children->registration}}</textarea>
            </div>

            <div class="inline-block">
                <input class="btn btn-success" type="submit" value="Сохранить">
                <a href="{{web_url()}}/user/proposale/{{$proposale_id}}/delete" class="btn btn-danger">Отмена</a>
            </div>
            <br>
        </form>
        {{--{!! Form::close() !!}--}}
    </div>

    <script type="text/javascript">
        $('.member-form').on('change',function(){
            var member = $("input[name='member']:checked").val();
            if(member == 0){
                $('.marketing-form').css('display','block')
            } else {
                $('.marketing-form').css('display','none')
            }
        })
    </script>
@stop