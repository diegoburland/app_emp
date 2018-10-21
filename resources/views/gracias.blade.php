@extends('layouts.master_eval')

@section('title', 'Evaluar Empresa - VidAndWork.com')


@section('content')


@section('head')
<script type="text/javascript" src="/js/jquery.numeric-min.js?v={{ time() }}"></script>
<script type="text/javascript" src="/js/empresa/evaluacion.js?v={{ time() }}"></script>
<script type="text/javascript">
function ir_a_vw() {

    window.location.href = "http://vidaandwork.com/";

}
    
$(function () {

    $('#myModal').modal();

    

});

</script>

@endsection

<div class="modal" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Información importante</h5>
                <!--button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="ir_a_vw()">
                    <span aria-hidden="true">&times;</span>
                </button-->
            </div>
            <div class="modal-body">
                <p>Te enviamos un correo con un enlace de verificación. 
                    Por favor, ingresa a tu cuenta de correo y dale click. </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="ir_a_vw()">¡Listo!</button>
            </div>
        </div>
    </div>
</div>

@endsection