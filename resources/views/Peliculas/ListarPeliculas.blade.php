@extends ('Layout.Plantilla')
@section('titulo')
  Listar Películas
@endsection

@section('contenido')
 
<div style="text-align: center">
    <h2>
      Listar Peliculas
    </h2>
    <br>
    
    <div class="row">
        <div class="text-left m-2">
            <a href="{{route("Peliculas.Crear")}}" class="btn btn-primary" style=" "> 
            <i class="fas fa-plus"> </i> 
                Registrar Película
            </a>
        </div>
        <div class="col-md-10">
            
        </div>
    </div>
    
    @include('Layout.MensajeEmergenteDatos')
    
    <table class="table table-sm" style="font-size: 10pt;  ">
        <thead class="thead-dark">
          <tr>
            <th>Cod</th>
            <th>Nombre</th>
            <th>Director</th>
            
            <th>Descripción</th>
            <th>Duración (min)</th>
             
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
        
        @foreach($listaPeliculas as $pelicula)
          <tr>
            <td>
              {{$pelicula->getId()}}
            </td>
            <td>
              {{$pelicula->nombre}}
            </td>
            <td>
              {{$pelicula->director}}
            </td>
            <td>

              {{$pelicula->getDescripcionAcortada()}}
            
            </td>
            <td>
              {{$pelicula->duracionMinutos}}
            </td>
            <td>
              <a href="{{route("Peliculas.Editar",$pelicula->getId())}}" class="btn btn-warning btn-xs btn-icon icon-left">
                <i class="fas fa-edit"></i>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{$listaPeliculas->links()}}
</div>
@endsection

@section('script')

@include('Layout.ValidatorJS')

<script>

   
  
</script>

@endsection