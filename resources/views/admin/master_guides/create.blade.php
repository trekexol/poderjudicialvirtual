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
            <h2>Ingresar Guia Master</h2>
            <ul class="col-sm-1 nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form method="POST" enctype="multipart/form-data" action="{{ route('master_guides.store') }}" id="form" data-parsley-validate class="form-horizontal form-label-left">
              @csrf 
                
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="id_office_agency">Oficina:</label>
                <div class="col-sm-4">
                  <select class="select2_group form-control" name="id_office_agency">
                      @if (isset($master_guide))
                        <option value="{{ $master_guide->id_office_agency ?? null }}">{{ $master_guide->office_agencies['name'] ?? null }}</option>
                        <option value="">---------------------</option>
                      @else
                        <option value="">Seleccione una Opción</option>
                      @endif
                      @foreach ($agencies as $agency)
                        <option value="{{ $agency->id }}">{{ $agency->name ?? '' }}</option>
                      @endforeach
                    </select>
                </div>
                <label class="col-form-label col-sm-3 label-align " for="id_office_agency">Referencia:</label>
                <div class="col-sm-4">
                  <input id="reference" name="reference"  class="date-picker form-control"  type="text" required="required" value="{{ $master_guide->reference ?? '' }}">
                </div>
              </div>
              <div class="item form-group">
                  <label class="col-form-label col-sm-1 label-align " for="id_airline">Aerolinea:</label>
                  <div class="col-sm-4">
                      <select class="select2_group form-control" name="id_airline">
                        @if (isset($master_guide))
                          <option value="{{ $master_guide->id_airline ?? null }}">{{ $master_guide->airlines['name'] ?? null }}</option>
                          <option value="">---------------------</option>
                        @else
                          <option value="">Seleccione una Opción</option>
                        @endif
                        @if (isset($airlines)) 
                          @foreach ($airlines as $airline)
                            <option value="{{ $airline->id }}">{{ $airline->name ?? '' }}</option>
                          @endforeach
                        @endif
                      
                      </select>
                  </div>
                  <label class="col-form-label col-sm-3 label-align " for="id_carrier_agent">Transportista:</label>
                  <div class="col-sm-4">
                      <select class="select2_group form-control" name="id_carrier_agent">
                        @if (isset($master_guide))
                          <option value="{{ $master_guide->id_carrier_agent ?? null }}">{{ $master_guide->carrier_agents['name'] ?? null }}</option>
                          <option value="">---------------------</option>
                        @else
                          <option value="">Seleccione una Opción</option>
                        @endif
                        @if (isset($carrier_agents)) 
                          @foreach ($carrier_agents as $carrier_agent)
                            <option value="{{ $carrier_agent->id }}">{{ $carrier_agent->name ?? '' }}</option>
                          @endforeach
                        @endif
                       
                      </select>
                  </div>
              </div>

              <div class="item form-group">
                  <label class="col-form-label col-sm-1 label-align " for="knowledge_number">Número Conocimiento:</label>
                  <div class="col-sm-3">
                    <input id="knowledge_number" name="knowledge_number" class="date-picker form-control"  type="text" required="required" value="{{ $master_guide->knowledge_number ?? '' }}">
                  </div>
                  <label class="col-form-label col-sm-4 label-align " for="id_consignee_agent">Consignatario:</label>
                  <div class="col-sm-4">
                      <select class="select2_group form-control" name="id_consignee_agent">
                        @if (isset($master_guide))
                          <option value="{{ $master_guide->id_consignee_agent ?? null }}">{{ $master_guide->consignee_agents['name'] ?? null }}</option>
                          <option value="">---------------------</option>
                        @else
                          <option value="">Seleccione una Opción</option>
                        @endif
                        @if (isset($consignee_agents)) 
                          @foreach ($consignee_agents as $consignee_agent)
                            <option value="{{ $consignee_agent->id }}">{{ $consignee_agent->name ?? '' }}</option>
                          @endforeach
                        @endif
                       
                      </select>
                  </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="amount">Cantidad:</label>
                <div class="col-sm-3">
                  <input id="amount" name="amount" class="date-picker form-control"  type="text" required="required" value="{{ $master_guide->amount ?? '' }}">
                </div>
                <label class="col-form-label col-sm-4 label-align " for="id_consignee_agent">Emisor:</label>
                <div class="col-sm-4">
                  <select class="select2_group form-control" name="id_transmitter_agent">
                    @if (isset($master_guide))
                      <option value="{{ $master_guide->id_transmitter_agent ?? null }}">{{ $master_guide->transmitter_agents['name'] ?? null }}</option>
                      <option value="">---------------------</option>
                    @else
                      <option value="">Seleccione una Opción</option>
                    @endif
                    @if (isset($transmitter_agents)) 
                      @foreach ($transmitter_agents as $transmitter_agent)
                        <option value="{{ $transmitter_agent->id }}">{{ $transmitter_agent->name ?? '' }}</option>
                      @endforeach
                    @endif
                   
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="weight_unit">Unidad de Peso:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control" name="weight_unit" required>
                      @if (isset($master_guide))
                        <option value="{{ $master_guide->weight_unit ?? '' }}">{{ $master_guide->weight_unit ?? '' }}</option>
                        <option value="">---------------------</option>
                      @else
                        <option value="">Seleccione</option>
                      @endif
                      <option value="Kilos">Kilos</option>
                      <option value="Libras">Libras</option>
                    </select>
                </div>
                <label class="col-form-label col-sm-4 label-align " for="id_consignee_agent">Cargo:</label>
                <div class="col-sm-4">
                  <select class="select2_group form-control" name="id_position_agent">
                    @if (isset($master_guide))
                      <option value="{{ $master_guide->id_position_agent ?? null }}">{{ $master_guide->position_agents['name'] ?? null }}</option>
                      <option value="">---------------------</option>
                    @else
                      <option value="">Seleccione una Opción</option>
                    @endif
                    @if (isset($position_agents)) 
                      @foreach ($position_agents as $position_agent)
                        <option value="{{ $position_agent->id }}">{{ $position_agent->name ?? '' }}</option>
                      @endforeach
                    @endif
                   
                  </select>
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="dimension">Peso Neto:</label>
                <div class="col-sm-3">
                  <input id="net_weight" name="net_weight"  class="date-picker form-control"  type="text" required="required" value="{{ number_format(bcdiv(($master_guide->net_weight ?? 0), '1', 2), 2, ',', '.') ?? null }}">
                </div>
                <label class="col-form-label col-sm-4 label-align " for="dimension">Peso Cargable:</label>
                <div class="col-sm-3">
                  <input id="loadable_weight" name="loadable_weight"  class="date-picker form-control"  type="text" required="required" value="{{ number_format(bcdiv(($master_guide->loadable_weight ?? 0), '1', 2), 2, ',', '.') ?? null }}">
                </div>
              </div>

            
              <div class="item form-group">
                  <label class="col-form-label col-sm-3 label-align " for="contains_dangerous_goods">Contiene Mercancia Peligrosa:</label>
                  <div class="col-md-1 col-sm-1 ">
                  <p> Si: <input type="radio" class="flat" name="contains_dangerous_goods" id="contains_dangerous_goodsYes" value="Yes"  required /> 
                  </div>
                  <div class="col-md-1 col-sm-1 ">
                      No: <input type="radio" class="flat" name="contains_dangerous_goods" id="contains_dangerous_goodsNo" value="No" checked=""/>
                  </p>
                  </div>
              
              </div>

              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="dimension">Aeropuerto Dest:</label>
                <div class="col-sm-3">
                  <input id="destination_airport" name="destination_airport"  class="date-picker form-control"  type="text" required="required" value="{{ $master_guide->destination_airport ?? '' }}">
                </div>
                <label class="col-form-label col-sm-3 label-align " for="dimension">Vuelo / Fecha:</label>
                <div class="col-sm-2">
                  <input id="flight" name="flight"  class="date-picker form-control"  type="text" required="required" value="{{ $master_guide->flight ?? '' }}">
                </div>
                <div class="col-sm-2">
                  <input id="flight_date" name="flight_date"  class="date-picker form-control"  type="date" required="required" value="{{ $master_guide->flight_date ?? $datenow }}">
                </div>
              </div>

            
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
  <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <div class="col-md-4 col-sm-4 h5">
              Descripción de la Guía
            </div>
          
            <ul class="col-sm-1 nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
                <div class="item form-group">
                  <label class="col-form-label col-sm-2 label-align " for="dimension">Handing Information (Información de entrega):</label>
                  <div class="col-sm-3">
                    <input id="handing_information" name="handing_information"  class="date-picker form-control"  type="text" required="required" value="{{ $master_guide->handing_information ?? '' }}">
                  </div>
                  <label class="col-form-label col-sm-4 label-align " for="dimension">Nature and Quanty of goods (Tipo de carga):</label>
                  <div class="col-sm-3">
                    <input id="nature_and_quanty_of_goods" name="nature_and_quanty_of_goods"  class="date-picker form-control"  type="text" required="required" value="{{ $master_guide->nature_and_quanty_of_goods ?? '' }}">
                  </div>
                </div>

                <div class="item form-group">
                  <label class="col-form-label col-sm-2 label-align " for="dimension">Información Extra (Tipo de carga):</label>
                  <div class="col-sm-3">
                    <input id="extra_information" name="extra_information"  class="date-picker form-control"  type="text" required="required" value="{{ $master_guide->extra_information ?? '' }}">
                  </div>
                  <label class="col-form-label col-sm-4 label-align " for="dimension">Información Extra 2 (Tipo de carga):</label>
                  <div class="col-sm-3">
                    <input id="extra_information2" name="extra_information2"  class="date-picker form-control"  type="text" required="required" value="{{ $master_guide->extra_information2 ?? '' }}">
                  </div>
                </div>

                  <div class="form-row">
                    @if (empty($master_guide))
                      <div class="col-sm-3 offset-sm-1">
                        <button type="submit" class="btn btn-primary" id="Btnmaster_guide">Registrar Tula</button>
                      </div>
                    @else
                      <div class="col-sm-3 offset-sm-1">
                        <button onclick="update();" class="btn btn-success" id="Btnmaster_guide">Actualizar Tula</button>
                      </div>
                    @endif
                    <div class="col-sm-2 ">
                      <a href="{{ route('master_guides.index') }}" class="btn btn-danger" type="button">Ver Listado</a>
                    </div>
                  </div>
                    </form>
              </div>
          </div>
    </div>
</div>

@endsection

@section('validation')

  @isset($master_guide)
    <script>
      if("{{$master_guide->loose_packages}}" == "Yes"){
          $('#loose_packagesYes').prop('checked', true);
      }else{
          $('#loose_packagesNo').prop('checked', true);
      }

      
    function update(){
      document.getElementById("form").action = "{{ route('master_guides.update',$master_guide->id) }}";
      document.getElementById("form").submit();
    }
    </script>
  @endisset
  
@endsection