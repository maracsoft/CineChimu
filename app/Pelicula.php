<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
class Pelicula extends Model
{


    protected $table = "pelicula";
    protected $primaryKey = "codPelicula";
    public $timestamps = false;  //para que no trabaje con los campos fecha 


    public static function getPeliculasActivas(){

      return Pelicula::where('fechaHoraDesactivacion',null)->get();

    }
 

}
