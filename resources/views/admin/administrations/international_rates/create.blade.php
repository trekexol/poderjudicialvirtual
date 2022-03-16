@extends('admin.layouts.dashboard')

@section('content')

{{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}
<div class="right_col" role="main">

    <div class="x_content">
        <br />
        <form method="POST" action="{{ route('international_rates.store') }}" id="form" data-parsley-validate class="form-horizontal form-label-left">
        @csrf
        <div class="item form-group">
            <div class="h3 col-md-8 col-sm-8 offset-sm-3">Registro de Tarifa Internacional</div>
        </div>
        <br>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Origen:</label>
            <div class="col-md-4 col-sm-4">
                <select id="type_origin" name="id_type_origin" class="select2_single form-control" >
                    <option>Seleccione un Tipo</option>
                    <option value="State">Estado</option>
                    <option value="Wharehouse">Almacén</option>
                    <option value="Client">Cliente</option>
                </select>
            </div>
            <div id="wharehouse_origin_form" class="col-md-4 col-sm-4">
                <select id="wharehouse_origin" name="id_wharehouse_origin" class="select2_single form-control" >
                    <option>Seleccione un Almacén</option>
                    @foreach ($wharehouses as $wharehouse)
                        <option value="{{ $wharehouse->id }}">{{ $wharehouse->name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="client_origin_form" class="col-md-4 col-sm-4">
                <select id="client_origin" name="id_client_origin" class="select2_single form-control" >
                    <option>Seleccione un Cliente</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="state_origin_form" class="col-md-4 col-sm-4">
                <select id="state_origin" name="id_state_origin" class="select2_single form-control" >
                    <option>Seleccione un Estado</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Destino:</label>
            <div class="col-md-4 col-sm-4">
                <select id="type_destination" name="id_type_destination" class="select2_single form-control" >
                    <option>Seleccione un Tipo</option>
                    <option value="State">Estado</option>
                    <option value="Wharehouse">Almacén</option>
                    <option value="Client">Cliente</option>
                </select>
            </div>
            <div id="wharehouse_destination_form" class="col-md-4 col-sm-4">
                <select id="wharehouse_destination" name="id_wharehouse_destination" class="select2_single form-control" >
                    <option>Seleccione un Almacén</option>
                    @foreach ($wharehouses as $wharehouse)
                        <option value="{{ $wharehouse->id }}">{{ $wharehouse->name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="client_destination_form" class="col-md-4 col-sm-4">
                <select id="client_destination" name="id_client_destination" class="select2_single form-control" >
                    <option>Seleccione un Cliente</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="state_destination_form" class="col-md-4 col-sm-4">
                <select id="state_destination" name="id_state_destination" class="select2_single form-control" >
                    <option>Seleccione un Estado</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Tipo de Peso:</label>
            <div class="col-md-4 col-sm-4">
                <select id="weight_type" name="weight_type" class="select2_single form-control" >
                    <option value="Kg">Kilogramo</option>
                    <option value="Libra">Libra</option>
                </select>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Tipo de Envío:</label>
            <div class="col-md-2 col-sm-2">
            <p> Maritimo: <input type="radio" class="flat" name="shipping_type" id="shipping_typeYes" value="Maritimo"  required /> 
            </div>
            <div class="col-md-1 col-sm-1 ">
                Aéreo: <input type="radio" class="flat" name="shipping_type" id="shipping_typeNo" value="Aereo" checked=""/>
            </p>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="weight">Peso Mínimo:</label>
            <div class="col-md-4 col-sm-4 ">
                <input type="text" id="minimum_weight" name="minimum_weight" required="required" class="form-control ">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="weight">Peso Máximo:</label>
            <div class="col-md-4 col-sm-4 ">
                <input type="text" id="maximum_weight" name="maximum_weight" required="required" class="form-control ">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Moneda:</label>
            <div class="col-md-4 col-sm-4">
                <select id="coin" name="coin" class="select2_single form-control" >
                    <option value="D">Dólares</option>
                    <option value="Bs">Bolívares</option>
                </select>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="price">Precio:</label>
            <div class="col-md-4 col-sm-4 ">
                <input type="text" id="price" name="price" required="required" class="form-control ">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="price">Tasa:</label>
            <div class="col-md-4 col-sm-4 ">
                <input type="text" id="rate" name="rate" required="required" class="form-control ">
            </div>
        </div>
          

        <div class="ln_solid"></div>
        <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <button type="submit" class="btn btn-primary">Registrar</button>
                <a href="{{ route('international_rates.index') }}" class="btn btn-danger" type="button">Cancel</a>
            </div>
        </div>

        </form>
    </div>
</div>

@endsection
@section('validation')
    <script>
         $("#wharehouse_origin_form").hide();
         $("#state_origin_form").hide();
         $("#client_origin_form").hide();

         $("#wharehouse_destination_form").hide();
         $("#state_destination_form").hide();
         $("#client_destination_form").hide();

        $("#type_origin").on('change',function(){
            value = $(this).val();

            if(value == 'Wharehouse'){
                hideAll();
                $("#wharehouse_origin_form").show();
            }else if(value == 'State'){
                hideAll();
                $("#state_origin_form").show();
            }else if(value == 'Client'){
                hideAll();
                $("#client_origin_form").show();
            }
            
        });

        $("#type_destination").on('change',function(){
            value = $(this).val();

            if(value == 'Wharehouse'){
                hideAllDestination();
                $("#wharehouse_destination_form").show();
            }else if(value == 'State'){
                hideAllDestination();
                $("#state_destination_form").show();
            }else if(value == 'Client'){
                hideAllDestination();
                $("#client_destination_form").show();
            }
            
        });

        function hideAll(){
            $("#wharehouse_origin_form").hide();
            $("#state_origin_form").hide();
            $("#client_origin_form").hide();
        }

        function hideAllDestination(){
            $("#wharehouse_destination_form").hide();
            $("#state_destination_form").hide();
            $("#client_destination_form").hide();
        }

    </script>
@endsection