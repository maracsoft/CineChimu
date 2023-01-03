@extends('Layout.Plantilla')

@section('titulo')
  Ver Venta
@endsection

@section('tiempoEspera')
 
@endsection

@section('contenido')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
 

@include('Layout.MensajeEmergenteDatos')


    <div class="card mx-2">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <div class="d-flex flex-row">
                <div class="">
                    <h3 class="card-title">
                        <b>Ver Venta</b>
                    </h3>
                </div>
            </div>
        </div>  
        <div class="card-body">
            <div class="col row">

              @if(!$venta->esVentaAnonima())
                    
                <div class="col-8">
                  <label for="" id="">
                    Cliente
                  </label>
                  <div class="d-flex">
                      
                      <input type="text" class="form-control mr-1" name="dni" id="dni" readonly placeholder="Buscar por DNI" value="{{$venta->getUsuarioComprador()->dni}}">
                      <input type="text" class="form-control" id="nombre_cliente" placeholder="Nombre del cliente" value="{{$venta->getUsuarioComprador()->getNombreCompleto()}}" readonly>
                    
                  </div>
                </div>


              @endif
              <div class="col-4">
                <label for="" id="">
                  Cajero:
                </label>
                <input type="text" class="form-control" name="" id="" value="{{$venta->getUsuarioCajero()->getNombreCompleto()}}" readonly>

              </div>
              <div class="col-3">
                
                <label for="" id="">
                  Método de Pago
                </label>
                <input type="text" class="form-control" value="{{$venta->getMetodoPago()->nombre}}" readonly>
                
              </div>
              <div class="col-9">
                <label for="" id="">
                  Comentario
                </label>
                <textarea name="" id="" class="form-control" cols="30" rows="2" readonly>{{$venta->comentario}}</textarea>
                
              </div>

              
            </div>  
           
            <div class="col-12 contenedor-detalles p-2">
              <div>
                <label for="">
                  Detalle de la venta
                </label>
              </div>
              <div class="d-flex">
              </div>
              <div>

                              
                <table class="table  table-sm my-2">
                  <thead class="thead-dark">
                    <tr>
                      <th>#</th>
                      <th>Producto</th>
                      <th class="text-right">Precio Unitario</th>
                      <th class="text-right">Cantidad</th>
                      <th class="text-right">Subtotal</th>
 
                    </tr>
                  </thead>
                  <tbody id="tbody_detalles">
                    @php
                      $i = 1;

                    @endphp
                    @foreach ($venta->getDetallesVenta() as $detalle)
                      <tr>
                        <td>
                          {{$i}}
                        </td>
                        <td class="nombre-producto">
                          {{$detalle->getProducto()->nombre}}
                        </td>
                        <td class="text-right numero">
                          S/ {{number_format($detalle->precioVenta,2)}}
                        </td>
                        <td class="text-right numero">
                          {{number_format($detalle->cantidad,2)}}
                        </td>
                        <td class="text-right numero">
                          S/ {{number_format($detalle->precioVenta*$detalle->cantidad,2)}}
                        </td>

                        
                      </tr>
                    @php
                      $i++;
                    @endphp
                    @endforeach
                  </tbody>
                </table>


              </div>

            </div>
              

  
        </div>
    </div>

    
 
    
 
    <div class="d-flex flex-row m-4">
        <div class="">

            <a href="{{route('Ventas.Listar')}}" class='btn btn-info '>
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
    
    document.addEventListener('DOMContentLoaded', onMounted, false);

    function onMounted(){
   
    }
  
</script>
 
@endsection
@section('estilos')
<style>
  .contenedor-detalles{
    background-color: rgb(241 241 241);
    border-radius:8px;
    
  }
  .contenedor-detalles .numero{
    font-size: 16pt;
    font-weight: 500;
  }
  .contenedor-detalles .nombre-producto{
    font-size: 14pt;
  }
  .poster-peli{
    background-color: rgb(172, 191, 255);
     
    height: 500px;
    width: 400px;
    color:rgb(93 91 113);

    border-width: 3px;
    border-style: dashed;
    
  }

  .cursorPointer{
    cursor:pointer;
  }

  #dni{
    max-width: 150px;
  }


</style>
@endsection
