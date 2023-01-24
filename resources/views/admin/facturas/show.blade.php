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
        <div class="col-sm-8">
          <h2>Listado de Compras de la factura  {{ str_pad($factura->id ?? 0, 6, "0", STR_PAD_LEFT)}}</h2>
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
              <th>Nombre Producto</th>
              <th>Precio</th>
              <th>Impuesto</th>
              <th>Cantidad</th>
            </tr>
          </thead>
        
          @php
           $total_precio = 0;
           $total_impuesto = 0;   
          @endphp
          @isset($compras)
            @foreach ($compras as $compra)
            @php
              $total_precio += $compra->productos['precio'] * $compra->cantidad;
              $total_impuesto += $compra->productos['impuesto'] * $compra->cantidad;
            @endphp
            <tr>
              <td class="text-center">
                {{$compra->id}}
              </td>
              <td>{{$compra->productos['nombre'] ?? ''}}</td>
              <td>{{$compra->productos['precio'] * $compra->cantidad}}</td>
              <td>{{$compra->productos['impuesto'] * $compra->cantidad}}</td>
              <td>{{$compra->cantidad ?? ''}}</td>
           
            </tr>
            @endforeach
         
          @endisset
          
          <tr>
            <td class="text-center">
             
            </td>
            <td></td>
            <td>{{$total_precio}}</td>
            <td>{{$total_impuesto}}</td>
            <td></td>
         
          </tr>
          </table>
        </div>
      </div>
    </div>
</div>
    </div>
  </div>
</div>


@endsection
