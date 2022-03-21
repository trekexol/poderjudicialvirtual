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
        <form  method="POST"   action="{{ route('type_of_goods.update',$type_of_good->id) }}" enctype="multipart/form-data" >
            @method('PATCH')
            @csrf()
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="code">Código:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="code" name="code" required="required" class="form-control " value="{{ $type_of_good->code }}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nombre:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="name" name="name" required="required" class="form-control " value="{{ $type_of_good->name }}">
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
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('type_of_goods.index') }}" class="btn btn-danger" type="button">Cancel</a>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
@section('validation')
    <script>
        if("{{$type_of_good->type}}" == "Maritimo"){
            $('#typeMaritimo').prop('checked', true);
        }else if("{{$type_of_good->type}}" == "Aereo"){
            $('#typeAereo').prop('checked', true);
        }else{
            $('#typeTerrestre').prop('checked', true);
        }
    </script>
@endsection
