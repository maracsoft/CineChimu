@extends('Layout.Plantilla')

@section('titulo')
  Editar Función
@endsection

@section('tiempoEspera')
 
@endsection

@section('contenido')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<div >
    <p class="h2" style="text-align: center">
        Editar Función
    </p>
</div>

@include('Layout.MensajeEmergenteDatos')

<form method = "POST" action = "{{route('Funciones.Actualizar')}}" id="formFuncion" name="formFuncion"  enctype="multipart/form-data">
    <input type="hidden" name="codFuncion" value="{{$funcion->codFuncion}}">
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
                    <span class="fontSize10">
                        (Función registrada el 
                        <b>
                          {{$funcion->getFechaHoraCreacion()}}  
                        </b>
                            por {{$funcion->getUsuarioCreador()->getNombreCompleto()}}
                        <b>)
                             
                    </span>
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
                        <option value="{{$pelicula->getId()}}" {{$pelicula->getId()==$funcion->codPelicula ? 'selected':''}}>
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
                        <option value="{{$sala->getId()}}" {{$sala->getId()==$funcion->codSala ? 'selected':''}}>
                          {{$sala->nombre}}
                        </option>
                      @endforeach

                    </select>
                </div>
                

               
               
                
  
                <div class="col-2">
                  <label for="" id="">
                    Precio entrada  
                  </label>
                  <input type="number" class="form-control" name="precioEntrada" id="precioEntrada" value="{{$funcion->precioEntrada}}">

                </div>
               

                <div class="col-2">
                  <label for="" id="">
                    Fecha función
                  </label>
                  <div class="input-group date form_date " data-date-format="dd/mm/yyyy" data-provide="datepicker">
                    {{-- INPUT PARA LA FECHA --}}
                    <input type="text" style="text-align: center" class="form-control" name="fechaFuncion" id="fechaFuncion" value="{{$funcion->getFechaFuncion()}}">
                    

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
                    <input min="0" max="23" placeholder="23" type="number" class="form-control text-center" name="horaFuncion" id="horaFuncion" value="{{$funcion->getHora_hora()}}" >
                    
                    <input min="0" max="59" placeholder="59" type="number" class="form-control text-center" name="minutosFuncion" id="minutosFuncion" value="{{$funcion->getHora_minutos()}}" >
                  
                  </div>
                  
                </div>
                 

                <div class="col-3">
                  <label for="" id="">
                    # Entradas para venta virtual  
                  </label>
                  <input type="number" class="form-control" name="cantidadEntradasVirtuales" id="cantidadEntradasVirtuales" value="{{$funcion->cantidadEntradasVirtuales}}">
                
                </div>
                

                

                <div class="col-3">
                  <label for="" id="">
                    # Entradas Venta presencial
                  </label>
                  <input type="number" class="form-control" name="cantidadEntradasVentaPresencial" id="cantidadEntradasVentaPresencial" value="{{$funcion->cantidadEntradasVentaPresencial}}">
                
                </div>
                
                <div class="col-3">
                  <label for="" id="">
                    # Entradas Vendidas
                  </label>
                  <input type="text" class="form-control" readonly  value="{{$funcion->cantidadEntradasVendidas}}/{{$funcion->cantidadEntradasVirtuales}}">
                </div>


                <div class="col-12">
                  <label for="">
                    Comentario:
                  </label>
                  <textarea name="comentario" id="comentario" class="form-control" name="" id="" cols="30" rows="2">{{$funcion->comentario}}</textarea>
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


    <div class="card mx-2">
      <div class="card-header ui-sortable-handle" style="cursor: move;">
          <h3 class="card-title">
            
            <b>Entradas:</b>
          </h3>
      </div>
      <div class="card-body">
        <div class="row">
            <button type="button" id="" class="ml-auto btn btn-sm btn-success " data-toggle="modal" data-target="#ModalAgregarEntrada">
              Registrar entrada
              <i class="fas fa-plus"></i>
            </button>
            
            <div class="table-responsive">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover" style='background-color:#FFFFFF;'>
                    <thead class="thead-default" style="background-color:#3c8dbc;color: #fff;">
                        <th>Cod</th>
                        <th>Comprador</th>
                        <th>Nombre persona</th>
                        <th>Monto pagado</th>
                          
                    </thead>

                    <tbody>
                        @foreach($funcion->getEntradas() as $entrada)
                            <tr>
                                <td>
                                    {{$entrada->getId()}}
                                </td>
                                <td>
                                    {{$entrada->getUsuarioComprador()->getNombreCompleto()}}
                                    <span class="fontSize10">  
                                      ({{$entrada->getFechaHoraCompra()}})
                                    </span>
                                </td>
                                <td>
                                  {{$entrada->nombrePersona}}
                                </td>
                                <td>
                                  {{$entrada->totalPagado}}
                                </td>
                                
                            </tr>
                        @endforeach



                    </tbody>
                </table>
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





<div class="modal  fade" id="ModalAgregarEntrada" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="" id="frmAgregarEntrada" name="frmAgregarEntrada"  method="POST">
                @csrf
                <input type="hidden" name="codUnidadProductiva" value="">

                <div class="modal-header">
                    <h5 class="modal-title" id="">Registrar nuevas entradas manualmente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-6">
                        <div>
                            <label for="">DNI:</label>
                        </div>
                        <div class="d-flex">
                            <div>
                                <input type="number" class="form-control" id="usuario_dni" name="usuario_dni" value="">
                            </div>
                            <div>
                                <button type="button" title="Buscar por DNI en la base de datos de Sunat"
                                    class="btn-sm btn btn-info d-flex align-items-center m-1" id="botonBuscarPorRUC" onclick="consultarUsuarioPorDNI()" >
                                    <i class="fas fa-search m-1"></i>

                                </button>
                            </div>

                        </div>
                        <div>
                          <span id="mensajeSiTieneCuenta">
                            
                          </span>
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="">Nombres:</label>
                        <input type="number" class="form-control" id="nombreCompletoUsuario" name="nombreCompletoUsuario" value="">
                    </div>
                    

                    <div class="col-12 row mt-2">
                        <div class="col-6 align-self-end">
                            <label class="d-flex" for="">
                                Entradas a registrar:
                            </label>
                        </div>
                        <div class="col-6 text-right">
                            <div class="mr-1 my-2">
                                <button type="button" class="btn btn-primary btn-sm" onclick="agregarUsuario()">
                                    <i class="fas fa-plus"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>

                    </div>
                    <div class="col-12">
                        <table class="table table-striped table-bordered table-condensed table-hover" >
                            <thead  class="thead-default">
                                <tr>
                                    <th>
                                        Nombre persona
                                    </th>
                                    <th>
                                        Monto pagado
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="modal_entradasACrear">

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Salir
                    </button>

                    <button type="button" class="m-1 btn btn-primary" onclick="clickGuardarNuevosSocios()">
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
