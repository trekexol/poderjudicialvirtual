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


          <div class="col-sm-2 h6">
            Entrada de Paquetes
          </div>
          <div class="col-sm-1">
              <a href="{{ route('package_exports.exportPackageTemplate') }}" type="submit" class="btn btn-success offset-sm-1" id="BtnPackage" title="Descargar plantilla"><i class="fa fa-download"></i></a>
            </div>
            <div class="col-sm-4">
              <form id="fileForm" method="POST" action="{{ route('package_imports.importPackageTemplate') }}" enctype="multipart/form-data" >
                @csrf
                <input id="file" type="file"  value="import" accept=".xlsx" name="file" class="file">
              </form>
            </div>
            
        <form action="{{ route('trakings.packageWithTracking') }}" method="POST" enctype="multipart/form-data" id="form" data-parsley-validate class="form-horizontal form-label-left">
          @csrf 
          <div class="col-sm-2">
            <input type="text" id="tracking" name="tracking" class="form-control" required>       
          </div>
          <div class="col-sm-3">
            <button type="submit" class="btn btn-round btn-primary ">Escanear Tracking</button>
          </div>
         
          <div class="clearfix"></div>
        </form>
      </div>
      <div class="x_content">
          <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
      
        <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Tracking</th>
              <th>N° Paquete</th>
              <th></th>
            </tr>
          </thead>
          @isset($package_trackings)
            @foreach ($package_trackings as $package_tracking)
            <tr>
              <td>
                <a href="{{ route('packages.createByTracking',$package_tracking->tracking) }}"  title="Mostrar">{{ $package_tracking->tracking }}</a>
              </td>
              <td>{{$package_tracking->id}}</td>
              <td>
               <a href="{{ route('historial_status.viewPackage',$package_tracking->id) }}"  title="Ver Historial de Status"><i class="fa fa-question"></i></a>
               <a href="#" class="delete" data-id-package={{$package_tracking->id}} data-toggle="modal" data-target="#deleteModal" title="Eliminar"><i class="fa fa-trash text-danger"></i></a>  
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
    $(document).on('click','.delete',function(){
         
         let id_package = $(this).attr('data-id-package');
 
         $('#id_package_modal').val(id_package);
     });

     $("#file").on('change',function(){
      
      var file = document.getElementById("file").value;

      /*Extrae la extencion del archivo*/
      var basename = file.split(/[\\/]/).pop(),  // extract file name from full path ...
                                          // (supports `\\` and `/` separators)
      pos = basename.lastIndexOf(".");       // get last position of `.`

      if (basename === "" || pos < 1) {
          alert("El archivo no tiene extension");
      }          
      /*-------------------------------*/     

      if(basename.slice(pos + 1) == 'xlsx'){
        document.getElementById("fileForm").submit();
      }else{
        alert("Solo puede cargar archivos .xlsx");
      }            
          
  });

</script>
@endsection
