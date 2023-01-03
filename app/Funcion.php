<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
class Funcion extends Model
{


    protected $table = "funcion";
    protected $primaryKey = "codFuncion";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
 
    function getTextoResumenHoy(){
      return $this->getPelicula()->nombre. " " .$this->getHora();

    }

    function getDescripcion(){
      return $this->getPelicula()->nombre. " " .$this->getFechaEscritaSinAño(). " ".$this->getHora();

    }

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

    function getHora_hora(){
      return Fecha::formatoSoloHora_hora($this->fechaHoraFuncion);
      
    }
    function getHora_minutos(){
      return Fecha::formatoSoloHora_minuto($this->fechaHoraFuncion);
      

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



    function yaPaso(){

      $fechaActual = new DateTime();
      $fechaHoraFuncion = new DateTime($this->fechaHoraFuncion);
      
      return $fechaActual < $fechaHoraFuncion;

    }
    function rowColor(){
      return $this->yaPaso() ? "pendiente" : '';
    }

}
