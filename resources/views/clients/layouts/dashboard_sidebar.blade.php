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
            <li><a href="{{ route('client_recipients.index') }}">Destinatarios</a></li>
           
          </ul>
        </li>
       
        <li><a href="{{ route('calculations.index') }}"><i class="fa fa-calculator"></i>Calcular<span class="fa fa-chevron-down"></span></a></li>
        

       


      </ul>
    </div>

  </div>

  
  <!-- /sidebar menu -->
</div>