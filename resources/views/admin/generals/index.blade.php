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
        <form method="POST" action="{{ route('generals.store') }}" id="form" data-parsley-validate class="form-horizontal form-label-left">
        @csrf
                
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nombre:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="name" name="name" required="required" class="form-control " value="{{ $general->name ?? ''}}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="legal_name">Denominación Legal:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="legal_name" name="legal_name" required="required" class="form-control " value="{{ $general->legal_name ?? ''}}">
                </div>
            </div>
           
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Dirección:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="direction" name="direction" required="required" class="form-control " value="{{ $general->direction ?? ''}}">
                </div>
            </div>
            <div class="item form-group">
                <div class="col-md-4 col-sm-4 offset-sm-3">
                    <input type="text" id="direction2" name="direction2" required="required" class="form-control " value="{{ $general->direction2 ?? ''}}">
                </div>
            </div>
            <div class="item form-group">
                <div class="col-md-4 col-sm-4 offset-sm-3">
                    <input type="text" id="direction3" name="direction3" required="required" class="form-control " value="{{ $general->direction3 ?? ''}}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Teléfonos:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="phone" name="phone" required="required" class="form-control " value="{{ $general->phone ?? ''}}">
                </div>
            </div> 
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="contact">Contacto:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="contact" name="contact" required="required" class="form-control " value="{{ $general->contact ?? ''}}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Email:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="email" name="email" required="required" class="form-control " value="{{ $general->email ?? ''}}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="currency">Moneda (Abrev):</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="currency" name="currency" required="required" class="form-control " value="{{ $general->currency ?? ''}}"> 
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="{{ route('generals.index') }}" class="btn btn-danger" type="button">Cancel</a>
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
