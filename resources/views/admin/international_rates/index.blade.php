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
          <h2>Tarifas Internacionales</h2>
        </div>
        <div class="col-sm-4">
          <a href="{{ route('international_rates.create') }}" type="button" class="btn btn-round btn-primary">Agregar Tarifa Internacional</a>
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
              <th>Peso</th>
              <th>Precio</th>
              <th>Origen</th>
              <th>Destino</th>
              <th></th>
            </tr>
          </thead>
          @isset($international_rates)
            @foreach ($international_rates as $international_rate)
            <tr>
              <td>{{$international_rate->weight}}</td>
              <td>{{$international_rate->price}}</td>
              <td></td>
              <td></td>
              <td>
                <a href="{{ route('international_rates.edit',$international_rate->id) }}"  title="Editar"><i class="fa fa-edit"></i></a>
                <a href="#" class="delete" data-id-international_rate={{$international_rate->id}} data-toggle="modal" data-target="#deleteModal" title="Eliminar"><i class="fa fa-trash text-danger"></i></a>  
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