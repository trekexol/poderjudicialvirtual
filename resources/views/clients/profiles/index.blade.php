@extends('clients.layouts.dashboard')

@section('content')

{{-- VALIDACIONES-RESPUESTA--}}
@include('clients.layouts.success')   {{-- SAVE --}}
@include('clients.layouts.danger')    {{-- EDITAR --}}
@include('clients.layouts.delete')    {{-- DELELTE --}}

{{-- VALIDACIONES-RESPUESTA --}}
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="item form-group">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
          <div class="x_title">
            <h2>Perfil</h2>
            <ul class="col-sm-1 nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form method="POST" enctype="multipart/form-data" action="{{ route('profiles.store') }}" id="form"  data-parsley-validate class="form-horizontal form-label-left">
              @csrf 
                         
              <input type="hidden" id="id_client" name="id_client" value="{{Auth::user()->id_client}}">
              
                <div class="item form-group">
                    <label class="col-form-label col-sm-1 label-align " for="dimension">Email:</label>
                    <div class="col-sm-4">
                        <input id="email" name="email"  class="date-picker form-control"  type="text" required="required" value="{{ Auth::user()->email ?? '' }}">
                    </div> 
                    <label class="col-form-label col-sm-2 label-align " for="dimension">Cédula:</label>
                    <div class="col-sm-1">
                        <select class="select2_group form-control" id="type_cedula" name="type_cedula">
                          @if (isset($profile))
                            <option value="{{$profile->type_cedula}}">{{$profile->type_cedula}}</option>
                          @endif
                            <option value="V-">V-</option>
                            <option value="E-">E-</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                      <input id="cedula" name="cedula"  class="date-picker form-control"  type="text" required="required" value="{{ $profile->cedula ?? '' }}">
                    </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-sm-1 label-align " for="dimension">Contraseña:</label>
                  <div class="col-sm-4">
                      <input id="password" name="password" onblur="confirmPassword();" class="date-picker form-control"  type="text" >
                  </div> 
                  <label class="col-form-label col-sm-2 label-align " for="dimension">Confirmacion Contraseña:</label>
                  <div class="col-sm-4">
                    <input id="confirm_password" onblur="confirmPassword();" name="confirm_password"  class="date-picker form-control"  type="text" >
                  </div> 
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-sm-1 label-align " for="dimension">Primer Nombre:</label>
                  <div class="col-sm-4">
                      <input id="firstname" name="firstname"  class="date-picker form-control"  type="text" required="required" value="{{ $profile->firstname ?? '' }}">
                  </div> 
                  <label class="col-form-label col-sm-2 label-align " for="dimension">Segundo Nombre:</label>
                  <div class="col-sm-4">
                    <input id="secondname" name="secondname"  class="date-picker form-control"  type="text" value="{{ $profile->secondname ?? '' }}">
                  </div> 
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-sm-1 label-align " for="dimension">Primer Apellido:</label>
                  <div class="col-sm-4">
                      <input id="firstlastname" name="firstlastname"  class="date-picker form-control"  type="text" required="required" value="{{ $profile->firstlastname ?? '' }}">
                  </div> 
                  <label class="col-form-label col-sm-2 label-align " for="dimension">Segundo Apellido:</label>
                  <div class="col-sm-4">
                    <input id="secondlastname" name="secondlastname"  class="date-picker form-control"  type="text" value="{{ $profile->secondlastname ?? '' }}">
                  </div> 
                </div>
              
                <div class="item form-group">
                  <label class="col-form-label col-sm-1 label-align " for="dimension">Pais de Residencia:</label>
                  <div class="col-sm-4">
                      <select class="select2_group form-control" id="id_country" name="id_country">
                        @if (isset($profile))
                          <option value="{{ $profile->id_country }}">{{ $profile->countries['name'] ?? '' }}</option>
                        @endif
                        <option disabled>-------------</option>
                        @if (isset($countries))
                            @foreach($countries as $var)
                                <option value="{{ $var->id }}">{{ $var->name }}</option>
                            @endforeach
                        @endif
                      </select>
                  </div>
                  <label class="col-form-label col-sm-2 label-align " for="dimension">Dirección:</label>
                  <div class="col-sm-4">
                      <input id="direction" name="direction"  class="date-picker form-control"  type="text" required="required" value="{{ $profile->direction ?? '' }}">
                  </div> 
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-sm-1 label-align " for="dimension">Pais donde recibirá:</label>
                  <div class="col-sm-4">
                      <select class="select2_group form-control" id="id_country_received" name="id_country_received">
                        @if (isset($profile))
                          <option value="{{ $profile->id_state_received }}">{{ $profile->states->countries['name'] ?? '' }}</option>
                        @endif
                        <option disabled>-------------</option>
                        @if (isset($countries))
                            @foreach($countries as $var)
                                <option value="{{ $var->id }}">{{ $var->name }}</option>
                            @endforeach
                        @endif
                      </select>
                  </div>
                  <label class="col-form-label col-sm-2 label-align " for="dimension">Estado donde recibirá:</label>
                  <div class="col-sm-4">
                    <select class="select2_group form-control" id="id_state_received" name="City">
                      @if (isset($profile))
                        <option value="{{ $profile->id_state_received }}">{{ $profile->states['name'] ?? '' }}</option>
                      @endif
                      <option disabled>-------------</option>
                      @if (isset($countries))
                          @foreach($states as $var)
                              <option value="{{ $var->id }}">{{ $var->name }}</option>
                          @endforeach
                      @endif
                    </select>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-sm-1 label-align " for="dimension">Calle / Avenida:</label>
                  <div class="col-sm-4">
                      <input id="street_received" name="street_received"  class="date-picker form-control"  type="text" required="required" value="{{ $profile->street_received ?? '' }}">
                  </div> 
                  <label class="col-form-label col-sm-2 label-align " for="dimension">Urbanización / Sector:</label>
                  <div class="col-sm-4">
                    <input id="urbanization_received" name="urbanization_received"  class="date-picker form-control"  type="text" value="{{ $profile->urbanization_received ?? '' }}">
                  </div> 
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-sm-1 label-align " for="dimension">Compañia:</label>
                  <div class="col-sm-4">
                      <input  id="company" name="company"  class="date-picker form-control"  type="text" value="{{ $profile->company ?? '' }}">
                  </div>
                  <label class="col-form-label col-sm-2 label-align " for="dimension">Rif:</label>
                  <div class="col-sm-4">
                      <input  id="rif" name="rif"  class="date-picker form-control"  type="text" value="{{ $profile->rif ?? '' }}">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-sm-1 label-align " for="dimension">  Recibir Envios en:</label>
                  <div class="col-sm-3 offset-sm-1">
                    <input class="form-check-input" type="radio" onclick="hideAgency();" value="This Direction" name="type_direction_received" id="flexRadioDefault1" checked>
                    <label class="form-check-label h5" for="flexRadioDefault1">
                        En ésta dirección 
                      </label>
                  </div>
                  <div class="col-sm-2">
                      <input class="form-check-input" onclick="showAgency();" type="radio" value="Agency Direction" name="type_direction_received" id="flexRadioDefault2">
                      <label class="form-check-label h5" for="flexRadioDefault2">
                          Retirar en Agencia
                        </label>
                  </div>
                 
                  <div class="col-sm-4">
                    <select class="select2_group form-control" id="id_agency" name="id_agency">
                      @if (isset($profile))
                        <option value="{{ $profile->id_agency }}">{{ $profile->states->countries['name'] ?? '' }} - {{ $profile->agencies['name'] ?? '' }}</option>
                      @endif
                      <option disabled>-------------</option>
                        @if (isset($agencies))
                            @foreach($agencies as $var)
                                <option value="{{ $var->id }}">{{ $var->states->countries['name'] ?? '' }} - {{ $var->name }}</option>
                            @endforeach
                        @endif
                    </select>
                  </div>
                </div>

                <br>
                <div class="item form-group">
                  <label class="col-form-label col-sm-1 label-align " for="dimension">Teléfonos:</label>
                </div>
                <div class="item form-group">
                    <div class="col-sm-2 offset-sm-1">
                      <input class="date-picker form-control"  id="code_phone_room" name="code_phone_room" readonly value="{{ $profile->countries['code_phone'] ?? '' }}">
                    </div>
                    <div class="col-sm-2">
                        <select class="select2_group form-control" id="id_code_room" name="id_code_room">
                          @if (isset($profile))
                            <option value="{{ $profile->making_code_rooms['id'] ?? '' }}">{{ $profile->making_code_rooms['code'] ?? '' }}</option>
                            <option disabled>-------------</option>
                            @if (isset($making_codes))
                                @foreach($making_codes as $var)
                                    <option value="{{ $var->id }}">{{ $var->code }}</option>
                                @endforeach
                            @endif
                          @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                      <input class="date-picker form-control"  id="phone_room"  name="phone_room" placeholder="Habitación * ..." value="{{ $profile->phone_room ?? '' }}">
                    </div>
                </div>
                <div class="item form-group">
                    <div class="col-sm-2 offset-sm-1">
                      <input class="date-picker form-control"  id="code_phone_work" name="code_phone_work" readonly value="{{ $profile->countries['code_phone'] ?? '' }}">
                    </div>
                    <div class="col-sm-2">
                        <select class="select2_group form-control" id="id_code_work" name="id_code_work">
                          @if (isset($profile))
                            <option value="{{ $profile->making_code_works['id'] ?? '' }}">{{ $profile->making_code_works['code'] ?? '' }}</option>
                            <option disabled>-------------</option>
                            @if (isset($making_codes))
                                @foreach($making_codes as $var)
                                    <option value="{{ $var->id }}">{{ $var->code }}</option>
                                @endforeach
                            @endif
                          @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                      <input class="date-picker form-control"  id="phone_work"  name="phone_work" placeholder="work ..." value="{{ $profile->phone_work ?? '' }}">
                    </div>
                </div>
                <div class="item form-group">
                    <div class="col-sm-2 offset-sm-1">
                      <input class="date-picker form-control"  id="code_phone_mobile" name="code_phone_mobile" readonly value="{{ $profile->countries['code_phone'] ?? '' }}">
                    </div>
                    <div class="col-sm-2">
                        <select class="select2_group form-control" id="id_code_mobile" name="id_code_mobile">
                          @if (isset($profile))
                            <option value="{{ $profile->making_code_mobiles['id'] ?? '' }}">{{ $profile->making_code_mobiles['code'] ?? '' }}</option>
                            <option disabled>-------------</option>
                            @if (isset($making_codes))
                                @foreach($making_codes as $var)
                                    <option value="{{ $var->id }}">{{ $var->code }}</option>
                                @endforeach
                            @endif
                          @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                      <input class="date-picker form-control"  id="phone_mobile"  name="phone_mobile" placeholder="mobile ..." value="{{ $profile->phone_mobile ?? '' }}">
                    </div>
                </div>
                <div class="item form-group">
                    <div class="col-sm-2 offset-sm-1">
                      <input class="date-picker form-control"  id="code_phone_fax" name="code_phone_fax" readonly value="{{ $profile->countries['code_phone'] ?? '' }}">
                    </div>
                    <div class="col-sm-2">
                        <select class="select2_group form-control" id="id_code_fax" name="id_code_fax">
                          @if (isset($profile))
                            <option value="{{ $profile->making_code_fax['id'] ?? '' }}">{{ $profile->making_code_fax['code'] ?? '' }}</option>
                            <option disabled>-------------</option>
                            @if (isset($making_codes))
                                @foreach($making_codes as $var)
                                    <option value="{{ $var->id }}">{{ $var->code }}</option>
                                @endforeach
                            @endif
                          @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                      <input class="date-picker form-control"  id="phone_fax"  name="phone_fax" placeholder="Fax ..." value="{{ $profile->phone_fax ?? '' }}">
                    </div>
                </div>
              
           
          
              <br>
              <br>
              <div class="form-row">
                <div class="col-sm-3 offset-sm-2">
                  <button type="submit" class="btn btn-primary" onclick="validatePassword();" id="Btnprofile">Actualizar</button>
                </div>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>

