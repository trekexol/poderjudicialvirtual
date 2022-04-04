@extends('admin.layouts.dashboard')

@section('content')

{{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}
<div class="right_col" role="main">
    <div class="col-sm-7 h2">
        Editar Bulto
    </div>
    <div class="x_content">
        <br />
        <form  method="POST"   action="{{ route('packages_lumps.update',$package_lump->id) }}" enctype="multipart/form-data" >
            @method('PATCH')
            @csrf()
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="code">Tipo de Paquete:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control " name="id_type_of_packaging">
                        <option value="{{ $package_lump->id_type_of_packaging ?? null }}">{{ $package_lump->type_of_packagings['description'] ?? null }}</option>
                        <option value="">---------------------</option>
                      @foreach ($type_of_packagings as $type_of_packaging)
                        <option value="{{ $type_of_packaging->id }}">{{ $type_of_packaging->description ?? '' }}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Cantidad:</label>
                <div class="col-md-2 col-sm-2 ">
                    <input type="text" id="amount" name="amount"  class="form-control" required value="{{ $package_lump->amount ?? '' }}">
                </div>
            </div>
           
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Peso Bulto:</label>
                <div class="col-md-2 col-sm-2 ">
                    <input type="text" id="bulk_weight" name="bulk_weight"  class="form-control" required value="{{ $package_lump->bulk_weight ?? '' }}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Largo:</label>
                <div class="col-md-2 col-sm-2 ">
                    <input type="text" id="length_weight" name="length_weight"  class="form-control" required value="{{ $package_lump->length_weight ?? '' }}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Ancho:</label>
                <div class="col-md-2 col-sm-2 ">
                    <input type="text" id="width_weight" name="width_weight"  class="form-control" required value="{{ $package_lump->width_weight ?? '' }}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Alto:</label>
                <div class="col-md-2 col-sm-2 ">
                    <input type="text" id="high_weight" name="high_weight"  class="form-control" required value="{{ $package_lump->high_weight ?? '' }}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Descripción:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="description" name="description"  class="form-control" required value="{{ $package_lump->description ?? '' }}">
                </div>
            </div>

            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('packages.create',$package_lump->id_package) }}" class="btn btn-danger" type="button">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection