@extends('admin.layouts.dashboard')

@section('content')

{{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}

<div class="right_col" role="main">
  <div class="col-md-12 col-sm-12 ">
    
<form method="POST" action="{{ route('consolidados.aerial') }}" enctype="multipart/form-data" >
  @csrf
    <div class="x_panel">
      <div class="x_title">
        <div class="col-sm-8">
          <h2>Listado de Paquetes del Cliente Aéreo</h2>
        </div>
        <input type="hidden" id="id_client" name="id_client" value="{{ $client->id ?? null }}">

        <div class="col-sm-3">
          <button type="submit" class="btn btn-round btn-primary">Consolidar Aéreo</button>
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
                <div class="card-box table-responsive">
    
        <table id="datatable-buttons" class="table table-striped jambo_table bulk_action" style="width:100%">
          <thead>
            <tr>
              <th>
                <input type="checkbox" id="check-all" class="flat">
              </th>
              <th>N°</th>
              <th>Tracking</th>
              <th>Cliente</th>
              <th>Casillero</th>
              <th>Descripcion</th>
              <th>PC</th>
              <th>P</th>
              <th>PV</th>
              <th>Tipo</th>
              <th>Agente</th>
              <th>Oficina</th>
            </tr>
          </thead>
          @isset($packages)
            @foreach ($packages as $package)
              @if ($package->instruction == 'Aéreo')
                <tr>
                  <td class="a-center ">
                    <input type="checkbox"  name="checkAerial{{$package->id}}" class="flat" value="{{ $package->id }}" id="flexCheckCheckedAerial">    
                  </td>
                  <td class="text-center">
                    <a href="{{ route('packages.create',$package->id) }}"  title="Seleccionar">{{$package->id}}</a>
                  </td>
                  <td>{{$package->tracking ?? ''}}</td>
                  <td>{{$package->clients['firstname'] ?? ''}} {{$package->clients['firstlastname'] ?? ''}}</td>
                  <td>{{$package->clients['casillero'] ?? ''}}</td>
                  <td>{{$package->description ?? ''}}</td>
                  <td>{{$package->cubic_foot ?? 0}}</td>
                  <td>{{$package->starting_weight ?? 0}}</td>
                  <td>{{$package->volume ?? 0}}</td>
                  <td>{{$package->instruction ?? ''}}</td>
                  <td>{{$package->vendors['name'] ?? ''}}</td>
                  <td>{{$package->office_locations['direction'] ?? ''}}</td>
                </tr>
              @endif
            @endforeach
            <tr>
              <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total</td>
            <td>{{$cubic_foot ?? 0}}</td>
            <td>{{$starting_weight ?? 0}}</td>
            <td>{{$volume ?? 0}}</td>
            <td></td>
            <td></td>
            <td></td>
            </tr>
          @endisset
        </table>
     
        </div>
     
      </div>
    </div>
</div>
    </div>

  </form>
  <form method="POST" action="{{ route('consolidados.maritime') }}" enctype="multipart/form-data" >
    @csrf
    <div class="x_panel">
      <div class="x_title">
        <div class="col-sm-8">
          <h2>Listado de Paquetes del Cliente Marítimo</h2>
        </div>
        <div class="col-sm-3">
          <button type="submit" class="btn btn-round btn-primary">Consolidar Marítimo</button>
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
                <div class="card-box table-responsive">
      
        <table id="datatable" class="table table-striped jambo_table bulk_action" style="width:100%">
          <thead>
            <tr>
              <th>
                <input type="checkbox" id="check-all2" class="flat">
              </th>
              <th>N°</th>
              <th>Tracking</th>
              <th>Cliente</th>
              <th>Casillero</th>
              <th>Descripcion</th>
              <th>Tipo</th>
              <th>Agente</th>
              <th>Oficina</th>
            </tr>
          </thead>
          @isset($packages)
            @foreach ($packages as $package)
            @if ($package->instruction == 'Marítimo')
              <tr>
                <td class="a-center ">
                  <input type="checkbox"  name="checkMaritime{{$package->id}}" class="flat" value="{{ $package->id }}" id="flexCheckCheckedMaritime">    
                </td>
                <td class="text-center">
                  <a href="{{ route('packages.create',$package->id) }}"  title="Seleccionar">{{$package->id}}</a>
                </td>
                <td>{{$package->tracking ?? ''}}</td>
                <td>{{$package->clients['firstname'] ?? ''}} {{$package->clients['firstlastname'] ?? ''}}</td>
                <td>{{$package->clients['casillero'] ?? ''}}</td>
                <td>{{$package->description ?? ''}}</td>
                <td>{{$package->instruction ?? ''}}</td>
                <td>{{$package->vendors['name'] ?? ''}}</td>
                <td>{{$package->office_locations['direction'] ?? ''}}</td>
              </tr>
            @endif
            @endforeach
          @endisset
          

          </table>
        </div>
      </div>
    </div>
    </div>
    </div>

  </form>



  </div>
</div>


<div class="modal modal-danger fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Verificar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <h5 class="text-center">Seguro que desea Consolidar los Paquetes Aereos?</h5>
              
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button onclick="consolidarAerial();" class="btn btn-danger">Consolidar</button>
          </div>
          </form>
      </div>
  </div>
</div>


@endsection

@section('validation')

<script>

    $('.bulk_action input#check-all').on('ifChecked', function () {
      checkState = 'all';
      countChecked();
    });
    $('.bulk_action input#check-all').on('ifUnchecked', function () {
      checkState = 'none';
      countChecked();
    });

    function countChecked() {
      if (checkState === 'all') {
          $(".bulk_action input[id='flexCheckCheckedAerial']").iCheck('check');
      }
      if (checkState === 'none') {
          $(".bulk_action input[id='flexCheckCheckedAerial']").iCheck('uncheck');
      }

      var checkCount = $(".bulk_action input[id='flexCheckCheckedAerial']:checked").length;

      if (checkCount) {
          $('.column-title').hide();
          $('.bulk-actions').show();
          $('.action-cnt').html(checkCount + ' Records Selected');
      } else {
          $('.column-title').show();
          $('.bulk-actions').hide();
      }
    }








    

    $('.bulk_action input#check-all2').on('ifChecked', function () {
      checkState2 = 'all';
      countChecked2();
    });
    $('.bulk_action input#check-all2').on('ifUnchecked', function () {
      checkState2 = 'none';
      countChecked2();
    });

    function countChecked2() {
      if (checkState2 === 'all') {
          $(".bulk_action input[id='flexCheckCheckedMaritime']").iCheck('check');
      }
      if (checkState2 === 'none') {
          $(".bulk_action input[id='flexCheckCheckedMaritime']").iCheck('uncheck');
      }

      var checkCount2 = $(".bulk_action input[id='flexCheckCheckedMaritime']:checked").length;

      if (checkCount2) {
          $('.column-title').hide();
          $('.bulk-actions').show();
          $('.action-cnt').html(checkCount2 + ' Records Selected');
      } else {
          $('.column-title').show();
          $('.bulk-actions').hide();
      }
    }

</script>
@endsection