@endsection


@section('javascript')
    <script>
        $(document).ready(function () {
            $("#cedula").mask('000.000.000.000.000', { reverse: true });
        
        });      

        hideAgency();
        validateTypeDirectionReceived();


        function confirmPassword(){
            var pass = document.getElementById('password').value;
            var confirm_pass = document.getElementById('confirm_password').value;
            $("#Btnprofile").hide();
            if(confirm_pass != ""){
                if(pass != confirm_pass){
                    
                    document.getElementById('password').style.borderColor = 'red';
                    document.getElementById('confirm_password').style.borderColor = 'red';
                    $("#Btnprofile").hide();
                }else{
                    document.getElementById('password').style.borderColor = 'green';
                    document.getElementById('confirm_password').style.borderColor = 'green';
                    $("#Btnprofile").show();
                }
            }
            
        }

       function validateTypeDirectionReceived(){

        if("{{$profile->type_direction_received}}" == "Agency Direction"){
          document.getElementById("flexRadioDefault2").checked = true;
          showAgency();
        }
       }
     
        function showAgency(){
            $("#id_agency").show();
        }
        function hideAgency(){
            $("#id_agency").hide();
        }
        function sendForm(){
            document.getElementById("regForm").submit();
        }
        $("#id_country_received").on('change',function(){
          
            var country_id = $(this).val();
            $("#id_state_received").val("");
            
            getCities(country_id);
        });
        function getCities(country_id){
            
            $.ajax({
                url:"{{ route('cities.list','') }}" + '/' + country_id,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                   
                    let city = $("#id_state_received");
                    let htmlOptions = `<option value='' >Seleccione Ciudad..</option>`;
                    // console.clear();
                    if(response.length > 0){
                        response.forEach((item, index, object)=>{
                            let {id,name} = item;
                            htmlOptions += `<option value='${id}' {{ old('City') == '${id}' ? 'selected' : '' }}>${name}</option>`
                        });
                    }
                    //console.clear();
                    // console.log(htmlOptions);
                   city.html('');
                   city.html(htmlOptions);
                
                    
                
                },
                error:(xhr)=>{
                    alert('hubo un error');
                }
            })
        }
        
        $("#id_country").on('change',function(){
           
            var country_id = $(this).val();
            $("#code_phone").val("");
          
            
            getCodePhone(country_id);
            getMakingCodes(country_id);
        });
        
        function getCodePhone(country_id){
            
            $.ajax({
                url:"{{ route('countries.listCodePhone','') }}" + '/' + country_id,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                   
                    if(response.length > 0){
                        response.forEach((item, index, object)=>{
                            let {id,name,code_phone} = item;
                            document.getElementById('code_phone_room').value = code_phone;
                            document.getElementById('code_phone_work').value = code_phone;
                            document.getElementById('code_phone_mobile').value = code_phone;
                            document.getElementById('code_phone_fax').value = code_phone;
                        });
                    }
                   
                },
                error:(xhr)=>{
                    alert('No se encontro el Codigo de Telefono');
                }
            })
        }
        function getMakingCodes(country_id){
            
            $.ajax({
                url:"{{ route('countries.listMakingCodes','') }}" + '/' + country_id,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                   
                    let code_room = $("#id_code_room");
                    let htmlOptions = `<option value='' >Codigo</option>`;
                    let code_work = $("#id_code_work");
                    let htmlOptions2 = `<option value='' >Codigo</option>`;
                    let code_mobile = $("#id_code_mobile");
                    let htmlOptions3 = `<option value='' >Codigo</option>`;
                    
                    let code_fax = $("#id_code_fax");
                    let htmlOptions4 = `<option value='' >Codigo</option>`;
                    
                    if(response.length > 0){
                        response.forEach((item, index, object)=>{
                            let {id,code} = item;
                            htmlOptions += `<option value='${id}' {{ old('id_code_room') == '${code}' ? 'selected' : '' }}>${code}</option>`
                            htmlOptions2 += `<option value='${id}' {{ old('id_code_work') == '${code}' ? 'selected' : '' }}>${code}</option>`
                            htmlOptions3 += `<option value='${id}' {{ old('id_code_mobile') == '${code}' ? 'selected' : '' }}>${code}</option>`
                            htmlOptions4 += `<option value='${id}' {{ old('id_code_fax') == '${code}' ? 'selected' : '' }}>${code}</option>`
                        });
                    }
                   
                   code_room.html('');
                   code_room.html(htmlOptions);
                   code_work.html('');
                   code_work.html(htmlOptions2);
                   code_mobile.html('');
                   code_mobile.html(htmlOptions3);
                   code_fax.html('');
                   code_fax.html(htmlOptions4);
                
                    
                
                },
                error:(xhr)=>{
                    alert('Presentamos inconvenientes al consultar los datos');
                }
            })
        }

       
    </script>
@endsection