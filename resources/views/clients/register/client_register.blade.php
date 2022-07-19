@extends('layouts.dashboard')

@section('content')
<div class="container mt-5 " style="">
    <div class="row d-flex justify-content-center align-items-center ">
        <div class="col-md-12">
            <form id="regForm" method="POST" action="{{ route('clients.store') }}" enctype="multipart/form-data">
                @csrf
                <br>
                <h1 id="register" style="color: black;">Registro de Cliente</h1>
                <div class="all-steps" id="all-steps"> 
                    <span class="step"><h6>Datos Generales   <br> <i class="fa fa-user"></i></h6></span> 
                    <span class="step"><h6>Dirección Completa <br> <i class="bi bi-geo-alt"></i></h6></span>
                    <span class="step"><h6>Dirección De Recepción <br> <i class="bi bi-building"></i></h6></span> 
                    <span class="step"><h6>Teléfonos<br><i class="bi bi-telephone"></i></h6></span> 
                    <span class="step"><h6>Adicional<br><i class="bi bi-patch-plus"></i></h6></span> 
                </div>
                <div class="tab">
                    <div class="row" >
                        <div class="col-sm-6">
                            
                            <p> <input class="require"  placeholder="Email ..." oninput="this.className = ''" name="email"></p>
                        </div> 
                        <div class="col-sm-2">
                            <select class="form-select form-select-lg mb-3" id="type_cedula" name="type_cedula">
                                <option value="V-">V-</option>
                                <option value="E-">E-</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                           
                          <input id="cedula" name="cedula"  placeholder="Cedula ..." oninput="this.className = ''" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                          
                            <p> <input  placeholder="Contraseña ..." type="password" oninput="this.className = ''" name="password"></p>
                        </div>
                        <div class="col">
                          
                            <p> <input  placeholder="Confirmacion Contraseña ..." type="password" oninput="this.className = ''" name="confirm_password"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                           
                            <p> <input  placeholder="Primer Nombre ..." oninput="this.className = ''"  name="firstname"></p>
                        </div>
                        <div class="col">
                          
                            <p> <input placeholder="Segundo Nombre ..." oninput="this.className = ''"  name="secondname"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                           
                            <p> <input  placeholder="Primer Apellido ..." oninput="this.className = ''" name="firstlastname"></p>
                        </div>
                        <div class="col">
                           
                            <p> <input placeholder="Segundo Apellido ..." oninput="this.className = ''" name="secondlastname"></p>
                        </div>
                    </div>
                </div>
                <div class="tab">
                    <div class="row">
                        <div class="col">
                            <select class="form-select form-select-lg mb-3" id="id_country" name="id_country">
                                <option value="">Seleccione el Pais de Residencia</option>
                                @if (isset($countries))
                                    @foreach($countries as $var)
                                        <option value="{{ $var->id }}">{{ $var->name }}</option>
                                    @endforeach
                                @endif
                               
                            </select>
                        </div>
                        <div class="col">
                            <p> <input placeholder="Dirección ..." oninput="this.className = ''" name="direction"></p>
                        </div>
                    </div>
                </div>
                <div class="tab">
                    <div class="row">
                        <div class="col">
                            <select class="form-select form-select-lg mb-3" id="id_country_received" name="id_country_received">
                                <option value="">Pais donde recibirá</option>
                                @if (isset($countries))
                                    @foreach($countries as $var)
                                        <option value="{{ $var->id }}">{{ $var->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select form-select-lg mb-3" id="city"  name="City" required>
                                <option value="">Selecciona una Ciudad</option>
                               
                            </select> 
                        </div>
                    </div> 
                    <div class="row" >
                        <div class="col">
                            <p> <input  placeholder="Calle / Avenida ..." oninput="this.className = ''" name="street_received"></p>
                        </div>
                        <div class="col">
                            <p> <input  placeholder="Urbanización / Sector ..." oninput="this.className = ''" name="urbanization_received"></p>
                        </div>
                    </div>
                    <br>
                    <div class="row" >
                        <label class="col-sm-3 h5 " >
                            Recibir Envios en:
                          </label>
                        <div class="col-sm-3">
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
                            <select class="form-select form-select-lg mb-3" id="id_agency" name="id_agency">
                                <option value="">Seleccione una Agencia</option>
                                    @if (isset($agencies))
                                        @foreach($agencies as $var)
                                            <option value="{{ $var->id }}">{{ $var->cities->countries['abbreviation'] ?? '' }} - {{ $var->name }}</option>
                                        @endforeach
                                    @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="tab">
                    <div class="row" >
                        <input class="form-group col-sm-1 offset-sm-3"  id="code_phone_room" name="code_phone_room" readonly>
                        <div class="col-sm-2">
                            <select class="form-select form-select-lg mb-3" id="id_code_room" name="id_code_room">
                                
                            </select>
                        </div>
                        <input class="form-group col-sm-3 "  id="phone_room"  name="phone_room" placeholder="Habitación * ..." >
                    </div>
                    <div class="row" >
                        <input class="form-group col-sm-1 offset-sm-3"  id="code_phone_work" name="code_phone_work" readonly>
                        <div class="col-sm-2">
                            <select class="form-select form-select-lg mb-3" id="id_code_work" name="id_code_work">
                                
                            </select>
                        </div>
                        <input class="form-group col-sm-3 "  id="phone_work"  name="phone_work" placeholder="work ..." >
                    </div>
                    <div class="row" >
                        <input class="form-group col-sm-1 offset-sm-3"  id="code_phone_mobile" name="code_phone_mobile" readonly>
                        <div class="col-sm-2">
                            <select class="form-select form-select-lg mb-3" id="id_code_mobile" name="id_code_mobile">
                                
                            </select>
                        </div>
                        <input class="form-group col-sm-3 "  id="phone_mobile"  name="phone_mobile" placeholder="mobile ..." >
                    </div>
                    <div class="row" >
                        <input class="form-group col-sm-1 offset-sm-3"  id="code_phone_fax" name="code_phone_fax" readonly>
                        <div class="col-sm-2">
                            <select class="form-select form-select-lg mb-3" id="id_code_fax" name="id_code_fax">
                                
                            </select>
                        </div>
                        <input class="form-group col-sm-3 "  id="phone_fax"  name="phone_fax" placeholder="Fax ..." >
                    </div>
                </div>
                <div class="tab">
                    <div class="row" >
                        <div class="col">
                            <p> <input  placeholder="Compañia ..." name="company"></p>
                        </div>
                        <div class="col">
                            <p> <input  placeholder="Rif ..." oninput="this.className = ''" name="rif"></p>
                        </div>
                    </div>
                </div>
              
                <div class="thanks-message text-center" id="text-message"> 
                    <img src="https://i.imgur.com/O18mJ1K.png" width="100" class="mb-4">
                    <h3>Gracias por ser parte de nuestro Equipo!</h3> <span>Para terminar su registro presione "enviar"</span>
                    <br><br>
                    <div class="col-sm-4  offset-sm-4">
                        <button type="submit" onclick="sendForm();" class="btn btn-primary ">
                           Enviar
                        </button>
                    </div>
                </div>
                <div style="overflow:auto;" id="nextprevious">
                    <div style="float:right;"> <button type="button" id="prevBtn" onclick="nextPrev(-1)"><i class="fa fa-angle-double-left"></i></button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)"><i class="fa fa-angle-double-right"></i></button> </div>
                </div>
            </form>
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
            $("#city").val("");
            getCities(country_id);
        });
        function getCities(country_id){
            
            $.ajax({
                url:"{{ route('cities.list','') }}" + '/' + country_id,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                   
                    let city = $("#city");
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