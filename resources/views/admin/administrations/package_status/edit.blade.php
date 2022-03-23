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
        <form  method="POST"   action="{{ route('package_status.update',$package_statu->id) }}" enctype="multipart/form-data" >
            @method('PATCH')
            @csrf()
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="code">Código:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="code" name="code" required="required" class="form-control " value="{{ $package_statu->code }}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Descripción:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="description" name="description" required="required" class="form-control " value="{{ $package_statu->description }}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Color:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="color" name="color" required="required" class="form-control " value="{{ $package_statu->color ?? ''}}">
                </div>
            </div>
         
            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('package_status.index') }}" class="btn btn-danger" type="button">Cancel</a>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
@section('validation')
    <script>
       
    </script>
@endsection
