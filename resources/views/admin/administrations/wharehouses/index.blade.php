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
        <div class="col-sm-7">
          <h2>Almacenes</h2>
        </div>
        <div class="col-sm-3">
          <a href="{{ route('wharehouses.create') }}" type="button" class="btn btn-round btn-primary">Agregar Almacen</a>
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
              <th>Código</th>
              <th>Nombre</th>
              <th>Agencia</th>
              <th></th>
            </tr>
          </thead>
          @isset($wharehouses)
            @foreach ($wharehouses as $wharehouse)
            <tr>
              <td>{{$wharehouse->code}}</td>
              <td>{{$wharehouse->name}}</td>
              <td>{{$wharehouse->agencies['name'] ?? ''}}</td>
              <td>
                <a href="{{ route('wharehouses.edit',$wharehouse->id) }}"  title="Editar"><i class="fa fa-edit"></i></a>
                <a href="#" class="delete" data-id-$wharehouse={{$wharehouse->id}} data-toggle="modal" data-target="#deleteModal" title="Eliminar"><i class="fa fa-trash text-danger"></i></a>  
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