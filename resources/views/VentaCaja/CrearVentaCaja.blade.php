@extends('Layout.Plantilla')

@section('titulo')
  Crear Venta
@endsection

@section('tiempoEspera')
    <div class="loader" id="pantallaCarga"></div>
@endsection

@section('contenido')

 
@include('Layout.MensajeEmergenteDatos')

<form method = "POST" action = "{{route('Ventas.Guardar')}}" id="formVenta" name="formVenta"  enctype="multipart/form-data">
    <input type="hidden" id="detalles_json" name="detalles_json">
    @csrf 

    <div class="card mx-2">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <div class="d-flex flex-row">
                <div class="">
                    <h3 class="card-title">
                        <b>Registrar Venta</b>
                    </h3>
                </div>
            </div>
        </div>  
        <div class="card-body">
            <div class="row">
              <div class="col-12">
                <input type="checkbox" id="esVentaAnonima" name="esVentaAnonima" onclick="togleVentaAnonima()">
                <label for="esVentaAnonima">
                  Es venta anonima
                </label>
                
              </div>

            </div>
            <div class="row" id="contenedor_cliente">
              <div class="col-10">
                <label for="" id="">
                  Cliente
                </label>
                <div class="d-flex">
                  <input type="number" class="form-control mr-1" name="dni" id="dni" placeholder="Buscar por DNI" value="">
                  <div id="btn_buscarPorDni">
                    <button  class="btn btn-success mr-1 h-100" onclick="buscarPorDNI()" type="button">
                      <i class="fas fa-search "></i>
                    </button>
                  </div>

                  <div id="btn_reiniciarCliente" class="d-none">
                    <button  class="btn btn-danger mr-1 h-100" onclick="reiniciarCliente()" type="button" title="Cambiar cliente">
                      <i class="fas fa-trash "></i>
                    </button>
                  </div>

                  
                  <input type="text" class="form-control" id="nombre_cliente" placeholder="Nombre del cliente" value="" readonly>
                  <input type="hidden" name="codUsuarioComprador" id="codUsuarioComprador" value="-1">
                </div>
              </div>
              <div class="col-1 text-left">
                <label for="" id="">
                  Validado:
                </label>
                <div class="text-left">
                  <div type="checkbox" class="clientIsValid" name="clientIsValid" id="clientIsValid">
                    <i id="client-valid-icon" class="fas fa-2x fa-times color-red"></i>
                    
                  </div>
                </div>
                
              </div>
            </div>
            <div class="row">

              <div class="col-12 col-sm-4">
                <label for="" id="">
                  Cajero:
                </label>
                <input type="text" class="form-control" name="" id="" value="{{$usuarioCajero->getNombreCompleto()}}" readonly>

              </div>
              
              <div class="col-12 col-sm-3">
                
            
                <label for="" id="">
                  Método de Pago
                </label>
                <select class="form-control" name="codMetodo" id="codMetodo">
                  <option value="-1">Método de Pago</option>
                  @foreach ($metodosPago as $metodo)
                    <option value="{{$metodo->getId()}}">
                      {{$metodo->nombre}}
                    </option>
                  @endforeach
                </select>
                
              </div>

              <div class="col-12 col-sm-5">
                <label for="">
                  Función
                </label>
                <select class="form-control" name="codFuncion" id="codFuncion">
                  <option value="0">- Funciones de Hoy -</option>
                  <option value="-1">Ninguna Función</option>
                  @foreach ($funcionesDeHoy as $funcion)
                    <option value="{{$funcion->getId()}}">
                      {{$funcion->getTextoResumenHoy()}}
                    </option>
                  @endforeach
                  
               
                </select>

              </div>
              <div class="col-12 col-sm-12">
                <label for="" id="">
                  Comentario
                </label>
                <textarea name="comentario" id="comentario" class="form-control" cols="30" rows="1"></textarea>
                
              </div>

            </div>
          
            <div class="col-12 contenedor-detalles p-2 mt-2">
              <div>
                <label for="">
                  Detalle de la venta
                </label>
              </div>
              <div class="d-flex">

                <select class="form-control select2 select2-hidden-accessible selectpicker" id="codProductoAñadir" onchange="clickAñadirDetalle()" data-select2-id="1" tabindex="-1" aria-hidden="true" data-live-search="true" >
                  <option value="-1">- Seleccione Producto para añadir-</option>          
                  @foreach($listaProductos as $producto)
                    <option value="{{$producto->getId()}}" >
                      {{$producto->nombre}} - S/ {{number_format($producto->precioVenta,2)}}
                    </option>                                 
                  @endforeach
                </select>
                
              </div>
              <div>

                              
                <table class="table table-bordered tabla-detalles table-sm my-2">
                  <thead class="thead-dark">
                    <tr>
                      <th>#</th>
                      <th>Producto</th>
                      <th class="text-right">P. Unit</th>
                      <th class="text-right">Cant</th>
                      <th class="text-right">Subtotal</th>

                      <th class="text-center">Opciones</th>
                    </tr>
                  </thead>
                  <tbody id="tbody_detalles">
                    
                  </tbody>
                </table>


              </div>

            </div>
              

           
            <div class="row">
                <div class="ml-auto mt-3">

                    <button type="button" class="btn btn-primary"  data-loading-text="<i class='fa a-spinner fa-spin'></i> Registrando"
                        onclick="clickGuardar()">
                        <i class='fas fa-save'></i>
                        Guardar
                    </button>

                </div>

            </div>

        </div>
    </div>

    
 
    
 
    <div class="d-flex flex-row m-4">
        <div class="">

            <a href="{{route('Ventas.Listar')}}" class='btn btn-info '>
                <i class="fas fa-arrow-left"></i>
                Regresar al Menú
            </a>

        </div>


    </div>


