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
                <a href="{{ route('packages.print',$package->id) }}"  title="Imprimir Etiquetas"><i class="fa fa-print"></i></a>
                <a href="{{ route('historial_status.viewPackage',$package->id) }}"  title="Ver Historial de Status"><i class="fa fa-question"></i></a>
                <a href="#" class="delete" data-id-package={{$package->id}} data-toggle="modal" data-target="#deleteModal" title="Eliminar"><i class="fa fa-trash text-danger"></i></a>  
                <a href="#"  data-id-package={{$package->id}} data-toggle="modal" data-target="#showModal" title="Mostrar"><i class="fa fa-search"></i></a>  
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
      <br>
      <div class="row">
      <div class="offset-sm-1 col-sm-6">
        <h6><strong>Identificación del paquete:</strong>  {{ str_pad($package->id ?? 0, 6, "0", STR_PAD_LEFT)}}</h6>
      </div>
      </div>
    @endisset
  
    <div class="row">
      <label class="col-form-label offset-sm-1 col-sm-11 label-align-left " style="font-size: x-small" for="id_client"><strong>Cliente:</strong> {{ $package->casillero ?? '' }} - {{ $package->firstname ?? '' }} {{ $package->secondname ?? '' }} {{ $package->firstlastname ?? '' }} {{ $package->secondlastname ?? '' }}</label>
    </div>
    <div class="row">
      <label class="col-form-label offset-sm-1 col-sm-11 label-align-left"  style="font-size: x-small" for="id_direccion"><strong>Dirección:</strong>  {{ $package->direction ?? '' }}, {{ $package->street_received ?? '' }}, {{ $package->urbanization_received ?? '' }} </label>
    </div>
    <div class="row">
      <label class="col-form-label offset-sm-1 col-sm-11 label-align-left"  style="font-size: x-small" for="id_direccion"><strong>Agencia:</strong>  {{ $package->name_agency_client ?? 'Recibe en su Dirección' }}</label>
    </div>
    <div class="row">
      <label class="col-form-label offset-sm-1 col-sm-11 label-align-left" style="font-size: x-small" for="first-name"><strong>Agente Vendedor:</strong> {{ $package->agent_name ?? '' }}</label>
    </div>
    <div class="row">
      <label class="col-form-label offset-sm-1 col-sm-11 label-align-left" style="font-size: x-small" for="first-name"><strong>Vendedor:</strong> {{ $package->agent_shipper_name ?? '' }}</label>
    </div>
    <div class="row">
      <label class="col-form-label offset-sm-1 col-sm-6 label-align-left" style="font-size: x-small"> <strong>Fecha Llegada:</strong> {{ date_format(date_create($package->arrival_date ?? $datenow ??null),"Y-m-d") }}</label>
      <label class="col-form-label col-sm-5 label-align-left" style="font-size: x-small"> <strong>Hora Llegada:</strong> {{ date_format(date_create($package->arrival_date ?? $datenow  ?? null),"H:i") }}</label>
    </div>
    <div class="row">
      <label class="col-form-label offset-sm-1 col-sm-6 label-align-left " style="font-size: x-small" for="first-name"><strong>Ubicación Oficina:</strong> {{ $package->agency_name ?? ''}}</label>
      <label class="col-form-label col-sm-5 label-align-left " style="font-size: x-small" for="id_wharehouse"><strong>Almacen:</strong> {{ $package->wharehouse_name ?? '' }}</label>
    </div>
    <div class="row">
      <label class="col-form-label offset-sm-1 col-sm-6 label-align-left " style="font-size: x-small" for="content"><strong>Contenido:</strong> {{$package->content ?? ''}}</label>
      <label class="col-form-label col-sm-5 label-align-left " style="font-size: x-small" for="value"><strong>Valor:</strong> {{ number_format($package->value ?? 0, 2, ',', '.') }}</label>
    </div>
    <div class="row">
      <label class="col-form-label offset-sm-1 col-sm-6 label-align-left " style="font-size: x-small" for="id_origin_country"><strong>Origen:</strong> {{$package->country_name ?? ''}}</label>
      <label class="col-form-label col-sm-5 label-align-left " style="font-size: x-small" for="id_destination_country"><strong>Destino:</strong> {{$package->destination_country_name ?? ''}}</label>
    </div>
    <div class="row"> 
      <label class="col-form-label offset-sm-1 col-sm-6 label-align-left " style="font-size: x-small" for="id_delivery_company"><strong>Tracking:</strong>{{$package->tracking ?? ''}}</label>
      <label class="col-form-label col-sm-5 label-align-left " style="font-size: x-small" for="id_delivery_company"><strong>Entregado por:</strong>{{$package->delivery_company_name ?? ''}}</label>
    </div>
    <div class="row"> 
      <label class="col-form-label offset-sm-1 col-sm-6 label-align-left " style="font-size: x-small" for="service_type"><strong>Tipo Servicio:</strong> {{$package->service_type ?? ''}}</label>
      <label class="col-form-label col-sm-5 label-align-left " style="font-size: x-small" for="instruction"><strong>Instrucciones:</strong> {{ $package->instruction ?? '' }} - {{ $package->instruction_type ?? '' }}</label>
    </div>

    <div class="row">
      <label class="col-form-label offset-sm-1 col-sm-6 label-align-left " style="font-size: x-small" for="description"><strong>Descrip/Coment:</strong> {{$package->description ?? ''}}</label>
      <label class="col-form-label col-sm-5 label-align-left " style="font-size: x-small" for="description"><strong>Estado:</strong> {{$package->status ?? ''}}</label>
     
    </div>
    <br>
    <div class="form-group row">
      <div class="offset-sm-1 col-sm-2">
        @if ($package->dangerous_goods == true)
          <input type="checkbox" style="font-size: x-small" disabled value="dangerous_goods" checked data-parsley-mincheck="2" /> Merc. Peligrosa:
        @else
          <input type="checkbox" style="font-size: x-small" disabled value="dangerous_goods" data-parsley-mincheck="2" /> Merc. Peligrosa:
        @endif
      </div> 
      <div class="col-sm-1">
        @if ($package->sed == true)
          <input type="checkbox" style="font-size: x-small" disabled value="sed" checked data-parsley-mincheck="2" /> SED:
        @else
          <input type="checkbox" style="font-size: x-small" disabled value="sed" data-parsley-mincheck="2" /> SED:
        @endif
      </div> 
      <div class="col-sm-2">
        @if ($package->document == true)
          <input type="checkbox" style="font-size: x-small"disabled  value="document" checked data-parsley-mincheck="2" /> Documento:
        @else
          <input type="checkbox" style="font-size: x-small" disabled value="document" data-parsley-mincheck="2" /> Documento:
        @endif
      </div> 
      <div class="col-sm-2">
        @if ($package->fragile == true)
          <input type="checkbox" style="font-size: x-small" disabled value="fragile" checked data-parsley-mincheck="2" /> Fragil:
        @else
          <input type="checkbox" style="font-size: x-small" disabled value="fragile" data-parsley-mincheck="2" /> Fragil:
        @endif
      </div> 
      <label class="col-form-label col-sm-4 label-align-left " style="font-size: x-small" for="number_transport_guide"><strong>N° Guía Transporte:</strong> {{$package->number_transport_guide ?? ''}}</label>
    </div>
    <div class="row">
      <label class="col-form-label offset-sm-1 col-sm-2 label-align-left " style="font-size: x-small" ><strong>Peso inicial:</strong> {{$package->starting_weight ?? 0}}</label>
      <label class="col-form-label col-sm-2 label-align-left " style="font-size: x-small" ><strong>Peso Final:</strong> {{$package->final_weight ?? 0}}</label>
      <label class="col-form-label col-sm-2 label-align-left " style="font-size: x-small" ><strong>Volumen:</strong> {{$package->volume ?? 0}}</label>
      <label class="col-form-label col-sm-5 label-align-left " style="font-size: x-small" ><strong>Dimensiones:</strong> {{$package->length_weight ?? 0}} x {{$package->width_weight ?? 0}} x {{$package->high_weight ?? 0}}</label>
    </div>
    
    <div class="row">
      <label class="col-form-label offset-sm-1 col-sm-2 label-align-left " style="font-size: x-small" ><strong>Guía:</strong> {{$package->guide ?? ''}}</label>
      <label class="col-form-label col-sm-2 label-align-left " style="font-size: x-small" ><strong>Tula:</strong> {{$package->id_tula ?? ''}}</label>
      <label class="col-form-label col-sm-2 label-align-left " style="font-size: x-small" ><strong>Paleta:</strong> {{$package->id_paddle ?? ''}}</label>
      <label class="col-form-label col-sm-2 label-align-left " style="font-size: x-small" ><strong>Ruta:</strong> </label>
      <label class="col-form-label col-sm-2 label-align-left " style="font-size: x-small" ><strong>Consolidado:</strong> </label>
    </div>

    <div class="row">
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
