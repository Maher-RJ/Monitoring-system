{{ Form::open(array('url' => route('form.'.$title.'.store'))) }}
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {{ Form::hidden('id', '0',['id'=>'id']) }}
    {!! Form::label('name', $title.' Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control','id'=>'name']) !!}
    {!! $errors->first('name', '<p class="alert alert-danger">:message</p>') !!}
</div>
<div class="form-group">
        {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
    {!! Form::reset('Reset', ['class' => 'btn btn-lg btn-info pull-right','onclick'=>"$('#id').val('0')"] ) !!}
</div>
{{ Form::close() }}