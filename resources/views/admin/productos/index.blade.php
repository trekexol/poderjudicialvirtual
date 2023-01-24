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
          <h2>Listado de Productos</h2>
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
              <th>Nombre</th>
              <th>Precio</th>
              <th>Impuesto</th>
              <th>Estado</th>
            </tr>
          </thead>
        
          @isset($productos)
            @foreach ($productos as $producto)
         
            <tr>
              <td class="text-center">
                {{$producto->id}}
              </td>
              <td>{{$producto->nombre ?? ''}}</td>
              <td>{{$producto->precio ?? ''}}</td>
              <td>{{$producto->impuesto ?? 0}} </td>
              <td>{{$producto->estado ?? ''}}</td>
           
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
