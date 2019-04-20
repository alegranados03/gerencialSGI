<?php

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
    return view('auth.login');
});

// Authentication Routes...
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function(){
	//Rutas Estrategicas
		//PRODUCTO
	Route::get('ReporteEstrategico/IngresosPorVentaPorCategoria', 'EstrategicoController@producto_P1')->name('estrategico.producto_P1')->middleware('has.permission:home.estrategico');
	Route::get('ReporteEstrategico/GananciaBrutaPorCategoria', 'EstrategicoController@producto_P2')->name('estrategico.producto_P2')->middleware('has.permission:home.estrategico');
		//MATERIA PRIMA
	Route::get('ReporteEstrategico/CostosDeMateriaPrimaPorProveedor', 'EstrategicoController@materia_prima_P3')->name('estrategico.materia_prima_P3')->middleware('has.permission:home.estrategico');
		//CLIENTES
	Route::get('ReporteEstrategico/PreferenciaDePagoDeLosClientes', 'EstrategicoController@clientes_P4')->name('estrategico.clientes_P4')->middleware('has.permission:home.estrategico');
	Route::get('ReporteEstrategico/VentasRealizadasAgrupadosPorGenero', 'EstrategicoController@clientes_P5')->name('estrategico.clientes_P5')->middleware('has.permission:home.estrategico');

	//Rutas Tacticas
		//PRODUCTO
	Route::get('ReporteTactico/IngresosPorVentaPorProducto', 'TacticoController@producto_P1')->name('tactico.producto_P1')->middleware('has.permission:home.tactico');
	Route::get('ReporteTactico/VentasEnLocal', 'TacticoController@producto_P2')->name('tactico.producto_P2')->middleware('has.permission:home.tactico');
	Route::get('ReporteTactico/VentasEnLinea', 'TacticoController@producto_P3')->name('tactico.producto_P3')->middleware('has.permission:home.tactico');
	Route::get('ReporteTactico/IngresosPorHora', 'TacticoController@producto_P4')->name('tactico.producto_P4')->middleware('has.permission:home.tactico');
		//MATERIA PRIMA
	Route::get('ReporteTactico/CostosMateriaPrima', 'TacticoController@materia_prima_P5')->name('tactico.materia_prima_P5')->middleware('has.permission:home.tactico');
		//CLIENTES
	Route::get('ReporteTactico/ClienteFrecuente', 'TacticoController@clientes_P6')->name('tactico.clientes_P6')->middleware('has.permission:home.tactico');


		//RUTAS AJAX ESTRATEGICO
	Route::get('ajaxRequestProducto_P1','EstrategicoController@ajaxRequestProducto_P1');
});
