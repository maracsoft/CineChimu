<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
class Venta extends Model
{


    protected $table = "venta";
    protected $primaryKey = "codVenta";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
  

    public function getUsuarioComprador(){
      return Usuario::findOrFail($this->codUsuarioComprador);
    }

    public function getUsuarioCajero(){
      return Usuario::findOrFail($this->codUsuarioCajero);

    }

    public function getMetodoPago(){
      return MetodoPago::findOrFail($this->codMetodo);

    }


    public function getDetallesVenta(){
      return DetalleVenta::where('codVenta',$this->codVenta)->get();
    }
    public function getFechaHora(){
      return Fecha::formatoFechaHoraParaVistas($this->fechaHora);
    }

    public function getTotal(){
      return number_format($this->montoTotal,2);
    }


}