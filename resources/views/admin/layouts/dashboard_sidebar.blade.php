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
               
        <li><a><i class="fa fa-user"></i> Administración<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{ route('airlines.index') }}">Aerolineas</a></li>
            <li><a href="{{ route('wharehouses.index') }}">Almacenes</a></li>
            <li><a href="{{ route('agencies.index') }}">Agencias</a></li>
            <li><a href="{{ route('cities.index') }}">Ciudades</a></li>
            <li><a href="{{ route('countries.index') }}">Paises</a></li>
            <li><a href="{{ route('national_rates.index') }}">Tarifas Nacionales</a></li>
            <li><a href="{{ route('international_rates.index') }}">Tarifas Internacionales</a></li>
          </ul>
        </li>
      </ul>
    </div>

  </div>
  <!-- /sidebar menu -->
</div>