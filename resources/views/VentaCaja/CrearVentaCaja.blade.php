@extends('Layout.Plantilla')

@section('titulo')
  Crear Venta
@endsection

@section('tiempoEspera')
 
@endsection

@section('contenido')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<div >
    <p class="h2" style="text-align: center">
        Crear Venta
    </p>
</div>

@include('Layout.MensajeEmergenteDatos')

<form method = "POST" action = "{{route('Ventas.Guardar')}}" id="formVenta" name="formVenta"  enctype="multipart/form-data">
    
    @csrf

    <div class="card mx-2">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <div class="d-flex flex-row">
                <div class="">
                    <h3 class="card-title">
                        <b>Información General</b>
                    </h3>
                </div>
            </div>
        </div>  
        <div class="card-body">
            <div class="col row">


              <div class="col-8">
                <label for="" id="">
                  Cliente
                </label>
                <div class="d-flex">
                  <input type="text" class="form-control mr-1" name="dni" id="dni" placeholder="Buscar por DNI" value="">
                  <button class="btn btn-success mr-1" onclick="buscarPorDNI">
                    <i class="fas fa-search "></i>
                  </button>
                  <input type="text" class="form-control" id="nombre_cliente" placeholder="Nombre del cliente" value="" readonly>
                  <input type="hidden" name="codUsuarioComprador" id="codUsuarioComprador">
                </div>
              </div>
              <div class="col-4">
                <label for="" id="">
                  Cajero:
                </label>
                <input type="text" class="form-control" name="" id="" value="{{$usuarioCajero->getNombreCompleto()}}" readonly>

              </div>
              <div class="col-3">
                
            
                <label for="" id="">
                  Método de Pago
                </label>
                <select class="form-control" name="" id="">
                  <option value="">Método de Pago</option>
                  @foreach ($metodosPago as $metodo)
                    <option value="{{$metodo->getId()}}">
                      {{$metodo->nombre}}
                    </option>
                  @endforeach
                </select>
                
              </div>
              <div class="col-9">
                <label for="" id="">
                  Comentario
                </label>
                <textarea name="" id="" class="form-control" cols="30" rows="2"></textarea>
                
              </div>

              
            </div>  
            <div class="row ">
              <div class="col contenedor-detalles mx-4 p-2">
                <div>
                  <label for="">
                    Detalle de la venta
                  </label>
                </div>
                <div class="d-flex">

                  <select class="form-control select2 select2-hidden-accessible selectpicker" data-select2-id="1" tabindex="-1" aria-hidden="true" id="codProducto" data-live-search="true" >
                    <option value="-1">- Seleccione Producto para añadir-</option>          
                    @foreach($listaProductos as $producto)
                      <option value="{{$producto->getId()}}" >
                        {{$producto->nombre}}
                      </option>                                 
                    @endforeach
                  </select>
                  <button class="btn btn-success ml-1" type="button" onclick="clickAñadirDetalle()">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
                <div>

                                
                  <table class="table  table-sm my-2">
                    <thead class="thead-dark">
                      <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>

                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_detalles">
                      
                    </tbody>
                  </table>


                </div>

              </div>
                

            </div>
            <div class="row">
                <div class="ml-auto m-1">

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

            <a href="{{route('Peliculas.Listar')}}" class='btn btn-info '>
                <i class="fas fa-arrow-left"></i>
                Regresar al Menú
            </a>

        </div>


    </div>


</form>


 


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

    document.addEventListener('DOMContentLoaded', onMounted, false);

    function onMounted(){
      imprimirTabla();

    }


    function clickGuardar(){
        msj = validarFormulario();
        if(msj!=''){
            alerta(msj);
            return;
        }
        
        confirmarConMensaje('Confirmacion','¿Desea actualizar la película?','warning',ejecutarSubmit);
    }

    function ejecutarSubmit(){

        document.formVenta.submit(); // enviamos el formulario	  

    }

 
    function validarFormulario(){
        limpiarEstilos(['nombre','director','añoEstreno','duracionMinutos','descripcion']);
        msj = "";

        
        msj = validarTamañoMaximoYNulidad(msj,'nombre',100,'Nombre de la película');
        msj = validarTamañoMaximoYNulidad(msj,'director',500,'Nombre de la película');
        msj = validarTamañoMaximoYNulidad(msj,'añoEstreno',4,'Nombre de la película');
        msj = validarPositividadYNulidad(msj,'duracionMinutos','Nombre de la película');
        msj = validarTamañoMaximoYNulidad(msj,'descripcion',1000,'Nombre de la película');

         
        return msj;

    }
    
    function onChange(){
 
      var archivo = document.getElementById('fotoPoster').files[0];
      var arraySeparadoPuntos = archivo.name.split(".");

      var terminacion = arraySeparadoPuntos[arraySeparadoPuntos.length-1]
      
      console.log(terminacion)
  
      document.getElementById('poster_name').innerHTML = archivo.name;
      document.getElementById("file_end").value = terminacion; //input que se manda

    }



    const TablaDetalles = document.getElementById('tbody_detalles');
    /* RENDERIZADO TABLA */
    function imprimirTabla(){

      var html_tabla = "";
      for (let index = 0; index < listaDetalles.length; index++) {
        const detalle = listaDetalles[index];
        var itemMasUno = index+1;
        var subTotal = detalle.producto.precioVenta * detalle.cantidad;
        var fila=      /* html */ `
                <tr>               
                    <td >              
                        `+itemMasUno+`
                    </td>             
                    <td> 
                        `+detalle.producto.nombre+`
                    </td>               
                    <td  style="">
                      `+ detalle.producto.precioVenta.toFixed(2) + ` 
                    </td>               

                    <td >              
                      `+detalle.cantidad+`
                    </td>              
                    <td >              
                      `+subTotal.toFixed(2)+`
                    </td>              
                    <td >              
                        <button type="button" class="btn btn-danger btn-xs" onclick="eliminardetalle(`+index+`);">
                            <i class="fa fa-times" ></i>               
                        </button>       
                        <button type="button" class="btn btn-xs" onclick="aumentarCantidadDetalle(`+index+`);">
                            <i class="fas fa-plus"></i>            
                        </button>        
                        <button type="button" class="btn btn-xs" onclick="reducirCantidadDetalle(`+index+`);">
                            <i class="fas fa-minus"></i>            
                        </button>        
                        
                    </td>               
                </tr>         `;
                
        html_tabla+= fila;

      }
      if(listaDetalles.length == 0){
        html_tabla = `
                <tr>               
                    <td colspan="6" class="text-center">              
                        No hay items en el carrito
                    </td>
                    
                `
      }

      TablaDetalles.innerHTML = html_tabla

    }

    const SelectorProductos = document.getElementById('codProducto');
    function clickAñadirDetalle(){
      var codProductoAñadir = SelectorProductos.value;

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

      if(listaDetalles[index].cantidad == 1){
        eliminarDetalle(index);
        return;
      }
      console.log("reduciendo")
      
      listaDetalles[index].cantidad = listaDetalles[index].cantidad - 1;

      imprimirTabla();
      
    }
    function eliminarDetalle(index){
      listaDetalles = listaDetalles.slice(index,0);

      imprimirTabla();
      
    }


</script>
 
@endsection
@section('estilos')
<style>
  .contenedor-detalles{
    background-color: rgb(203, 189, 216);
    border-radius:8px;
    
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
