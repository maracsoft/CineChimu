<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
class Usuario extends Model
{


    protected $table = "usuario";
    protected $primaryKey = "codUsuario";
    public $timestamps = false;  //para que no trabaje con los campos fecha 


    protected $fillable = [
        'codCliente', 'email','password','fechaActualizacion','isAdmin'
    ];

    public static function getLogeado(){
        return Usuario::findOrFail(Auth::id());
    }

    public function getNombreCompleto(){
      return $this->apellidos." ". $this->nombres;
    }

}
