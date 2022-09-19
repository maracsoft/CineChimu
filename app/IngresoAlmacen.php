<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
class IngresoAlmacen extends Model
{


    protected $table = "ingreso_almacen";
    protected $primaryKey = "codIngreso";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
  
    public function getDetallesIngreso(){

      return DetalleIngreso::where('codIngreso',$this->codIngreso)->get();;
    }


    public function getUsuarioCreador(){
      return IngresoAlmacen::findOrFail($this->codUsuarioCreador);
    }
}