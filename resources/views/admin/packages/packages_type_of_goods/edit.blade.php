@extends('admin.layouts.dashboard')

@section('content')

{{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}
<div class="right_col" role="main">
    <div class="col-sm-7 h2">
        Editar Tipo de Paquete
    </div>
    <div class="x_content">
        <br />
        <form  method="POST"   action="{{ route('packages_type_of_goods.update',$package_type_of_good->id) }}" enctype="multipart/form-data" >
            @method('PATCH')
            @csrf()
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="code">Tipo de Paquete:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control " name="id_type_of_good">
                        <option value="{{ $package_type_of_good->id_type_of_good ?? null }}">{{ $package_type_of_good->type_of_goods['description'] ?? null }}</option>
                        <option value="">---------------------</option>
                      @foreach ($type_of_goods as $type_of_good)
                        <option value="{{ $type_of_good->id }}">{{ $type_of_good->description ?? '' }}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Unidad:</label>
                <div class="col-md-2 col-sm-2 ">
                    <input type="text" id="unit" name="unit"  class="form-control" required value="{{ $package_type_of_good->unit ?? '' }}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Descripción:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="description" name="description"  class="form-control" required value="{{ $package_type_of_good->description ?? '' }}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Valor:</label>
                <div class="col-md-2 col-sm-2 ">
                    <input type="text" id="value" name="value"  class="form-control" required value="{{ $package_type_of_good->value ?? '' }}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Arancel:</label>
                <div class="col-md-2 col-sm-2 ">
                    <input type="text" id="tariff" name="tariff"  class="form-control" required value="{{ $package_type_of_good->tariff ?? '' }}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Cargo:</label>
                <div class="col-md-2 col-sm-2 ">
                    <input type="text" id="charge" name="charge"  class="form-control" required value="{{ $package_type_of_good->charge ?? '' }}">
                </div>
            </div>

            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('packages.create',$package_type_of_good->id_package) }}" class="btn btn-danger" type="button">Cancelar</a>
                </div>
            </div>
           
        </form>
    </div>
</div>
@endsection