@extends ('Layout.Plantilla')
@section('titulo')
  Listar usuarios
@endsection

@section('contenido')
@php
  $hayAlguienLogeado = Auth::id()!=null;
@endphp
 
<div style="text-align: center">
  <div>
    <h2 class="mb-3">
      Nuestra Cartelera
    </h2>
  </div>
    
  
  @include('Layout.MensajeEmergenteDatos')
  
  <div class="row">
      
    @foreach($listaFunciones as $funcion)
      @php
        $pelicula = $funcion->getPelicula();
      @endphp


      <div class="col-12 col-md-6">
        
        <div class="card">
          <div class="card-header text-left">
            <h2>
              {{$pelicula->nombre}}
            </h2>
          </div>
          <div class="card-body row">
            <div class="col">
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
                
                
                
                @if($hayAlguienLogeado)
                  <a href="{{route("IntencionPago.VerComprar",$funcion->getId())}}" class="btn btn-success  btn-icon icon-left">
                    Comprar
                  </a>

                
                @else
                  <a href="#" onclick="clickComprarNoLogeado()" class="btn btn-success  btn-icon icon-left">
                    Comprar
                  </a>
                  
                @endif
                
              </div>
              
            </div>
            

          </div>
          
        </div>


      </div>

    @endforeach
      
  </div>
  {{$listaFunciones->links()}}
</div>
@endsection

@section('script')

@include('Layout.ValidatorJS')

<script>

function clickComprarNoLogeado(){
  alerta("Para comprar funciones debe iniciar sesión");
}
  
</script>

@endsection
@section('estilos')
<style>
  .poster-peli{
    max-height: 500px

  }

</style>
@endsection
