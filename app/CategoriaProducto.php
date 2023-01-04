<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
class CategoriaProducto extends Model
{


    protected $table = "categoria_producto";
    protected $primaryKey = "codCategoria";
    public $timestamps = false;  

    



}