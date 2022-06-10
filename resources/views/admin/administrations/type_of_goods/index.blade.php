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
          <h2>Tipos de Mercancias</h2>
        </div>
        <div class="col-sm-2">
          <a href="{{ route('type_of_goods.create') }}" type="button" class="btn btn-round btn-primary">Agregar</a>
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
              <th>Arancel (%)</th>
              <th>Impuesto (%)</th>
              <th></th>
            </tr>
          </thead>
          @isset($type_of_goods)
            @foreach ($type_of_goods as $type_of_good)
            <tr>
              <td>{{$type_of_good->code}}</td>
              <td>{{$type_of_good->description}}</td>
              <td>{{$type_of_good->tariff_rate ?? ''}}</td>
              <td>{{$type_of_good->tax_percentage ?? ''}}</td>
              <td>
                <a href="{{ route('type_of_goods.edit',$type_of_good->id) }}"  title="Editar"><i class="fa fa-edit"></i></a>
                <a href="#" class="delete" data-id-type_of_good={{$type_of_good->id}} data-toggle="modal" data-target="#deleteModal" title="Eliminar"><i class="fa fa-trash text-danger"></i></a>  
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
<!-- Delete Warning Modal -->
<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
          <form action="{{ route('type_of_goods.delete') }}" method="post">
              @csrf
              @method('DELETE')
              <input id="id_type_of_good_modal" type="hidden" class="form-control @error('id_type_of_good_modal') is-invalid @enderror" name="id_type_of_good_modal" readonly required autocomplete="id_type_of_good_modal">
                     
              <h5 class="text-center">Seguro que desea eliminar?</h5>
              
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-danger">Eliminar</button>
          </div>
          </form>
      </div>
  </div>
</div>
@endsection

@section('validation')

<script>
    $(document).on('click','.delete',function(){
         
         let id_type_of_good = $(this).attr('data-id-type_of_good');
 
         $('#id_type_of_good_modal').val(id_type_of_good);
     });
</script>
@endsection
