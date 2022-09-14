<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
class ErrorHistorial extends Model
{


    protected $table = "error_historial";
    protected $primaryKey = "codErrorHistorial";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
 

}
