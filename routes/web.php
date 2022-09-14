<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


/* RUTAS PARA INGRESO Y REGISTRO DE USUARIO Y CLIENTE */


Route::get('/', 'UserController@home')->name('user.home');

Route::get('/login', 'UserController@verLogin')->name('user.verLogin'); //para desplegar la vista del Login
Route::post('/ingresar', 'UserController@logearse')->name('user.logearse'); //post

Route::get('/cerrarSesion','UserController@cerrarSesion')->name('user.cerrarSesion');


Route::group(['middleware'=>"ValidarSesion"],function()
{

    /* USUARIOS */
    
    Route::get('/Usuarios/Listar','UsuarioController@Listar')->name('Usuarios.Listar');

    Route::get('/Usuarios/Crear','UsuarioController@Crear')->name('Usuarios.Crear');
    Route::get('/Usuarios/{id}/Editar','UsuarioController@Editar')->name('Usuarios.Editar');
    
    Route::post('/Usuarios/Guardar','UsuarioController@Guardar')->name('Usuarios.Guardar');
    Route::post('/Usuarios/Update','UsuarioController@Update')->name('Usuarios.Update');
    
    Route::get('/Usuarios/{id}/eliminar','UsuarioController@Eliminar')->name('Usuarios.Eliminar');
    
    
    /* PELICULA */
    Route::get('/Peliculas/Listar','PeliculaController@ListarPeliculas')->name('Peliculas.Listar');

    Route::get('/Peliculas/Crear','PeliculaController@CrearPelicula')->name('Peliculas.Crear');
    Route::get('/Peliculas/{id}/Editar','PeliculaController@EditarPelicula')->name('Peliculas.Editar');
    
    Route::post('/Peliculas/Guardar','PeliculaController@GuardarPelicula')->name('Peliculas.Guardar');
    Route::post('/Peliculas/Actualizar','PeliculaController@ActualizarPelicula')->name('Peliculas.Actualizar');
    
    Route::get('/Peliculas/{id}/Cancelar','PeliculaController@Eliminar')->name('Peliculas.Eliminar');
    
    

    /* FUNCION */

    Route::get('/Funciones/Listar','FuncionController@ListarFunciones')->name('Funciones.Listar');

    Route::get('/Funciones/Crear','FuncionController@CrearFuncion')->name('Funciones.Crear');
    Route::get('/Funciones/{id}/Editar','FuncionController@EditarFuncion')->name('Funciones.Editar');
    
    Route::post('/Funciones/Guardar','FuncionController@GuardarFuncion')->name('Funciones.Guardar');
    Route::post('/Funciones/Actualizar','FuncionController@ActualizarFuncion')->name('Funciones.Actualizar');
    
    Route::get('/Funciones/{id}/Cancelar','FuncionController@Eliminar')->name('Funciones.Eliminar');
    
    
    /* VENTAS */

    Route::get('/Cartelera','FuncionController@VerCartelera')->name('Funciones.VerCartelera');
    Route::get('/Comprar/{id}','FuncionController@VerComprar')->name('Funciones.VerComprar');


    
});


