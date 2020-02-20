{{ Form::open(array('url' => route('form.'.$title.'.store'))) }}
<div class="row">
    <div class="col-6 {{ $errors->has('name') ? ' has-error' : '' }}">
        {{ Form::hidden('id', '0',['id'=>'id']) }}
        {!! Form::label('name', $title.' Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control','id'=>'name']) !!}
        {!! $errors->first('name', '<p class="alert alert-danger">:message</p>') !!}
    </div>
    <div class="col-6 {{ $errors->has('crop') ? ' has-error' : '' }}">
        {!! Form::Label('crop', 'Crop:') !!}
        {!! Form::select('crop', $crops, null, ['class' => 'form-control']) !!}
        {!! $errors->first('crop', '<p class="alert alert-danger">:message</p>') !!}
    </div>
</div>
<div class="row">
    <div class="col-6 {{ $errors->has('region') ? ' has-error' : '' }}">
        {!! Form::Label('region', 'Region:') !!}
        {!! Form::select('region', $regions, null, ['class' => 'form-control']) !!}
        {!! $errors->first('region', '<p class="alert alert-danger">:message</p>') !!}
    </div>
    <div class="col-6 {{ $errors->has('node') ? ' has-error' : '' }}">
        {!! Form::Label('node', 'Node:') !!}
        {!! Form::select('node', $nodes, null, ['class' => 'form-control']) !!}
        {!! $errors->first('node', '<p class="alert alert-danger">:message</p>') !!}
    </div>
</div>
<div class="row">
    <div class="col-6 {{ $errors->has('soil') ? ' has-error' : '' }}">
        {!! Form::Label('soil', 'Soil:') !!}
        {!! Form::select('soil', $soils, null, ['class' => 'form-control']) !!}
        {!! $errors->first('soil', '<p class="alert alert-danger">:message</p>') !!}
    </div>
</div>
<div class="row">
    <div class="col-6 {{ $errors->has('plantDate') ? ' has-error' : '' }}">
        {!! Form::label('plantDate', 'Plant date') !!}
        {!! Form::date('plantDate', null, ['class' => 'form-control']) !!}
        {!! $errors->first('plantDate', '<p class="alert alert-danger">:message</p>') !!}
    </div>
    <div class="col-6 {{ $errors->has('offset') ? ' has-error' : '' }}">
        {!! Form::label('offset', 'offset days') !!}
        {!! Form::number('offset', null, ['class' => 'form-control']) !!}
        {!! $errors->first('offset', '<p class="alert alert-danger">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right','id'=>'submit'] ) !!}
    {!! Form::reset('Reset', ['class' => 'btn btn-lg btn-info pull-right','onclick'=>"reset()"] ) !!}
</div>
{{ Form::close() }}