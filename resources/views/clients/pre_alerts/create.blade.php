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
            <h2>Ingresar Pre Alertas</h2>
            <ul class="col-sm-1 nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form method="POST" enctype="multipart/form-data" action="{{ route('client_pre_alerts.store') }}" id="form" data-parsley-validate class="form-horizontal form-label-left">
              @csrf 
                         
              <input type="hidden" id="id_client" name="id_client" value="{{Auth::user()->id_client}}">
               
           
              <div class="item form-group">
                <label class="col-form-label col-sm-3 label-align " for="dimension">Tracking:</label>
                <div class="col-sm-3">
                  <input id="tracking" name="tracking"  class="date-picker form-control"  type="text" required="required" value="{{ $client_pre_alert->tracking ?? '' }}">
                </div>
              </div>

             
              <div class="item form-group">
                <label class="col-form-label col-sm-3 label-align " for="shipping_type">Tipo de Envío:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control" name="shipping_type" required>
                      @if (isset($client_pre_alert))
                        <option value="{{ $client_pre_alert->shipping_type ?? null }}">{{ $client_pre_alert->shipping_type ?? null }}</option>
                        <option value="">---------------------</option>
                      @else
                        <option value="">Seleccione</option>
                      @endif
                      <option value="Aéreo">Aéreo</option>
                      <option value="Marítimo">Marítimo</option>
                      <option value="Terrestre">Terrestre</option>
                      </select>
                </div>
              </div>
              
              <div class="item form-group">
                <label class="col-form-label col-sm-3 label-align " for="dimension">Sitio Web Origen:</label>
                <div class="col-sm-3">
                  <input id="origin_web" name="origin_web"  class="date-picker form-control"  type="text" required="required" value="{{ $client_pre_alert->origin_web ?? '' }}">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-sm-3 label-align " for="transport_company">Empresa de Transporte:</label>
                <div class="col-sm-3">
                  <input id="transport_company" name="transport_company"  class="date-picker form-control"  type="text" required="required" value="{{ $client_pre_alert->transport_company ?? '' }}">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-sm-3 label-align " for="dimension">Contenido del Paquete:</label>
                <div class="col-sm-3">
                  <input id="package_content" name="package_content"  class="date-picker form-control"  type="text" required="required" value="{{ $client_pre_alert->package_content ?? '' }}">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-sm-3 label-align " for="package_remarks">Observaciones del Paquete:</label>
                <div class="col-sm-3">
                  <input id="package_remarks" name="package_remarks"  class="date-picker form-control"  type="text" required="required" value="{{ $client_pre_alert->package_remarks ?? '' }}">
                </div>
              </div>
              <br>
              <br>
              <div class="form-row">
                @if (empty($client_pre_alert))
                  <div class="col-sm-3 offset-sm-2">
                    <button type="submit" class="btn btn-primary" id="Btnclient_pre_alert">Registrar Pre Alerta</button>
                  </div>
                @else
                  <div class="col-sm-3 offset-sm-2">
                    <button onclick="update();" class="btn btn-success" id="Btnclient_pre_alert">Actualizar Pre Alerta</button>
                  </div>
                @endif
                <div class="col-sm-2 ">
                  <a href="{{ route('client_pre_alerts.index') }}" class="btn btn-danger" type="button">Ver Listado</a>
                </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('validation')

  @isset($client_pre_alert)
    <script>
     
      
    function update(){
      document.getElementById("form").action = "{{ route('client_pre_alerts.update',$client_pre_alert->id) }}";
      document.getElementById("form").submit();
    }
    </script>
  @endisset
  
@endsection