<?php

namespace App\Http\Controllers;

use App\Funcion;
use App\User;
use App\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

 
//Este controller sirve para renderizar las vistas estáticas que son públicas

class StaticController extends Controller
{
     
  public function VerCartelera(){

    $fechaActual = Carbon::now();

    /* Solo lista las que aun no suceden */
    $listaFunciones = Funcion::where('fechaHoraFuncion','>',$fechaActual)
        ->orderBy('fechaHoraFuncion','ASC')
        ->paginate(20);

    return view('Funciones.VerCartelera',compact('listaFunciones'));
  }
  

  public function VerNosotros(){
    

    return view('Static.Nosotros');
  }

  

  public function VerContactanos(){



    return view('Static.Contactanos');
  }




}
