@extends('clients.layouts.dashboard')

@section('content')

{{-- VALIDACIONES-RESPUESTA--}}
@include('clients.layouts.success')   {{-- SAVE --}}
@include('clients.layouts.danger')    {{-- EDITAR --}}
@include('clients.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}
<div class="right_col" role="main">
 
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
          <div class="col-sm-8 h5">
            Listado de Pre Alertas
          </div>
          <div class="col-sm-3">
            <a href="{{ route('client_pre_alerts.create') }}" class="btn btn-primary" type="button">Registrar</a>
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
              <th>Tracking</th>
              <th>Casillero</th>
              <th>Nombre</th>
              <th>Tipo</th>
              <th>Transportista</th>
              <th>Fecha_Rg.</th>
              <th>Contenido</th>
              <th>Nota</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          @isset($client_pre_alerts)
            @foreach ($client_pre_alerts as $client_pre_alert)
            <tr>
              <td class="text-center">
                <a href="{{ route('client_pre_alerts.create',$client_pre_alert->id) }}"  title="Seleccionar">{{$client_pre_alert->tracking}}</a>
              </td>
              <td>{{$client_pre_alert->clients->countries['abbreviation'] ?? ''}}{{$client_pre_alert->id_client}}</td>
              <td>{{$client_pre_alert->clients['firstname'] ?? '' }} {{ $client_pre_alert->clients['firstlastname'] ?? ''}}</td>
              <td>{{$client_pre_alert->shipping_type ?? ''}}</td>
              <td>{{$client_pre_alert->transport_company ?? ''}}</td>
              <td>{{$client_pre_alert->created_at ?? ''}}</td>
              <td>{{$client_pre_alert->package_content ?? ''}}</td>
              <td>{{$client_pre_alert->package_remarks ?? ''}}</td>
              <td>{{$client_pre_alert->status ?? ''}}</td>
              <td>
                <a href="{{ route('client_pre_alerts.create',$client_pre_alert->id) }}"  title="Editar"><i class="fa fa-edit"></i></a>
                <a href="#" class="delete" data-id-client_pre_alert={{$client_pre_alert->id}} data-toggle="modal" data-target="#deleteModal" title="Eliminar"><i class="fa fa-trash text-danger"></i></a>  
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
          <form action="{{ route('client_pre_alerts.delete') }}" method="post">
              @csrf
              @method('DELETE')
              <input id="id_client_pre_alert_modal" type="hidden" class="form-control @error('id_client_pre_alert_modal') is-invalid @enderror" name="id_client_pre_alert_modal" readonly required autocomplete="id_client_pre_alert_modal">
                     
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
         
         let id_client_pre_alert = $(this).attr('data-id-client_pre_alert');
 
         $('#id_client_pre_alert_modal').val(id_client_pre_alert);
     });
</script>
@endsection