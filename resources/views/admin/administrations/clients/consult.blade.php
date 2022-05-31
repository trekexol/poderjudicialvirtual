@extends('admin.layouts.dashboard')

@section('content')

{{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}
<div class="right_col" role="main">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <div class="col-sm-8">
          <h2>Listado de Paquetes del Cliente Aéreo</h2>
        </div>
      <form method="POST" action="{{ route('consolidados.aerial') }}" id="form" data-parsley-validate class="form-horizontal form-label-left">
        @csrf 
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
                    <input type="checkbox" class="flat" name="table_records" id="{{$package->id}}" value="{{$package->id}}">
                  </td>
                  <td class="text-center">
                    <a href="{{ route('packages.create',$package->id) }}"  title="Seleccionar">{{$package->id}}</a>
                  </td>
                  <td>{{$package->tracking ?? ''}}</td>
                  <td>{{$package->clients['firstname'] ?? ''}} {{$package->clients['firstlastname'] ?? ''}}</td>
                  <td>{{$package->clients['type_cedula'] ?? ''}}{{$package->clients['cedula'] ?? ''}}</td>
                  <td>{{$package->description ?? ''}}</td>
                  <td>{{$package->instruction ?? ''}}</td>
                  <td>{{$package->vendors['name'] ?? ''}}</td>
                  <td>{{$package->office_locations['direction'] ?? ''}}</td>
                </tr>
              @endif
            @endforeach
          @endisset
        </table>
      </form>
        </div>
      </div>
    </div>
</div>
    </div>




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
                  <input type="checkbox" class="flat" name="table_records2">
                </td>
                <td class="text-center">
                  <a href="{{ route('packages.create',$package->id) }}"  title="Seleccionar">{{$package->id}}</a>
                </td>
                <td>{{$package->tracking ?? ''}}</td>
                <td>{{$package->clients['firstname'] ?? ''}} {{$package->clients['firstlastname'] ?? ''}}</td>
                <td>{{$package->clients['type_cedula'] ?? ''}}{{$package->clients['cedula'] ?? ''}}</td>
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





  </div>
</div>



@endsection

@section('validation')

<script>
   $('.bulk_action input#check-all2').on('ifChecked', function () {
    checkState = 'all';
    countChecked2();
});
$('.bulk_action input#check-all2').on('ifUnchecked', function () {
    checkState = 'none';
    countChecked2();
});

function countChecked2() {
    if (checkState === 'all') {
        $(".bulk_action input[name='table_records2']").iCheck('check');
    }
    if (checkState === 'none') {
        $(".bulk_action input[name='table_records2']").iCheck('uncheck');
    }

    var checkCount = $(".bulk_action input[name='table_records2']:checked").length;

    if (checkCount) {
        $('.column-title').hide();
        $('.bulk-actions').show();
        $('.action-cnt').html(checkCount + ' Records Selected');
    } else {
        $('.column-title').show();
        $('.bulk-actions').hide();
    }
}

</script>
@endsection
