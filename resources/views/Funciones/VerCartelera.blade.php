@extends ('Layout.Plantilla')
@section('titulo')
  Listar usuarios
@endsection

@section('contenido')
 
<div style="text-align: center">
  <h2>
    Nuestra Cartelera
  </h2>
 
    
  
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
                
                
                

                <a href="{{route("IntencionPago.VerComprar",$funcion->getId())}}" class="btn btn-success  btn-icon icon-left">
                  Comprar
                  
                </a>

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

   
  
</script>

@endsection
@section('estilos')
<style>
  .poster-peli{
    max-height: 500px

  }

</style>
@endsection
