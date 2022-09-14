<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
class Sala extends Model
{


    protected $table = "sala";
    protected $primaryKey = "codSala";
    public $timestamps = false;  //para que no trabaje con los campos fecha 

  
    public static function getSalasActivas(){
      return Sala::All();
    }

}
