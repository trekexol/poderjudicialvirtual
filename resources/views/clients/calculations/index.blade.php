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
           
              
              <div class="item form-group">
                <label class="col-sm-5 offset-sm-1  h5" for="tracking">Cliente: {{Auth::user()->clients['firstname']}} {{Auth::user()->clients['firstlastname']}}</label>
                <label class="col-sm-5 offset-sm-1  h5" for="tracking">Casillero: {{Auth::user()->clients->countries['abbreviation'] ?? '' }}{{str_pad(Auth::user()->id_client ?? 0, 6, "0", STR_PAD_LEFT)}}</label>
            
              </div>
           
        
     
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="id_origin_country">País de Origen:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control" name="id_origin_country" required>
                      <option value="">Seleccione...</option>
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
                    
                      <option value="">Seleccione...</option>
                      @if (isset($countries))
                        @foreach ($countries as $country)
                          <option value="{{ $country->id }}">{{ $country->name ?? '' }}</option>
                        @endforeach
                      @endif
                    </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="instruction">Tipo de Envío:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control" name="instruction" required>
                      <option value="">Seleccione...</option>
                      <option value="Aéreo">Aéreo</option>
                      <option value="Marítimo">Marítimo</option>
                    </select>
                </div>
                <label class="col-form-label col-sm-3 label-align " for="instruction">Tipo de Mercancía:</label>
                <div class="col-sm-3">
                  <select class="select2_group form-control " name="type_of_good">
                    <option value="">Seleccione ...</option>
                    @foreach ($type_of_goods as $type_of_good)
                      <option value="{{ $type_of_good->id }}">{{ $type_of_good->description ?? '' }}</option>
                    @endforeach
                  </select>
                </div>
              </div>


              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="instruction">Peso del Paquete:</label>
                <div class="col-sm-3">
                  <input type="text" id="weight" name="weight" required="required" class="form-control" >
                </div>
                <label class="col-form-label col-sm-3 label-align " for="instruction">Valor del Paquete:</label>
                <div class="col-sm-3">
                  <input type="text" id="value" name="value" required="required" class="form-control" >
                </div>
              </div>
          
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="instruction">Dimesiones del paquete (pulg):</label>

                <label class="col-form-label col-sm-1 label-align " for="instruction">Alto:</label>
                <div class="col-sm-1">
                  <input type="text"  id="tall" name="tall" class="form-control" >
                </div>
                <label class="col-form-label col-sm-1 label-align " for="instruction">Ancho:</label>
                <div class="col-sm-1">
                  <input type="text"  id="width" name="width" class="form-control" >
                </div>
                <label class="col-form-label col-sm-1 label-align " for="instruction">Largo:</label>
                <div class="col-sm-1">
                  <input type="text" onblur="calculateVolume();" id="lenght"  name="lenght" class="form-control" >
                </div>
                <label class="col-form-label col-sm-1 label-align " for="instruction">Volumen:</label>
                <div class="col-sm-1">
                  <input type="text"  id="volume" name="volume" class="form-control" >
                </div>
                <label class="col-form-label col-sm-1 label-align " for="instruction">Pie Cúbico:</label>
                <div class="col-sm-1">
                  <input type="text"  id="cubic_foot" name="cubic_foot" class="form-control" >
                </div>
              </div>

              <br>
              <div class="form-row">
                  <div class="col-sm-3 offset-sm-4">
                    <button type="submit" class="btn btn-primary offset-sm-1" id="BtnPackage">Calcular</button>
                  </div>
              </div>
            </form>
            <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">Concepto</th>
                  <th class="text-center">Costo</th>
                </tr>
                <tr>
                  <td id="first" class="text-center"></td>
                  <td id="first2" class="text-center"></td>
                </tr>
              </thead>
             
              </table>
        </div>
      </div>
    </div>

  @endsection


@section('validation')
<script>

   

    $(document).ready(function () {
        $("#value").mask('000.000.000.000.000,00', { reverse: true });
        
    });        
    
    $(document).ready(function () {
        $("#weight").mask('000.000.000.000.000,00', { reverse: true });
        
    });    

    $(document).ready(function () {
        $("#tall").mask('000.000.000.000.000,00', { reverse: true });
        
    });    
    $(document).ready(function () {
        $("#width").mask('000.000.000.000.000,00', { reverse: true });
        
    });    
    $(document).ready(function () {
        $("#lenght").mask('000.000.000.000.000,00', { reverse: true });
        
    });    
    $(document).ready(function () {
        $("#volume").mask('000.000.000.000.000,00', { reverse: true });
        
    });    
    $(document).ready(function () {
        $("#cubic_foot").mask('000.000.000.000.000,00', { reverse: true });
        
    });    

    function calculateVolume(){
      
      var tall = document.getElementById("tall").value;
      var montoFormat = tall.replace(/[$.]/g,'');
      tall = montoFormat.replace(/[,]/g,'.');    

      var width = document.getElementById("width").value;
      var montoFormat = width.replace(/[$.]/g,'');
      width = montoFormat.replace(/[,]/g,'.');    

      var lenght = document.getElementById("lenght").value;
      var montoFormat = lenght.replace(/[$.]/g,'');
      lenght = montoFormat.replace(/[,]/g,'.');    

      if((tall != "" && tall != 0) && (width != "" && width != 0) && (lenght != "" && lenght != 0)){
        var volume = Math.ceil((tall * width * lenght) / 166);
        document.getElementById("volume").value = volume;
        var cubic_foot = Math.ceil((tall * width * lenght) / 1728);
        document.getElementById("cubic_foot").value = cubic_foot;
      }
      
    }
    

    function getRates(weight){
            
            $.ajax({
                url:"{{ route('international_rates.list','') }}" + '/' + weight,
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
</script>
   
@endsection