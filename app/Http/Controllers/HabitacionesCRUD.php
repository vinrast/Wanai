<?php namespace App\Http\Controllers;

use App\Habitacion;
use App\Http\Requests;
use Input;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Http\Request;
use Session;
use Validator;

class HabitacionesCRUD extends Controller {

	public function Create(Request $request){
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

		$rules = ['i_nombre'	=>'required',
				'i_descripcion'	=>'required',
				'i_costo'		=>'required|numeric'
			];

		$v = Validator::make($request->all() , $rules);

		if ($v->fails()){
			$redirecto     = url("#");
			$success 	   = false;
			$mensaje 	   = "Errores de formulario, por favor intente de nuevo.";
			$titulo  	   = "Disculpe!";
			$data["erros"] = $v->messages();
			$data["fail"]  = $v->failed();
			$json 		   = array('success'  => $success,
								  'mensaje'   => $mensaje,
								  'titulo'    => $titulo,
								  'redirecto' => $redirecto,
								  'data'	  => $data);
			return json_encode($json);
		}

		$habitacion                         = new Habitacion();
		$habitacion->nombre_habitacion      = Input::get('i_nombre');
		$habitacion->descripcion_habitacion = Input::get('i_descripcion');
		$habitacion->costo_habitacion		= Input::get('i_costo');
		$habitacion->id_hotel 				= Session::get('hotel');
		$habitacion->save();

		$redirecto     = url("#");
		$success 	   = true;
		$mensaje 	   = "Habitación registrada";
		$titulo  	   = "Registro exitoso!";
		$data 		   = array( "id"	  => $habitacion->id);
		$json 		   = array('success'  => $success,
							  'mensaje'   => $mensaje,
							  'titulo'    => $titulo,
							  'redirecto' => $redirecto,
							  'data'	  => $data);
		
		return json_encode($json);
	}


	public function Edit(){
	
	}


	public function Delete($id){
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

		habitacion::where('id_habitacion', '=', $id)->delete();

		$redirecto     = url("#");
		$success 	   = true;
		$mensaje 	   = "Habitación eliminada";
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
