<?php

namespace App\Http\Controllers;

use App\Fecha;
use App\Funcion;
use App\Pelicula;
use App\Sala;
use App\User;
use App\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FuncionController extends Controller
{
     
  /* Renders the view */
  public function ListarFunciones(Request $request){

    $listaFunciones = Funcion::paginate(50);


    return view('Funciones.ListarFuncion',compact('listaFunciones'));
  }
  
  /* Renders the view */
  public function EditarFuncion($codFuncion){

    $funcion = Funcion::findOrFail($codFuncion);
    $listaPeliculas = Pelicula::getPeliculasActivas();
    $listaSalas = Sala::getSalasActivas();


    return view('Funciones.EditarFuncion',compact('funcion','listaPeliculas','listaSalas'));
  }


  /* Renders the view */
  public function CrearFuncion(){

    $listaPeliculas = Pelicula::getPeliculasActivas();
    $listaSalas = Sala::getSalasActivas();



    return view('Funciones.CrearFuncion',compact('listaPeliculas','listaSalas'));
  }



  public function ActualizarFuncion(Request $request){
    try {
      $codFuncion = $request->codFuncion;

      db::beginTransaction();

      
      $horaFuncion = $request->horaFuncion;
      if(strlen($horaFuncion) == 1)
        $horaFuncion = "0".$horaFuncion;
    
      $minutosFuncion = $request->minutosFuncion;
      if(strlen($minutosFuncion) == 1)
        $minutosFuncion = "0".$minutosFuncion;
      $fechaHoraFuncion = Fecha::formatoParaSQL($request->fechaFuncion)." ".$horaFuncion.":".$minutosFuncion.":00";


      $funcion = Funcion::findOrFail($codFuncion);
      
      $funcion->codPelicula = $request->codPelicula;
      $funcion->precioEntrada = $request->precioEntrada;
      $funcion->cantidadEntradasVirtuales = $request->cantidadEntradasVirtuales;
      $funcion->fechaHoraFuncion = $fechaHoraFuncion;
      $funcion->cantidadEntradasVentaPresencial = $request->cantidadEntradasVentaPresencial;
      $funcion->codSala = $request->codSala;


      $funcion->comentario = $request->comentario;
      
      $funcion->save();


      

      db::commit();

      return redirect()->route('Funciones.Editar',$codFuncion)->with('datos',"Función actualizada exitosamente");

    } catch (\Throwable $th) {
      throw $th;
    }


  }
  public function GuardarFuncion(Request $request){
    try {
       
      db::beginTransaction();

      
      $horaFuncion = $request->horaFuncion;
      if(strlen($horaFuncion) == 1)
        $horaFuncion = "0".$horaFuncion;
    
      $minutosFuncion = $request->minutosFuncion;
      if(strlen($minutosFuncion) == 1)
        $minutosFuncion = "0".$minutosFuncion;
      $fechaHoraFuncion = Fecha::formatoParaSQL($request->fechaFuncion)." ".$horaFuncion.":".$minutosFuncion.":00";


      $funcion = new Funcion();
      
      $funcion->codPelicula = $request->codPelicula;
      $funcion->precioEntrada = $request->precioEntrada;
      $funcion->cantidadEntradasVirtuales = $request->cantidadEntradasVirtuales;
      $funcion->cantidadEntradasVendidas = 0;

      $funcion->fechaHoraFuncion = $fechaHoraFuncion;
      $funcion->cantidadEntradasVentaPresencial = $request->cantidadEntradasVentaPresencial;
      $funcion->codSala = $request->codSala;
      $funcion->comentario = $request->comentario;
      
      $funcion->codUsuarioCreador = Usuario::getLogeado()->getId();
      $funcion->fechaHoraCreacion = Carbon::now();

      $funcion->save();

      db::commit();

      return redirect()->route('Funciones.Editar',$funcion->getId())->with('datos',"Función creada exitosamente");

    } catch (\Throwable $th) {
      throw $th;
    }


  }
  

}
