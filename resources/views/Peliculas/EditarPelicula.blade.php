@extends('Layout.Plantilla')

@section('titulo')
  Editar Película
@endsection

@section('tiempoEspera')
 
@endsection

@section('contenido')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<div >
    <p class="h2" style="text-align: center">
        Editar Película
    </p>
</div>

@include('Layout.MensajeEmergenteDatos')

<form method = "POST" action = "{{route('Peliculas.Actualizar')}}" id="formPelicula" name="formPelicula"  enctype="multipart/form-data">
    <input type="hidden" name="codPelicula" value="{{$pelicula->codPelicula}}">
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
                        (Película registrada el 
                        <b>
                          {{$pelicula->getFechaHoraCreacion()}}  
                        </b>
                            por {{$pelicula->getUsuarioCreador()->getNombreCompleto()}}
                        <b>)
                             
                    </span>
                </div>

            </div>
        </div>
        <div class="card-body">


            <div class="row">
              <div class="col text-center">
                <img src="{{$pelicula->urlFoto}}"  class="poster-peli" alt="">


                <div class="d-flex flex-column mx-5 text-left">
                  <label for="fotoPoster">
                    Remplazar Foto:
                  </label>
                  <input onchange="onChange()" type="file" id="fotoPoster" name="fotoPoster" accept="image/png, image/jpeg, image/jpg">
                  <input type="hidden" id="file_end" name="file_end" value="">
                
                </div>
                

              </div>
              <div class="col row">


                <div class="col-12">
                  <label for="" id="">
                    Nombre
                  </label>
                  <input type="text" class="form-control" name="nombre" id="nombre" value="{{$pelicula->nombre}}">

                </div>
                <div class="col-12">
                  <label for="" id="">
                    Director
                  </label>
                  <input type="text" class="form-control" name="director" id="director" value="{{$pelicula->director}}">

                </div>
                <div class="col-12">
                  
              
                  <label for="" id="">
                    Duración (min)
                  </label>
                  <input type="number" class="form-control" name="duracionMinutos" id="duracionMinutos" value="{{$pelicula->duracionMinutos}}">
  
                 
                </div>
                <div class="col">
                  <label for="" id="">
                    Año de estreno
                  </label>
                  <input type="number" class="form-control" name="añoEstreno" id="añoEstreno" value="{{$pelicula->añoEstreno}}">

                </div>


                 
                <div class="col-12">
                  <label for="">
                    Descripción:
                  </label>
                  <textarea name="descripcion" id="descripcion" class="form-control" name="" id="" cols="30" rows="6">{{$pelicula->descripcion}}</textarea>
                </div>
                
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
  


    function clickGuardar(){
        msj = validarFormulario();
        if(msj!=''){
            alerta(msj);
            return;
        }
        
        confirmarConMensaje('Confirmacion','¿Desea actualizar la película?','warning',ejecutarSubmit);
    }

    function ejecutarSubmit(){

        document.formPelicula.submit(); // enviamos el formulario	  

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
  
      document.getElementById("file_end").value = terminacion; //input que se manda

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
