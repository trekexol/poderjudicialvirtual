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
          <div class="col-sm-7 h5">
            Lista de Guías / Masters Ingresados
          </div>
          <div class="col-sm-3">
            <a href="{{ route('master_guides.create') }}" class="btn btn-primary" type="button">Registrar</a>
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
              <th>Aerolinea</th>
              <th>Vuelo</th>
              <th>Conocimiento</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          @isset($master_guides)
            @foreach ($master_guides as $master_guide)
            <tr>
              <td>{{$master_guide->id ?? ''}}</td>
              <td>
                {{$master_guide->airlines['name'] ?? ''}}
              </td>
              <td>
                {{$master_guide->flight ?? ''}}
              </td>
              <td>
                {{$master_guide->knowledge_number ?? ''}}
              </td>
              <td>
                {{$master_guide->status ?? ''}}
              </td>
              <td>
                <a href="{{ route('master_guides.create',$master_guide->id) }}" title="Ver Guia" class="text-center text-success font-weight-bold"><i class="fa fa-search" style="color: orange;"></i></a>                         
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