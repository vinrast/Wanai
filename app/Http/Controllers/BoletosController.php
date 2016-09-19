<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use App\Boleto;
use DB;
use App\Tipo;
use Input;
use Url;
use Validator;

class BoletosController extends Controller {

	public function Index(){
		$destino= DB::select('CALL p_t_hoteles(?,?)',array('cantidad_destino_reservados',''));
		return View::make('boletos/index', compact('destino'));
	}


	public function LinkAgregar(){
		\Session::forget('boleto');
		return \Redirect::to('/boletos/agregar');
	}


	public function AgregarBoleto(){
		$data = "";
        if(\Session::has('boleto')){
        	$id_boleto = \Session::get('boleto');
        	$data = (string) Boleto::where('id_boleto',$id_boleto)->first();
        };

		$aerolinea = DB::table('t_aerolineas')->get();
		$estados  = Tipo::where('id_maestro','=', '2')-> get();
		return View::make('boletos/agregar_boleto',compact('aerolinea','estados','data'));
	}


	public function PostAgregarBoleto(Request $request){

		$mensaje	 = "El boleto se registró exitosamente.";
		$titulo 	 = "Boleto registrado";
		$success 	 = true;
		$data        = array();
		$redirecto   = url("/boletos/registrado");

		$rules 	  = ['s_aerolinea'		=>'required|integer',
					's_origen'			=>'required|integer',
					's_destino' 		=>'required|integer',
					'i_salida'			=>'required',
					'i_cantidad'		=>'required|numeric',
					'i_costo_infante'	=>'required|numeric',
					'i_costo_adulto'	=>'required|numeric',
					'i_costo_bebe'		=>'required|numeric',
					];

		$v = Validator::make($request->all() , $rules);


		// validacion en backend

		if ($v->fails()){
			$redirecto     = url("#");
			$success 	   = false;
			$mensaje 	   = "Errores de formulario, por favor intente de nuevo.";
			$titulo  	   = "Disculpe!";
			$data["erros"] = $v->messages();
			$json = array('success'   => $success,
			  'mensaje'   => $mensaje,
			  'titulo'    => $titulo,
			  'redirecto' => $redirecto,
			  'data'	  => $data);
			
			return json_encode($json);
		}
		
		$boleto                      = new Boleto;
		$boleto->id_aerolinea        = Input::get('s_aerolinea');
		$boleto->id_tipo_origen      = Input::get('s_origen');
		$boleto->id_tipo_destino     = Input::get('s_destino');
		$boleto->fecha_salida_boleto = Input::get('i_salida');
		$boleto->cantidad_boleto     = Input::get('i_cantidad');
		$boleto->costo_boleto_adulto = Input::get('i_costo_adulto');
		$boleto->costo_boleto_infante= Input::get('i_costo_infante');
		$boleto->costo_boleto_bebe   = Input::get('i_costo_bebe');
		$boleto->save();
		

		if ($boleto->id){
			\Session::put('boleto',$boleto->id);
		}else{
			$redirecto   = url("/boletos/agregar");
			$success = false;
			$mensaje = "Por favor intentelo de nuevo.";
			$titulo  = "Disculpe!";
		}
		$json = array('success'   => $success,
					  'mensaje'   => $mensaje,
					  'titulo'    => $titulo,
					  'redirecto' => $redirecto,
					  'data'	  => $data);
		return json_encode($json);
	}


