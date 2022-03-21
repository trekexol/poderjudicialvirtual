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
        <form method="POST" action="{{ route('type_of_goods.store') }}" id="form" data-parsley-validate class="form-horizontal form-label-left">
        @csrf
                
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="code">Código:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="code" name="code" required="required" class="form-control ">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Descripción:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="description" name="description" required="required" class="form-control ">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Arancel (%):</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="tariff_rate" name="tariff_rate" required="required" class="form-control ">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Impuesto (%):</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="tax_percentage" name="tax_percentage" required="required" class="form-control ">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Cargo Adicional:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="additional_charge" name="additional_charge" required="required" class="form-control ">
                </div>
            </div>

            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="{{ route('type_of_goods.index') }}" class="btn btn-danger" type="button">Cancel</a>
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
