<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Exception;
use Illuminate\Support\Facades\Auth;
class EstadoIntencion extends Model
{


    protected $table = "estado_intencion";
    protected $primaryKey = "codEstado";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
 
    public static function getCodEstado($nombre){
      $lista = EstadoIntencion::where('nombre',$nombre)->get();
      if(count($lista)==0){
        throw new Exception("No existe el estado con el nombre " . $nombre);
      }

      return $lista[0]->getId();

    }

}
