<?php

//$router->group(['middleware' => 'auth'], function() {

//___________________________BOLETOS_____________________________
	Route::get('boletos/index', 			'BoletosController@Index');
	Route::get('boletos/agr', 				'BoletosController@LinkAgregar');
	Route::get('boletos/agregar',			'BoletosController@AgregarBoleto');
	Route::post('boletos/postboleto',		'BoletosController@PostAgregarBoleto');
	Route::get('boletos/registrado',		'BoletosController@GetDetalleBoleto');
	Route::get('boletos/listar', 			'BoletosController@ListarBoleto');
	Route::get('boletos/editar/{id}', 		'BoletosController@EditBoleto');
	Route::post('boletos/posteditarboleto', 'BoletosController@PostEditBoleto');
	Route::post('boletos/delboleto/',		'BoletosController@DelBoleto');

//___________________________HOTELES_____________________________
 	Route::get('hoteles/index', 			'HotelController@Index');
	Route::get('hoteles/agr', 				'HotelController@LinkAgregar');
	Route::get('hoteles/agregar', 			'HotelController@AgregarHotel');
	Route::post('hoteles/posthotel', 		'HotelController@PostAgregarHotel');
	Route::post('hoteles/posteditarhotel',  'HotelController@PostEditHotel');
	Route::get('hoteles/listar', 			'HotelController@ListarHotel');
	Route::any('hoteles/agregar-imagen', 	'HotelController@AgregarImagen');
	Route::post('hoteles/postagregarimagen','HotelController@PostAgregarImagen');
	Route::post('hoteles/posteliminarimagen','HotelController@PostDelImagen');
	Route::get('hoteles/agregar-habitacion','HotelController@AgregarHabitacion');
	Route::get('hoteles/agregar-regimen', 	'HotelController@AgregarRegimen');
	Route::get('hoteles/registrado', 		'HotelController@AgregarFin');
	Route::get('hoteles/editar/{id}', 		'HotelController@EditHotel');
	Route::post('hoteles/delhotel/',		'HotelController@DelHotel');

	//curd habitacion
	Route::post('habitacion/create', 		'HabitacionesCRUD@Create');
	Route::post('habitacion/edit/{id}', 	'HabitacionesCRUD@Edit');
	Route::post('habitacion/{id}', 			'HabitacionesCRUD@Delete');

	//curd regimen
	Route::post('regimen/create', 			'RegimenesCRUD@Create');
	Route::post('regimen/edit/{id}', 		'RegimenesCRUD@Edit');
	Route::post('regimen/{id}', 			'RegimenesCRUD@Delete');

//___________________________PAQUETES____________________________
	Route::any('paquetes/index', 			'PaqueteController@Index');
	Route::any('paquetes/agregar', 			'PaqueteController@AgregarPaquete');
	Route::any('paquetes/agr', 				'PaqueteController@LinkAgregar');
	Route::any('paquetes/listar', 			'PaqueteController@ListarPaquete');
	Route::any('paquetes/agregar-imagen', 	'PaqueteController@AgregarImagen');
	Route::any('paquetes/postpaquete', 		'PaqueteController@PostAgregarPaquete');
	Route::get('paquetes/editar/{id}', 		'PaqueteController@EditPaquete');
	Route::any('paquetes/registrado', 		'PaqueteController@AgregarFinal');
	Route::post('paquetes/posteditarpaquete','PaqueteController@PostEditPaquete');
	Route::post('paquetes/delpaquete/',		'PaqueteController@DelPaquete');

	Route::post('paquetes/postagregarimagen','PaqueteController@PostAgregarImagen');
	Route::post('paquetes/posteliminarimagen','PaqueteController@PostDelImagen');	

//______________________ SERVICES ________________________________
	Route::any('upload/img',				'ImgController@create');
//});

//______________________ CLIENTE __________________________________
Route::get('/', 							'ClienteController@Index');

Route::get('hoteles', 						'ClienteController@GetHoteles');
Route::get('paquetes', 						'ClienteController@GetPaquetes');
Route::get('boletos', 						'ClienteController@GetBoletos');

Route::get('hoteles/detalle/{id}',			'ClienteController@DetailHoteles');
Route::get('paquetes/detalle/{id}',			'ClienteController@DetailPaquetes');
Route::get('boletos/detalle/{id}',			'ClienteController@DetailBoletos');

Route::get('hoteles/cotizar/{id}',		'ClienteController@CotizacionHoteles');
Route::get('paquetes/cotizar/{id}',		'ClienteController@CotizacionPaquetes');
Route::get('boletos/cotizar/{id}',		'ClienteController@CotizacionBoletos');


Route::post('hoteles/cotizacion/post',		'ClienteController@PostCotizacionHoteles');
Route::post('paquetes/cotizacion/post',		'ClienteController@PostCotizacionPaquetes');
Route::post('boletos/cotizacion/post',		'ClienteController@PostCotizacionBoletos');

Route::get('home', 							'HomeController@index');
Route::get('auth/cerrar', 					'LoginController@CerrarSesion');
Route::controllers([
					'auth' 		=> 'Auth\AuthController',
					'password' 	=> 'Auth\PasswordController',
]);





	