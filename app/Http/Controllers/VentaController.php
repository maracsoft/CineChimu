<?php

namespace App\Http\Controllers;

use App\Debug;
use App\DetalleVenta;
use App\Funcion;
use App\Venta;
use App\User;
use App\Usuario;
use App\MetodoPago;
use App\Producto;
use App\UI\UIFiltros;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class VentaController extends Controller
{
     
  const PAGINATION = 50;

  /* Renders the view */
  public function ListarVentas(Request $request){
    

    $listaVentas = Venta::where('codVenta','>',0);
    
    $filtros_usados_paginacion = UIFiltros::getFiltersCompleteArray($listaVentas,$request->getQueryString());
    dd($request);
    /* BUG QUE REMPLAZA EL . POR _ EN LA URI */
    $listaVentas = UIFiltros::buildQuery($listaVentas,$request->getQueryString());
    $filtros_usados = UIFiltros::getQueryValues($listaVentas,$request->getQueryString());
    


    $listaVentas = $listaVentas->paginate($this::PAGINATION);

    $listaFunciones = Funcion::añadirDescripcionAColeccion(Funcion::All());
    $listaUsuarios = Usuario::añadirNombreCompletoAColeccion(Usuario::All());
    $listaMetodosPago = MetodoPago::All();

   
    return view('VentaCaja.ListarVentasCaja',compact('listaVentas','filtros_usados','listaFunciones','listaUsuarios','listaMetodosPago','filtros_usados_paginacion'));
    
  }
  
  /* Renders the view */
  public function EditarVenta($codVenta){

    $venta = Venta::findOrFail($codVenta);

    return view('Ventas.EditarVenta',compact('venta'));
  }
  
  
  /* Renders the view */
  public function VerVenta($codVenta){

    $venta = Venta::findOrFail($codVenta);

    return view('VentaCaja.VerVentaCaja',compact('venta'));
  }
  

  /* Renders the view */
  public function CrearVenta(){
    $metodosPago = MetodoPago::All();
    $usuarioCajero = Usuario::getLogeado();
    $listaProductos = Producto::All();
    $hoy = date("Y-m-d");
    
    $funcionesDeHoy = Funcion::where('fechaHoraFuncion','>',$hoy)->get();
    return view('VentaCaja.CrearVentaCaja',compact('metodosPago','usuarioCajero','listaProductos','funcionesDeHoy'));
  }



  public function ActualizarVenta(Request $request){
    try {
      db::beginTransaction();

      $codVenta = $request->codVenta;
      $venta = Venta::findOrFail($codVenta);

      $venta->nombre = $request->nombre; 
      $venta->director = $request->director; 
      $venta->añoEstreno = $request->añoEstreno; 
      $venta->duracionMinutos = $request->duracionMinutos; 
      $venta->descripcion = $request->descripcion; 

      $venta->save();

      if($request->file('fotoPoster')){
         
        $archivoRespuestas = $request->file('fotoPoster'); 
      
        $filegetRespuestas = \File::get($archivoRespuestas);
        $nombreArchivo = $venta->getPosterFileName().".".$request->file_end;
        
        $venta->urlFoto = "/img/posters/".$nombreArchivo;
        $venta->save();
        Storage::disk('posters')->put($nombreArchivo,$filegetRespuestas );  
      }
      
      db::commit();

      return redirect()->route('Ventas.Editar',$codVenta)->with('datos',"Película editada exitosamente");

    } catch (\Throwable $th) {
      throw $th;
    }


  }
  public function GuardarVenta(Request $request){
    try {
      db::beginTransaction();
      $venta = new Venta();
      $venta->fechaHora = Carbon::now();
      $venta->codUsuarioCajero = Usuario::getLogeado()->getId();
      
      $venta->montoTotal = 0; //por ahora
      $venta->codMetodo = $request->codMetodo;
      $venta->comentario = $request->comentario;

      if($request->esVentaAnonima == 'on'){
        $venta->codUsuarioComprador = null;
        $venta->venta_anonima = 1;
      }else{
        $venta->codUsuarioComprador = $request->codUsuarioComprador;
        $venta->venta_anonima = 0;
      }
      if($request->codFuncion=='-1')
        $venta->codFuncion = null;
      else
        $venta->codFuncion = $request->codFuncion;
      $venta->save();
      
      $detalles =  json_decode($request->detalles_json);
      
      $monto_total = 0;
      foreach ($detalles as $detalle) {
        
        $producto = Producto::findOrFail($detalle->producto->codProducto);
        
        $detalle_venta = new DetalleVenta();
        $detalle_venta->codVenta = $venta->getId();
        $detalle_venta->codProducto = $producto->codProducto;
        $detalle_venta->precioVenta = $producto->precioVenta;
        $detalle_venta->cantidad = $detalle->cantidad;
        $detalle_venta->save();

        $monto_total = $monto_total + $detalle_venta->precioVenta;
      }
      $venta->montoTotal = $monto_total;
      $venta->save();
      db::commit();

      return redirect()->route('Ventas.Listar',$venta->getId())->with('datos',"Venta registrada exitosamente");

    } catch (\Throwable $th) {
      
      Debug::mensajeError("VentaController",$th);

      throw $th;
    }


  }
  
  
  /* Ya no se listará de ahora en adelante */
  public function Eliminar($codVenta){

    


  }
  



}
