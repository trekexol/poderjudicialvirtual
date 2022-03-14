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
            <label class="col-form-label col-md-3 col-sm-3 label-align">Almacén de Origen:</label>
            <div class="col-md-4 col-sm-4">
                <select id="wharehouse" name="id_wharehouse_origin" class="select2_single form-control" >
                    <option>Seleccione un Almacén</option>
                    @foreach ($wharehouses as $wharehouse)
                        <option value="{{ $wharehouse->id }}">{{ $wharehouse->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Almacén de Destino:</label>
            <div class="col-md-4 col-sm-4">
                <select id="wharehouse" name="id_wharehouse_destination" class="select2_single form-control" >
                    <option>Seleccione un Almacén</option>
                    @foreach ($wharehouses as $wharehouse)
                        <option value="{{ $wharehouse->id }}">{{ $wharehouse->name }}</option>
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
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="weight">Peso:</label>
            <div class="col-md-4 col-sm-4 ">
                <input type="text" id="weight" name="weight" required="required" class="form-control ">
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
