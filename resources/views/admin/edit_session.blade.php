@extends('admin.layout')
@section('content')

    {!! Form::open(array('url'=>"admin/programs/session/save",'method'=>'POST')) !!}
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="program_id" value="{{$program_id}}">
        <input type="hidden" name="vacation_id" value="{{$vacation_id}}">
        <input type="hidden" name="id" value="{{$session->id}}">

        <div class="add-event">
            <div class="inline-block">
                <div class="line-title"><span>Начало смены</span></div><div class="line-value">
                    @if($session->start_date=='0000-00-00 00:00:00'||!isset($session->start_date))
                        {!! Form::text('start_date','', ['placeholder' => 'Начало', 'class'=>'inputbox','class'=>'datepicker']) !!}
                    @else
                        {!! Form::text('start_date', date('m/d/Y',strtotime($session->start_date)),
                        ['placeholder' => 'Начало', 'class'=>'inputbox','class'=>'datepicker']) !!}
                    @endif
                </div>
            </div>

            <div class="inline-block">
                <div class="line-title"><span>Окончание смены </span></div><div class="line-value">
                    @if($session->finish_date=='0000-00-00 00:00:00'||!isset($session->finish_date))
                        {!! Form::text('finish_date','', ['placeholder' => 'Окончание', 'class'=>'inputbox','class'=>'datepicker']) !!}
                    @else
                        {!! Form::text('finish_date',date('m/d/Y',strtotime($session->finish_date)), ['placeholder' => 'Окончание', 'class'=>'inputbox','class'=>'datepicker']) !!}
                    @endif
                </div>
            </div>
        </div>

        <div class="add-event">
            <div class="inline-block">
                <div class="btn-group">
                    {{--{!! Form::submit('Сохранить', array('class'=>'btn add addevent', 'id' => 'edit_programs')) !!}--}}
                    <button class="btn add add-program" type="submit"><i class="fa pull-left fa-floppy-o"></i>Сохранить</button>
                    <a href="{{web_url()}}/admin/programs/session/{{$session->id}}/delete" class="btn cancel"><i class="fa pull-left fa-times-circle"></i>Удалить</a>
                    <a href="{{web_url()}}/admin/programs/vacation/{{$vacation_id}}/edit" class="btn cancel"><i class="fa pull-left fa-times-circle"></i>Отмена</a>
                </div>
            </div>
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
        $('input[name=document_4]').on('click',function(){
            var v=Math.abs(this.value-1);
            this.value=v;
        });
        $('input[name=document_5]').on('click',function(){
            var v=Math.abs(this.value-1);
            this.value=v;
        });
        $('input[name=document_6]').on('click',function(){
            var v=Math.abs(this.value-1);
            this.value=v;
        });
        $('input[name=document_7]').on('click',function(){
            var v=Math.abs(this.value-1);
            this.value=v;
        });
        $('input[name=document_8]').on('click',function(){
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
    <script type="text/javascript">
        $(function() {
            $( ".datepicker" ).datepicker();
        });
    </script>
@stop
