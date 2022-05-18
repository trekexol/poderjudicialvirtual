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
          <div class="col-sm-8 h5">
            Listado de Pre Alertas
          </div>
          <div class="col-sm-3">
            <a href="{{ route('pre_alerts.create') }}" class="btn btn-primary" type="button">Registrar</a>
          </div>
        <ul class="col-sm-1 nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
      
        <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Tracking</th>
              <th>Casillero</th>
              <th>Nombre</th>
              <th>Tipo</th>
              <th>Transportista</th>
              <th>Fecha_Rg.</th>
              <th>Contenido</th>
              <th>Nota</th>
              <th>Ofic.</th>
              <th>Agente</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          @isset($pre_alerts)
            @foreach ($pre_alerts as $pre_alert)
            <tr>
              <td class="text-center">
                <a href="{{ route('pre_alerts.create',$pre_alert->id) }}"  title="Seleccionar">{{$pre_alert->tracking}}</a>
              </td>
              <td>{{$pre_alert->clients->countries['abbreviation'] ?? ''}}{{$pre_alert->id_client}}</td>
              <td>{{$pre_alert->clients['firstname'] ?? '' }} {{ $pre_alert->clients['firstlastname'] ?? ''}}</td>
              <td>{{$pre_alert->shipping_type ?? ''}}</td>
              <td>{{$pre_alert->transport_company ?? ''}}</td>
              <td>{{$pre_alert->created_at ?? ''}}</td>
              <td>{{$pre_alert->package_content ?? ''}}</td>
              <td></td>
              <td></td>
              <td> </td>
              <td>{{$pre_alert->status ?? ''}}</td>
              <td></td>
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
