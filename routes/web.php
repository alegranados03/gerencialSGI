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
	//Rutas Administrador
	Route::get('BitacoraUsuario/{idUsuario}', 'UserController@bitacoraUsuarios')->name('usuario.bitacora')->middleware('has.role:admin');
	Route::resource('usuario','UserController')->middleware('has.role:admin');
	


	
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
	Route::get('ajaxRequestProducto_P1E','EstrategicoController@ajaxRequestProducto_P1E');
	Route::get('ajaxRequestProducto_P2E','EstrategicoController@ajaxRequestProducto_P2E');
	Route::get('ajaxRequestMateria_Prima_P3E','EstrategicoController@ajaxRequestMateria_Prima_P3E');
	Route::get('ajaxRequestClientes_P4E','EstrategicoController@ajaxRequestClientes_P4E');
	Route::get('ajaxRequestClientes_P5E','EstrategicoController@ajaxRequestClientes_P5E');

		//RUTAS AJAX TACTICO
	Route::get('ajaxRequestProducto_P1T','TacticoController@ajaxRequestProducto_P1T');
	Route::get('ajaxRequestProducto_P2T','TacticoController@ajaxRequestProducto_P2T');
	Route::get('ajaxRequestProducto_P3T','TacticoController@ajaxRequestProducto_P3T');
	Route::get('ajaxRequestProducto_P4T','TacticoController@ajaxRequestProducto_P4T');
	Route::get('ajaxRequestMateria_Prima_P5T','TacticoController@ajaxRequestMateria_Prima_P5T');
	Route::get('ajaxRequestClientes_P6T','TacticoController@ajaxRequestClientes_P6T');



		//RUTAS GENERAR EXCEL TACTICO
	Route::get('ReporteExcel/{json}', 'TacticoController@generarExcel');

		//RUTAS GENERAR PDF TACTICO
	Route::get('ReportePDF_P1T/{json}/{fechaInicio}/{fechaFin}', 'TacticoController@generarPDF_P1');
	Route::get('ReportePDF_P2T/{json}/{fechaInicio}/{fechaFin}', 'TacticoController@generarPDF_P2');
	Route::get('ReportePDF_P3T/{json}/{fechaInicio}/{fechaFin}', 'TacticoController@generarPDF_P3');
	Route::get('ReportePDF_P4T/{json}/{fechaInicio}/{fechaFin}', 'TacticoController@generarPDF_P4');
	Route::get('ReportePDF_P5T/{json}/{fechaInicio}/{fechaFin}', 'TacticoController@generarPDF_P5');
	Route::get('ReportePDF_P6T/{json}/{fechaInicio}/{fechaFin}', 'TacticoController@generarPDF_P6');

			//RUTAS GENERAR PDF ESTRATEGICO
	Route::get('ReportePDF_P1E/{json}/{fechaInicio}/{fechaFin}', 'EstrategicoController@generarPDF_P1');
	Route::get('ReportePDF_P2E/{json}/{fechaInicio}/{fechaFin}', 'EstrategicoController@generarPDF_P2');
	Route::get('ReportePDF_P3E/{json}/{fechaInicio}/{fechaFin}', 'EstrategicoController@generarPDF_P3');
	Route::get('ReportePDF_P4E/{json}/{fechaInicio}/{fechaFin}', 'EstrategicoController@generarPDF_P4');
	Route::get('ReportePDF_P5E/{json}/{fechaInicio}/{fechaFin}', 'EstrategicoController@generarPDF_P5');
	
});
