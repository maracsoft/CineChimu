<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
class LogeoHistorial extends Model
{


    protected $table = "logeo_historial";
    protected $primaryKey = "codLogeoHistorial";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
 

}
