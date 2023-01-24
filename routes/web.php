<?php

use App\Http\Controllers\Administracion\Compras\CompraController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Administracion\Productos\ProductoController;
use App\Http\Controllers\Administracion\Facturas\FacturaController;
use App\Http\Controllers\Clientes\ClienteController;

Route::get('/', function () {
    
    return view('welcome');
})->name('welcome');

Route::post('asignacnioasd','UserController@assigndatabase')->name('assigndatabase');

Auth::routes();

Route::get('/home',  [BackendController::class, 'index'])->name('home');

Route::group(["prefix"=>'clientes'],function(){
    Route::get('/index', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/register', [ClienteController::class, 'register'])->name('clientes.create');
    Route::post('/store', [ClienteController::class, 'store'])->name('clientes.store');
  
});

Route::group(["prefix"=>'productos'],function(){
    Route::get('/index', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/register', [ProductoController::class, 'register'])->name('productos.create');
    Route::post('/store', [ProductoController::class, 'store'])->name('productos.store');
   
});

Route::group(["prefix"=>'facturas'],function(){
    Route::get('/index', [FacturaController::class, 'index'])->name('facturas.index');
    Route::get('/register', [FacturaController::class, 'create'])->name('facturas.create');
    Route::post('/store', [FacturaController::class, 'store'])->name('facturas.store');
    Route::get('/show/{id_factura}', [FacturaController::class, 'show'])->name('facturas.show');
   
});

Route::group(["prefix"=>'compras'],function(){
    Route::get('/index', [CompraController::class, 'index'])->name('compras.index');
    Route::get('/register/{id_producto}', [CompraController::class, 'create'])->name('compras.create');
    Route::post('/store', [CompraController::class, 'store'])->name('compras.store');
   
});