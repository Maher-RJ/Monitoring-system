@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  @include('partial.chartheader')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="maherscard2 card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                  <i><img style="width:40px" src="{{ asset('material') }}/img/wifi.svg"></i>
              </div>
              <p class="card-category">Active Nodes</p>
              <h3 class="card-title">{{$dashboard['nodec']}}
                <small></small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">info</i>
                <a href="{{route('form.nodes.view')}}">Get More Information...</a>
              </div>
            </div>
          </div>
        </div>

      <div class="row">
        <div class="col-md-4  collapse hide"  id="chart1container">
          <div class="card card-chart">
            <div class="card-header card-header-success">
              <div class="ct-chart" id="chart1"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title"  id="chart1title"></h4>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i>Irrigation schedule</i>
              </div>
            </div>
          </div>
        </div>

  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      data=JSON.parse('@json($dashboard['data'])');
      index=1;
      for (key in data) {
        if (data.hasOwnProperty(key)) {
          if(data[key].length>0) {
            var item=[];
            item[key]=data[key];
            draw('chart' + index, item, 'Minutes',320,200);
            $("#chart"+index+"container").removeClass('hide');
            $("#chart"+index+"container").addClass('show');
            $("#chart"+index+"title").val(key);
            index++;
          }
        }
      }
    });
  </script>
@endpush
