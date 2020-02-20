{{ Form::open(array('url' => route('form.'.$title.'.store'),'id'=>'form')) }}
<div class="row">
    <div class="col-6 {{ $errors->has('area') ? ' has-error' : '' }}">
        {{ Form::hidden('id', '0',['id'=>'id']) }}
        {!! Form::Label('area', 'Area:') !!}
        {!! Form::select('area', $areas, null, ['class' => 'form-control','id'=>'area']) !!}
        {!! $errors->first('area', '<p class="alert alert-danger">:message</p>') !!}
    </div>
    <div class="col-6 {{ $errors->has('stage') ? ' has-error' : '' }}">
        {!! Form::Label('stage', 'Stage:') !!}
        {!! Form::select('stage', $stages, null, ['class' => 'form-control','id'=>'stage']) !!}
        {!! $errors->first('stage', '<p class="alert alert-danger">:message</p>') !!}
    </div>
</div>
<div class="row">
    <div class="col-6 {{ $errors->has('value') ? ' has-error' : '' }}">
        {!! Form::label('value', 'Coefficient Value') !!}
        {!! Form::number('value', null, ['class' => 'form-control','step'=>'0.01','id'=>'value']) !!}
        {!! $errors->first('value', '<p class="alert alert-danger">:message</p>') !!}
    </div>
    <div class="col-6 {{ $errors->has('duration') ? ' has-error' : '' }}">
        {!! Form::label('duration', 'duration days:') !!}
        {!! Form::number('duration', null, ['class' => 'form-control','id'=>'duration']) !!}
        {!! $errors->first('duration', '<p class="alert alert-danger">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right','id'=>'submit'] ) !!}
    {!! Form::reset('Reset', ['class' => 'btn btn-lg btn-info pull-right','onclick'=>"reset()"] ) !!}
</div>
{{ Form::close() }}