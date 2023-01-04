@extends ('Layout.Plantilla')
@section('titulo')
  Listar Productos
@endsection

@section('contenido')
 
<div style="text-align: center">
    <h2>
      Listar Productos
    </h2>
    <br>
    
    <div class="row">
        <div class="text-left m-2">
            <a href="{{route("Productos.Crear")}}" class="btn btn-primary" style=" "> 
            <i class="fas fa-plus"> </i> 
                Registrar Producto
            </a>
        </div>
        <div class="col-md-10">
            
        </div>
    </div>
    
    @include('Layout.MensajeEmergenteDatos')
    
    <table class="table table-sm" style="font-size: 10pt;  ">
        <thead class="thead-dark">
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>
              Stock
            </th>
            <th>
              Precio Venta
            </th>
            <th>
              Estado
            </th>

            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
        
        @foreach($listaProductos as $producto)
          <tr>
            <td>
              {{$producto->getId()}}
            </td>
            <td>
              
              {{$producto->nombre}}
   
            </td>
            <td>
              {{$producto->descripcion}}
            </td>
            <td>
              
              {{$producto->stock}}
              
              
            </td>
            <td>
              S/ {{number_format($producto->precioVenta,2)}}
            </td>
            <td title="{{$producto->getEstado()->descripcion}}">
              {{$producto->getEstado()->nombre}}
            </td>

            <td>
              
              <a href="{{route("Productos.Editar",$producto->getId())}}" class="btn btn-warning btn-xs btn-icon icon-left">
                <i class="fas fa-edit"></i>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{$listaProductos->links()}}
</div>
@endsection

@section('script')

@include('Layout.ValidatorJS')

<script>

   
  
</script>

@endsection