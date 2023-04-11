<?php

use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\cat_clientesController;
use App\Http\Controllers\catalogo_proveedoresController;
use App\Http\Controllers\CotizacionesController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\setMenuController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/menu', 'MenuController@index');
// Route::get('/menu', [MenuController::class,'index'])->name('menu');
Route::get('/home', [setMenuController::class,'index'])->name('menu');
Route::resource('permissions', PermissionController::class);
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    // Route::resource('products', ProductController::class);
    Route::resource('cotizaciones', CotizacionesController::class);
});

// catalogo de clientes 
Route::group(['middleware' => ['auth']], function() {

Route::get('cat_clientes', [cat_clientesController::class, 'index'])->name('admin.cat_clientes')->middleware('auth');
Route::get('listado_clientes', [cat_clientesController::class, 'listado_clientes'])->name('admin.listado_clientes');

Route::get('combo', [cat_clientesController::class, 'combo'])->name('combo');
Route::get('dddw_status', [cat_clientesController::class, 'dddw_status'])->name('dddw_status');
Route::get('dddw_niveles', [cat_clientesController::class, 'dddw_niveles'])->name('dddw_niveles');
Route::get('inserta_cliente', [cat_clientesController::class, 'inserta_cliente'])->name('inserta_cliente');
Route::get('inserta_nueva_direccion', [cat_clientesController::class, 'inserta_nueva_direccion'])->name('inserta_nueva_direccion');

Route::get('edita_cliente', [cat_clientesController::class, 'edita_cliente'])->name('edita_cliente');
Route::get('actualiza_cliente', [cat_clientesController::class, 'actualiza_cliente'])->name('actualiza_cliente');
Route::get('edita_cliente_direccion', [cat_clientesController::class, 'edita_cliente_direccion'])->name('edita_cliente_direccion');
Route::get('actualiza_cliente_direccion', [cat_clientesController::class, 'actualiza_cliente_direccion'])->name('actualiza_cliente_direccion');

Route::get('cliente_show/{id}', [cat_clientesController::class, 'cliente_show'])->name('cliente_show');

});

//catalogo de proveedores
Route::group(['middleware' => ['auth']], function() {
    Route::get('catalogo_proveedores', [catalogo_proveedoresController::class, 'index_prov'])->name('catalogo_proveedores')->middleware('auth');
    Route::get('listado_proveedores', [catalogo_proveedoresController::class, 'listado_proveedores'])->name('listado_proveedores');
    Route::get('inserta_nuevo_proveedor', [catalogo_proveedoresController::class, 'inserta_nuevo_proveedor'])->name('inserta_nuevo_proveedor');
    Route::get('valida_nuevo_proveedor', [catalogo_proveedoresController::class, 'valida_nuevo_proveedor'])->name('valida_nuevo_proveedor');

    Route::get('edita_proveedor', [catalogo_proveedoresController::class, 'edita_proveedor'])->name('edita_proveedor');
    Route::get('actualiza_proveedor', [catalogo_proveedoresController::class, 'actualiza_proveedor'])->name('actualiza_proveedor');
    Route::get('edita_proveedor_direccion', [catalogo_proveedoresController::class, 'edita_proveedor_direccion'])->name('edita_proveedor_direccion');
    Route::get('actualiza_proveedor_direccion', [catalogo_proveedoresController::class, 'actualiza_proveedor_direccion'])->name('actualiza_proveedor_direccion');

    Route::get('proveedor_show/{id}', [catalogo_proveedoresController::class, 'proveedor_show'])->name('proveedor_show');

});
//catalogo de Marcas
Route::group(['middleware' => ['auth']], function() {
    Route::get('cat_marcas', [MarcasController::class, 'index'])->name('cat_marcas')->middleware('auth');
    Route::get('listado_marcas', [MarcasController::class, 'listado_marcas'])->name('listado_marcas');
    Route::get('inserta_marca', [MarcasController::class, 'inserta_marca'])->name('inserta_marca');
    Route::get('edita_marca', [MarcasController::class, 'edita_marca'])->name('edita_marca');
    Route::get('actualiza_marca', [MarcasController::class, 'actualiza_marca'])->name('actualiza_marca');
    Route::post('upload', [MarcasController::class, 'store']);

    Route::get('marca_show/{id}', [MarcasController::class, 'marca_show'])->name('marca_show');

});
//catalogo de Articulos
Route::group(['middleware' => ['auth']], function() {
    Route::get('Articulos', [ArticulosController::class, 'index'])->name('Articulos')->middleware('auth');
    Route::get('listado_articulos', [ArticulosController::class, 'listado_articulos'])->name('listado_articulos');
    Route::get('inserta_articulo', [ArticulosController::class, 'inserta_articulo'])->name('inserta_articulo');
    Route::get('edita_articulo', [ArticulosController::class, 'edita_articulo'])->name('edita_articulo');
    Route::get('actualiza_articulo', [ArticulosController::class, 'actualiza_articulo'])->name('actualiza_articulo');
});

//catalogo de Menus
Route::group(['middleware' => ['auth']], function() {
    Route::get('/menu', [MenuController::class, 'index'])->name('menu')->middleware('auth');
    Route::get('listado_menu', [MenuController::class, 'listado_menu'])->name('listado_menu');
    Route::get('inserta_menu', [MenuController::class, 'inserta_menu'])->name('inserta_menu');
    Route::get('edita_menu', [MenuController::class, 'edita_menu'])->name('edita_menu');
    Route::get('actualiza_menu', [MenuController::class, 'actualiza_menu'])->name('actualiza_menu');
});



