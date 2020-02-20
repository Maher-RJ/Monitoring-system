<div class="sidebar" data-color="azure" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="" class="simple-text logo-normal">
      {{ __('Monitoring System') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i><img style="width:25px" src="{{ asset('material') }}/img/home.svg"></i>
            <p>{{ __('Home') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i><img style="width:25px" src="{{ asset('material') }}/img/user.svg"></i>
          <p>{{ __('Users Management') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'stages' || $activePage == 'regions'||$activePage == 'crops'||$activePage == 'nodes'||$activePage == 'areas'||$activePage == 'coefficients') ? ' active' : '' }}">

        <div class="collapse show" id="Forms">
          <ul class="nav">

            <li class="nav-item{{ $activePage == 'nodes' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('form.nodes.view') }}">
                  <i><img style="width:25px"src="{{ asset('material') }}/img/node.svg"></i>
                <span class="sidebar-normal"> {{ __('nodes') }} </span>
              </a>
            </li>


          </ul>
        </div>
      </li>

      <li class="nav-item {{ ($activePage == 'fields' || $activePage == 'schedules'||$activePage == 'light'||$activePage == 'wind'||$activePage == 'air humidity'||$activePage == 'air temperature'||$activePage == 'soil temperature'||$activePage == 'soil humidity'||$activePage == 'ph') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="" aria-expanded="true" onclick="collapse('Tables')">
          <i><img style="width:25px" src="{{ asset('material') }}/img/leave.svg"></i>
          <p>{{ __('Tables') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="Tables">
          <ul class="nav">

            <li class="nav-item{{ $activePage == 'light'||$activePage == 'wind'||$activePage == 'air humidity'||$activePage == 'air temperature'
             ||$activePage == 'soil temperature'||$activePage == 'soil humidity'||$activePage == 'ph'? ' active' : '' }}">

              <div class="collapse show" id="dataTables">
                <ul class="nav">
                    <div id="myimg">
                        <i><img style="width:25px" src="{{ asset('material') }}/img/light.svg"></i>
                    </div>
                    <div id="">
                    <li class="nav-item{{ $activePage == 'light' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('table.data.light.view') }}">
                      <span class="sidebar-mini" >&nbsp;</span>
                      <span class="sidebar-normal"> {{ __('light intensity ') }} </span>
                    </a>
                  </li>
                    </div>

                    <div id="myimg">
                        <i><img style="width:25px" src="{{ asset('material') }}/img/humidity.svg"></i>
                    </div>
                    <div id="">
                  <li class="nav-item{{ $activePage == 'air humidity' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('table.data.ahumidity.view') }}">
                      <span class="sidebar-mini" >&nbsp;</span>
                      <span class="sidebar-normal"> {{ __('air humidity') }} </span>
                    </a>
                  </li>
                    </div>
                    <div id="myimg">
                        <i><img style="width:25px" src="{{ asset('material') }}/img/pot.svg"></i>
                    </div>
                    <div id="">
                  <li class="nav-item{{ $activePage == 'soil humidity' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('table.data.shumidity.view') }}">
                      <span class="sidebar-mini" >&nbsp;</span>
                      <span class="sidebar-normal"> {{ __('soil Moisture') }} </span>
                    </a>
                  </li>
                    </div>

                    <div id="myimg">
                        <i><img style="width:25px" src="{{ asset('material') }}/img/hot.svg"></i>
                    </div>
                    <div id="">
                  <li class="nav-item{{ $activePage == 'air temperature' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('table.data.atemperature.view') }}">
                      <span class="sidebar-mini" >&nbsp;</span>
                      <span class="sidebar-normal"> {{ __('air temperature') }} </span>
                    </a>
                  </li>
                    </div>

                    <div id="myimg">
                        <i><img style="width:25px" src="{{ asset('material') }}/img/ground.svg"></i>
                    </div>
                    <div id="">
                  <li class="nav-item{{ $activePage == 'soil temperature' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('table.data.stemperature.view') }}">
                      <span class="sidebar-mini" >&nbsp;</span>
                      <span class="sidebar-normal"> {{ __('soil temperature') }} </span>
                    </a>
                  </li>
                    </div>
                    <div id="myimg">
                        <i><img style="width:25px" src="{{ asset('material') }}/img/ph.svg"></i>
                    </div>
                    <div id="">
                  <li class="nav-item{{ $activePage == 'ph' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('table.data.ph.view') }}">
                      <span class="sidebar-mini" >&nbsp;</span>
                        <span class="sidebar-normal"> {{ __('pH Value') }} </span>
                    </a>
                  </li>
                    </div>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item {{ ($activePage == 'Fields' || $activePage == 'Schedules') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="" aria-expanded="true" onclick="collapse('Charts')">
          <i><img style="width:25px" src="{{ asset('material') }}/img/graph.svg"></i>
          <p>{{ __('Charts') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="Charts">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'custom chart' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('chart.customs.view') }}">
                  <i class="material-icons">C</i>
                <span class="sidebar-normal"> {{ __('custom chart') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>

<script>
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
