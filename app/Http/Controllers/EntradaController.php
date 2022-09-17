<?php

namespace App\Http\Controllers;

use App\Entrada;
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
  public function ListarEntradas(Request $request){

    

    return view('Funciones.ListarFuncion',compact('listaFunciones'));
  }

}