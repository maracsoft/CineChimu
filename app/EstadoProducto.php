<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
class EstadoProducto extends Model
{




    protected $table = "estado_producto";
    protected $primaryKey = "codEstadoProducto";
    public $timestamps = false;  

    const Activo = 1;
    const Inactivo = 1;
      



}