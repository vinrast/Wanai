<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;

class AdministracionController extends Controller {

	public function Index(){
		return View::make('panel-registro');
	}
	public function Registrado(){
		/*$hotel                                = new Hotel;
		$hotel->nombre_hotel                  = e(Input::get('i_nombre')); 	
		$hotel->estado                        = e(Input::get('i_rif'));
		$hotel->ubicacion                     = e(Input::get('i_direccion'));
		$hotel->categoria                     = e(Input::get('i_categoria'));
		$hotel->correo_empresa                = e(Input::get('i_correo'));
		$hotel->id_estado                     = e(Input::get('id_estado'));
		$hotel->url_empresa                   = e(Input::get('i_sitio_web'));
		$hotel->positionmap_empresa_latitude  = e(Input::get('i_latitud'));
		$hotel->positionmap_empresa_longitude = e(Input::get('i_longitud'));					
		$hotel->telefono_empresa              = e(Input::get('i_telefono'));
		$hotel->telefono_2_empresa            = e(Input::get('i_telefono2'));
		$hotel->telefono_3_empresa            = e(Input::get('i_telefono3'));
		$hotel->telefono_movil_empresa        = e(Input::get('i_celular'));
		$hotel->save();*/
		return View::make('hoteles/registrado');
	}

	public function RegistroHabitaciones(){
		return View::make('hoteles/registro_habitacion');
	}

	public function RegistroPaquetes(){
		return View::make('hoteles/registro_paquete');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}