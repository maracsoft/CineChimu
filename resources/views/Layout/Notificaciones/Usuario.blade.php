{{-- EN ESTE VAN LAS SOLICITUDES POR RENDIR Y LAS OBSERVADAS --}}



<div class="flex-column mx-3 text-right fontSize11  d-none d-sm-flex">

  <span class="mb--1 font-weight-bold" title="Nombre de usuario">
    {{$userLogeado->usuario}}
  </span>
  <span>
    {{$userLogeado->getNombreCompleto()}}
  </span>
</div>
<li class="nav-item dropdown">
  
    {{-- CABECERA DE TODA LA NOTIF  --}}
    <a class="nav-link btn btn-info" style="color:beige" data-toggle="dropdown" href="#">
      <i class="far fa-user"></i>
      Cuenta
      
    </a>



    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right ">
        
          
         

         
        <a href="" class="dropdown-item">
          <div class="media" >
            <i class="fas fa-address-card"></i> &nbsp;
            
              <h3 class="dropdown-item-title">
                Mis Datos
                <span class="float-right text-sm text-warning"></span>
              </h3>
              
          </div>
        </a>
        <a href=" " class="dropdown-item">
          <div class="media" >
            <i class="fas fa-unlock-alt"></i> &nbsp;
              <h3 class="dropdown-item-title">
                Cambiar Contraseña
                <span class="float-right text-sm text-warning"></span>
              </h3>
              
          </div>
        </a>
        <a href="#" onclick="confirmarCerrarSesion()" class="dropdown-item">
          <div class="media" >
              <i class="fas fa-sign-out-alt"></i> &nbsp;
            
              <h3 class="dropdown-item-title">
                Cerrar Sesión
                <span class="float-right text-sm text-warning"></span>
              </h3>
              
          </div>
        </a>
        

    </div>


</li> 

 