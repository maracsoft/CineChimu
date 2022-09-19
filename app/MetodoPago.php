<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
class MetodoPago extends Model
{


    protected $table = "metodo_pago";
    protected $primaryKey = "codMetodo";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
  
    
}