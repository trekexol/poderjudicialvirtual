@if(Session::has('success'))
<div class="col-sm-11 offset-sm-1">
    <div id="alerta" class="alert alert-success alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        {{Session::get('success')}}
    </div>
</div>
@endif

@section('validacion_time')

<script>
  $(document).ready(function() {
    setTimeout(function() {
        $("#alerta").fadeOut(1500);
    },5000);
 
   
});
  
</script>
    
@endsection