</form>
 
 
<div class="modal  fade" id="modalAgregarUsuario" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
          <form action="" id="frmCrearUsuario" name="frmCrearUsuario"  method="POST">
              @csrf
              <div class="modal-header">
                  <h5 class="modal-title" id="">Registrar nuevo usuario</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body row">   
                  <div class="col-6">
                      <label for="">
                        DNI
                      </label>
                      <input type="number" class="form-control" id="modal_dni" name="modal_dni" value="" readonly>
                  </div>
                  <div class="col-6">
                    <label for="">
                      Correo
                    </label>
                    <input type="text" class="form-control" id="modal_email" name="modal_email" value="" placeholder="alguncorreo@example.com">
                  </div>
                  <div class="col-12">
                    <div class="msj-modal">
                      <span>
                        La contraseña por defecto es el DNI del usuario, al iniciar sesión este podrá cambiarla.
                      </span>
                    </div>
                    
                  </div>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">
                      Salir
                  </button>

                  <button type="button" class="m-1 btn btn-primary" onclick="clickGuardarUsuario()">
                      Guardar
                      <i class="fas fa-save"></i>
                  </button>
              </div>

          </form>
      </div>
  </div>
</div>


 


@endsection

{{-- ************************************************************************************************************* --}}
{{-- ************************************************************************************************************* --}}
{{-- ************************************************************************************************************* --}}
{{-- ************************************************************************************************************* --}}
{{-- ************************************************************************************************************* --}}
{{-- ************************************************************************************************************* --}}
{{-- ************************************************************************************************************* --}}
{{-- ************************************************************************************************************* --}}
{{-- ************************************************************************************************************* --}}
{{-- ************************************************************************************************************* --}}
{{-- ************************************************************************************************************* --}}

<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

@include('Layout.EstilosPegados')
@include('Layout.ValidatorJS')
@section('script')

