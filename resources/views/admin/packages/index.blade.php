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
           
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="first-name">Tracking </label>
                <div class="col-sm-4">
                  <input type="text" id="first-name" required="required" class="form-control ">
                </div>
                <label class="col-form-label col-sm-3 label-align " for="last-name">Shipper: </label>
                <div class="col-sm-3">
                  <input type="text" id="last-name" name="last-name" required="required" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="first-name">Cliente</label>
                <div class="col-sm-4">
                  <input type="text" id="first-name" required="required" class="form-control ">
                </div>
                <div class="form-group col-md-1">
                  <a href="#" title="Seleccionar Cliente"><i class="fa fa-magnifying-glass"></i></a> 
              </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="first-name">Agente Vendedor:</label>
                <div class="col-sm-4">
                    <select class="select2_group form-control">
                      @foreach ($agents as $agent)
                        <option value="{{ $agent->id }}">{{ $agent->name ?? '' }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="first-name">Vendedor Externo:</label>
                <div class="col-sm-4">
                    <select class="select2_group form-control">
                      
                        <option value="WY">Wyoming</option>
                      
                    </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align">Fecha Llegada:
                </label>
                <div class="col-sm-4">
                  <input id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                  <script>
                    function timeFunctionLong(input) {
                      setTimeout(function() {
                        input.type = 'text';
                      }, 60000);
                    }
                  </script>
                </div>
                <label class="col-form-label col-sm-3 label-align">Hora Llegada:
                </label>
                <div class="col-sm-3 ">
                  <input id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                  <script>
                    function timeFunctionLong(input) {
                      setTimeout(function() {
                        input.type = 'text';
                      }, 60000);
                    }
                  </script>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="first-name">Ubicación Oficina:</label>
                <div class="col-sm-4">
                    <select class="select2_group form-control">
                      
                        <option value="WY">Wyoming</option>
                      
                    </select>
                </div>
                <label class="col-form-label col-sm-3 label-align " for="first-name">Almacen:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control">
                      
                        <option value="WY">Wyoming</option>
                      
                    </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="first-name">Contenido:</label>
                <div class="col-sm-4">
                  <input type="text" id="first-name" required="required" class="form-control ">
                </div>
                <label class="col-form-label col-sm-3 label-align " for="last-name">Valor:</label>
                <div class="col-sm-3">
                  <input type="text" id="last-name" name="last-name" required="required" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="first-name">País de Origen:</label>
                <div class="col-sm-4">
                    <select class="select2_group form-control">
                      
                        <option value="WY">Wyoming</option>
                      
                    </select>
                </div>
                <label class="col-form-label col-sm-3 label-align " for="first-name">País de Destino:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control">
                      
                        <option value="WY">Wyoming</option>
                      
                    </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="first-name">Entregado por:</label>
                <div class="col-sm-4">
                    <select class="select2_group form-control">
                      
                        <option value="WY">Wyoming</option>
                      
                    </select>
                </div>
                <label class="col-form-label col-sm-3 label-align " for="last-name">N° Guía Transporte:</label>
                <div class="col-sm-3">
                  <input type="text" id="last-name" name="last-name" required="required" class="form-control">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="first-name">Tipo Servicio:</label>
                <div class="col-sm-4">
                    <select class="select2_group form-control">
                      
                        <option value="WY">Wyoming</option>
                      
                    </select>
                </div>
                <label class="col-form-label col-sm-3 label-align " for="first-name">Instrucciones:</label>
                <div class="col-sm-2">
                    <select class="select2_group form-control">
                      
                        <option value="WY">Wyoming</option>
                      
                    </select>
                </div>
                <div class="col-sm-2">
                  <select class="select2_group form-control">
                    <optgroup label="Alaskan/Hawaiian Time Zone">
                      <option value="AK">Alaska</option>
                      <option value="HI">Hawaii</option>
                    
                    <optgroup label="Pacific Time Zone">
                      <option value="CA">California</option>
                      <option value="NV">Nevada</option>
                      <option value="OR">Oregon</option>
                      <option value="WA">Washington</option>
                    
                    <optgroup label="Mountain Time Zone">
                      <option value="AZ">Arizona</option>
                      <option value="CO">Colorado</option>
                      <option value="ID">Idaho</option>
                      <option value="MT">Montana</option>
                      <option value="NE">Nebraska</option>
                      <option value="NM">New Mexico</option>
                      <option value="ND">North Dakota</option>
                      <option value="UT">Utah</option>
                      <option value="WY">Wyoming</option>
                    
                  </select>
                </div>
              </div>


              <div class="ln_solid"></div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button class="btn btn-primary" type="button">Cancel</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
</div>

@endsection