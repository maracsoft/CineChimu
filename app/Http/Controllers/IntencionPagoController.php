<?php

namespace App\Http\Controllers;

use App\Entrada;
use App\EstadoIntencion;
use App\Funcion;
use App\IntencionCompra;
use App\User;
use App\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IntencionPagoController extends Controller
{
    


  function VerComprar($codFuncion){
    $funcion = Funcion::findOrFail($codFuncion);
    $pelicula = $funcion->getPelicula();


    return view('Funciones.VerComprar',compact('funcion','pelicula'));

  }


    public function guardarIntencion(Request $request){
      try {
        db::beginTransaction();

        $funcion = Funcion::findOrFail($request->codFuncion);


        $intencion = new IntencionCompra();
        $intencion->fechaHoraCreacion = Carbon::now();
        $intencion->cantidadEntradas = $request->cantidadEntradas;
        $intencion->precioUnitario = $funcion->precioEntrada;
        $intencion->montoTotal = $intencion->cantidadEntradas * $intencion->precioUnitario;

        $vectorNombres = [];
        for ($i=1; $i <= $intencion->cantidadEntradas ; $i++) { 
          $vectorNombres[] = $request->get('nombrePersona_'.$i);
        }

        $intencion->arrayNombres = join(',',$vectorNombres);
        
        $intencion->codFuncion = $request->codFuncion;
        $intencion->codEstado = EstadoIntencion::getCodEstado('Creado');
        $intencion->codUsuario = Usuario::getLogeado()->getId();
        $intencion->save();
        db::commit();

        return redirect()->route('IntencionPago.VerPagar',$intencion->getId());

      } catch (\Throwable $th) {
        db::rollBack();
        
        throw $th;        


      }

    }

    public function VerPagar($codIntencion){

      try {
        
        $intencion = IntencionCompra::findOrFail($codIntencion);
        $funcion = $intencion->getFuncion();
        $pelicula = $funcion->getPelicula();

        return view('Ventas.VerPagar',compact('intencion','funcion','pelicula'));

      } catch (\Throwable $th) {
         
        throw $th;
      }

    }


    public function EfectuarPago(Request $request){
      try {
        db::beginTransaction();

        $intencion = IntencionCompra::findOrFail($request->codIntencion);
        $intencion->codEstado = EstadoIntencion::getCodEstado('Pendiente');

        sleep(2); //aqui simulamos la consulta a la API de izipay

        $intencion->codEstado = EstadoIntencion::getCodEstado('Confirmado');
        
        $intencion->save();

        
        $nombresSeparadosPorComa = explode(',',$intencion->arrayNombres);

        for ($i=0; $i < $intencion->cantidadEntradas ; $i++) {
          $nombre = $nombresSeparadosPorComa[$i]; 
          $entrada = new Entrada();
          $entrada->codUsuarioComprador = $intencion->codUsuario;
          $entrada->precio = $intencion->precioUnitario;
          $entrada->codFuncion = $intencion->getFuncion()->getId();
          $entrada->nombrePersona = $nombre;
          $entrada->codIntencion = $intencion->getId();
          $entrada->save();

        }

        db::commit();

        return redirect()->route('IntencionPago.VerMiCompra',$intencion->getId())->with('datos',"¡Se ha completado exitosamente la compra!"); 

      } catch (\Throwable $th) {
        throw $th;
      }


    }


    public function VerMiCompra($codIntencion){
      try {


        $intencion = IntencionCompra::findOrFail($codIntencion);
        $entradas = $intencion->getEntradas();

        return view('Ventas.VerMiCompra',compact('intencion','entradas'));


      } catch (\Throwable $th) {
        throw $th;
      }


    }

}
