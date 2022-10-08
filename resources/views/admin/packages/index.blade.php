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
        <div class="col-sm-2">
          <h2>Listado de Paquetes</h2>
        </div>
        <div class="col-sm-1">
          <a href="{{ route('package_exports.exportPackageManifiesto') }}" title="Paquetes en Origen Todos"><img src="{{asset('img/excel.png')}}" /> </a>
         </div>
        <div class="col-sm-1">
          <a href="{{ route('package_exports.exportPackage') }}" title="Paquetes en Origen AP"><img src="{{asset('img/excel.png')}}" /> </a>
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
              <form id="formSearch" method="POST" action="{{ route('package_searchs.index') }}" enctype="multipart/form-data" >
                @csrf
              <div class="item form-group">
                <label class="col-form-label col-sm-2 label-align " for="first-name">Tipo de Envío:</label>
                <div class="col-sm-1">
                  <input type="radio" name="checks"  id="myCheck"  value="Todos"> <img for="myCheck" src="{{asset('img/todos.png')}}" />
                </div> 
                <div class="col-sm-1">
                  <input type="radio" name="checks" id="Aereo" value="Aéreo" data-parsley-mincheck="2" />  <img for="myCheck" src="{{asset('img/aereo.png')}}" />
                </div> 
                <div class="col-sm-1">
                  <input type="radio" name="checks" id="Maritimo" value="Marítimo" data-parsley-mincheck="2" /><img for="myCheck" src="{{asset('img/maritimo.png')}}" />
                </div> 
                <div class="col-sm-1">
                  <input type="radio" name="checks" id="MaritimoExpress" value="Marítimo Express" data-parsley-mincheck="2" /> <img for="myCheck" src="{{asset('img/maritimoexpres.png')}}" />
                </div> 
                <div class="col-sm-1">
                  <input type="radio" name="checks" id="Terrestre" value="Terrestre" data-parsley-mincheck="2" /> <img for="myCheck" src="{{asset('img/truck.png')}}" />
                </div> 
                
                <div class="col-sm-4">
                    <select class="select2_group form-control" name="status" required>
                      @if (isset($status))
                          <option >{{ $status }}</option>
                          <option disabled value="">--------------------</option>
                        @else
                          <option value="">Seleccione un Status</option>
                        @endif
                        
                        <option >(1) Recibido en Origen</option>
                        <option >(2) Embalado Para Despacho</option>
                        <option >(3) En Transporte Internacional</option>
                        <option >(4) Recibido Destino Principal</option>
                        <option >(5) En Ruta de Entrega</option>
                        <option >(6) Recibido en Agencia</option>
                        <option >(7) Entregado Cliente</option>
                        <option >(8) Entregado a Transporte</option>
                        <option >(9) Retenido / Hold</option>
                        <option >(10) Devuelto a la oficina</option>
                        <option >(11) Cliente no contactado</option>
                        <option >(32) En Transporte a Destino</option>
                        <option >(34) En Aduana</option>
                        <option >(66) Extraviado</option>
                        <option >(88) En Abandono</option>
                        <option >(89) Devolucion al Proveedor</option>
                      
                      </select>
                    </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="first-name">Oficina:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control" name="id_agency" required>
                      @if (isset($agency_search))
                        <option value="{{ $agency_search->id ?? null }}">{{ $agency_search->name ?? null }} </option>
                        <option value="">---------------------</option>
                      @else
                        <option value="">Seleccione una Opción</option>
                      @endif
                      @if (isset($agencies))
                        @foreach ($agencies as $agency)
                          <option value="{{ $agency->id }}">{{ $agency->name ?? '' }} </option>
                        @endforeach
                      @endif
                    </select>
                </div>
                <label class="col-form-label col-sm-1 label-align " for="id_wharehouse">Almacen:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control" name="id_wharehouse" required>
                      @if (isset($wharehouse_search))
                        <option value="{{ $wharehouse_search->id ?? null }}">{{ $wharehouse_search->name ?? null }}</option>
                        <option value="">---------------------</option>
                      @else
                        <option value="">Seleccione una Opción</option>
                      @endif
                      @if (isset($wharehouses))
                        @foreach ($wharehouses as $wharehouse)
                          <option value="{{ $wharehouse->id }}">{{ $wharehouse->name ?? '' }}</option>
                        @endforeach
                      @endif
                    </select>
                </div>
                <label class="col-form-label col-sm-1 label-align " for="client">Cliente:</label>
                <div class="col-sm-2">
                  <input type="text" id="client" name="client"  class="form-control " value="{{ $search_client ?? null }}">
                </div>
                <a href="#" onclick="searchIndex();" title="Buscar" ><i class="fa fa-search"></i></a>  
              </div>
              </form>
        <table  class="table table-striped table-bordered" style="width:100%" > 
          <thead>
            <tr>
              <th>N°</th>
              <th>Pz</th>
              <th>Tracking</th>
              <th>Cliente</th>
              <th>Casillero</th>
              <th>Descripcion</th>
              <th>$</th>
              <th>Tipo</th>
              <th>Ins</th>
              <th>Oficina</th>
              <th>PC</th>
              <th>P</th>
              <th>PV</th>
              <th>Status</th>
              <th>Fecha</th>
              <th>O</th>
              <th></th>
            </tr>
          </thead>
          @php
               $cubic_foot = 0;
               $starting_weight = 0;
               $volume = 0;
           @endphp
          @isset($packages)
            @foreach ($packages as $package)
           @php
               $cubic_foot += $package->cubic_foot;
               $starting_weight += $package->starting_weight;
               $volume += $package->volume;
           @endphp
            <tr>
              <td class="text-center">
                <a href="{{ route('packages.create',$package->id) }}"  title="Seleccionar">{{$package->id}}</a>
              </td>
              <td>{{$package->count_package_lumps ?? ''}}</td>
              <td>{{$package->tracking ?? ''}}</td>
              <td>{{$package->firstname ?? ''}} {{$package->firstlastname ?? ''}}</td>
              <td>{{$package->casillero ?? ''}}</td>
              <td>{{$package->description ?? ''}} </td>
              <td>
                @if (isset($package->date_payment) && $package->date_payment != null)
                  <a href="{{ route('packages.payment',$package->id) }}"><img src="{{asset('img/ok.png')}}" /> </a>
                @else
                  <a href="{{ route('packages.payment',$package->id) }}"><img src="{{asset('img/pagar.png')}}" /></a>
                @endif
              </td>
              <td>{{$package->instruction ?? ''}}</td>
              <td>
                @if ($package->instruction == "Aéreo")
                  <a href="{{ route('packages.tipoEnvio',$package->id) }}"><img src="{{asset('img/aereo.png')}}" /></a>
                @else
                  <a href="{{ route('packages.tipoEnvio',$package->id) }}"><img src="{{asset('img/maritimo.png')}}" /></a>
                @endif
              </td>
              <td>{{$package->agency_name ?? ''}}</td>
              <td>{{$package->cubic_foot ?? 0}}</td>
              <td>{{$package->starting_weight ?? 0}}</td>
              <td>{{$package->volume ?? 0}}</td>
              <td>{{$package->status ?? ''}}</td>
              <td>{{date_format(date_create($package->arrival_date ?? ''),"d-m-Y") }}</td>
              <td>{{$package->wharehouse_code ?? ''}}</td>
              <td>
                <a href="{{ route('packages.print',$package->id) }}"  title="Editar"><i class="fa fa-print"></i></a>
                <a href="{{ route('historial_status.viewPackage',$package->id) }}"  title="Ver Historial de Status"><i class="fa fa-question"></i></a>
                <a href="#" class="delete" data-id-package={{$package->id}} data-toggle="modal" data-target="#deleteModal" title="Eliminar"><i class="fa fa-trash text-danger"></i></a>  
                <a href="#" class="delete" data-id-package={{$package->id}} data-toggle="modal" data-target="#showModal" title="Mostrar"><i class="fa fa-trash text-danger"></i></a>  
              </td>
            </tr>
            @endforeach
            <tfoot>
            <tr>
              <td class="text-center">
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>Total</td>
              <td>{{$cubic_foot ?? 0}}</td>
              <td>{{$starting_weight ?? 0}}</td>
              <td>{{$volume ?? 0}}</td>
              <td></td>
              <td></td>
              <td></td>
              <td>
               </td>
            </tr>
          </tfoot>
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
          <form action="{{ route('packages.delete') }}" method="post">
              @csrf
              @method('DELETE')
              <input id="id_package_modal" type="hidden" class="form-control @error('id_package_modal') is-invalid @enderror" name="id_package_modal" readonly required autocomplete="id_package_modal">
                     
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

