@extends('Layout.Plantilla')

@section('titulo')
  Editar Producto
@endsection

@section('tiempoEspera')
 
@endsection

@section('contenido')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
 

@include('Layout.MensajeEmergenteDatos')

<form method = "POST" action = "{{route('Productos.Actualizar')}}" id="formProducto" name="formProducto"  enctype="multipart/form-data">
    <input type="hidden" name="codProducto" value="{{$producto->codProducto}}">
    @csrf

    <div class="card mx-2">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <div class="d-flex flex-row">
                <div class="">
                    <h3 class="card-title">
                        <b>
                          Editar Producto
                        </b>
                    </h3>

                </div>

                <div class="ml-1 mt-1">
                     
                </div>

            </div>
        </div>
        <div class="card-body">


            <div class="row ">

                <div class="col-4">
                    <label for="" class="">
                        Nombre:
                    </label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{$producto->nombre}}">
                </div>

                <div class="col-4">
                  <label for="" id="">
                    Categoría
                  </label>
                  <select class="form-control" name="codCategoria" id="codCategoria">
                    <option value="-1">- Categoría -</option>
                    @foreach($listaCategorias as $categoria)

                      <option value="{{$categoria->getId()}}"
                      @if($categoria->getId() == $producto->codCategoria)
                      selected                        
                      @endif  
                        
                      >
                        {{$categoria->nombre}}
                      </option>
                    @endforeach

                  </select>
                </div>

                <div class="col-1">
                  <label for="" id="">
                    Stock
                  </label>
                  <input type="number" class="form-control" id="stock" name="stock" value="{{$producto->stock}}" readonly>
                </div>
                <div class="col-3">
                  <label for="" id="">
                    Estado
                  </label>
                  <select class="form-control" name="codEstadoProducto" id="codEstadoProducto">
                    <option value="-1">- Categoría -</option>
                    @foreach($listaEstados as $estado)
                      <option value="{{$estado->getId()}}"
                        @if($estado->getId() == $producto->codEstadoProducto)
                          selected                        
                        @endif   
                      >
                        {{$estado->nombre}}
                      </option>
                    @endforeach

                  </select>
                </div>
                <div class="col-4">
                  <label for="" id="">
                    Precio de Venta
                  </label>
                  <input type="number" id="precioVenta" name="precioVenta" class="form-control" value="{{$producto->precioVenta}}">
                </div>
                
                <div class="col-8">
                  <label for="codSala" class="">
                      Descripción:
                  </label>
                  <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="1">{{$producto->descripcion}}</textarea>
                </div>

                
            </div>


            <div class="row">
                <div class="ml-auto m-1">

                    <button type="button" class="btn btn-primary" id="btnEditar" data-loading-text="<i class='fa a-spinner fa-spin'></i> Registrando"
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

            <a href="{{route('Productos.Listar')}}" class='btn btn-info '>
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
  


    function clickGuardar(){
        msj = validarFormulario();
        if(msj!=''){
            alerta(msj);
            return;
        }
        
        confirmarConMensaje('Confirmacion','¿Desea actualizar el producto?','warning',ejecutarSubmit);
    }

    function ejecutarSubmit(){

        document.formProducto.submit(); // enviamos el formulario	  

    }

 
    function validarFormulario(){

        limpiarEstilos(['nombre','descripcion','stock','precioVenta','codCategoria','codEstadoProducto']);
        msj = "";


        msj = validarSelect(msj,'codCategoria',"-1","Categoría")
        msj = validarSelect(msj,'codEstadoProducto',"-1","Producto")
        
        msj = validarPositividadYNulidad(msj,'precioVenta','Precio de venta');

        msj = validarTamañoMaximoYNulidad(msj,'nombre',90,'Nombre del producto');

        return msj;

    }
    


</script>
 
@endsection
