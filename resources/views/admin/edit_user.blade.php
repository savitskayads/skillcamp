@extends('admin.layout')
@section('content')
    {!! Form::open(array('url'=>"admin/users/save",'method'=>'POST', 'files'=>true)) !!}
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="id" value="{{$user->id}}">
        <div class="add-event">
            <div class="inline-block">
                <div class="line-title"><span>ФИО</span></div><div class="line-value">
                    {!!  Form::text('name', $user->name, ['placeholder' => 'Иванов Иван Иванович', 'class'=>'inputbox']) !!}</div>
            </div>
            <div class="inline-block">
                <div class="line-title">
                    <span>e-mail</span>
                </div>
                <div class="inline-block">
                {!!  Form::text('email', $user->email, ['placeholder' => 'email', 'class'=>'inputbox']) !!}
                    {!! Form::checkbox('confirmed', $user->confirmed, $user->confirmed) !!} <span> подтвержден</span>

                </div>
            </div>
            <div class="inline-block">
                <div class="line-title"><span>Телефон</span></div><div class="line-value">
                    {!!  Form::text('phone', $user->phone, ['placeholder' => 'телефон', 'class'=>'inputbox']) !!}</div>
            </div>
        </div>
        <div class="add-event">
            <div class="inline-block">
                <div class="btn-group">
                    {{--{!! Form::submit('Сохранить', array('class'=>'btn add addevent', 'id' => 'edit_programs')) !!}--}}
                    <button class="btn add add-program" type="submit"><i class="fa pull-left fa-floppy-o"></i>Сохранить</button>
                    <a href="{{web_url()}}/admin/users" class="btn cancel"><i class="fa pull-left fa-times-circle"></i>Отмена</a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    <script type="text/javascript">
        $('input[name=confirmed]').on('click',function(){
            var v=Math.abs(this.value-1);
            this.value=v;
        });
    </script>
@stop
