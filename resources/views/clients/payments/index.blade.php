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
            Listado de Pagos
          </div>
          <div class="col-sm-3">
            <a href="{{ route('client_payments.create') }}" class="btn btn-primary" type="button">Registrar</a>
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
              <th>Fecha</th>
              <th>Banco</th>
              <th>Tipo de Depósito</th>
              <th>Transferido desde</th>
              <th>Confirmación</th>
              <th>Monto</th>
              <th>Observaciones</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          @isset($client_payments)
            @foreach ($client_payments as $client_payment)
            <tr>
             
              <td>{{date_format(date_create($client_payment->date ?? ''),"d-m-Y") }}</td>
              <td>{{$client_payment->banks['description'] ?? '' }}</td>
              <td>{{$client_payment->type ?? ''}}</td>
              <td>{{$client_payment->transferred_from ?? ''}}</td>
              <td>{{$client_payment->confirmation ?? ''}}</td>
              <td>{{number_format($client_payment->amount ?? 0, 2, ',', '.')}}</td>
              <td>{{$client_payment->observation ?? ''}}</td>
              <td>{{$client_payment->status ?? ''}}</td>
              <td>
                <a href="{{ route('client_payments.create',$client_payment->id) }}"  title="Editar"><i class="fa fa-edit"></i></a>
                <a href="#" class="delete" data-id-client_payment={{$client_payment->id}} data-toggle="modal" data-target="#deleteModal" title="Eliminar"><i class="fa fa-trash text-danger"></i></a>  
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
          <form action="{{ route('client_payments.delete') }}" method="post">
              @csrf
              @method('DELETE')
              <input id="id_client_payment_modal" type="hidden" class="form-control @error('id_client_payment_modal') is-invalid @enderror" name="id_client_payment_modal" readonly required autocomplete="id_client_payment_modal">
                     
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
         
         let id_client_payment = $(this).attr('data-id-client_payment');
 
         $('#id_client_payment_modal').val(id_client_payment);
     });
</script>
@endsection
