 <!-- sidebar menu -->
 <div class="clearfix"></div>

  <!-- menu profile quick info -->
  <div class="profile clearfix">
    <div class="profile_pic">
      <img src="{{ asset('images/img.jpg') }}" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
      <span>Bienvenido</span>
      <h2></h2>
    </div>
  </div>
  <!-- /menu profile quick info -->

  <br />

 <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <h3>General</h3>
      <ul class="nav side-menu">
        <li><a href="{{ route('home') }}">
          <i class="fa fa-home"></i>Pagina Principal</a></li>
       @if(empty(Auth::user()->id_client))    
        <li><a><i class="fa fa-user"></i> Administración<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{ route('airlines.index') }}">Aerolineas</a></li>
            <li><a href="{{ route('wharehouses.index') }}">Almacenes</a></li>
            <li><a href="{{ route('agencies.index') }}">Agencias</a></li>
            <li><a href="{{ route('agents.index') }}">Agentes</a></li>
            <li><a href="{{ route('clients.index') }}">Clientes</a></li>
            <li><a href="{{ route('cities.index') }}">Ciudades</a></li>
            <li><a href="{{ route('delivery_companies.index') }}">Empresas Entrega</a></li>
            <li><a href="{{ route('countries.index') }}">Paises</a></li>
            <li><a href="{{ route('national_rates.index') }}">Tarifas Nacionales</a></li>
            <li><a href="{{ route('international_rates.index') }}">Tarifas Internacionales</a></li>
            <li><a href="{{ route('type_of_packagings.index') }}">Tipos de Empaques</a></li>
            <li><a href="{{ route('type_of_goods.index') }}">Tipos de Mercancia</a></li>
            <li><a href="{{ route('carriers.index') }}">Transportistas</a></li>
            <li><a href="{{ route('package_status.index') }}">Status Paquetes</a></li>
          </ul>
        </li>
        @endif
        <li><a><i class="fa fa-paper-plane"></i> Origen<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{ route('pre_alerts.index') }}">Pre-Alertas</a></li>
            <li><a href="{{ route('trakings.index') }}">Ingresar Paquetes</a></li>
            <li><a href="{{ route('packages.index') }}">Listar Paquetes</a></li>
            <li><a href="{{ route('consolidados.index') }}">Listar Consolidados</a></li>
            <li><a href="{{ route('tulas.create') }}">Crear Tula</a></li>
            <li><a href="{{ route('tulas.index') }}">Listar Tulas</a></li>
            <li><a href="{{ route('master_guides.create') }}">Guias</a></li>
            <li><a href="{{ route('master_guides.index') }}">Listar Guias</a></li>
            <li><a href="{{ route('paddles.create') }}">Crear Paletas</a></li>
            <li><a href="{{ route('paddles.index') }}">Listar Paletas</a></li>
          </ul>
        </li>
        @if(empty(Auth::user()->id_client))    
        <li><a><i class="fa fa-map-pin"></i> Destino<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{ route('pre_alerts.index') }}">Pre-Alertas</a></li>
            <li><a href="{{ route('packages.index') }}">Listar Paquetes</a></li>
            <li><a href="{{ route('consolidados.index') }}">Listar Consolidados</a></li>
            <li><a href="{{ route('tulas.index') }}">Listar Tulas</a></li>
            <li><a href="{{ route('master_guides.index') }}">Listar Guias</a></li>
          </ul>
        </li>

        <li><a><i class="fa fa-search"></i>Consultas<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{ route('clients.index') }}">Clientes</a></li>
           
          </ul>
        </li>
        <li><a href="{{ route('generals.index') }}"><i class="fa fa-wrench"></i>General<span class="fa fa-chevron-down"></span></a>
          
        </li>

        @endif


      </ul>
    </div>

  </div>

  
  <!-- /sidebar menu -->
</div>