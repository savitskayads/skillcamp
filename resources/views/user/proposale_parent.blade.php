@extends('layout')
@section('content')
    <div class="cabinet">

        <form  method="POST" action="{{web_url()}}/user/proposale/parent_data" role="form" class = "login-form">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <h3>Оформление заявки - шаг 2, Ваши данные</h3>
            <div class="form-group">
                <input type="hidden" name="id" value="{{$user->id}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" name="proposale_id" value="{{$proposale_id}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="name">ФИО</label>
                <input type="text" name="name" class="form-control" value="{{$user->name}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input type="text" name="email" class="form-control" value="{{$user->email}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="text" name="phone" class="form-control" value="{{$user->phone}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
            @if($user->data_processing==0)
            <div class="form-group">
                Для оформления заявки Вам необходимо дать согласие на обработку Ваши данных
                <div class="radio">
                    <label><input type="radio" name="data_processing" value="1" @if($user->data_processing==1) checked @endif>Согласен</label>
                    <label><input type="radio" name="data_processing" value="0" @if($user->data_processing==0) checked @endif>Не согласен</label>
                </div>
            </div>
            <div class="passport hidden">
                <div class="form-group">
                    <label for="passport">Паспорт (серия и номер)</label>
                    <input type="text" name="passport" class="form-control" value="{{$user->passport}}">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                </div>
                <div class="form-group">
                    <label for="passport_date">Выдан</label>
                    <input type="text" name="passport_date" class="form-control" value="{{$user->passport_date}}">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                </div>
            </div>
            @else
                <div class="passport">
                    <div class="form-group">
                        <label for="passport">Паспорт (серия и номер)</label>
                        <input type="text" name="passport" class="form-control" value="{{$user->passport}}">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    </div>
                    <div class="form-group">
                        <label for="passport_date">Выдан</label>
                        <input type="text" name="passport_date" class="form-control" value="{{$user->passport_date}}">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    </div>
                </div>
            @endif
            <div class="inline-block">
                <input class="btn btn-success" type="submit" value="Сохранить" @if($user->data_processing==0) disabled @endif>
                <a href="{{web_url()}}/user/proposale/{{$proposale_id}}/delete" class="btn btn-danger">Отмена</a>
            </div>
            <br>
        </form>
        {{--{!! Form::close() !!}--}}
    </div>
<script type="text/javascript">
    $('input[name=data_processing]').on('change',function(){
        if ($(this).val()==1){
            $('.passport').removeClass('hidden');
            $('.btn-success').prop( "disabled", false );
        } else{
            $('.passport').addClass('hidden');
            $('.btn-success').prop( "disabled", true );
        }
    })
</script>
@stop