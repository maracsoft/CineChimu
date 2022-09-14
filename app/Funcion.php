<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
class Funcion extends Model
{


    protected $table = "funcion";
    protected $primaryKey = "codFuncion";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
 

    function getSala(){
      return Sala::findOrFail($this->codSala);
    }

    function getPelicula(){
      return Pelicula::findOrFail($this->codPelicula);
    }


    function getFechaEscritaSinAño(){
      return Fecha::formatoFechaEscritaSinAño($this->fechaHoraFuncion);
    }

    function getFechaEscrita(){
      return Fecha::formatoFechaEscrita($this->fechaHoraFuncion);
    }

    
    function getHora(){
      return Fecha::formatoSoloHora($this->fechaHoraFuncion);

    }

    function getAforo(){
      return $this->cantidadEntradasVirtuales + $this->cantidadEntradasVentaPresencial;
      
    }

    function getEntradas(){

      return Entrada::where('codFUncion',$this->getId())->get();
    }


    function getFechaFuncion(){
      return Fecha::formatoFechaParaVistas($this->fechaHoraFuncion);
    }

    function getHoraFuncion(){
      return Fecha::formatoHoraParaVistas($this->fechaHoraFuncion);

    }

    function getUsuarioCreador(){
      return Usuario::findOrFail($this->codUsuarioCreador);
    }

    function getFechaHoraCreacion(){
      return Fecha::formatoFechaHoraEscrita($this->fechaHoraCreacion);
    }


}
