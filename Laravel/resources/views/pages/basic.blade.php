@extends('layouts.app', ['activePage' => $title, 'titlePage' => __($title)])

@section('content')
  @include("partial.tableheader")
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-primary">
        <h3 class="card-title">{!!$title!!}</h3>
      </div>
      @if(session()->has('danger'))
        <div class="alert alert-danger" style="margin: 5px">
          {{ session()->get('danger') }}
        </div>
      @endif
      @if(session()->has('success'))
        <div class="alert alert-success" style="margin: 5px">
          {{ session()->get('success') }}
        </div>
      @endif
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            @if($type=='basic')
              @include("partial.forms._basic")
            @elseif($type=='node')
              @include("partial.forms._node")
            @elseif($type=='area')
              @include("partial.forms._area")
            @elseif($type=='coefficient')
              @include("partial.forms._coefficient")
            @elseif($type=='custom')
              @include("partial.forms._chart")
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            @if($type=='basic')
              @include("partial.tables.basic")
            @elseif($type=='node')
              @include("partial.tables.node")
            @elseif($type=='area')
              @include("partial.tables.area")
            @elseif($type=='coefficient')
              @include("partial.tables.coefficient")
            @elseif($type=='field')
              @include("partial.tables.field")
            @elseif($type=='schedule')
              @include("partial.tables.schedule")
            @elseif($type=='data')
              @include("partial.tables.datatable")
            @elseif($type=='custom')
              @include("partial.charts.custom")
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
