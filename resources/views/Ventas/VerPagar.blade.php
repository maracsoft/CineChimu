@extends('Layout.Plantilla')

@section('titulo')
  Pagar entradas
@endsection

@section('tiempoEspera')
 
@endsection

@section('contenido')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<div >
    <p class="h2" style="text-align: center">
      Pagar entradas
    </p>
</div>

@include('Layout.MensajeEmergenteDatos')


  
  
        <div class="col-12">
    
          <div class="card">
            <div class="card-header text-left">
              <h2>
                Efectuar pago
              </h2>
             
            </div>
            <form name="formPago" method="POST" action="{{route('IntencionPago.EfectuarPago')}}">
              @csrf
              <input type="hidden" name="codIntencion" id="codIntencion" value="{{$intencion->codIntencion}}">
              <div class="card-body row">
                <div class="col-12 text-center d-flex">
                  
                  <div class="pasarela m-auto">
                    AQUÍ VA LA PASARELA DE PAGO
                    {{$intencion}}
                  </div>
                  
                  
                </div>
                <div class="col text-right">
                  <button onclick="clickEfectuarPago()" class="btn btn-primary">
                    Efectuar pago
                  </button>
                  
                </div>
              </div>
              
            </form> 
          
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
       
    });
    

    function clickEfectuarPago(){

      document.formPago.submit();

    }
 


</script>
 
@endsection
@section('estilos')
<style>
  .pasarela{
    height: 500px;
    width: 500px;

    background-color: red
  }
</style>
@endsection
