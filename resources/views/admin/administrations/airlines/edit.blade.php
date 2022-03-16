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
        <form  method="POST"   action="{{ route('airlines.update',$airline->id) }}" enctype="multipart/form-data" >
            @method('PATCH')
            @csrf()
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="code">Código:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="code" name="code" required="required" class="form-control " value="{{ $airline->code }}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nombre:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="name" name="name" required="required" class="form-control " value="{{ $airline->name }}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Tipo de Guia:</label>
                <div class="col-md-1 col-sm-1 ">
                    <p>Peso: <input type="radio" class="flat" name="type" id="typeNo" value="peso" />
                </p>
                </div>
                <div class="col-md-3 col-sm-3 ">
                    <p> Peso Cargable: <input type="radio" class="flat" name="type" id="typeYes" value="peso_cargable" required /> </p>
                    </div>
            </div>
         
            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('airlines.index') }}" class="btn btn-danger" type="button">Cancel</a>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
