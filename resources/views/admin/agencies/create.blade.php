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
        <form method="POST" action="{{ route('agencies.store') }}" id="form" data-parsley-validate class="form-horizontal form-label-left">
        @csrf
                
            <div class="item form-group">
                <label class="col-form-label col-md-1 col-sm-1 label-align" for="code">Código:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="code" name="code" required="required" class="form-control ">
                </div>

                <label class="col-form-label col-md-2 col-sm-2 label-align">Agencia Comercial:</label>
                <div class="col-md-1 col-sm-1 ">
                <p> Si: <input type="radio" class="flat" name="comercial" id="comercialYes" value="Yes"  required /> 
                </div>
                <div class="col-md-1 col-sm-1 ">
                    No: <input type="radio" class="flat" name="comercial" id="comercialNo" value="No" checked=""/>
                </p>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-1 col-sm-1 label-align" for="name">Nombre Agencia:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="name" name="name" required="required" class="form-control ">
                </div>
                <label class="col-form-label col-md-2 col-sm-2 label-align" for="phone">Teléfono:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="phone" name="phone"  data-inputmask="'mask' : '(9999) 999-9999'" autocomplete="phone" required="required" class="form-control">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-1 col-sm-1 label-align">Pais:</label>
                <div class="col-md-4 col-sm-4">
                    <select id="country" name="id_country" class="select2_single form-control" onchange="getCities(value);">
                        <option>Seleccione un Pais</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="col-form-label col-md-2 col-sm-2 label-align">Ciudad:</label>
                <div class="col-md-4 col-sm-4">
                    <select id="city" name="id_city" class="select2_single form-control" >
                        <option></option>
                    </select>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-1 col-sm-1 label-align" for="direction">Dirección:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="direction" name="direction" required="required" class="form-control ">
                </div>
                <label class="col-form-label col-md-2 col-sm-2 label-align" for="contact_person">Persona Contacto:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="contact_person" name="contact_person" required="required" class="form-control ">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-1 col-sm-1 label-align" for="amount">Tarifa:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="amount" name="amount" required="required" class="form-control ">
                </div>
                <label class="col-form-label col-md-2 col-sm-2 label-align">Pago Virtual:</label>
                <div class="col-md-1 col-sm-1 ">
                <p> Si: <input type="radio" class="flat" name="payment_virtual" id="payment_virtualYes" value="Yes"  required /> 
                </div>
                <div class="col-md-1 col-sm-1 ">
                    No: <input type="radio" class="flat" name="payment_virtual" id="payment_virtualNo" value="No" checked=""/>
                </p>
                </div>
            </div>


            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="{{ route('agencies.index') }}" class="btn btn-danger" type="button">Cancel</a>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection


@section('country')
    <script>
      
    

        function getCities(country_id){
            
            $.ajax({
                url:"{{ route('cities.list','') }}" + '/' + country_id,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                   
                    let city = $("#city");
                    let htmlOptions = `<option value='' >Seleccione Ciudad..</option>`;
                    // console.clear();
                    if(response.length > 0){
                        response.forEach((item, index, object)=>{
                            let {id,name} = item;
                            htmlOptions += `<option value='${id}' {{ old('City') == '${id}' ? 'selected' : '' }}>${name}</option>`

                        });
                    }
                    //console.clear();
                    // console.log(htmlOptions);
                   city.html('');
                   city.html(htmlOptions);
                
                    
                
                },
                error:(xhr)=>{
                    alert('Presentamos inconvenientes al consultar los datos');
                }
            })
        }

        
        </script> 
@endsection   
