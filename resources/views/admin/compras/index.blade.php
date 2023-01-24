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
          <h2>Listado de Compras</h2>
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
              <th>N° Compra</th>
              <th>N° Factura</th>
              <th>Nombre Producto</th>
              <th>Precio</th>
             
            </tr>
          </thead>
        
          @isset($compras)
            @foreach ($compras as $compra)
         
            <tr>
              <td class="text-center">
                {{$compra->id}}
              </td>
              <td class="text-center">
                {{$compra->id_factura}}
              </td>
              <td>{{$compra->productos['nombre'] ?? ''}}</td>
              <td>{{$compra->productos['precio'] ?? ''}}</td>
           
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