<script type="application/javascript">

    var listaDetalles = [];
    var listaProductos = @json($listaProductos)
    
    var esVentaAnonima = false;


    const ValidClientClass = "fas fa-2x fa-check color-green";
    const InvalidClientClass = "fas fa-2x fa-times color-red";
    var isClientValid = false;
    

    document.addEventListener('DOMContentLoaded', onMounted, false);
    const IconoClientValid = document.getElementById('client-valid-icon');
    function onMounted(){
      imprimirTabla();
      setClientValid(false);
      $(".loader").hide();
    }

    const ContenedorCliente = document.getElementById('contenedor_cliente');
    const CheckboxVentaAnonima = document.getElementById('esVentaAnonima');
    function togleVentaAnonima(){
      esVentaAnonima = CheckboxVentaAnonima.checked;
      if(esVentaAnonima){
        ContenedorCliente.className = "row d-none";

      }else{
        ContenedorCliente.className = "row ";
        
      }
    }

    function clickGuardar(){
        msj = validarFormulario();
        if(msj!=''){
            alerta(msj);
            return;
        }
        
        confirmarConMensaje('Confirmacion','¿Desea registrar la venta?','warning',ejecutarSubmit);
    }

    function ejecutarSubmit(){

        document.formVenta.submit(); // enviamos el formulario	  

    }

 
    function validarFormulario(){
        limpiarEstilos(['codMetodo','comentario']);
        msj = "";
 
        
        msj = validarSelect(msj,'codMetodo',"-1",'Método de Pago');
        msj = validarSelect(msj,'codFuncion',"0",'Función');
        msj = validarTamañoMaximo(msj,'comentario',250,'Comentario de la venta');
        if(!esVentaAnonima){
          if(!isClientValid){
            msj = "El usuario comprador aun no ha sido validado."
          }
        }

        if(listaDetalles.length == 0)
          msj = "No hay items en el carrito";
         
        return msj;

    }
    



    const PlantillaHtmlFilaDetalle = /* html */
    `
      <tr>               
          <td>              
              [IndiceMostrable]
          </td>             
          <td class="nombre-producto"> 
              [NombreProducto]
          </td>               
          <td class="text-right numero">
            S/ [PrecioVenta] 
          </td>               
          <td class="text-right numero">              
            [Cantidad]
          </td>              
          <td class="text-right numero">          
            S/ [Subtotal]
          </td>              
          <td class="text-center">              
              <button type="button" class="btn btn-success btn-sm" onclick="aumentarCantidadDetalle([Index]);">
                  <i class="fas fa-plus"></i>            
              </button>        
              <button type="button" class="btn btn-success  btn-sm" onclick="reducirCantidadDetalle([Index]);">
                  <i class="fas fa-minus"></i>            
              </button>   
              <button type="button" class="btn btn-danger  btn-sm" onclick="eliminarDetalle([Index]);">
                  <i class="fa fa-times" ></i>               
              </button>         
          </td>               
      </tr>         
    `;

    const PlantillaHtmlTablaVacia = /* html */
    `
      <tr>               
        <td colspan="6" class="text-center">              
            No hay items en el carrito
        </td>
      </tr>
    `;
    const PlantillaHtmlFilaTotal = /* html */
    `
          <tr>                
              <td colspan="4" class="nombre-producto text-right">              
                  TOTAL:
              </td>                        
              <td  class="text-right numero">              
                 S/ [TotalAcumulado]
              </td>                        
              
              <td class="text-center">              
                              
              </td>               
          </tr>         
    `;

    const ContenedorDetalles = document.getElementById('detalles_json')
    const TablaDetalles = document.getElementById('tbody_detalles');
    /* RENDERIZADO TABLA */
    function imprimirTabla(){

      var html_tabla = "";
      var total_acumulado = 0;
      for (let index = 0; index < listaDetalles.length; index++) {
        const detalle = listaDetalles[index];
        var itemMasUno = index+1;
        var subTotal = detalle.producto.precioVenta * detalle.cantidad;
        total_acumulado+= subTotal;

        var objectToPrint = {
          IndiceMostrable:itemMasUno,
          NombreProducto:detalle.producto.nombre,
          PrecioVenta:detalle.producto.precioVenta.toFixed(2),
          Cantidad:detalle.cantidad,
          Subtotal:subTotal.toFixed(2),
          Index:index
        }
        fila = hidrateHtmlString(PlantillaHtmlFilaDetalle,objectToPrint);
        html_tabla+= fila;

      }
      if(listaDetalles.length == 0){
        html_tabla = PlantillaHtmlTablaVacia;
      }

      var fila_total = hidrateHtmlString(PlantillaHtmlFilaTotal,
        {   
          TotalAcumulado:total_acumulado.toFixed(2)
        }
      );
      
      html_tabla += fila_total;

      ContenedorDetalles.value = JSON.stringify(listaDetalles);
      TablaDetalles.innerHTML = html_tabla

    }

    const SelectorProductos = document.getElementById('codProductoAñadir');
    function clickAñadirDetalle(){
      var codProductoAñadir = SelectorProductos.value;
      if(codProductoAñadir=="-1"){
        return;
      }
       
      var productoYaEnlistado = listaDetalles.find(e => e.producto.codProducto == codProductoAñadir);
      if(productoYaEnlistado){
        alerta("El producto ya está en el carrito")
        
        return;
      }

      var producto = listaProductos.find(e => e.codProducto == codProductoAñadir);
      listaDetalles.push({
        producto:producto,
        cantidad:1,
        subTotal:producto.precioVenta,
      });
      
      imprimirTabla();

    }


    function aumentarCantidadDetalle(index){
      listaDetalles[index].cantidad = listaDetalles[index].cantidad + 1;

      imprimirTabla();
      
    }
    function reducirCantidadDetalle(index){ 
      console.log(listaDetalles[index].cantidad)
      if(listaDetalles[index].cantidad == 1){
        eliminarDetalle(index);
        return;
      }
      console.log("reduciendo")
      
      listaDetalles[index].cantidad = listaDetalles[index].cantidad - 1;

      imprimirTabla();
      
    }
    function eliminarDetalle(index){
      
      listaDetalles.splice(index,1);
      
      console.log("despues",listaDetalles)
      imprimirTabla();
      
    }

    /*  
      Buscamos si el DNI tiene un usuario existente
      Si tiene un usuario existente, se trae su codUsuario
      Si no tiene usuario existente, se le crea uno 

    */

    const InputDNI = document.getElementById('dni');
    const InputNombreCliente = document.getElementById('nombre_cliente');
    const InputCodUsuarioComprador = document.getElementById('codUsuarioComprador');
    
    const ModalAgregarUsuario = document.getElementById("modalAgregarUsuario");
    const BootstrapModalAgregarUsuario = new bootstrap.Modal(ModalAgregarUsuario, {});
        
    async function buscarPorDNI(){
      var dni = InputDNI.value;
      $(".loader").show();
      const request = await fetch("/usuarios/verificarExistenciaUsuarioConDNI/" + dni)
      const verify_response = await request.json();
      $(".loader").hide();
      if(verify_response.exist){ //ya existe el usuario
        
        var codUsuario = verify_response.codUsuario;
        InputCodUsuarioComprador.value = codUsuario;
        InputNombreCliente.value = verify_response.nombre;
        alertaMensaje("Enhorabuena","Usuario encontrado " + verify_response.nombre,'success');
        setClientValid(true);
        
      }else{ //no existe el usuario, creamos su cuenta
        
        BootstrapModalAgregarUsuario.show();
        InputModalDni.value = dni;


      }


    }

    function reiniciarCliente(){

      alertaMensaje("Enhorabuena","Se reinició el cliente exitosamente",'success');
      limpiarCamposCliente();

    }
    function limpiarCamposCliente(){
      InputDNI.readOnly = false;
      InputDNI.value = "";
      InputNombreCliente.value = "";
      setClientValid(false);

    }

    const BotonBuscarPorDNI = document.getElementById('btn_buscarPorDni');
    const BotonReiniciarCliente = document.getElementById('btn_reiniciarCliente'); 



    function updateBotonesCliente(sePuedeEditar){
      if(sePuedeEditar){
        BotonBuscarPorDNI.className = ""
        BotonReiniciarCliente.className = "d-none";
      }else{
        BotonBuscarPorDNI.className = "d-none"
        BotonReiniciarCliente.className = ""

      }

    }

    function setClientValid(isValid){
      if(isValid){
        IconoClientValid.className = ValidClientClass
        InputDNI.readOnly = true;
        
      }else
        IconoClientValid.className = InvalidClientClass;

      isClientValid = isValid;
      updateBotonesCliente(!isValid);

    }


    /* Modal de crear usuario */
    
    function clickGuardarUsuario(){
        msj = validarModalUsuario();
        if(msj!=''){
            alerta(msj);
            return;
        }

        guardarNuevoUsuario();
    }
    function validarModalUsuario(){
      msj ="";  

      msj = validarNulidad(msj,'modal_email','Correo');
      msj = validarEmail(msj,'modal_email','Correo');
      


      return msj; 

    }
    
    
    const InputModalDni = document.getElementById('modal_dni'); 
    const InputModalEmail = document.getElementById('modal_email'); 
    async function guardarNuevoUsuario(){
      
      url = "/usuarios/crearCuentaPorDefecto";
      formData = {
          email:InputModalEmail.value,
          dni:InputModalDni.value,
          _token	 	: "{{ csrf_token() }}"
      }
      request =  {
          method: "POST",
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify(formData)
      }
      $(".loader").show();
      maracFetch(url,request,function(objetoRespuesta){
          alertaMensaje(objetoRespuesta.titulo,objetoRespuesta.mensaje,objetoRespuesta.tipoWarning);
          console.log(objetoRespuesta);
          $(".loader").hide();

          if(objetoRespuesta.ok=='1'){

            var dataRecibida = objetoRespuesta.datos;
            var codUsuario = dataRecibida.codUsuario;
            var nombresUsuario = dataRecibida.nombres + " " + dataRecibida.apellidos;

            InputNombreCliente.value = nombresUsuario;
            InputCodUsuarioComprador.value = codUsuario;
            setClientValid(true);
            
          }else{
            limpiarCamposCliente();
          }
          BootstrapModalAgregarUsuario.hide();


      })

    }

</script>
 
@endsection
@section('estilos')
<style>
  #contenedor_cliente{
    padding: 7px;
    background-color: rgb(241 241 241);
    border-radius: 8px;
  }
  .msj-modal{
    font-size: 10pt;
    color:rgb(66, 66, 66);
    padding: 5px;
  }
  .clientIsValid{
    height: 30px;
    width: 30px;
  }
  .color-red{
    color:red
  }
  .color-green{
    color:green
  }

  @media (max-width: 600px){/* mobile */
    .tabla-detalles{
      font-size: 12pt
    }
  }
  @media (min-width: 600px){/* Bigger */
    .tabla-detalles{
      font-size: 14pt
    }
  }
   
  
  .contenedor-detalles{
    background-color: rgb(241 241 241);
    border-radius:8px;
    
  }
  .contenedor-detalles .numero{
    
    font-weight: 500;
  }
  
  .poster-peli{
    background-color: rgb(172, 191, 255);
     
    height: 500px;
    width: 400px;
    color:rgb(93 91 113);

    border-width: 3px;
    border-style: dashed;
    
  }

  .cursorPointer{
    cursor:pointer;
  }

  #dni{
    max-width: 150px;
  }


</style>
@endsection
