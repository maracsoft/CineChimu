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
 

    public function getDescripcionAcortada(){
      
      // Si la longitud es mayor que el límite...
      $limiteCaracteres = 70;
      $cadena = $this->descripcion;
      if(strlen($cadena) > $limiteCaracteres){
          // Entonces corta la cadena y ponle el sufijo
          return substr($cadena, 0, $limiteCaracteres) . '...';
      }

      // Si no, entonces devuelve la cadena normal
      return $cadena;

    }
    function getUsuarioCreador(){
      return Usuario::findOrFail($this->codUsuarioCreador);
    }

    function getFechaHoraCreacion(){
      return Fecha::formatoFechaHoraEscrita($this->fechaHoraCreacion);
    }

    function getPosterFileName(){

      

      return "poster_".$this->getId();
    }
}
