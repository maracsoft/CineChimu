@extends('Layout.Plantilla')

@section('titulo')
  Comprar entradas Función
@endsection

@section('tiempoEspera')
 
@endsection

@section('contenido')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<div >
    <p class="h2" style="text-align: center">
        Comprar entradas
    </p>
</div>

@include('Layout.MensajeEmergenteDatos')


  
  
        <div class="col-12">
    
          <div class="card">
            <div class="card-header text-left">
              <h2>
                {{$pelicula->nombre}} 
              </h2>
             
            </div>
            <div class="card-body row">
              <div class="col text-center">
                <img src="{{$pelicula->urlFoto}}"  class="poster-peli" alt="">
              </div>
              <div class="col d-flex flex-column">
                <div class="text-justify">
                  {{$pelicula->descripcion}}
                </div>
                <div class="mt-auto">
                  
                  <div>
                    <span class="">
                      {{$funcion->getFechaEscrita()}}
                    </span>
                  </div>
                  <div>
                    <span>
                      {{$funcion->getHora()}}
                    </span>
                  </div>
                  
                  <br>
                  {{$funcion->getSala()->nombre}}
                  
                  
                  
                  <h2>
                    S/ {{$funcion->precioEntrada}}
                  </h2>
                  
                  <div class="mt-5">
                    <div class="d-flex">
                      <div class="d-flex flex-column">
                        <h3 class="my-auto"> 
                          Cantidad de entradas:
                        </h3> 
                      </div>
                    
                      <div class="ml-auto" id="cantidad_entradas_span">
                            1
                      </div>

                    </div>
                   


                    <div class="d-flex mt-3 mb-1">
                      <div class="">
                        Nombres de los asistentes:
                      </div>
                      <div class="ml-auto">
                        <button type="button" class="btn btn-primary btn-sm" onclick="clickAgregarEntrada()">
                          <i class="fas fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" onclick="clickEliminarEntrada()">
                          <i class="fas fa-minus"></i>
                        </button>
                        
                      </div>
                      
                    </div>
                    
                                        
                    <form method = "POST" action = "{{route('IntencionPago.GuardarIntencion')}}" id="formFuncion" name="formFuncion"  enctype="multipart/form-data">
                      <input type="hidden" name="codFuncion" value="{{$funcion->codFuncion}}">
                      <input type="hidden" id="cantidadEntradas" name="cantidadEntradas" value="1">
                      @csrf

                     


                      <table class="table table-sm" style="font-size: 10pt;  ">
                        <thead class="thead-dark">
                          <tr>
                            <th>
                              #
                            </th>
                            <th>
                              Reservar
                            </th>
                            <th>
                              Nombre
                            </th>
                          </tr>
                        </thead>
                        <tbody id="tabla_asistentes">
                          
                          
                        </tbody>
                      </table> 
                    </form>

                    <div class="d-flex">
                      <div class="d-flex flex-column">
                        <h3 class="my-auto"> 
                          Total:
                        </h3> 
                      </div>
                    
                      <div class="ml-auto" id="monto_total">
                          S/ 0
                      </div>

                    </div>
                    <div class="text-center">
                      <button type="button" class="btn btn-success" onclick="clickPagar()">
                        Ir a pagar
                        <i class="fas fa-buy"></i>
                      </button>
                    </div>
                  </div>


    
                </div>
                
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
  
    $(document).ready(function(){
      clickAgregarEntrada();
    });

    function clickPagar(){
        msj = validarFormulario();
        if(msj!=''){
            alerta(msj);
            return;
        }
        var plural = "";
        if(cantidadEntradas == 1){
          plural = " entrada";
        }else{
          plural = " entradas";
        }


        confirmarConMensaje('Confirmacion','¿Desea comprar ' + cantidadEntradas + plural + ' para la funcion de "' + pelicula.nombre + '" del día <b>'+funcion_fechaEscrita+'</b>  ?','warning',ejecutarSubmit);
    }

    function ejecutarSubmit(){

        document.formFuncion.submit(); // enviamos el formulario	  

    }

 
    function validarFormulario(){
        limpiarEstilos([]);
        msj = "";
 
        
         
        return msj;

    }


    const pelicula = @php echo $pelicula;  @endphp

    const funcion_fechaEscrita = "{{$funcion->getFechaEscrita()}}"

    const funcion = @php echo $funcion; @endphp

    
    
    
    var listaAsistentes = [];
    var cantidadEntradas = 0;
    var precioEntrada = {{$funcion->precioEntrada}};
    var montoTotal = precioEntrada;
    
    const TablaAsistentes = document.getElementById('tabla_asistentes');
    function clickAgregarEntrada(){
      var actual_index = cantidadEntradas + 1;
      var row_html = `
            
              <td>
                 ${actual_index}
              </td>
              <td>
                <input class="form-control" type="checkbox" name="" id="" onclick="togleReservacion(this,${actual_index})">    
              </td>
              <td>
                <input id="nombrePersona_${actual_index}" name="nombrePersona_${actual_index}" type="text" placeholder="Nombre del asistente ${actual_index}" class="form-control" readonly>
              </td>
            
        `

      const newRow = document.createElement('tr');
      newRow.id = "row_"+actual_index;
      newRow.innerHTML = row_html;

      TablaAsistentes.appendChild(newRow)
      cantidadEntradas++;
      montoTotal = precioEntrada*cantidadEntradas;

      updateImprimibles();
      
    }
    function clickEliminarEntrada(){

      if(cantidadEntradas == 1)
        return;
      const element = document.getElementById("row_" + cantidadEntradas);
      element.remove();
      cantidadEntradas--;
      montoTotal = precioEntrada*cantidadEntradas;
      updateImprimibles();
      
    }

    function updateImprimibles(){
      document.getElementById('cantidad_entradas_span').innerHTML = cantidadEntradas;
      document.getElementById('cantidadEntradas').value = cantidadEntradas;
      document.getElementById('monto_total').innerHTML = "S/ " + montoTotal;
      


    }
    

    function togleReservacion(element,index){
      var activada = element.checked;
      document.getElementById('nombrePersona_' + index).readOnly = !activada;


    }

     

</script>
 
@endsection
@section('estilos')
<style>
  .poster-peli{
    max-height: 400px

  }
  #cantidad_entradas_span {
    height: 50px;
    width: 50px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    text-align: center;
    
    font-size: 25pt;
  }


  #monto_total{
    
    background-color: #bbb;
    padding: 6px;
    border-radius: 6px;
    display: inline-block;
    text-align: center;
    
    font-size: 18pt;

  }
</style>
@endsection
