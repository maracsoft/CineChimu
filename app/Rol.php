<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
class Rol extends Model
{


    protected $table = "rol";
    protected $primaryKey = "codRol";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
 

}
