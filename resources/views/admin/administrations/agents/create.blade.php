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
        <form method="POST" action="{{ route('agents.store') }}" id="form" data-parsley-validate class="form-horizontal form-label-left">
        @csrf
                
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="code">Código:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="code" name="code" required="required" class="form-control ">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nombre:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="name" name="name" required="required" class="form-control ">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Tipo de Agente:</label>
                <div class="col-md-4 col-sm-4">
                    <select id="type" name="type" class="select2_single form-control" >
                        <option value="Transportista">Transportista</option>
                        <option value="Consignatario">Consignatario</option>
                        <option value="Emisor">Emisor</option>
                        <option value="Cargo">Cargo</option>
                        <option value="Vendedor">Vendedor</option>
                        <option value="Shipper">Shipper</option>
                    </select>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Dirección:</label>
                <div class="col-md-4 col-sm-4 ">
                    <textarea type="text" id="direction" name="direction" rows="5" cols="20" required="required" class="form-control "></textarea>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Teléfonos:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="phone" name="phone" required="required" class="form-control ">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Email:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="email" name="email" required="required" class="form-control ">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Persona Contacto:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="contact_person" name="contact_person" required="required" class="form-control ">
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="{{ route('agents.index') }}" class="btn btn-danger" type="button">Cancel</a>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection


@section('country')
    <script>
      
    
    </script> 
@endsection   
