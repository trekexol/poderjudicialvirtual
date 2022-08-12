@extends('clients.layouts.dashboard')

@section('content')

{{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
          <div class="x_title">
            <h2>Ingresar Destinatarios</h2>
            <ul class="col-sm-1 nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
        <form method="POST" action="{{ route('client_recipient_packages.store') }}" id="form" data-parsley-validate class="form-horizontal form-label-left">
        @csrf
           
          
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Pais:</label>
            <div class="col-md-4 col-sm-4">
                <select id="country" name="id_country" class="select2_single form-control" >
                    <option value="{{ $package->client_recipient['id_country'] ?? '' }}">{{ $package->client_recipient->countries['name'] ?? '' }}</option>
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
                <input type="text" id="email" name="email" required="required" class="form-control " value="{{$package->client_recipient['email'] ?? ''}}">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nombre:</label>
            <div class="col-md-4 col-sm-4 ">
                <input type="text" id="name" name="name" required="required" class="form-control " value="{{$package->client_recipient['name'] ?? ''}}">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Cédula:</label>
            <div class="col-md-4 col-sm-4">
                <input type="text" id="identification_card" name="identification_card" required="required" class="form-control " value="{{$package->client_recipient['identification_card'] ?? ''}}">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Dirección:</label>
            <div class="col-md-4 col-sm-4 ">
                <textarea type="text" id="direction" name="direction" rows="5" cols="20" required="required" class="form-control ">{{$package->client_recipient['direction1'] ?? ''}}</textarea>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Dirección 2:</label>
            <div class="col-md-4 col-sm-4 ">
                <textarea type="text" id="direction2" name="direction2" rows="5" cols="20" required="required" class="form-control ">{{$package->client_recipient['direction2'] ?? ''}}</textarea>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Teléfono:</label>
            <div class="col-md-4 col-sm-4 ">
                <input type="text" id="phone" name="phone" required="required" class="form-control " value="{{$package->client_recipient['phone'] ?? ''}}">
            </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Observación:</label>
            <div class="col-md-4 col-sm-4 ">
                <textarea type="text" id="observation" name="observation" rows="5" cols="20" required="required" class="form-control ">{{$package->client_recipient['observation'] ?? ''}}</textarea>
            </div>
        </div>

            <div class="ln_solid"></div>

            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="{{ route('package_client_recipients.index') }}" class="btn btn-danger" type="button">Cancel</a>
                </div>
            </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection


@section('country')
    <script>
      
    
    </script> 
@endsection   
