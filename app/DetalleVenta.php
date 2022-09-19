<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
class DetalleVenta extends Model
{


    protected $table = "detalle_venta";
    protected $primaryKey = "codDetalleVenta";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
  


    public function getVenta(){

      return Venta::findOrFail($this->codVenta);
    }

    public function getProducto(){
      return Producto::findOrFail($this->codProducto);
    }

    
}