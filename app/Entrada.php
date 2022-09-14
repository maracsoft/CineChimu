<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
class Entrada extends Model
{


    protected $table = "entrada";
    protected $primaryKey = "codEntrada";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
 

    public function getFuncion(){ 
      return Funcion::findOrFail($this->codFuncion);
    }

    public function getUsuarioComprador(){
      return Usuario::findOrFail($this->codUsuarioComprador);

    }

    function getFechaHoraCompra(){
      return Fecha::formatoFechaHoraParaVistas($this->fechaHoraCompra);
    }

}
