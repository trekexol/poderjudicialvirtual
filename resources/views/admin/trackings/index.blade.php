@extends('admin.layouts.dashboard')

@section('content')

{{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}
<div class="right_col" role="main">
 
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">


        <form action="{{ route('trakings.packageWithTracking') }}" method="POST" enctype="multipart/form-data" id="form" data-parsley-validate class="form-horizontal form-label-left">
          @csrf 
          <div class="col-sm-4 h5">
            Entrada de Paquetes
          </div>
          <div class="col-sm-4">
            <input type="text" id="tracking" name="tracking" class="form-control" required>       
          </div>
          <div class="col-sm-3">
            <button type="submit" class="btn btn-round btn-primary">Escanear Tracking</button>
          </div>
          <ul class="col-sm-1 nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </form>
      </div>
      <div class="x_content">
          <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
      
        <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Tracking</th>
              <th>N° Paquete</th>
              <th></th>
            </tr>
          </thead>
          @isset($package_trakings)
            @foreach ($package_trakings as $package_traking)
            <tr>
              <td>
                <a href="{{ route('packages.createByTracking',$package_traking->tracking) }}"  title="Mostrar">{{ $package_traking->tracking }}</a>
              </td>
              <td>{{$package_traking->id}}</td>
              <td>
               <a href="{{ route('historial_status.viewPackage',$package_traking->id) }}"  title="Ver Historial de Status"><i class="fa fa-question"></i></a>
              </td>
            </tr>
            @endforeach
          @endisset
          

          </table>
        </div>
      </div>
    </div>
</div>
    </div>
  </div>
</div>

@endsection