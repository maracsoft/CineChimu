<?php

namespace App\Http\Controllers;

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



    return view('Funciones.CrearFuncion');
  }



  public function ActualizarFuncion(Request $request){



  }
  public function GuardarFuncion(Request $request){



  }
  

  public function VerCartelera(){

    $fechaActual = Carbon::now();
    $listaFunciones = Funcion::where('fechaHoraFuncion','>',$fechaActual)->paginate(20);

    return view('Funciones.VerCartelera',compact('listaFunciones'));

  }

}
