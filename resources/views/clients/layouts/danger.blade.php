@if(Session::has('danger'))
<div class="col-sm-11 offset-sm-1">
    <div id="alerta_danger" class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{Session::get('danger')}}
    </div>
</div>
@endif


