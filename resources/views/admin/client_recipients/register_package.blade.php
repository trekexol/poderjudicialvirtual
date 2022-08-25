@extends('clients.layouts.dashboard')

@section('content')

{{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}
@if (isset($package))
<div class="col-sm-1 offset-sm-4">
    <a href="{{ route('packages.index') }}" type="submit" class="btn btn-light offset-sm-1" id="BtnPackage">Tracking</a>
  </div>
 
    <div class="col-sm-1">
      <a href="{{ route('packages.create',$package->id)  }}" type="submit" class="btn btn-light offset-sm-1" id="BtnPackage">Basico</a>
    </div>
    <div class="col-sm-1">
      <a href="{{ route('client_recipient_packages.register',$package->id) }}" type="submit" class="active btn btn-light offset-sm-1" id="BtnPackage">Destino</a>
    </div>
    <div class="col-sm-1">
      <a href="{{ route('package_charges.index',$package->id) }}" type="submit" class="btn btn-light offset-sm-1" id="BtnPackage">Cargos</a>
    </div>
  @endif
  
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
              <h2>Registrar Destinatario al Paquete</h2>
              <ul class="col-sm-1 nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
            <form  method="POST"   action="{{ route('client_recipient_packages.store') }}" enctype="multipart/form-data" >
           
            @csrf()
        
            @if (isset($client_recipients))
            <input type="hidden" id="id_package" name="id_package" value="{{$package->id}}">
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Seleccione un Destino:</label>
                <div class="col-md-4 col-sm-4">
                    <select id="client_recipient" name="id_client_recipient" class="select2_single form-control" >
                        @if (isset($package->id_client_recipient))
                            <option value="{{ $package->client_recipients['id'] ?? ''}}">{{ $package->client_recipients['name'] ?? ''}} - {{ $package->client_recipients['direction1'] ?? ''}}</option>
                            <option>------------</option>
                        @endif
                        
                        @foreach ($client_recipients as $client_recipient)
                            <option value="{{ $client_recipient->id }}">{{ $client_recipient->name }} - {{ $client_recipient->direction1 }}</option>
                        @endforeach
                    </select>
                </div>
                <a href="{{ route('client_recipient_packages.create',$package->id) }}" class="btn btn-info" type="button">Agregar Nuevo</a>
            </div>
            @endif
          
            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('packages.create',$package->id) }}" class="btn btn-danger" type="button">Cancel</a>
                </div>
            </div>

        </form>
    </div>
</div>
</div>
</div>
@endsection
@section('validation')
    <script>
      
    </script>
@endsection
