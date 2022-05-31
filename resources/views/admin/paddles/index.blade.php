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
            Listado de Paletas
          </div>
          <div class="col-sm-3">
            <a href="{{ route('paddles.index') }}" class="btn btn-primary" type="button">Registrar</a>
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
              <th>Agente</th>
              <th>Destino</th>
              <th>Referencia</th>
              <th>Peso</th>
              <th>PV</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          @isset($paddles)
            @foreach ($paddles as $paddle)
            <tr>
              <td class="text-center">
                <a href="{{ route('paddles.create',$paddle->id) }}"  title="Seleccionar">{{$paddle->id}}</a>
              </td>
              <td>{{$paddle->agents['name'] ?? ''}}</td>
              <td>{{$paddle->destination_states['name'] ?? ''}}</td>
              <td>{{$paddle->reference ?? ''}}</td>
              <td>{{$paddle->weight ?? ''}}</td>
              <td>{{$paddle->volume ?? ''}}</td>
              <td>{{$paddle->status ?? ''}}</td>
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
