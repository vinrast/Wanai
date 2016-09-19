<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Regimen;
use App\Tipo;
use App\Habitacion;
use Input;
use Response;
use Session;
use Illuminate\Http\Request;
use Validator;

class RegimenesCRUD extends Controller {

	public function Create(Request $request){

		if (!Session::has('hotel') ){
			$redirecto     = url("/hoteles/agregar");
			$success 	   = false;
			$mensaje 	   = "Introduzca la información básica del hotel para continuar.";
			$titulo  	   = "Disculpe!";
			$data 		   = array();
			$json 		   = array('success'   => $success,
								  'mensaje'   => $mensaje,
								  'titulo'    => $titulo,
								  'redirecto' => $redirecto,
								  'data'	  => $data);
			return json_encode($json);
		}

		$rules = ['i_nombre'	=>'required',
				'i_descripcion'	=>'required',
				'i_costo'		=>'required|numeric'
			];	
		$rules = [];

		$v = Validator::make($request->all() , $rules);

		if ($v->fails()){
			$redirecto     = url("#");
			$success 	   = false;
			$mensaje 	   = "Errores de formulario, por favor intente de nuevo.";
			$titulo  	   = "Disculpe!";
			$data["erros"] = $v->messages();
			$data["fail"]  = $v->failed();
			$data["sesion"]= array("has" => Session::has('hotel'),
									"id" => Session::get('hotel'));
			$json 		   = array('success'   => $success,
								  'mensaje'   => $mensaje,
								  'titulo'    => $titulo,
								  'redirecto' => $redirecto,
								  'data'	  => $data);
			
			return json_encode($json);
		}

		$regimen                     		= new Regimen();
		$regimen->costo_detalle_regimen		= Input::get('i_costo');
		$regimen->id_habitacion				= Input::get('i_habitacion');
		$regimen->id_tipo					= Input::get('i_regimen');
		$regimen->id_hotel 			 		= Session::get('hotel');
		$regimen->save();


		$tipo = Tipo::where('id_tipo', Input::get('i_regimen'))->first();

		$habitacion = Habitacion::where('id_habitacion',Input::get('i_habitacion'))->first();


		$redirecto     = url("#");
		$success 	   = true;
		$mensaje 	   = "Régimen registrado.";
		$titulo  	   = "Registro exitoso!";
		$data 		   = array( "id"	  			=> $regimen->id,
								"nombre_tipo"	 	=> $tipo->nombre_tipo,
								"nombre_habitacion" => $habitacion->nombre_habitacion,
								"costo_habitacion"	=> $habitacion->costo_habitacion,
							);
		$json 		   = array('success'  => $success,
							  'mensaje'   => $mensaje,
							  'titulo'    => $titulo,
							  'redirecto' => $redirecto,
							  'data'	  => $data);
		
		return json_encode($json);
	}


	public function Delete($id_regimen){
		if (!Session::has('hotel')){
			$redirecto     = url("/hoteles/agregar");
			$success 	   = false;
			$mensaje 	   = "Introduzca la información básica del hotel para continuar.";
			$titulo  	   = "Disculpe!";
			$data 		   = array();
			$json 		   = array('success'   => $success,
								  'mensaje'   => $mensaje,
								  'titulo'    => $titulo,
								  'redirecto' => $redirecto,
								  'data'	  => $data);
			return json_encode($json);
		}

		Regimen::where("id_detalle_regimen","=",$id_regimen)->delete();

		$redirecto     = url("#");
		$success 	   = true;
		$mensaje 	   = "Régimen eliminado";
		$titulo  	   = "Borrado exitoso!";
		$data 		   = array();
		$json 		   = array('success'  => $success,
							  'mensaje'   => $mensaje,
							  'titulo'    => $titulo,
							  'redirecto' => $redirecto,
							  'data'	  => $data);
		
		return json_encode($json);
	}

}
