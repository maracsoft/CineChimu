<?php

use App\EstadoIntencion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


/* RUTAS PARA INGRESO Y REGISTRO DE USUARIO Y CLIENTE */


Route::get('/', 'UserController@home')->name('user.home');

Route::get('/login', 'UserController@verLogin')->name('user.verLogin'); //para desplegar la vista del Login
Route::post('/ingresar', 'UserController@logearse')->name('user.logearse'); //post

Route::get('/cerrarSesion','UserController@cerrarSesion')->name('user.cerrarSesion');


Route::get('/probandoCosas',function(){
  return EstadoIntencion::getCodEstado('Creado');

});





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
    
    
    /* VENTAS de funciones */

    Route::get('/Cartelera','IntencionPagoController@VerCartelera')->name('IntencionPago.VerCartelera');
    Route::get('/Comprar/{id}','IntencionPagoController@VerComprar')->name('IntencionPago.VerComprar');


    Route::post('/IntencionPago/Guardar/','IntencionPagoController@guardarIntencion')->name('IntencionPago.GuardarIntencion');
    Route::get('/IntencionPago/{codIntencion}/VerPagar','IntencionPagoController@VerPagar')->name('IntencionPago.VerPagar'); /* En esta vista se debería mostrar la pasarela incrustada */
    
    Route::post('/IntencionPago/EfectuarPago','IntencionPagoController@EfectuarPago')->name('IntencionPago.EfectuarPago');
    

    //para compra ya realizada
    Route::get('/IntencionPago/VerMiCompra/{codIntencion}','IntencionPagoController@VerMiCompra')->name('IntencionPago.VerMiCompra');





    /* MODULO DE PUNTO DE VENTA */
    
    /* PRODUCTO */

    Route::get('/Productos/Listar','ProductoController@ListarProductos')->name('Productos.Listar');

    Route::get('/Productos/Crear','ProductoController@CrearProducto')->name('Productos.Crear');
    Route::get('/Productos/{id}/Editar','ProductoController@EditarProducto')->name('Productos.Editar');
    
    Route::post('/Productos/Guardar','ProductoController@GuardarProducto')->name('Productos.Guardar');
    Route::post('/Productos/Actualizar','ProductoController@ActualizarProducto')->name('Productos.Actualizar');
    
    Route::get('/Productos/{id}/Eliminar','ProductoController@Eliminar')->name('Productos.Eliminar');
    

    /* VENTA */


    Route::get('/Ventas/Listar','VentaController@ListarVentas')->name('Ventas.Listar');

    Route::get('/Ventas/Crear','VentaController@CrearVenta')->name('Ventas.Crear');
    Route::get('/Ventas/{id}/Editar','VentaController@EditarVenta')->name('Ventas.Editar');
    
    Route::post('/Ventas/Guardar','VentaController@GuardarVenta')->name('Ventas.Guardar');
    Route::post('/Ventas/Actualizar','VentaController@ActualizarVenta')->name('Ventas.Actualizar');
    
    Route::get('/Ventas/{id}/Eliminar','VentaController@Eliminar')->name('Ventas.Eliminar');
    



    /* INGRESO DE ALMACEN */

    Route::get('/IngresoAlmacen/Listar','IngresoAlmacenController@ListarIngresos')->name('IngresoAlmacen.Listar');

    Route::get('/IngresoAlmacen/Crear','IngresoAlmacenController@CrearIngreso')->name('IngresoAlmacen.Crear');
    Route::get('/IngresoAlmacen/{id}/Editar','IngresoAlmacenController@EditarIngreso')->name('IngresoAlmacen.Editar');
    
    Route::post('/IngresoAlmacen/Guardar','IngresoAlmacenController@GuardarIngreso')->name('IngresoAlmacen.Guardar');
    Route::post('/IngresoAlmacen/Actualizar','IngresoAlmacenController@ActualizarIngreso')->name('IngresoAlmacen.Actualizar');
    
    Route::get('/IngresoAlmacen/{id}/Eliminar','IngresoAlmacenController@Eliminar')->name('IngresoAlmacen.Eliminar');
    
    

});


