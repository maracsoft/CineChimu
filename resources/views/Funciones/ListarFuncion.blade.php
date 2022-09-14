@extends ('Layout.Plantilla')
@section('titulo')
  Listar usuarios
@endsection

@section('contenido')
 
<div style="text-align: center">
    <h2>
      Listar Funciones
    </h2>
    <br>
    
    <div class="row">
        <div class="text-left m-2">
            <a href="{{route("Funciones.Crear")}}" class="btn btn-primary" style=" "> 
            <i class="fas fa-plus"> </i> 
                Registrar Función
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
            <th>Película</th>
            <th>Fecha hora</th>
            <th>Precio entrada</th>
            <th># Vendidas</th>
            
            <th># Presenciales</th>
            <th>Sala</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
        
        @foreach($listaFunciones as $funcion)
          <tr>
              <td>
                {{$funcion->codFuncion}}
              </td>
              <td>
                {{$funcion->getPelicula()->nombre}}
              </td>
              <td>
                {{$funcion->getFechaEscrita()}} {{$funcion->getHora()}}
              </td>
              <td>
                {{$funcion->precioEntrada}}
              </td>
              <td>
                {{$funcion->cantidadEntradasVendidas}}/{{$funcion->cantidadEntradasVirtuales}}
              </td>
              <td>
                {{$funcion->cantidadEntradasVentaPresencial}}
              </td>
              <td>
                {{$funcion->getSala()->nombre}} ({{$funcion->getAforo()}})
              </td>
              <td>
                <a href="{{route("Funciones.Editar",$funcion->getId())}}" class="btn btn-warning btn-xs btn-icon icon-left">
                  <i class="fas fa-edit"></i>
                </a>
              </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{$listaFunciones->links()}}
</div>
@endsection

@section('script')

@include('Layout.ValidatorJS')

<script>

   
  
</script>

@endsection