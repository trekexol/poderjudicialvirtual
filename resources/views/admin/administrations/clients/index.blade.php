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
        <div class="col-sm-9">
          <h2>Clientes</h2>
        </div>
        <div class="col-sm-2">
          <a href="{{ route('clients.create') }}" type="button" class="btn btn-round btn-primary">Agregar</a>
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
              <th>Casillero</th>
              <th>Nombre</th>
              <th>Cédula</th>
              <th>Dirección</th>
              <th>Ciudad</th>
              <th>Oficina</th>
              <th>Teléfonos</th>
              <th></th>
            </tr>
          </thead>
          @isset($clients)
            @foreach ($clients as $client)
            <tr>
              <td>{{$client->countries['abbreviation'] ?? ''}}{{str_pad($client->id_client ?? 0, 6, "0", STR_PAD_LEFT)}}</td>
              <td>{{$client->firstname}} {{$client->firstlastname}}</td>
              <td>{{$client->casillero}}</td>
              <td>{{$client->direction ?? ''}}</td>
              <td>{{$client->states['name'] ?? ''}}</td>
              <td>{{$client->agencies['name'] ?? ''}}</td>
              <td>{{$client->phone_mobile ?? ''}} / {{$client->phone_room ?? ''}}</td>
              <td>
                <a href="{{ route('clients.consult',$client->id) }}"  title="Consultar"><i class="fa fa-search"></i></a>
               
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
