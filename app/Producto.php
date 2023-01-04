<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
class Producto extends Model
{


    protected $table = "producto";
    protected $primaryKey = "codProducto";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
  

    public function getUsuarioCreador(){
      return Usuario::findOrFail($this->codUsuarioCreador);
    }

    public function getEstado(){
      return EstadoProducto::findOrFail($this->codEstadoProducto);
    }
    
}