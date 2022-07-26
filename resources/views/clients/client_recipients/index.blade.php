@extends('clients.layouts.dashboard')

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
          <h2>Destinatarios</h2>
        </div>
        <div class="col-sm-2">
          <a href="{{ route('client_recipients.create') }}" type="button" class="btn btn-round btn-primary">Agregar</a>
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
              <th>Email</th>
              <th>Nombre</th>
              <th>Cédula</th>
              <th>Dirección</th>
              <th>Dirección 2</th>
              <th>Teléfono</th>
              <th>Pais</th>
              <th>Observaciones</th>
              <th></th>
            </tr>
          </thead>
          @isset($client_recipients)
            @foreach ($client_recipients as $client_recipient)
            <tr>
              <td>{{$client_recipient->email}}</td>
              <td>{{$client_recipient->name}}</td>
              <td>{{$client_recipient->identification_card ?? ''}}</td>
              <td>{{$client_recipient->direction1 ?? ''}}</td>
              <td>{{$client_recipient->direction2 ?? ''}}</td>
              <td>{{$client_recipient->phone ?? ''}}</td>
              <td>{{$client_recipient->countries['name'] ?? ''}}</td>
              <td>{{$client_recipient->observation ?? ''}}</td>
              <td>
                <a href="{{ route('client_recipients.edit',$client_recipient->id) }}"  title="Editar"><i class="fa fa-edit"></i></a>
                <a href="#" class="delete" data-id-client_recipient={{$client_recipient->id}} data-toggle="modal" data-target="#deleteModal" title="Eliminar"><i class="fa fa-trash text-danger"></i></a>  
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
          <form action="{{ route('client_recipients.delete') }}" method="post">
              @csrf
              @method('DELETE')
              <input id="id_client_recipient_modal" type="hidden" class="form-control @error('id_client_recipient_modal') is-invalid @enderror" name="id_client_recipient_modal" readonly required autocomplete="id_client_recipient_modal">
                     
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
         
         let id_client_recipient = $(this).attr('data-id-client_recipient');
 
         $('#id_client_recipient_modal').val(id_client_recipient);
     });
</script>
@endsection
