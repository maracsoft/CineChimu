@extends('Layout.Plantilla')

@section('titulo')
  Crear Función
@endsection

@section('tiempoEspera')
 
@endsection

@section('contenido')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<div >
    <p class="h2" style="text-align: center">
        Crear Función
    </p>
</div>

@include('Layout.MensajeEmergenteDatos')

<form method = "POST" action = "{{route('Funciones.Guardar')}}" id="formFuncion" name="formFuncion"  enctype="multipart/form-data">
     
    @csrf

    <div class="card mx-2">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <div class="d-flex flex-row">
                <div class="">
                    <h3 class="card-title">
                        {{--  <i class="fas fa-chart-pie"></i> --}}
                        <b>Información General</b>
                    </h3>

                </div>

                <div class="ml-1 mt-1">
                     
                </div>

            </div>
        </div>
        <div class="card-body">


            <div class="row ">

                <div class="col-4">
                    <label for="codPelicula" class="">
                        Película:
                    </label>
                    <select class="form-control select2 select2-hidden-accessible selectpicker" data-select2-id="1" tabindex="-1" aria-hidden="true" id="codPelicula" name="codPelicula" data-live-search="true">
                      <option value="-1">- Seleccione Película -</option>          
                      @foreach($listaPeliculas as $pelicula)
                        <option value="{{$pelicula->getId()}}" >
                          {{$pelicula->nombre}}
                        </option>                                 
                      @endforeach
                    </select> 
                </div>

                <div class="col-2">
                    <label for="codSala" class="">
                        Sala:
                    </label>
                    <select class="form-control"  id="codSala" name="codSala">
                      <option value="-1">-- Sala --</option>
                      @foreach ($listaSalas as $sala)
                        <option value="{{$sala->getId()}}"  >
                          {{$sala->nombre}}
                        </option>
                      @endforeach

                    </select>
                </div>
                

               
               
                
  
                <div class="col-2">
                  <label for="" id="">
                    Precio entrada  
                  </label>
                  <input type="number" class="form-control" name="precioEntrada" id="precioEntrada" value="">

                </div>
               

                <div class="col-2">
                  <label for="" id="">
                    Fecha función
                  </label>
                  <div class="input-group date form_date " data-date-format="dd/mm/yyyy" data-provide="datepicker">
                    {{-- INPUT PARA LA FECHA --}}
                    <input type="text" style="text-align: center" class="form-control" name="fechaFuncion" id="fechaFuncion" value="">
                    

                    <div class="input-group-btn">
                        <button class="btn btn-primary date-set btn-sm" type="button" style="display: none">
                            <i class="fas fa-calendar fa-xs"></i>
                        </button>
                    </div>
                  </div>
                </div>
                

                <div class="col-2">
                  <label for="" id="">
                    Hora y minuto
                  </label>
                  <div class="d-flex flex-row">
                    <input min="0" max="23" placeholder="23" type="number" class="form-control text-center" name="horaFuncion" id="horaFuncion" value="" >
                    
                    <input min="0" max="59" placeholder="59" type="number" class="form-control text-center" name="minutosFuncion" id="minutosFuncion" value="" >
                  
                  </div>
                  
                </div>
                 

                <div class="col-3">
                  <label for="" id="">
                    # Entradas para venta virtual  
                  </label>
                  <input type="number" class="form-control" name="cantidadEntradasVirtuales" id="cantidadEntradasVirtuales" value="">
                
                </div>
                

                

                <div class="col-3">
                  <label for="" id="">
                    # Entradas Venta presencial
                  </label>
                  <input type="number" class="form-control" name="cantidadEntradasVentaPresencial" id="cantidadEntradasVentaPresencial" value="">
                
                </div>
                 


                <div class="col-12">
                  <label for="">
                    Comentario:
                  </label>
                  <textarea name="comentario" id="comentario" class="form-control" name="" id="" cols="30" rows="2"></textarea>
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

            <a href="{{route('Funciones.Listar')}}" class='btn btn-info '>
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
        
        confirmarConMensaje('Confirmacion','¿Desea actualizar la funcion?','warning',ejecutarSubmit);
    }

    function ejecutarSubmit(){

        document.formFuncion.submit(); // enviamos el formulario	  

    }

 
    function validarFormulario(){
        limpiarEstilos(['codPelicula','codSala','precioEntrada','cantidadEntradasVirtuales','cantidadEntradasVentaPresencial','fechaFuncion','horaFuncion','minutosFuncion']);
        msj = "";


        msj = validarSelect(msj,'codPelicula',"-1","Película")
        msj = validarSelect(msj,'codSala',"-1","Sala")
        
        msj = validarPositividadYNulidad(msj,'precioEntrada','Precio de entrada');
        msj = validarPositividadYNulidad(msj,'cantidadEntradasVirtuales','Cantidad de entradas virtuales');
        msj = validarPositividadYNulidad(msj,'cantidadEntradasVentaPresencial','Cantidad de entradas destinadas a venta presencial');


        msj = validarNulidad(msj,'fechaFuncion','Fecha de la función');
        msj = validarNulidad(msj,'horaFuncion','Hora de la función');
        msj = validarNulidad(msj,'minutosFuncion','Hora de la función');
        

        msj = validarEntreRangoNumeros(msj,'horaFuncion',0,23,'Hora de la función')
        msj = validarEntreRangoNumeros(msj,'minutosFuncion',0,59,'Minutos de la hora de la función')
        
        
         
        return msj;

    }
    


</script>
 
@endsection
