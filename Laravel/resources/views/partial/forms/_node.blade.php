<script>
    function reset() {
        $('#id').val('0');
        $('#name').attr("disabled", true);
        $('#status').attr("disabled", true);
        $('#submit').attr("disabled", true);
    }
</script>
{{ Form::open(array('url' => route('form.'.$title.'.store'))) }}
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {{ Form::hidden('id', '0',['id'=>'id']) }}
    {!! Form::label('name', $title.' Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control','id'=>'name','disabled'=>'disabled']) !!}
    {!! $errors->first('name', '<p class="alert alert-danger">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {{ Form::checkbox('status', 'active', false, ['id'=>'status','disabled'=>'disabled']) }} Node Status (active or disactive)
    {!! $errors->first('status', '<p class="alert alert-danger">:message</p>') !!}
</div>
<div class="form-group">
    {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right','disabled'=>'disabled','id'=>'submit'] ) !!}
    {!! Form::reset('Reset', ['class' => 'btn btn-lg btn-info pull-right','onclick'=>"reset()"] ) !!}
</div>
{{ Form::close() }}