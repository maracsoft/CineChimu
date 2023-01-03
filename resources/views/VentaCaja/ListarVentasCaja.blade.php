@extends ('Layout.Plantilla')
@section('titulo')
  Listar Ventas
@endsection

@section('contenido')
 
<div style="text-align: center">
    <h2>
      Listar Ventas
    </h2>
    <br>
    
    <div class="row">
        <div class="text-left m-2">
            <a href="{{route("Ventas.Crear")}}" class="btn btn-primary" style=" "> 
            <i class="fas fa-plus"> </i> 
                Registrar Venta
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
            <th>Comprador</th>
            <th>Fecha hora</th>
            <th>Cajero</th>
            <th>Total</th>

            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
        
        @foreach($listaVentas as $venta)
          <tr>
            <td>
              {{$venta->getId()}}
            </td>
            <td>
              {{$venta->getUsuarioComprador()->getNombreCompleto()}}
            </td>
            <td>
              {{$venta->getFechaHora()}}
            </td>
            <td>
              {{$venta->getUsuarioCajero()->getNombreCompleto()}}
            </td>
            <td>
              {{$venta->getTotal()}}
            </td>
            <td>
              <a href="{{route('Ventas.Ver',$venta->getId())}}" class="btn btn-primary btn-xs">
                <i class="fas fa-eye"></i>
              </a>
              <a href="{{route("Ventas.Editar",$venta->getId())}}" class="btn btn-warning btn-xs btn-icon icon-left">
                <i class="fas fa-edit"></i>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{$listaVentas->links()}}
</div>
@endsection

@section('script')

@include('Layout.ValidatorJS')

<script>

   
  
</script>

@endsection