@extends('admin.layout')
@section('content')
    <form  method="POST" action="changepass" class="uploadpreviewform">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <div class="inline-block">
    <div class="line-title">Старый пароль</div>
    <div class="line-value"><input class="inputbox" type="password" name="oldpass" value=""></div>
</div>
<div class="inline-block">
    <div class="line-title">Новый пароль</div>
    <div class="line-value"><input class="inputbox" type="password" name="newpass" value=""></div>
</div>
<div class="inline-block">
    <div class="line-title">Повторите новый пароль</div>
    <div class="line-value"><input class="inputbox" type="password" name="newpass2" value=""></div>
</div>
<div class="inline-block">
    <div class="btn-group">
        <button class="btn add addevent" type="submit"><i class="fa pull-left fa-floppy-o"></i>Сохранить</button>
    </div>
</div>
    </form>
@stop
