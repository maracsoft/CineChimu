<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
class IntencionCompra extends Model
{

    protected $table = "intencion_compra";
    protected $primaryKey = "codIntencion";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
 

    public function getFuncion(){
      return Funcion::findOrFail($this->codFuncion);
    }

    function getUsuario(){
      return Usuario::findOrFail($this->codUsuario);
    }

    function getEstado(){
      return EstadoIntencion::findOrFail($this->codEstado);
    }

    function getArrayNombres() : array{
      return explode(',',$this->arrayNombres);
    }


    function getEntradas(){
      return Entrada::where('codIntencion',$this->getId())->get();
      
    }

}
