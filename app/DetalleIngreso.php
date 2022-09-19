<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Auth;
class DetalleIngreso extends Model
{

    protected $table = "detalle_ingreso";
    protected $primaryKey = "codDetalleIngreso";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
  

    public function getIngreso(){
      return IngresoAlmacen::findOrFail($this->codIngreso);
    }

    public function getProducto(){
      return Producto::findOrFail($this->codProducto);
    }

    
}