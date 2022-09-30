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
        <div class="col-sm-2">
          <h2>Listado de Paquetes</h2>
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
              <form id="formSearch" method="POST" action="{{ route('package_searchs.index') }}" enctype="multipart/form-data" >
                @csrf
              <div class="item form-group">
                <label class="col-form-label col-sm-1 label-align " for="first-name">Oficina:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control" name="id_agency" required>
                      @if (isset($agency_search))
                        <option value="{{ $agency_search->id ?? null }}">{{ $agency_search->name ?? null }} </option>
                        <option value="">---------------------</option>
                      @else
                        <option value="">Seleccione una Opción</option>
                      @endif
                      @if (isset($agencies))
                        @foreach ($agencies as $agency)
                          <option value="{{ $agency->id }}">{{ $agency->name ?? '' }} </option>
                        @endforeach
                      @endif
                    </select>
                </div>
                <label class="col-form-label col-sm-1 label-align " for="id_wharehouse">Almacen:</label>
                <div class="col-sm-3">
                    <select class="select2_group form-control" name="id_wharehouse" required>
                      @if (isset($wharehouse_search))
                        <option value="{{ $wharehouse_search->id ?? null }}">{{ $wharehouse_search->name ?? null }}</option>
                        <option value="">---------------------</option>
                      @else
                        <option value="">Seleccione una Opción</option>
                      @endif
                      @if (isset($wharehouses))
                        @foreach ($wharehouses as $wharehouse)
                          <option value="{{ $wharehouse->id }}">{{ $wharehouse->name ?? '' }}</option>
                        @endforeach
                      @endif
                    </select>
                </div>
                <label class="col-form-label col-sm-1 label-align " for="client">Cliente:</label>
                <div class="col-sm-2">
                  <input type="text" id="client" name="client"  class="form-control " value="{{ $search_client ?? null }}">
                </div>
                <a href="#" onclick="searchIndex();" title="Buscar" ><i class="fa fa-search"></i></a>  
              </div>
              </form>
        <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>N°</th>
              <th>Pz</th>
              <th>Tracking</th>
              <th>Cliente</th>
              <th>Casillero</th>
              <th>Descripcion</th>
              <th>Tipo</th>
              <th>Oficina</th>
              <th></th>
            </tr>
          </thead>
          @isset($packages)
            @foreach ($packages as $package)
            <tr>
              <td class="text-center">
                <a href="{{ route('packages.create',$package->id) }}"  title="Seleccionar">{{$package->id}}</a>
              </td>
              <td>{{$package->count_package_lumps ?? ''}}</td>
              <td>{{$package->tracking ?? ''}}</td>
              <td>{{$package->firstname ?? ''}} {{$package->firstlastname ?? ''}}</td>
              <td>{{$package->casillero ?? ''}}</td>
              <td>{{$package->description ?? ''}}</td>
              <td>{{$package->instruction ?? ''}}</td>
              <td>{{$package->agency ?? ''}}</td>
              <td>
                <a href="{{ route('packages.print',$package->id) }}"  title="Editar"><i class="fa fa-print"></i></a>
                <a href="#" class="delete" data-id-package={{$package->id}} data-toggle="modal" data-target="#deleteModal" title="Eliminar"><i class="fa fa-trash text-danger"></i></a>  
              </td>
            </tr>
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
          <form action="{{ route('packages.delete') }}" method="post">
              @csrf
              @method('DELETE')
              <input id="id_package_modal" type="hidden" class="form-control @error('id_package_modal') is-invalid @enderror" name="id_package_modal" readonly required autocomplete="id_package_modal">
                     
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
    function searchIndex(){
      document.getElementById("formSearch").submit();
    }


    $(document).on('click','.delete',function(){
         
         let id_package = $(this).attr('data-id-package');
 
         $('#id_package_modal').val(id_package);
     });

    
</script>
@endsection
