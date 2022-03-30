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
            <h2>Ingresar Paquetes</h2>
            <ul class="col-sm-1 nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form method="POST" enctype="multipart/form-data" action="{{ route('packages.store') }}" id="form" data-parsley-validate class="form-horizontal form-label-left">
              @csrf 
              
              <input type="hidden" id="id_client" name="id_client" value="{{ $client->id ?? null }}" >
                
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="tracking">Tracking </label>
                <div class="col-sm-4">
                  <input type="text" id="tracking" name="tracking" required="required" class="form-control ">
                </div>
                <label class="col-form-label col-sm-3 label-align " for="id_agent_shipper">Shipper: </label>
                <div class="col-sm-3">
                  <select class="select2_group form-control" name="id_agent_shipper">
                      <option value="">Seleccione una Opción</option>
                      @foreach ($agents as $agent)
                        <option value="{{ $agent->id }}">{{ $agent->name ?? '' }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="id_client">Cliente</label>
                <div class="col-sm-4">
                  <input type="text" id="client" name="client" required="required" class="form-control ">
                </div>
                <div class="form-group col-md-1">
                  <a href="#" title="Seleccionar Cliente"><i class="fa fa-search"></i></a> 
              </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="first-name">Agente Vendedor:</label>
                <div class="col-sm-4">
                    <select class="select2_group form-control" name="id_agent_vendor" required>
                      <option value="">Seleccione una Opción</option>
                      @foreach ($agents as $agent)
                        <option value="{{ $agent->id }}">{{ $agent->name ?? '' }}</option>
                      @endforeach
                    </select>
                </div>
                <label class="col-form-label col-sm-3 label-align " for="first-name">Vendedor Externo:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control">
                      
                    </select>
                </div>
              </div>
           
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align">Fecha Llegada:
                </label>
                <div class="col-sm-4">
                  <input id="arrival_date" name="arrival_date" class="date-picker form-control"  required="required" type="date" >
                  
                </div>
                <label class="col-form-label col-sm-3 label-align">Hora Llegada:
                </label>
                <div class="col-sm-3 ">
                  <input id="check_in" name="check_in" class="date-picker form-control"  type="time" required="required" >
                 
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="first-name">Ubicación Oficina:</label>
                <div class="col-sm-4">
                    <select class="select2_group form-control" name="id_agent_office_location">
                      <option value="">Seleccione una Opción</option>
                      @foreach ($agents as $agent)
                        <option value="{{ $agent->id }}">{{ $agent->name ?? '' }}</option>
                      @endforeach
                    </select>
                </div>
                <label class="col-form-label col-sm-3 label-align " for="id_wharehouse">Almacen:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control" name="id_wharehouse">
                      <option value="">Seleccione una Opción</option>
                      @foreach ($wharehouses as $wharehouse)
                        <option value="{{ $wharehouse->id }}">{{ $wharehouse->name ?? '' }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="content">Contenido:</label>
                <div class="col-sm-4">
                  <input type="text" id="content" name="content" required="required" class="form-control ">
                </div>
                <label class="col-form-label col-sm-3 label-align " for="value">Valor:</label>
                <div class="col-sm-3">
                  <input type="text" id="value" name="value" required="required" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="id_origin_country">País de Origen:</label>
                <div class="col-sm-4">
                    <select class="select2_group form-control" name="id_origin_country">
                      <option value="">Seleccione una Opción</option>
                      @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name ?? '' }}</option>
                      @endforeach
                    </select>
                </div>
                <label class="col-form-label col-sm-3 label-align " for="id_destination_country">País de Destino:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control" name="id_destination_country">
                      <option value="">Seleccione una Opción</option>
                      @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name ?? '' }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="id_delivery_company">Entregado por:</label>
                <div class="col-sm-4">
                    <select class="select2_group form-control" name="id_delivery_company">
                      <option value="">Seleccione una Opción</option>
                      @foreach ($delivery_companies as $delivery_company)
                        <option value="{{ $delivery_company->id }}">{{ $delivery_company->description ?? '' }}</option>
                      @endforeach
                    </select>
                </div>
                <label class="col-form-label col-sm-3 label-align " for="number_transport_guide">N° Guía Transporte:</label>
                <div class="col-sm-3">
                  <input type="text" id="number_transport_guide" name="number_transport_guide" required="required" class="form-control">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="service_type">Tipo Servicio:</label>
                <div class="col-sm-4">
                    <select class="select2_group form-control" name="service_type" required>
                      <option value="">Seleccione una Opción</option>
                      <option value="Pre-Pagado">Pre-Pagado</option>
                      <option value="Collected">Collected</option>
                    </select>
                </div>
                <label class="col-form-label col-sm-3 label-align " for="instruction">Instrucciones:</label>
                <div class="col-sm-2">
                    <select class="select2_group form-control" name="instruction" required>
                      <option value="">Seleccione</option>
                      <option value="Aéreo">Aéreo</option>
                      <option value="Marítimo">Marítimo</option>
                      <option value="Terrestre">Terrestre</option>
                      <option value="Marítimo Express">Marítimo Express</option>
                    </select>
                </div>
                <div class="col-sm-2">
                  <select class="select2_group form-control" name="instruction_type" required>
                     <option value="">Seleccione</option>
                      <option value="Directo">Directo</option>
                      <option value="Consolidado">Consolidado</option>
                  </select>
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-sm-2 label-align " for="description">Descrip/Coment:</label>
                <div class="col-sm-9">
                  <input type="text" id="description" name="description" required="required" class="form-control">
                </div>
              </div>
              <br>
              <div class="form-group row">
                <div class="col-sm-2 offset-sm-1">
                  <input type="checkbox" name="checks[]" id="check1" value="high_value" data-parsley-mincheck="2"  class="flat" /> Alto Valor: 
                </div> 
                <div class="col-sm-2">
                  <input type="checkbox" name="checks[]" id="check2" value="dangerous_goods" data-parsley-mincheck="2" class="flat" /> Merc. Peligrosa: 
                </div> 
                <div class="col-sm-2">
                  <input type="checkbox" name="checks[]" id="check3" value="sed" data-parsley-mincheck="2" class="flat" /> SED: 
                </div> 
                <div class="col-sm-2">
                  <input type="checkbox" name="checks[]" id="check4" value="document" data-parsley-mincheck="2" class="flat" /> Documento: 
                </div> 
                <div class="col-sm-2">
                  <input type="checkbox" name="checks[]" id="check5" value="fragile" data-parsley-mincheck="2" class="flat" /> Fragil: 
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
            <h2>Tipo de mercancia</h2>
            <ul class="col-sm-1 nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
           
              <!--FORMULARIO TIPO DE MERCANCIA-->
              <div id="type_of_goods_form" class="inputs">
               
                <div class="item form-group">
                  <div class="col-sm-3">
                      <select class="select2_group form-control " name="service_type_type_of_good">
                        <option value="">Seleccione ...</option>
                        @foreach ($type_of_goods as $type_of_good)
                          <option value="{{ $type_of_good->id }}">{{ $type_of_good->description ?? '' }}</option>
                        @endforeach
                      </select>
                  </div>
                  
                  <div class="col-sm-1">
                    <input type="text" id="unit_type_of_good" name="unit_type_of_good" placeholder="Unid." class="form-control">
                  </div>
                  <div class="col-sm-2">
                    <input type="text" id="description_type_of_good" name="description_type_of_good"  placeholder="Descripción." class="form-control">
                  </div>
                  <div class="col-sm-2">
                    <input type="text" id="value_type_of_good" name="value_type_of_good" placeholder="Valor." class="form-control">
                  </div>
                  <div class="col-sm-2">
                    <input type="text" id="tariff_type_of_good" name="tariff_type_of_good" placeholder="Arancel." class="form-control">
                  </div>
                  <div class="col-sm-1">
                    <input type="text" id="charge_type_of_good" name="charge_type_of_good" placeholder="Cargo." class="form-control">
                  </div>
                  <button type="button" onclick="AgregarCampos();" class="btn btn-round btn-info fa fa-plus"></button>
                </div>
              </div>

              <div class="ln_solid" name="end_type_of_goods_form"></div>
              <!-- FIN DE FORMULARIO-->
              <div id="campos"></div>
              </form>
            
      </div>
    </div>
  </div>
