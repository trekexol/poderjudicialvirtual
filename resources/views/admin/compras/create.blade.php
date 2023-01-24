@extends('admin.layouts.dashboard')

@section('content')

{{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}



{{-- VALIDACIONES-RESPUESTA --}}
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
          <div class="x_title">
            <div class="col-sm-2">
              <h2>Ingresar Facturas</h2>
            </div>
            
            <ul class="col-sm-1 nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_referencia">
            <br />
            <form method="POST" enctype="multipart/form-data" action="{{ route('compras.store') }}" id="form" data-parsley-validate class="form-horizontal form-label-left">
              @csrf 
              @isset($factura)
                <div class="item form-group">
                <div class="col-sm-6">
                  <h3>Número de Factura: {{ str_pad($factura->id ?? 0, 6, "0", STR_PAD_LEFT)}}</h3>
                </div>
                </div>
                <input type="hidden" id="id_factura" name="id_factura" value="{{$factura->id}}">
              @endisset
          
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="id_producto">Producto:</label>
                <div class="col-sm-4">
                    <select class="select2_group form-control" name="id_producto" required>
                     
                      <option value="">Seleccione una Opción</option>
                      @if (isset($productos))
                        @foreach ($productos as $producto)
                          <option value="{{ $producto->id }}">{{ $producto->nombre ?? '' }}</option>
                        @endforeach
                      @endif
                    </select>
                </div>
              
              </div>
           
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="cantidad">Cantidad:</label>
                <div class="col-sm-4">
                  <input type="text" id="cantidad" name="cantidad" required="required" class="form-control " value="{{ $factura->cantidad ?? null }}">
               
              </div>
            
            </div>
              <br>
              <div class="form-row">
              
                  <div class="col-sm-3 offset-sm-1">
                    <button type="submit" class="btn btn-primary offset-sm-1" id="Btnproducto">Registrar Producto</button>
                  </div>
               
                <div class="col-sm-2">
                  <a href="{{ route('facturas.index') }}" type="submit" class="btn btn-danger offset-sm-1" >Volver</a>
                </div>
          </form>
          </div>
      </div>
    </div>
  </div>
</div>




@endsection

