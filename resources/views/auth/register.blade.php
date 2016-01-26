@extends('layout')
@section('content')

    <form  method="POST" action="/skillcamp/public/auth/register" role="form" class = "login-form">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label for="email">ФИО</label>
            <input type="text" name="name" class="form-control inp" placeholder="Иванов Иван Иванович">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email" class="form-control inp">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>

        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" class="form-control password inp">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </div>
        <div class="form-group">
            <label for="password">Повторите пароль</label>
            <div class = 'pass'>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control password inp">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            </div>
        </div>
        @if(isset($message))
            <div class="danger-message">
                {{$message}}
            </div>
        @endif
        <div class="message bad-message"><span class="glyphicon glyphicon-remove"></span></div>
        <div class="message good-message"><span class="glyphicon glyphicon-ok"></span></div>
        <div class="inline-block">
            <input class="btn btn-success" type="submit" name="login" value="Регистрация" disabled>
        </div>
    </form>
    <script type="text/javascript">
        $('.password').on ('input', function(){
            var password = $('#password').val();
            if(password.length<6){
                $('.good-message').css('display','none');
                $('.bad-message').text('В пароле должно быть более 6 символов');
                $('.bad-message').css('display','block');
                $('.bad-message').addClass('danger-message');
                return;
            }
            var password_confirmation = $('#password_confirmation').val();
            if(password != password_confirmation){
                $('.good-message').css('display','none');
                $('.bad-message').text('Введенные пароли не совпадают');
                $('.bad-message').css('display','block');
                $('.bad-message').addClass('danger-message');
            } else{
                if(password !=''){
                    $('.bad-message').css('display','none');
                    $('.bad-message').removeClass('danger-message');
                    $('.good-message').text('Введенные пароли совпадают!');
                    $('.good-message').addClass('ok-message');
                    $('.good-message').css('display','block');
                }
            }
        });

        $('.form-control').on('input',function(){

            var allInputs = $('.inp');
            var empty = false;
            $.each(allInputs, function(i,v){

//                console.log($(v).val());
                if($(v).val() ==''){
                    $('.btn').prop( "disabled", true );
                    empty = true;
                    return;
                }
                if(!empty && !$('.bad-message').hasClass('danger-message')){
                    $('.btn').prop( "disabled", false );
                }
            });

        });
    </script>

@stop