	public function PostEditBoleto(Request $request){
		$mensaje	 = "El boleto se registró exitosamente.";
		$titulo 	 = "Boleto registrado";
		$success 	 = true;
		$data        = array();
		$redirecto   = url("/boletos/registrado");
		$id 		 = \Session::get('boleto',0);

		if (!$id){
			$redirecto   = url("/boletos/index");
			$success 	 = false;
			$mensaje 	 = "Por favor intentelo de nuevo.";
			$titulo  	 = "Disculpe!";
			$json = array('success'   => $success,
						  'mensaje'   => $mensaje,
						  'titulo'    => $titulo,
						  'redirecto' => $redirecto,
						  'data'	  => $data);
			return json_encode($json);			
		}

		$rules 	  = ['s_aerolinea'		=>'required|integer',
					's_origen'			=>'required|integer',
					's_destino' 		=>'required|integer',
					'i_salida'			=>'required',
					'i_cantidad'		=>'required|numeric',
					'i_costo_infante'	=>'required|numeric',
					'i_costo_adulto'	=>'required|numeric',
					'i_costo_bebe'		=>'required|numeric',
					];

		$v = Validator::make($request->all() , $rules);

		// validacion en backend
		if ($v->fails()){
			$redirecto     = url("#");
			$success 	   = false;
			$mensaje 	   = "Errores de formulario, por favor intente de nuevo.";
			$titulo  	   = "Disculpe!";
			$data["erros"] = $v->messages();
			$json = array('success'   => $success,
			  'mensaje'   => $mensaje,
			  'titulo'    => $titulo,
			  'redirecto' => $redirecto,
			  'data'	  => $data);
			
			return json_encode($json);
		}
		
		$boleto  = Boleto::where('id_boleto', $id)->update(
					array(
						'id_aerolinea' 			=> Input::get('s_aerolinea'),
						'id_tipo_origen' 		=> Input::get('s_origen'),
						'id_tipo_destino' 		=> Input::get('s_destino'),
						'fecha_salida_boleto' 	=> Input::get('i_salida'),
						'cantidad_boleto' 		=> Input::get('i_cantidad'),
						'costo_boleto_adulto' 	=> Input::get('i_costo_adulto'),
						'costo_boleto_infante' 	=> Input::get('i_costo_infante'),
						'costo_boleto_bebe' 	=> Input::get('i_costo_bebe'),
					)
			);

		$json = array('success'   => $success,
					  'mensaje'   => $mensaje,
					  'titulo'    => $titulo,
					  'redirecto' => $redirecto,
					  'data'	  => $data);
		return json_encode($json);
	}	


	public function GetDetalleBoleto(){
		$id_boleto = \Session::get('boleto');
		$datos = DB::select('CALL p_t_boletos(?,?)',array('detalle_boleto',$id_boleto));
		if (!$datos ||  !$id_boleto){
			return Redirect::to('/boletos/index');
		}
		//\Session::forget('boleto')
		return View::make('boletos/agregar_final',compact('datos'));
			
	}


	public function ListarBoleto(){
		$boletos = Boleto::where('habilitado_boleto',1)->orderBy('id_boleto','desc')->paginate(15);
		return View::make('boletos/listar_boleto', compact('boletos'));
	}


	public function EditBoleto($id){
		\Session::forget('boleto');
		\Session::put('boleto', $id);
		return \Redirect::to('/boletos/agregar');
	}

	public function DelBoleto(Request $request){

		$rules 	  = ['id' => 'required|numeric'];
		$v = Validator::make($request->all() , $rules);
		if ($v->fails()){
			$redirecto     = url("/boletos/index");
			$success 	   = false;
			$mensaje 	   = "El boleto no pudo ser eliminado, intentelo de nuevo y si el el problema continua consulte a soporte técnico.";
			$titulo  	   = "Disculpe!";
			$data["erros"] = $v->messages();
			$data["fail"]  = $v->failed();
			$json = array('success'   => $success,
						  'mensaje'   => $mensaje,
						  'titulo'    => $titulo,
						  'redirecto' => $redirecto,
						  'data'	  => $data);
			return json_encode($json);
		};

		Boleto::where('id_boleto',$request->input('id'))->update(
				array(
					'habilitado_boleto'=> 0,
					)
			);

		$redirecto     = url("#");
		$success 	   = true;
		$mensaje 	   = "El boleto a sido eliminado correctamente.";
		$titulo  	   = "Borrado satisfactorio.";
		$data 		   = array();
		$json 		   = array('success'   => $success,
							  'mensaje'   => $mensaje,
							  'titulo'    => $titulo,
							  'redirecto' => $redirecto,
							  'data'	  => $data);
		return json_encode($json);
	}

}