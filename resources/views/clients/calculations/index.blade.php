@extends('clients.layouts.dashboard')

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
              
              <div class="item form-group">
                <label class="col-sm-5 offset-sm-1  h5" for="tracking">Cliente: {{Auth::user()->clients['firstname']}} {{Auth::user()->clients['firstlastname']}}</label>
                <label class="col-sm-6 offset-sm-1  h5" for="tracking">Casillero: {{Auth::user()->clients->countries['abbreviation'] ?? '' }}{{str_pad(Auth::user()->id_client ?? 0, 6, "0", STR_PAD_LEFT)}}</label>
            
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
                  <input type="text"  id="lenght"  name="lenght" class="form-control" >
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
                  <div class="col-sm-3 offset-sm-1">
                    <button type="submit" class="btn btn-primary offset-sm-1" id="BtnPackage">Calcular</button>
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

    
</script>
   
@endsection