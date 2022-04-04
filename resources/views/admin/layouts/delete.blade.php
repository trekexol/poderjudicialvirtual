@if(Session::has('delete'))
<div class="col-sm-11 offset-sm-1">
    <div id="alerta_delete" class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{Session::get('delete')}}
    </div>
</div>
@endif

