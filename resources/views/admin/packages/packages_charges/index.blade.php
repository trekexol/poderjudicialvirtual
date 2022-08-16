@extends('admin.layouts.dashboard')

@section('content')

<div class="col-sm-1 offset-sm-4">
  <a href="{{ route('trakings.index') }}" type="submit" class="btn btn-light offset-sm-1" id="BtnPackage">Tracking</a>
</div>
@if (isset($package))
  <div class="col-sm-1">
    <a href="{{ route('packages.create',$package->id) }}" type="submit" class=" btn btn-light offset-sm-1" id="BtnPackage">Basico</a>
  </div>
  <div class="col-sm-1">
    <a href="{{ route('client_recipient_packages.register',$package->id) }}" type="submit" class="btn btn-light offset-sm-1" id="BtnPackage">Destino</a>
  </div>
  <div class="col-sm-1">
    <a href="{{ route('package_charges.index',$package->id) }}" type="submit" class="active btn btn-light offset-sm-1" id="BtnPackage">Cargos</a>
  </div>
@endif

{{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}
<div class="right_col" role="main">
 
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <div class="col-sm-9">
          <h2>Cargos y Gastos</h2>
        </div>
       
        <ul class="col-sm-1 nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <div class="row">
          <div class="col-sm-12">   
            <form method="POST" action="{{ route('package_charges.store') }}" id="form" data-parsley-validate class="form-horizontal form-label-left">
            @csrf
            <input type="hidden" id="id_package" name="id_package" value="{{$package->id}}">
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="concept">Concepto</label>
                <div class="col-sm-3">
                  <input type="text" id="concept" name="concept" required="required" class="form-control " value="{{ $package_charge->concept ?? '' }}">
                </div>
                <label class="col-form-label col-sm-1 label-align " for="amount">Monto</label>
                <div class="col-sm-3">
                  <input type="text" id="amount" name="amount" required="required" class="form-control " value="{{ number_format($package_charge->amount ?? 0, 2, ',', '.') }}">
                </div>
                <div class="col-sm-1">
                  @if (isset($package_charge))
                    <a href="#" onclick="update();" id="btnSubmit" type="button" class="btn btn-success">Actualizar</a>
                  @else
                    <button type="submit" class="btn btn-primary">Agregar</button>
                  @endif
                </div>
                </div>
              </div>
            </form>
          </div>
        </div>
          <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
      
        <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Concepto</th>
              <th>Monto</th>
              <th></th>
            </tr>
          </thead>
          @php
              $total_amount = 0;
          @endphp
          @isset($package_charges)
            @foreach ($package_charges as $package_charge)
            @php
                $total_amount += $package_charge->amount;
            @endphp
            <tr>
              <td>{{$package_charge->concept}}</td>
              <td>{{ number_format($package_charge->amount ?? 0, 2, ',', '.') }}</td>
              <td>
                <a href="{{ route('package_charges.edit',[$package_charge->id,$package_charge->id_package]) }}"  title="Editar"><i class="fa fa-edit"></i></a>
                <a href="#" class="delete" data-id-package_charge={{$package_charge->id}} data-toggle="modal" data-target="#deleteModal" title="Eliminar"><i class="fa fa-trash text-danger"></i></a>  
              </td>
            </tr>
            @endforeach
          @endisset
          <tr>
            <td>Total a Pagar por envio....</td>
            <td>{{ number_format($total_amount ?? 0, 2, ',', '.') }}</td>
            <td></td>
          </tr>

          </table>
        </div>
      </div>
    </div>
</div>
    </div>
  </div>
</div>
<!-- Delete Warning Modal -->
<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
          <form action="{{ route('package_charges.delete') }}" method="post">
              @csrf
              @method('DELETE')
              <input id="id_package_charge_modal" type="hidden" class="form-control @error('id_package_charge_modal') is-invalid @enderror" name="id_package_charge_modal" readonly required autocomplete="id_package_charge_modal">
                     
              <h5 class="text-center">Seguro que desea eliminar?</h5>
              
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-danger">Eliminar</button>
          </div>
          </form>
      </div>
  </div>
</div>
@endsection

@section('validation')

<script>
    $(document).on('click','.delete',function(){
         
         let id_package_charge = $(this).attr('data-id-package_charge');
 
         $('#id_package_charge_modal').val(id_package_charge);
     });

     $(document).ready(function () {
        $("#amount").mask('000.000.000.000.000,00', { reverse: true });
        
    });    

  
    
</script>
@isset($package_charge)
  <script>
     function update(){
        document.getElementById("form").action = "{{ route('package_charges.update',$package_charge->id) }}";
        document.getElementById("form").submit();
      }
  </script>
@endisset
@endsection
