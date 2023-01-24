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
        <div class="col-sm-2">
          <h2>Listado de Facturas</h2>
        </div>
        <div class="col-sm-4">
          <a href="{{ route('facturas.create') }}" type="submit" class="btn btn-primary offset-sm-1" >Registrar Factura</a>
        </div>
        <ul class="col-sm-1 nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <div class="row">
          
        <table  class="table table-striped table-bordered" style="width:100%" > 
          <thead>
            <tr>
              <th>N°</th>
              <th>Nombre Cliente</th>
              <th>Referencia</th>
              <th>Estado</th>
            </tr>
          </thead>
        
          @isset($facturas)
            @foreach ($facturas as $factura)
         
            <tr>
              <td class="text-center">
                {{$factura->id}}
              </td>
              <td>{{$factura->clientes['primer_nombre'] ?? ''}}</td>
              <td>{{$factura->referencia ?? ''}}</td>
              <td>{{$factura->estado ?? ''}}</td>
              <td>
                <a href="{{ route('compras.create',$factura->id) }}" type="submit" class="btn btn-success offset-sm-1" >Comprar</a>
                <a href="{{ route('facturas.show',$factura->id) }}" type="submit" class="btn btn-warning offset-sm-1" >Mostrar</a>
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
