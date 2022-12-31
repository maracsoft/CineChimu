<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8"/>
     <title>CINE CHIMÚ | Registrarme</title>
	 <link rel="shortcut icon" href="/img/LogoCedepas.png" type="image/png">
  
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta content="width=device-width, initial-scale=1.0" name="viewport"/>      
     <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
     <link rel="stylesheet" href="/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
     <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
     <link rel="stylesheet" href="/stylebonis.css">
     <link rel="stylesheet" href="css/login.css">
     <link rel="stylesheet" href="css/style.css">
     <link  rel="stylesheet" href="public/uicons-regular-rounded/css/uicons-regular-rounded.css">
     <link rel="stylesheet" href="/adminlte/dist/css/sweetalert.css">

</head>
<body>
  <div class="loader hidden" id="pantallaCarga"></div>

  <div class="conteiner">
     
    <div class="login-wrap">
        

      <form method="POST" action="{{route('user.registrarUsuario')}}" name="form">
        @csrf  
        <div class="login-html">
          <div>

          
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
            <label for="tab-1" class="tab" style="font-size: xx-large">
              Registrarme
            </label>


            <input id="tab-2" type="radio" name="tab" class="sign-up">
            <label for="tab-2" class="tab"> </label>


            <div class="login-form">
              <div class="sign-in-htm">

                <div class="group flex">
                  <div class="">
                    <label for="user" class="label" style="font-size: medium">DNI</label>
                    <input type="number" class="text-center inputDNI" placeholder="Ingrese DNI"  id="dni" name="dni" value="">  
                  </div>
                  <div class="flex-grow">
                    <label for="user" class="label" style="font-size: medium">Nombre</label>
                    <input type="text" class="text-center nombreCompleto bloqued w-100" placeholder="Su nombre aparecerá aquí..." readonly id="nombreCompleto" name="nombreCompleto" value="">
                  </div>
                  
                </div>

                <div class="group">
                  <label for="user" class="label" style="font-size: medium">Usuario</label>
                  <input type="text" class="input " placeholder="Ingrese usuario" 
                    id="usuario" name="usuario" value="">
                  
                </div>
              
                
                <div class="group">
                  <label for="pass" class="label" style="font-size: medium">Contraseña</label>
                  <input placeholder="Ingrese contraseña"  id="password" name="password"
                    type="password" class="input " data-type="password">
                  
                </div>
                
                <div class="group">
                  <label for="pass" class="label" style="font-size: medium">Repetir Contraseña</label>
                  <input placeholder="Ingrese contraseña"  id="password2" name="password2"
                    type="password" class="input " data-type="password">
                  
                </div>
                
                <div class="group text-center">
                  <button id="ingresar" name="ingresar" type="button" onclick="clickSubmit()" class="botonPrincipal" value="Ingresar">
                    Registrarme
                  </button>
                  <div class="div-no-tienes">
                    ¿Ya tienes cuenta?
                    <a href="/login">
                      <span class="linkRegistrarme">
                        Iniciar Sesión
                      </span>
                    </a>
                  </div>
                </div>
              </div>

              
        
            </div>
          </div>
          <div class="text-center">
            
            <img src="/img/CineChimu.png" height="140" >
          </div>
        </div>
        
      </form>


    </div>
  </div>
  
</body>
<style>


</style>
@include('Layout.ValidatorJS')
<script src="/adminlte/dist/js/sweetalert.min.js"></script>

<script>
  
  const nombreC =  document.getElementById('nombreCompleto') 


  async function clickSubmit(){
    var msj = await validarForm();
    if(msj!=""){
      alerta(msj);
      return;
    }

    
    setTimeout(function () {
      document.form.submit();
    }, 2000);
    
  }

  async function validarForm(){
    msj = "";
    
    msj = validarTamañoExacto(msj,'dni',8,'DNI')
    
    msj = validarTamañoMaximoYNulidad(msj,'usuario',50,'Nombre de usuario');
    msj = validarTamañoMaximoYNulidad(msj,'password',50,'Contraseña');
    msj = validarTamañoMaximoYNulidad(msj,'password2',50,'Repetir Contraseña');
    msj = validarContenidosIguales(msj,'password','password2','Las contraseñas deben coincidir');
    
    if(msj=="")
      msj = await validarDNI();
    
    return msj;
  }

  async function validarDNI(){
    msj = "";
    /* Validamos el dni */
    var dni = document.getElementById('dni').value
    var username = document.getElementById('usuario').value
    startLoader();
    var obj = await consultarPorDniYUsuario(dni,username)
    finishLoader();
    if(obj.ok == "1"){
      var persona = obj.datos;
      nombreC.value = persona.apellidoPaterno + " " +  persona.apellidoMaterno + " " + persona.nombres; 
      nombreC.classList.remove('bloqued');
      nombreC.classList.add('ready');
    }else{
      msj = obj.mensaje;
      nombreC.value = "";
      nombreC.classList.add('bloqued');
      nombreC.classList.remove('ready');
    }

    return msj;

  }

  async function consultarPorDniYUsuario(dni,username){
    const response = await fetch("/usuarios/consultarPorDni/" + dni + "*" + username)
    const data = await response.json();
    return data;

  } 

  const loader = document.getElementById('pantallaCarga')
  function startLoader(){
    loader.classList.remove('hidden')
  }
  function finishLoader(){
    loader.classList.add('hidden')
  }


</script>

<script>
  function alerta(msj){
      swal(//sweetalert
          {
              title: 'Error',
              text: msj,     //mas texto
              type: 'warning',//e=[success,error,warning,info]
              showCancelButton: false,//para que se muestre el boton de cancelar
              confirmButtonColor: '#3085d6',
              //cancelButtonColor: '#d33',
              confirmButtonText:  'OK',
              //cancelButtonText:  'NO',
              closeOnConfirm:     true,//para mostrar el boton de confirmar
              html : true
          },
          function(){//se ejecuta cuando damos a aceptar
              
          }
      );
  }
  function alertaMensaje(title,msj,type){
      swal(//sweetalert
          {
              title: title,
              text: msj,     //mas texto
              type: type,//e=[success,error,warning,info]
              showCancelButton: false,//para que se muestre el boton de cancelar
              confirmButtonColor: '#3085d6',
              //cancelButtonColor: '#d33',
              confirmButtonText:  'OK',
              //cancelButtonText:  'NO',
              closeOnConfirm:     true,//para mostrar el boton de confirmar
              html : true
          },
          function(){//se ejecuta cuando damos a aceptar
              
          }
      );
  }

</script>
</html>