</div>

   <div class="clearfix"></div>
  <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Bultos</h2>
            <ul class="col-sm-1 nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
              <!--FORMULARIO TIPO DE MERCANCIA-->
              <div id="type_of_packagings_form" class="inputs_type_of_packaging">
               
                <div class="item form-group">

                <form method="POST" action="{{ route('countries.store') }}" id="form_contacto" data-parsley-validate class="form-horizontal form-label-left">
                  @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Contacto</label>
                                <input type="text" class="form-control" name="nombre_contacto">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Número</label>
                                <input type="text" class="form-control" name="numero">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" id="agregar">Agregar campo +</button>
                            </div>
                        </div>
                        <div class="form-row clonar">
                            <div class="form-group col-md-12">
                                <label for="">Nombres</label>
                                <input type="text" class="form-control" name="nombres[]">
                                <span class="badge badge-pill badge-danger puntero ocultar">Eliminar</span>
                            </div>
                        </div>
                        <div id="contenedor"></div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <button class="btn btn-primary" id="enviar_contacto">Enviar</button>
                            </div>
                        </div>

                    </form>
                </div>
              </div>

            

              
          </div>
    </div>
  </div>
</div>




@endsection


@section('validation')

 <script>
    
        let agregar = document.getElementById('agregar');
        let contenido = document.getElementById('contenedor');

        let boton_enviar = document.querySelector('#enviar_contacto')

        agregar.addEventListener('click', e =>{
            e.preventDefault();
            let clonado = document.querySelector('.clonar');
            let clon = clonado.cloneNode(true);

            contenido.appendChild(clon).classList.remove('clonar');

            let remover_ocutar = contenido.lastChild.childNodes[1].querySelectorAll('span');
            remover_ocutar[0].classList.remove('ocultar');
        });

        contenido.addEventListener('click', e =>{
            e.preventDefault();
            if(e.target.classList.contains('puntero')){
                let contenedor  = e.target.parentNode.parentNode;
            
                contenedor.parentNode.removeChild(contenedor);
            }
        });


        boton_enviar.addEventListener('click', e => {
            e.preventDefault();

            const formulario = document.querySelector('#form_contacto');
            const form = new FormData(formulario);

            const peticion = {
                body:form,
                method:'POST'
            };
          
          document.getElementById("form_contacto").submit();

        });


    </script>
