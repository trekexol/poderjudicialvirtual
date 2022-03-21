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
        <form method="POST" action="{{ route('carriers.store') }}" id="form" data-parsley-validate class="form-horizontal form-label-left">
        @csrf
                
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="code">Código:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="code" name="code" required="required" class="form-control ">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nombre Transportista:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="name" name="name" required="required" class="form-control ">
                </div>
            </div>
         
         
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Tipo de Envío:</label>
                <div class="col-md-2 col-sm-2">
                <p> Maritimo: <input type="radio" class="flat" name="type" id="typeMaritimo" value="Maritimo"  required /> 
                </div>
                <div class="col-md-2 col-sm-2 ">
                    Aéreo: <input type="radio" class="flat" name="type" id="typeAereo" value="Aereo" checked=""/>
                </p>
                </div>
                <div class="col-md-2 col-sm-2 ">
                    Terrestre: <input type="radio" class="flat" name="type" id="typeTerrestre" value="Terrestre" checked=""/>
                </p>
                </div>
            </div>


            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="{{ route('carriers.index') }}" class="btn btn-danger" type="button">Cancel</a>
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
