@include('partial.chartheader')
<a class="nav-link" data-toggle="collapse" href="" aria-expanded="true" onclick="collapse('colform')">
    <i><img style="width:25px"></i>
    <p>{{ __('Click (Show/Hide) Form') }}
        <b class="caret"></b>
    </p>
</a>
<div class="collapse show" id="colform">
{{ Form::open(['method' => 'GET', 'action' => 'chartController@getCustoms', 'id' => 'form', 'role' => 'form']) }}
<div class="row">
    <div class="col-sm-12 col-md-6">
        {!!Form::label('Type')!!}
        {!!Form::select('types', $data['types'], null, ['class' => 'form-control','id'=>'type'])!!}
    </div>
    <div class="col-sm-12 col-md-6">
        {!!Form::label('Node')!!}<br>
        @foreach ($data['nodes'] as $key => $value)
            {!!Form::checkbox('nodes[]', $key,false,['class' => 'checkbox'])!!}
            {{$value}}
            <br>
        @endforeach
        {{--<div class="alert alert-info">Keep it empty if your type is wind speed else you should choice at least one node</div>--}}
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6">
        {!!Form::label('From')!!}
        {!!Form::date('start', null, ['class' => 'form-control'])!!}
        <div class="alert alert-info">Keep it empty if you dont want to specify date</div>

    </div>
    <div class="col-sm-12 col-md-6">
        {!!Form::label('To')!!}
        {!!Form::date('end', null, ['class' => 'form-control'])!!}
        <div class="alert alert-info">Keep it empty if you dont want to specify date</div>

    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6">
        {!!Form::label('Max Samples')!!}
        {!!Form::number('number', 100, ['steps'=>"100", 'min'=>"100",'max'=>"1000",'class' => 'form-control'])!!}
        <div class="alert alert-info">between 100 and 1000</div>
    </div>
    <div class="col-sm-12 col-md-6">
        {!!Form::label('Data Type')!!}
        {!!Form::select('datatypes', $data['datatypes'], null, ['class' => 'form-control','id'=>'datatype'])!!}
    </div>
</div>
<hr style="border-width: 5px;">
<div class="row">
    <div class="col-sm-12 col-md-12">
        {!! form::submit('submit',['class'=>'btn btn-success btn-block btn-lg','style'=>"margin-top:20px"]) !!}
    </div>
</div>
{{ Form::close() }}
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $( document ).ready(function() {
        $("#form").submit(function(event) {
            event.preventDefault();

            $.ajax({
                type     : "GET",
                url      : $(this).attr('action'),
                data     : $('#form :input[value!=null]').serialize(),
                cache    : false,

                success  : function(data) {
                    collapse('colform');
                    var indexdatatype=$('#datatype').children('option:selected').val();
                    var index=$('#type').children('option:selected').val();
                    var units=["","g/m3","g/m3","luminous","degree","degree"];
                    var unit="";
                    if(indexdatatype==1) {
                         unit = units[index - 1];
                    }else
                         unit="Average per day";
                    draw('container', data,unit );
                }
            });

            return false;

        });
    });
    function collapse(id){
        if($('#'+id).hasClass("show") ) {
            $('#'+id).removeClass('show');
            $('#'+id).addClass('hidden');
        }else{
            $('#'+id).removeClass('hidden');
            $('#' + id).addClass('show');
        }
    }
</script>
