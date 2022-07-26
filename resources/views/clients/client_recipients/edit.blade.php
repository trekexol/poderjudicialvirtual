@extends('clients.layouts.dashboard')

@section('content')

{{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}
<div class="right_col" role="main">

    <div class="x_content">
        <br />
        <form  method="POST"   action="{{ route('client_recipients.update',$client_recipient->id) }}" enctype="multipart/form-data" >
            @method('PATCH')
            @csrf()
        
          
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Pais:</label>
                <div class="col-md-4 col-sm-4">
                    <select id="country" name="id_country" class="select2_single form-control" >
                        <option value="{{ $client_recipient->id_country }}">{{ $client_recipient->countries['name'] }}</option>
                        <option>------------</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="code">Email:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="email" name="email" required="required" class="form-control " value="{{$client_recipient->email}}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nombre:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="name" name="name" required="required" class="form-control " value="{{$client_recipient->name}}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Cédula:</label>
                <div class="col-md-4 col-sm-4">
                    <input type="text" id="identification_card" name="identification_card" required="required" class="form-control " value="{{$client_recipient->identification_card}}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Dirección:</label>
                <div class="col-md-4 col-sm-4 ">
                    <textarea type="text" id="direction" name="direction" rows="5" cols="20" required="required" class="form-control ">{{$client_recipient->direction1}}</textarea>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Dirección 2:</label>
                <div class="col-md-4 col-sm-4 ">
                    <textarea type="text" id="direction2" name="direction2" rows="5" cols="20" required="required" class="form-control ">{{$client_recipient->direction2}}</textarea>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Teléfono:</label>
                <div class="col-md-4 col-sm-4 ">
                    <input type="text" id="phone" name="phone" required="required" class="form-control " value="{{$client_recipient->phone}}">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Observación:</label>
                <div class="col-md-4 col-sm-4 ">
                    <textarea type="text" id="observation" name="observation" rows="5" cols="20" required="required" class="form-control ">{{$client_recipient->observation}}</textarea>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('client_recipients.index') }}" class="btn btn-danger" type="button">Cancel</a>
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
