<?php

namespace App\Http\Controllers;

use App\User;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    const PAGINATION = 15;

    public function Listar(){
        $usuarios = User::paginate($this::PAGINATION);

        return view('Usuarios.Listar',compact('usuarios'));
    }

    public function Crear(){
        return view('Usuarios.Crear');
    }

    public function Editar($id){
        $usuario=Usuario::findOrFail($id);
        return view('Usuarios.Editar',compact('usuario'));
    }

    public function Eliminar($id){
        $usuario=User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('Usuarios.Listar')
                ->with('datos','Usuario '.$usuario->usuario.' eliminado exitosamente');
    }



    public function Guardar(Request $request){
        try{
            DB::beginTransaction();
            
            $usuario=new User();
            $usuario->usuario=$request->usuario;
            $usuario->password=hash::make($request->password1);
            $usuario->save();
            

            db::commit();
            return redirect()->route('Usuarios.Listar')
                ->with('datos','Usuario '.$usuario->usuario.' registrado exitosamente');
            
        }catch (\Throwable $th) {
            //Debug::mensajeError(' ACTOR CONTROLLER guardarcrearactor' ,$th);    
            DB::rollback();

            return redirect()->route('Usuarios.Listar')
                ->with('datos','Error al registrar un usuario');
                
        }
         
    }
    public function Update(Request $request){
        try{
            DB::beginTransaction();
            
            $usuario=User::findOrFail($request->codUsuario);
            $usuario->usuario=$request->usuario;
            $usuario->password=hash::make($request->password1);
            $usuario->save();
            

            db::commit();
            return redirect()->route('Usuarios.Listar')
                ->with('datos','Usuario '.$usuario->usuario.' editado exitosamente');
            
        }catch (\Throwable $th) {
            //Debug::mensajeError(' ACTOR CONTROLLER guardarcrearactor' ,$th);    
            DB::rollback();

            return redirect()->route('Usuarios.Listar')
                ->with('datos','Error al editar un usuario');
                
        }
         
    }

}
