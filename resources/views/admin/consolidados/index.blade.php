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
            Lista de Consolidados Ingresados
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
              <th>N°</th>
              <th>Tipo</th>
              <th>Casillero</th>
              <th>Cliente</th>
              <th>Paquetes</th>
              <th>Total a pagar</th>
              <th>Oficina</th>
              <th>Agente</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          @isset($consolidados)
            @foreach ($consolidados as $consolidado)
            <tr>
              <td class="text-center">
                {{$consolidado->id_tula ?? $consolidado->id_paddle}}
              </td>
              <td>{{$consolidado->instruction ?? ''}}</td>
              <td>{{$consolidado->casillero ?? ''}}</td>
              <td>{{$consolidado->firstname ?? '' }} {{ $consolidado->firstlastname ?? '' }}</td>
              <td>{{$consolidado->amount_packages ?? ''}}</td>
              <td>{{$consolidado->amount_for_pay ?? ''}}</td>
              <td>{{$consolidado->office_name ?? ''}}</td>
              <td>{{$consolidado->agent_name ?? ''}}</td>
              <td>{{$consolidado->status ?? ''}}</td>
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
