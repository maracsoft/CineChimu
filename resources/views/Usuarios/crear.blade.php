@extends('Layout.Plantilla')

@section('titulo')
    Crear Usuario
@endsection

@section('contenido')

<form id="frmCrearUsuario" name="frmCrearUsuario" role="form" action="{{route("Usuarios.Guardar")}}" 
    class="form-horizontal form-groups-bordered" method="post">

@csrf 


  <div class="well">
      <H3 style="text-align: center;">
          Nuevo Usuario
      </H3>
  </div>

  <div class="">

    <div class="row mx-5">
     

        <div class="col" style="">
            
          <div class="row">
              <div class="col-2">
                  <label class="" style="">Usuario:</label>
                  <div class="">
                      <input type="text" class="form-control" id="usuario" name="usuario" 
                          value="" placeholder="Usuario..." >
                  </div>
              </div>
              
              <div class="col-2">
                  <label class="" style="">DNI:</label>
                  <div class="">
                      <input type="number" class="form-control" id="dni" name="dni" 
                          value="" placeholder="Contraseña..." >
                  </div>
              </div>


              
              <div class="col-2">
                <label class="" style="">Nombres:</label>
                <div class="">
                    <input type="text" class="form-control" id="nombres" name="nombres" 
                        value="" placeholder="Contraseña..." >
                </div>
              </div>

              <div class="col-2">
                <label class="" style="">Apellidos:</label>
                <div class="">
                    <input type="text" class="form-control" id="apellidos" name="apellidos" 
                        value="" placeholder="Contraseña..." >
                </div>
              </div>

              
              <div class="col-2">
                <label class="" style="">Contraseña:</label>
                <div class="">
                    <input type="password" class="form-control" id="password1" name="password1" 
                        value="" placeholder="Contraseña..." >
                </div>
              </div>

              <div class="col-2">
                  <label class="" style="">Repetir Contraseña:</label>
                  <div class="">
                      <input type="password" class="form-control" id="password2" name="password2" 
                          value="" placeholder="Contraseña..." >
                  </div>
              </div>

              <div class="w-100"></div>
              <br>

              <div class="col" style=" text-align:center">
                  
                  <button type="button" class="btn btn-primary float-right" id="btnRegistrar" data-loading-text="<i class='fa a-spinner fa-spin'></i> Registrando" 
                      onclick="clickGuardar()">
                      <i class='fas fa-save'></i> 
                      Registrar
                  </button> 
                  
                  <a href="{{route('Usuarios.Listar')}}" class='btn btn-info float-left'>
                      <i class="fas fa-arrow-left"></i> 
                      Regresar al Menú
                  </a>

              </div>

          </div>

               
        </div>
        


    </div>

 
  </div>

</form>

@include('Layout.ValidatorJS')
<script type="text/javascript"> 
       

    function clickGuardar(){
        msj = validarFormulario();
        if(msj!=''){
            alerta(msj);
            return;
        }
        
        confirmarConMensaje('Confirmacion','¿Desea crear el usuario?','warning',ejecutarSubmit);
    }

    function ejecutarSubmit(){

        document.frmCrearUsuario.submit(); // enviamos el formulario	  

    }

 
    function validarFormulario(){
        limpiarEstilos(
            ['usuario','password1','password2']);
        msj = "";

        msj = validarTamañoMaximoYNulidad(msj,'usuario',100,'Usuario');
        msj = validarTamañoMaximoYNulidad(msj,'password1',200,'Contraseña');
        msj = validarTamañoMaximoYNulidad(msj,'password2',200,'Repetir contraseña');
        msj = validarContenidosIguales(msj,'password1','password2','Las contraseñas deben coincidir');

        return msj;

    }
    
</script>
@endsection