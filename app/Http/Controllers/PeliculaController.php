<?php

namespace App\Http\Controllers;

use App\User;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PeliculaController extends Controller
{
     

  /* Renders the view */
  public function ListarPeliculas(Request $request){

    
  }
  
  /* Renders the view */
  public function EditarPelicula($codPelicula){

  }


  /* Renders the view */
  public function CrearPelicula(){


  }



  public function ActualizarPelicula(Request $request){



  }
  public function GuardarPelicula(Request $request){



  }
  
  
  /* Ya no se listará de ahora en adelante */
  public function Eliminar($codPelicula){

    


  }
  



}
