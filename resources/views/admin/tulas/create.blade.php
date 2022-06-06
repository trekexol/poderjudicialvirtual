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
            <h2>Ingresar Tulas</h2>
            <ul class="col-sm-1 nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form method="POST" enctype="multipart/form-data" action="{{ route('tulas.store') }}" id="form" data-parsley-validate class="form-horizontal form-label-left">
              @csrf 
                         
              <div class="item form-group">
                <label class="col-form-label col-sm-2 label-align " for="id_office_agency">Almacén de Origen:</label>
                <div class="col-sm-3">
                  <select class="select2_group form-control" name="id_office_agency">
                      @if (isset($tula))
                        <option value="{{ $tula->id_office_agency ?? null }}">{{ $tula->office_agencies['name'] ?? null }}</option>
                        <option value="">---------------------</option>
                      @else
                        <option value="">Seleccione una Opción</option>
                      @endif
                      @foreach ($wharehouses as $wharehouse)
                        <option value="{{ $wharehouse->id }}">{{ $wharehouse->name ?? '' }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-sm-2 label-align " for="id_agent">Almacén de Destino:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control" name="id_agent">
                      @if (isset($tula))
                        <option value="{{ $tula->id_agent ?? null }}">{{ $tula->agents['name'] ?? null }}</option>
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
                <label class="col-form-label col-sm-2 label-align " for="id_destination_state">Destino:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control" name="id_destination_state" required>
                      @if (isset($tula))
                        <option value="{{ $tula->id_destination_state ?? null }}">{{ $tula->destination_states['name'] ?? null }}</option>
                        <option value="">---------------------</option>
                      @else
                        <option value="">Seleccione una Opción</option>
                      @endif
                      
                      @foreach ($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name ?? '' }}</option>
                      @endforeach
                    </select>
                </div>
                <label class="col-form-label col-sm-3 label-align " for="cubic_foot">Pié Cúbico:</label>
                <div class="col-sm-3">
                  <input id="cubic_foot" name="cubic_foot" class="date-picker form-control"  type="text" required="required" value="{{ number_format(bcdiv(($tula->cubic_foot ?? 0), '1', 2), 2, ',', '.') ?? null }}">
                </div>
              </div>
           
              <div class="item form-group">
                <label class="col-form-label col-sm-2 label-align " for="dimension">Dimensiones:</label>
                <div class="col-sm-1">
                  <input id="dimension_width" name="dimension_width" placeholder="Ancho" class="date-picker form-control"  type="text" required="required" value="{{ number_format(bcdiv(($tula->dimension_width ?? 0), '1', 2), 2, ',', '.') ?? null }}">
                </div>
                <div class="col-sm-1">
                  <input id="dimension_length" name="dimension_length" placeholder="Largo" class="date-picker form-control"  type="text" required="required" value="{{ number_format(bcdiv(($tula->dimension_length ?? 0), '1', 2), 2, ',', '.') ?? null }}">
                </div>
                <div class="col-sm-1">
                  <input id="dimension_high" name="dimension_high" placeholder="Alto" class="date-picker form-control"  type="text" required="required" value="{{ number_format(bcdiv(($tula->dimension_high ?? 0), '1', 2), 2, ',', '.') ?? null }}">
                </div>

                <label class="col-form-label col-sm-3 label-align " for="dimension">Volumen:</label>
                <div class="col-sm-3">
                  <input id="volume" name="volume"  class="date-picker form-control"  type="text" required="required" value="{{ number_format(bcdiv(($tula->volume ?? 0), '1', 2), 2, ',', '.') ?? null }}">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-sm-2 label-align " for="dimension">Peso en lbs:</label>
                <div class="col-sm-3">
                  <input id="weight" name="weight"  class="date-picker form-control"  type="text" required="required" value="{{ number_format(bcdiv(($tula->weight ?? 0), '1', 2), 2, ',', '.') ?? null }}">
                </div>
                <label class="col-form-label col-sm-3 label-align " for="dimension">Peso Cargable:</label>
                <div class="col-sm-3">
                  <input id="loadable_weight" name="loadable_weight"  class="date-picker form-control"  type="text" required="required" value="{{ number_format(bcdiv(($tula->loadable_weight ?? 0), '1', 2), 2, ',', '.') ?? null }}">
                </div>
              </div>

             
              <div class="item form-group">
                <label class="col-form-label col-sm-2 label-align " for="type_of_service">Servicio:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control" name="type_of_service" required>
                      @if (isset($tula))
                        <option value="{{ $tula->type_of_service ?? null }}">{{ $tula->type_of_service ?? null }}</option>
                        <option value="">---------------------</option>
                      @else
                        <option value="">Seleccione</option>
                      @endif
                      <option value="Aéreo">Aéreo</option>
                      <option value="Marítimo">Marítimo</option>
                      <option value="Terrestre">Terrestre</option>
                      <option value="Marítimo Express">Marítimo Express</option>
                    </select>
                </div>
                <label class="col-form-label col-sm-3 label-align " for="class">Clase:</label>
                <div class="col-sm-2">
                    <select class="select2_group form-control" name="class" required>
                      @if (isset($tula))
                        <option value="{{ $tula->class ?? null }}">{{ $tula->class ?? null }}</option>
                        <option value="">---------------------</option>
                      @else
                        <option value="">Seleccione</option>
                      @endif
                      <option value="Clase 1">Clase 1</option>
                      <option value="Clase 2">Clase 2</option>
                      <option value="Clase 3">Clase 3</option>
                    </select>
                </div>
              </div>
              <div class="item form-group">
                  <label class="col-form-label col-sm-2 label-align " for="loose_packages">Bultos sueltos:</label>
                  <div class="col-md-1 col-sm-1 ">
                  <p> Si: <input type="radio" class="flat" name="loose_packages" id="loose_packagesYes" value="Yes"  required /> 
                  </div>
                  <div class="col-md-1 col-sm-1 ">
                      No: <input type="radio" class="flat" name="loose_packages" id="loose_packagesNo" value="No" checked=""/>
                  </p>
                  </div>
                  <label class="col-form-label col-sm-4 label-align " for="reference">Referencia:</label>
                  <div class="col-sm-3">
                    <input id="reference" name="reference"  class="date-picker form-control"  type="text" required="required" value="{{ $tula->reference ?? '' }}">
                  </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-sm-2 label-align " for="dimension">Expediente:</label>
                <div class="col-sm-3">
                  <input id="record" name="record"  class="date-picker form-control"  type="text" required="required" value="{{ $tula->record ?? '' }}">
                </div>
                <label class="col-form-label col-sm-3 label-align " for="dimension">Número de Paquetes:</label>
                <div class="col-sm-3">
                  <input id="number_of_packages" name="number_of_packages"  class="date-picker form-control"  type="text" required="required" value="{{ $tula->number_of_packages ?? '' }}">
                </div>
              </div>

              <br>
              <br>
              <div class="form-row">
                @if (empty($tula))
                  <div class="col-sm-3 offset-sm-1">
                    <button type="submit" class="btn btn-primary" id="Btntula">Registrar Tula</button>
                  </div>
                @else
                  <div class="col-sm-3 offset-sm-1">
                    <button onclick="update();" class="btn btn-success" id="Btntula">Actualizar Tula</button>
                  </div>
                @endif
                <div class="col-sm-2 ">
                  <a href="{{ route('tulas.index') }}" class="btn btn-danger" type="button">Ver Listado</a>
                </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('validation')

  @isset($tula)
    <script>
      if("{{$tula->loose_packages}}" == "Yes"){
          $('#loose_packagesYes').prop('checked', true);
      }else{
          $('#loose_packagesNo').prop('checked', true);
      }

      
    function update(){
      document.getElementById("form").action = "{{ route('tulas.update',$tula->id) }}";
      document.getElementById("form").submit();
    }
    </script>
  @endisset
  
@endsection