<div class="modal fade bd-example-modal-lg" id="showModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      @isset($package)
      <div class="item form-group">
      <div class="col-sm-6">
        <h3>Número de Paquete: {{ str_pad($package->id ?? 0, 6, "0", STR_PAD_LEFT)}}</h3>
      </div>
      </div>
    @endisset
    <div class="item form-group">
      <label class="col-form-label col-sm-1 label-align " for="tracking">Tracking </label>
      <div class="col-sm-4">
        <input type="text" id="tracking" name="tracking" required="required" class="form-control " value="{{ $tracking ?? $package->tracking ?? null }}">
      </div>
      <label class="col-form-label col-sm-3 label-align " for="id_agent_shipper">Shipper: </label>
      <div class="col-sm-3">
        <select class="select2_group form-control" name="id_agent_shipper" required>
            @if (isset($package))
              <option value="{{ $package->id_agent_shipper ?? null }}">{{ $package->shippers['name'] ?? null }}</option>
              <option value="">---------------------</option>
            @else
              <option value="">Seleccione una Opción</option>
            @endif
            @if (isset($agents))
              @foreach ($agents as $agent)
                <option value="{{ $agent->id }}">{{ $agent->name ?? '' }}</option>
              @endforeach
            @endif
          </select>
      </div>
    </div>
    <div class="item form-group">
      <label class="col-form-label col-sm-1 label-align " for="id_client">Cliente</label>
      <div class="col-sm-4">
          <select class="select2_group form-control js-example-matcher" data-live-search="true" data-show-subtext="true" name="id_client" required>
            @if (isset($package))
              <option value="{{ $package->id_client ?? null }}">{{$package->clients['casillero'] ?? ''}} - {{ $package->clients['firstname'] ?? null }} {{ $package->clients['firstlastname'] ?? null }}</option>
              <option value="">---------------------</option>
            @else
              <option value="">Seleccione una Opción</option>
            @endif
            @if (isset($clients)) 
              @foreach ($clients as $client)
                <option value="{{ $client->id }}">{{$client->casillero ?? ''}} - {{ $client->firstname ?? '' }} {{ $client->firstlastname ?? '' }}</option>
              @endforeach
            @endif
           
          </select>
      </div>
    </div>
    <div class="item form-group">
      <label class="col-form-label col-sm-1 label-align " for="first-name">Agente Vendedor:</label>
      <div class="col-sm-4">
          <select class="select2_group form-control" name="id_agent_vendor" required>
            @if (isset($package))
              <option value="{{ $package->id_agent_vendor ?? null }}">{{ $package->vendors['name'] ?? null }}</option>
              <option value="">---------------------</option>
            @else
              <option value="">Seleccione una Opción</option>
            @endif
            @if (isset($agents))
              @foreach ($agents as $agent)
                <option value="{{ $agent->id }}">{{ $agent->name ?? '' }}</option>
              @endforeach
            @endif
          </select>
      </div>
    
    </div>
 
    <div class="item form-group">
      <label class="col-form-label col-sm-1 label-align">Fecha Llegada:
      </label>
      <div class="col-sm-4">
        <input id="arrival_date" name="arrival_date" class="date-picker form-control"  required="required" type="date" value="{{ date_format(date_create($package->arrival_date ?? $datenow ??null),"Y-m-d") }}">
      </div>
      <label class="col-form-label col-sm-3 label-align">Hora Llegada:
      </label>
      <div class="col-sm-3 ">
        @if (isset($package->arrival_date))
          <input id="check_in" name="check_in" class="date-picker form-control"  type="time"  value="{{ date_format(date_create($package->arrival_date ?? $datenow  ?? null),"H:i") }}">        
        @else
          <input id="check_in" name="check_in" class="date-picker form-control"  type="time"  >                   
        @endif
        </div>
    </div>
    <div class="item form-group">
      <label class="col-form-label col-sm-1 label-align " for="first-name">Ubicación Oficina:</label>
      <div class="col-sm-4">
          <select class="select2_group form-control" name="id_agency_office_location" required>
            @if (isset($package))
              <option value="{{ $package->id_agency_office_location ?? null }}">{{ $package->office_locations['name'] ?? null }} - {{ $package->office_locations['direction'] ?? null }}</option>
              <option value="">---------------------</option>
            @else
              <option value="">Seleccione una Opción</option>
            @endif
            @if (isset($agencies))
              @foreach ($agencies as $agency)
                <option value="{{ $agency->id }}">{{ $agency->name ?? '' }} - {{ $agency->direction ?? '' }}</option>
              @endforeach
            @endif
          </select>
      </div>
      <label class="col-form-label col-sm-3 label-align " for="id_wharehouse">Almacen:</label>
      <div class="col-sm-3">
          <select class="select2_group form-control" name="id_wharehouse" required>
            @if (isset($package))
              <option value="{{ $package->id_wharehouse ?? null }}">{{ $package->wharehouses['name'] ?? null }}</option>
              <option value="">---------------------</option>
            @else
              <option value="">Seleccione una Opción</option>
            @endif
            @if (isset($wharehouses))
              @foreach ($wharehouses as $wharehouse)
                <option value="{{ $wharehouse->id }}">{{ $wharehouse->name ?? '' }}</option>
              @endforeach
            @endif
          </select>
      </div>
    </div>
    <div class="item form-group">
      <label class="col-form-label col-sm-1 label-align " for="content">Contenido:</label>
      <div class="col-sm-4">
        <input type="text" id="content" name="content" required="required" class="form-control " value="{{ $package->content ?? null }}">
      </div>
      <label class="col-form-label col-sm-3 label-align " for="value">Valor:</label>
      <div class="col-sm-3">
        <input type="text" id="value" name="value" required="required" class="form-control" value="{{ number_format($package->value ?? 0, 2, ',', '.') }}">
      </div>
    </div>
    <div class="item form-group">
      <label class="col-form-label col-sm-1 label-align " for="id_origin_country">País de Origen:</label>
      <div class="col-sm-4">
          <select class="select2_group form-control" name="id_origin_country" required>
            @if (isset($package))
              <option value="{{ $package->id_origin_country ?? null }}">{{ $package->origin_countries['name'] ?? null }}</option>
              <option value="">---------------------</option>
            @else
              <option value="">Seleccione una Opción</option>
            @endif
            @if (isset($countries))
              @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name ?? '' }}</option>
              @endforeach
            @endif
          </select>
      </div>
      <label class="col-form-label col-sm-3 label-align " for="id_destination_country">País de Destino:</label>
      <div class="col-sm-3">
          <select class="select2_group form-control" name="id_destination_country" required>
            @if (isset($package))
              <option value="{{ $package->id_destination_country ?? null }}">{{ $package->destination_countries['name'] ?? null }}</option>
              <option value="">---------------------</option>
            @else
              <option value="">Seleccione una Opción</option>
            @endif
            @if (isset($countries))
              @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name ?? '' }}</option>
              @endforeach
            @endif
          </select>
      </div>
    </div>
    <div class="item form-group">
      <label class="col-form-label col-sm-1 label-align " for="id_delivery_company">Entregado por:</label>
      <div class="col-sm-4">
          <select class="select2_group form-control" name="id_delivery_company" required>
            @if (isset($package))
              <option value="{{ $package->id_delivery_company ?? null }}">{{ $package->delivery_companies['description'] ?? null }}</option>
              <option value="">---------------------</option>
            @else
              <option value="">Seleccione una Opción</option>
            @endif
            @if (isset($delivery_companies))
              @foreach ($delivery_companies as $delivery_company)
                <option value="{{ $delivery_company->id }}">{{ $delivery_company->description ?? '' }}</option>
              @endforeach
            @endif
          </select>
      </div>
      <label class="col-form-label col-sm-3 label-align " for="number_transport_guide">N° Guía Transporte:</label>
      <div class="col-sm-3">
        <input type="text" id="number_transport_guide" name="number_transport_guide"  class="form-control" value="{{ $package->number_transport_guide ?? null }}">
      </div>
    </div>

    <div class="item form-group">
      <label class="col-form-label col-sm-1 label-align " for="service_type">Tipo Servicio:</label>
      <div class="col-sm-4">
          <select class="select2_group form-control" name="service_type" required>
            @if (isset($package))
              <option value="{{ $package->service_type ?? null }}">{{ $package->service_type ?? null }}</option>
              <option value="">---------------------</option>
            @else
              <option value="">Seleccione una Opción</option>
            @endif
            <option value="Pre-Pagado">Pre-Pagado</option>
            <option value="Collected">Collected</option>
          </select>
      </div>
      <label class="col-form-label col-sm-3 label-align " for="instruction">Instrucciones:</label>
      <div class="col-sm-2">
          <select class="select2_group form-control" name="instruction" required>
            @if (isset($package))
              <option value="{{ $package->instruction ?? null }}">{{ $package->instruction ?? null }}</option>
              <option value="">---------------------</option>
            @else
              <option value="">Seleccione una Opción</option>
            @endif
            <option value="Aéreo">Aéreo</option>
            <option value="Marítimo">Marítimo</option>
            <option value="Terrestre">Terrestre</option>
            <option value="Marítimo Express">Marítimo Express</option>
          </select>
      </div>
      <div class="col-sm-2">
        <select class="select2_group form-control" name="instruction_type" required>
              @if (isset($package))
                <option value="{{ $package->instruction_type ?? null }}">{{ $package->instruction_type ?? null }}</option>
                <option value="">---------------------</option>
              @else
                <option value="">Seleccione una Opción</option>
              @endif
            <option value="Directo">Directo</option>
            <option value="Consolidado">Consolidado</option>
        </select>
      </div>
    </div>

    <div class="item form-group">
      <label class="col-form-label col-sm-2 label-align " for="description">Descrip/Coment:</label>
      <div class="col-sm-9">
        <input type="text" id="description" name="description" required="required" class="form-control" value="{{ $package->description ?? null }}">
      </div>
    </div>
    <br>
    <div class="form-group row">
      <div class="col-sm-2 offset-sm-1">
        <input type="checkbox" name="checks[]"  id="myCheck"  value="high_value" onclick="myFunction();" >  Alto Valor: 
      </div> 
      <div class="col-sm-2">
        <input type="checkbox" name="checks[]" id="dangerous_goods" value="dangerous_goods" data-parsley-mincheck="2" /> Merc. Peligrosa: 
      </div> 
      <div class="col-sm-2">
        <input type="checkbox" name="checks[]" id="sed" value="sed" data-parsley-mincheck="2" /> SED: 
      </div> 
      <div class="col-sm-2">
        <input type="checkbox" name="checks[]" id="document" value="document" data-parsley-mincheck="2" /> Documento: 
      </div> 
      <div class="col-sm-2">
        <input type="checkbox" name="checks[]" id="fragile" value="fragile" data-parsley-mincheck="2" /> Fragil: 
      </div> 
    </div>

    </div>
  </div>
</div>

@endsection

@section('validation')

<script>
    function searchIndex(){
      document.getElementById("formSearch").submit();
    }


    $(document).on('click','.delete',function(){
         
         let id_package = $(this).attr('data-id-package');
 
         $('#id_package_modal').val(id_package);
     });

  
   
    
</script>
@if(isset($shipping_type))
<script>
  if("{{$shipping_type}}" == 'Todos'){
    document.getElementById("myCheck").checked = "true";
  }
  if("{{$shipping_type}}" == 'Aéreo'){
    document.getElementById("Aereo").checked = "true";
  }
  if("{{$shipping_type}}" == 'Marítimo'){
    document.getElementById("Maritimo").checked = "true";
  }
  if("{{$shipping_type}}" == 'Marítimo Express'){
    document.getElementById("MaritimoExpress").checked = "true";
  }
  if("{{$shipping_type}}" == 'Terrestre'){
    document.getElementById("Terrestre").checked = "true";
  }
</script>
@else
<script>
  
  document.getElementById("myCheck").checked = "true";

</script>
@endif
@endsection