<script type="text/javascript">
    var nextinput = 0;
   // Create a form synamically
    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "{{ route('packages.store') }}");

    function AgregarCampos(){
    nextinput++;
    campo_inicial = '<div class="item form-group">'+'<div class="col-sm-1"><input type="text" id="unit_type_of_good'+nextinput+'" name="unit_type_of_good'+nextinput+'" placeholder="Unid." class="form-control"></div>'+' <div class="col-sm-2"><input type="text" id="description_type_of_good'+nextinput+'" name="description_type_of_good'+nextinput+'"  placeholder="Descripción." class="form-control"></div>';
    +'</div><div class="ln_solid" name="end_type_of_goods_form"></div>';

    $("#campos").append(campo_inicial).html();
    $("#campos").append(form);

    var s = document.createElement("input");
    s.setAttribute("type", "submit");
    s.setAttribute("value", "Submit");

    $("#campos").append(s);
    
      
    // Append the full name input to the form
    form.appendChild(campo_inicial); 
    form.appendChild(s); 
    document.getElementsByTagName("body")[0]
               .appendChild(form);

}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>


<script>
    
      let nuevo = function() {
      $("<section/>").insertBefore("[name='end_type_of_goods_form']")
                    .append($(".inputs").html())
                    .find("button")
                    .attr("onclick", "eliminar(this)")
                    .removeClass("btn-info")
                    .addClass("btn-danger")
                    .removeClass("fa-plus")
                    .addClass("fa-minus");

      var group = $('input[name="unit_type_of_good"]');

    }

    let eliminar = function(obj) {
      $(obj).closest("section").remove();
    }

    let nuevo_packagings = function() {
      $("<section/>").insertBefore("[name='end_type_of_packagings_form']")
                    .append($(".inputs_type_of_packaging").html())
                    .find("button")
                    .attr("onclick", "eliminar_packagings(this)")
                    .removeClass("btn-info")
                    .addClass("btn-danger")
                    .removeClass("fa-plus")
                    .addClass("fa-minus")
    }

    let eliminar_packagings = function(obj) {
      $(obj).closest("section").remove();
    }
</script>
@endsection