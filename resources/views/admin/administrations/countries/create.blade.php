@extends('admin.layouts.dashboard')

@section('content')

{{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}
<div class="right_col" role="main">

    <div class="x_content">
        <br />
        <form method="POST" action="{{ route('countries.store') }}" id="form_contacto" data-parsley-validate class="form-horizontal form-label-left">
        @csrf
                
             <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Contacto</label>
                                <input type="text" class="form-control" name="nombre_contacto">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Número</label>
                                <input type="text" class="form-control" name="numero">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" id="agregar">Agregar campo +</button>
                            </div>
                        </div>
                        <div class="form-row clonar">
                            <div class="form-group col-md-12">
                                <label for="">Nombres</label>
                                <input type="text" class="form-control" name="nombres[]">
                                <span class="badge badge-pill badge-danger puntero ocultar">Eliminar</span>
                            </div>
                        </div>
                        <div id="contenedor"></div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <button class="btn btn-primary" id="enviar_contacto">Enviar</button>
                            </div>
                        </div>
        </form>
    </div>
</div>

@endsection

@section('validation')
<script>
    
        let agregar = document.getElementById('agregar');
        let contenido = document.getElementById('contenedor');

        let boton_enviar = document.querySelector('#enviar_contacto')

        agregar.addEventListener('click', e =>{
            e.preventDefault();
            let clonado = document.querySelector('.clonar');
            let clon = clonado.cloneNode(true);

            contenido.appendChild(clon).classList.remove('clonar');

            let remover_ocutar = contenido.lastChild.childNodes[1].querySelectorAll('span');
            remover_ocutar[0].classList.remove('ocultar');
        });

        contenido.addEventListener('click', e =>{
            e.preventDefault();
            if(e.target.classList.contains('puntero')){
                let contenedor  = e.target.parentNode.parentNode;
            
                contenedor.parentNode.removeChild(contenedor);
            }
        });


        boton_enviar.addEventListener('click', e => {
            e.preventDefault();

            const formulario = document.querySelector('#form_contacto');
            const form = new FormData(formulario);

            const peticion = {
                body:form,
                method:'POST'
            };
       
            document.getElementById("form_contacto").submit();

        });


    </script>
@endsection
