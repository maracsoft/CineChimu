<?php

namespace App\Http\Controllers;

use App\Pelicula;
use App\User;
use App\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class PeliculaController extends Controller
{
     

  /* Renders the view */
  public function ListarPeliculas(Request $request){
    $listaPeliculas = Pelicula::paginate(50);

    return view('Peliculas.ListarPeliculas',compact('listaPeliculas'));
    
  }
  
  /* Renders the view */
  public function EditarPelicula($codPelicula){

    $pelicula = Pelicula::findOrFail($codPelicula);

    return view('Peliculas.EditarPelicula',compact('pelicula'));
  }


  /* Renders the view */
  public function CrearPelicula(){

    return view('Peliculas.CrearPelicula');
  }



  public function ActualizarPelicula(Request $request){
    try {
      db::beginTransaction();

      $codPelicula = $request->codPelicula;
      $pelicula = Pelicula::findOrFail($codPelicula);

      $pelicula->nombre = $request->nombre; 
      $pelicula->director = $request->director; 
      $pelicula->añoEstreno = $request->añoEstreno; 
      $pelicula->duracionMinutos = $request->duracionMinutos; 
      $pelicula->descripcion = $request->descripcion; 

      $pelicula->save();

      if($request->file('fotoPoster')){
         
        $archivoRespuestas = $request->file('fotoPoster'); 
      
        $filegetRespuestas = \File::get($archivoRespuestas);
        $nombreArchivo = $pelicula->getPosterFileName().".".$request->file_end;
        
        $pelicula->urlFoto = "/img/Posters/".$nombreArchivo;
        $pelicula->save();
        Storage::disk('posters')->put($nombreArchivo,$filegetRespuestas );  
      }
      
      db::commit();

      return redirect()->route('Peliculas.Editar',$codPelicula)->with('datos',"Película editada exitosamente");

    } catch (\Throwable $th) {
      throw $th;
    }


  }
  public function GuardarPelicula(Request $request){
    try {
      db::beginTransaction();

      $pelicula = new Pelicula();
      $pelicula->fechaHoraCreacion = Carbon::now();
      $pelicula->codUsuarioCreador = Usuario::getLogeado()->getId();
      $pelicula->nombre = $request->nombre; 
      $pelicula->director = $request->director; 
      $pelicula->añoEstreno = $request->añoEstreno; 
      $pelicula->duracionMinutos = $request->duracionMinutos; 
      $pelicula->descripcion = $request->descripcion; 
      $pelicula->urlFoto = "temporal";
      $pelicula->save();
 
        
      $archivoRespuestas = $request->file('fotoPoster'); 
    
      $filegetRespuestas = \File::get($archivoRespuestas);
      $nombreArchivo = $pelicula->getPosterFileName().".".$request->file_end;
      
      $pelicula->urlFoto = "/img/Posters/".$nombreArchivo;
      $pelicula->save();
      Storage::disk('posters')->put($nombreArchivo,$filegetRespuestas );  
      
      
      db::commit();

      return redirect()->route('Peliculas.Editar',$pelicula->getId())->with('datos',"Película registrada exitosamente");

    } catch (\Throwable $th) {
      throw $th;
    }


  }
  
  
  /* Ya no se listará de ahora en adelante */
  public function Eliminar($codPelicula){

    


  }
  



}
