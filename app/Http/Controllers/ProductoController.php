<?php

namespace App\Http\Controllers;

use App\CategoriaProducto;
use App\EstadoProducto;
use App\Producto;
use App\User;
use App\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class ProductoController extends Controller
{
     

  /* Renders the view */
  public function ListarProductos(Request $request){
    $listaProductos = Producto::paginate(50);

    return view('Productos.ListarProductos',compact('listaProductos'));
    
  }
  
  /* Renders the view */
  public function EditarProducto($codProducto){
    $listaCategorias = CategoriaProducto::All();
    $listaEstados = EstadoProducto::All();
    $producto = Producto::findOrFail($codProducto);

    return view('Productos.EditarProducto',compact('producto','listaCategorias','listaEstados'));
  }


  /* Renders the view */
  public function CrearProducto(){

    $listaCategorias = CategoriaProducto::All();

    return view('Productos.CrearProducto',compact('listaCategorias'));
  }



  public function ActualizarProducto(Request $request){
    try {
      db::beginTransaction();

      $codProducto = $request->codProducto;
      $producto = Producto::findOrFail($codProducto);

      $producto->nombre = $request->nombre; 
      $producto->descripcion = $request->descripcion;
      $producto->stock = $request->stock;
      $producto->precioVenta = $request->precioVenta;
      $producto->codCategoria = $request->codCategoria;
      
      $producto->codEstadoProducto = $request->codEstadoProducto;

      $producto->save();

      db::commit();

      return redirect()->route('Productos.Editar',$codProducto)->with('datos',"Película editada exitosamente");

    } catch (\Throwable $th) {
      throw $th;
    }
  }


  public function GuardarProducto(Request $request){
    try {
      db::beginTransaction();

      $producto = new Producto();
      
      $producto->nombre = $request->nombre; 
      $producto->descripcion = $request->descripcion;
      $producto->stock = $request->stock;
      $producto->precioVenta = $request->precioVenta;
      $producto->fechaHoraCreacion = Carbon::now();
      $producto->codEstadoProducto = EstadoProducto::Activo;
      $producto->codUsuarioCreador = Usuario::getLogeado()->getId();
      $producto->codCategoria = $request->codCategoria;

      
      $producto->save();

      db::commit();

      return redirect()->route('Productos.Editar',$producto->getId())->with('datos',"Producto registrado exitosamente");

    } catch (\Throwable $th) {
      throw $th;
    }


  }
  
  
  



}
