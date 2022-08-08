@extends('clients.layouts.dashboard')

@section('content')

{{-- VALIDACIONES-RESPUESTA--}}
@include('clients.layouts.success')   {{-- SAVE --}}
@include('clients.layouts.danger')    {{-- EDITAR --}}
@include('clients.layouts.delete')    {{-- DELELTE --}}

{{-- VALIDACIONES-RESPUESTA --}}
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
          <div class="x_title">
            <h2>Ingresar Pago</h2>
            <ul class="col-sm-1 nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form method="POST" enctype="multipart/form-data" action="{{ route('client_payments.store') }}" id="form" data-parsley-validate class="form-horizontal form-label-left">
              @csrf 
                         
              <input type="hidden" id="id_client" name="id_client" value="{{Auth::user()->id_client}}">
               
           
              <div class="item form-group">
                <label class="col-form-label col-sm-3 label-align " for="dimension">Fecha:</label>
                <div class="col-sm-3">
                  <input id="date" name="date"  class="date-picker form-control"  type="date" required="required" value="{{ $client_payment->date ?? $datenow }}">
                </div>
              </div>

             
              <div class="item form-group">
                <label class="col-form-label col-sm-3 label-align " for="id_bank">Banco:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control" name="id_bank" required>
                      @if (isset($client_payment))
                        <option value="{{ $client_payment->banks['id'] ?? null }}">{{ $client_payment->banks['description'] ?? null }}</option>
                        <option value="">---------------------</option>
                      @else
                          <option value="">Seleccione...</option>
                      @endif
                        @if (isset($banks))
                          @foreach ($banks as $bank)
                            <option value="{{$bank->id}}">{{$bank->description}}</option>
                          @endforeach
                        @endif
                      </select>
                </div>
              </div>
              
              <div class="item form-group">
                <label class="col-form-label col-sm-3 label-align " for="id_bank">Tipo Depósito:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control" name="type" required>
                        @if (isset($client_payment))
                          <option value="{{$client_payment->type}}">{{$client_payment->type}}</option>
                          <option value="">-----------------</option>
                        @else
                          <option value="">Seleccione...</option>
                        @endif
                        
                        <option value="Efectivo">Efectivo</option>
                        <option value="Transferencia">Transferencia</option>
                    </select>
                </div>
              </div>
              

              <div class="item form-group">
                <label class="col-form-label col-sm-3 label-align " for="transferred_from">Transferido Desde:</label>
                <div class="col-sm-3">
                  <input id="transferred_from" name="transferred_from"  class="date-picker form-control"  type="text" required="required" value="{{ $client_payment->transferred_from ?? '' }}">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-sm-3 label-align " for="confirmation">Confirmación:</label>
                <div class="col-sm-3">
                  <input id="confirmation" name="confirmation"  class="date-picker form-control"  type="text" required="required" value="{{ $client_payment->confirmation ?? '' }}">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-sm-3 label-align " for="amount">Monto:</label>
                <div class="col-sm-3">
                  <input id="amount" name="amount"  class="date-picker form-control"  type="text" required="required" value="{{ number_format($client_payment->amount ?? 0, 2, ',', '.') }}">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-sm-3 label-align " for="amount">Observaciones:</label>
                <div class="col-sm-3">
                  <input id="observation" name="observation"  class="date-picker form-control"  type="text" required="required" value="{{ $client_payment->observation ?? '' }}">
                </div>
              </div>

              <br>
              <br>
              <div class="form-row">
                @if (empty($client_payment))
                  <div class="col-sm-3 offset-sm-2">
                    <button type="submit" class="btn btn-primary" id="Btnclient_payment">Registrar</button>
                  </div>
                @else
                  <div class="col-sm-3 offset-sm-2">
                    <button onclick="update();" class="btn btn-success" id="Btnclient_payment">Actualizar</button>
                  </div>
                @endif
                <div class="col-sm-2 ">
                  <a href="{{ route('client_payments.index') }}" class="btn btn-danger" type="button">Ver Listado</a>
                </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('validation')
  <script>
    $(document).ready(function () {
      $("#amount").mask('000.000.000.000.000,00', { reverse: true });
      
    });        

  </script>
  @isset($client_payment)
    <script>
          
    function update(){
      document.getElementById("form").action = "{{ route('client_payments.update',$client_payment->id) }}";
      document.getElementById("form").submit();
    }
    </script>
  @endisset
  
@endsection