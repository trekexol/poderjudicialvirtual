@extends('clients.layouts.dashboard')

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


       
          <div class="col-sm-4 offset-sm-4 h5">
            Lista de Paquetes en Transito
          </div>
          
        
          <div class="clearfix"></div>
       
      </div>
      <div class="x_content">
          <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
      
        <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Paquete</th>
              <th>Tracking</th>
              <th>Destinatario</th>
              <th>Descripción</th>
              <th>Peso/Vol</th>
              <th>Tipo de Envío</th>
              <th>Envío</th>
              <th>Estado</th>
              <th></th>
            </tr>
          </thead>
          @isset($package_trakings)
            @foreach ($package_trakings as $package_traking)
            <tr>
              <td>{{$package_traking->id}}</td>
              <td>
                <a href="{{ route('packages.createByTracking',$package_traking->tracking) }}"  title="Mostrar">{{ $package_traking->tracking }}</a>
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
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