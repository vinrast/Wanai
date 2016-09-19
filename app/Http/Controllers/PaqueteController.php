<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ImgController;
use Illuminate\Http\Request;
use View;
use App\Tipo;
use Response;
use App\Paquete;
use App\Imagenes;
use Input;
use DB;
use Validator;

class PaqueteController extends Controller {

	public function Index (){
		$paquetes= DB::select('CALL p_t_paquetes(?,?)',array('cantidad_paquetes_reservados',''));
		return View::make('paquetes/index', compact('paquetes'));
	}


	public function LinkAgregar(){
		\Session::forget('paquete');
		return \Redirect::to('/paquetes/agregar');
	}


	public function AgregarPaquete(){
		$data = "";
        if(\Session::has('paquete')){
        	$id_paquete = \Session::get('paquete');
        	$data = (string) Paquete::where('id_paquete',$id_paquete)->first();
        };		
		$paquetes = Tipo::where('id_maestro','=', '3')-> get();
		return View::make('paquetes/agregar_paquete',compact('paquetes','data')
		);
	}


	public function PostAgregarPaquete(Request $request){

		$mensaje	 = "El paquete se registró exitosamente.";
		$titulo 	 = "Paquete registrado";
		$success 	 = true;
		$data        = array("datos"=> Input::all());
		$redirecto   = url("/paquetes/agregar-imagen");

		$rules 	  = ['i_nombre'		=>'required',
					'i_descripcion'	=>'required',
					's_paquete' 	=>'required',
					'i_traslado'	=>'required',
					'i_salida'		=>'required',
					'i_retorno'		=>'required',
					'i_costo'		=>'required|numeric',
					];

		$v = Validator::make($request->all() , $rules);

		if ($v->fails()){
			$redirecto     = url("#");
			$success 	   = false;
			$mensaje 	   = "Errores de formulario, por favor intente de nuevo.";
			$titulo  	   = "Disculpe!";
			$data["erros"] = $v->messages();
			$data["fail"]  = $v->failed();
			$json = array('success'   => $success,
						  'mensaje'   => $mensaje,
						  'titulo'    => $titulo,
						  'redirecto' => $redirecto,
						  'data'	  => $data);
			return json_encode($json);
		}
		$paquete                        = new Paquete;
		$paquete->nombre_paquete        = Input::get('i_nombre');
		$paquete->descripcion_paquete   = Input::get('i_descripcion');
		$paquete->id_tipo_paquete 		= Input::get('s_paquete');
		$paquete->con_boleto_paquete    = Input::get('i_traslado');
		$paquete->fecha_inicio_paquete  = Input::get('i_salida');
		$paquete->fecha_final_paquete   = Input::get('i_retorno');
		$paquete->costo_paquete         = Input::get('i_costo');
		$paquete->save();
		
		if ($paquete->id ){
			\Session::put('paquete',$paquete->id);
		}else{

			$redirecto   = Url::to("/paquetes/agregar");
			$success 	 = false;
			$mensaje 	 = "Por favor intentelo de nuevo.";
			$titulo  	 = "Disculpe!";
		}

		$json = array('success'   => $success,
					  'mensaje'   => $mensaje,
					  'titulo'    => $titulo,
					  'redirecto' => $redirecto,
					  'data'	  => $data);
		return json_encode($json);
	}

	public function PostEditPaquete(Request $request){

		$mensaje	 = "El paquete se registró exitosamente.";
		$titulo 	 = "Paquete registrado";
		$success 	 = true;
		$data        = array("datos"=> Input::all());
		$redirecto   = url("/paquetes/agregar-imagen");
		$id 		 = \Session::get('paquete',0);

		if (!$id){
			$redirecto   = url("/paquetes/index");
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

		$rules 	  = ['i_nombre'		=>'required',
					'i_descripcion'	=>'required',
					's_paquete' 	=>'required',
					'i_traslado'	=>'required',
					'i_salida'		=>'required',
					'i_retorno'		=>'required',
					'i_costo'		=>'required|numeric',
					];

		$v = Validator::make($request->all() , $rules);

		if ($v->fails()){
			$redirecto     = url("#");
			$success 	   = false;
			$mensaje 	   = "Errores de formulario, por favor intente de nuevo.";
			$titulo  	   = "Disculpe!";
			$data["erros"] = $v->messages();
			$data["fail"]  = $v->failed();
			$json = array('success'   => $success,
						  'mensaje'   => $mensaje,
						  'titulo'    => $titulo,
						  'redirecto' => $redirecto,
						  'data'	  => $data);
			
			return json_encode($json);
		}

		$paquete 	= Paquete::where('id_paquete', $id)->update(
						array('nombre_paquete' 		=> Input::get('i_nombre'),
							'descripcion_paquete' 	=> Input::get('i_descripcion'),
							'id_tipo_paquete' 		=> Input::get('s_paquete'),
							'con_boleto_paquete' 	=> Input::get('i_traslado'),
							'fecha_inicio_paquete' 	=> Input::get('i_salida'),
							'fecha_final_paquete' 	=> Input::get('i_retorno'),
							'costo_paquete' 		=> Input::get('i_costo'),
							)
						);

		$json = array('success'   => $success,
					  'mensaje'   => $mensaje,
					  'titulo'    => $titulo,
					  'redirecto' => $redirecto,
					  'data'	  => $data);
		return json_encode($json);
	}


	public function AgregarImagen(){
		$data = "";
        if(\Session::has('paquete')){
        	$id_paquete = \Session::get('paquete');
        	$data = (string) Imagenes::where('id_paquete',$id_paquete)->get(['url_imagen', 'tipo_archivo_imagen']);
        };
		return View::make('paquetes/agregar_imagen', compact('data'));
	}


	public function PostAgregarImagen(Request $request){
		$id_paquete = \Session::get('paquete');
		if (!\Session::has('paquete')){
			$redirecto     = url("/paquetes/agregar");
			$success 	   = false;
			$mensaje 	   = "Introduzca la información básica del paquete para continuar.";
			$titulo  	   = "Disculpe!";
			$data 		   = array("paquete"=>\Session::get('paquete'));
			$json 		   = array('success'   => $success,
								  'mensaje'   => $mensaje,
								  'titulo'    => $titulo,
								  'redirecto' => $redirecto,
								  'data'	  => $data);
			return json_encode($json);
		}


		$rules 	  = ['cantidad' => 'required|numeric'];
		$v = Validator::make($request->all() , $rules);
		if ($v->fails()){
			$redirecto     = url("#");
			$success 	   = false;
			$mensaje 	   = "Errores de formulario, por favor intente de nuevo.";
			$titulo  	   = "Disculpe!";
			$data["erros"] = $v->messages();
			$data["fail"]  = $v->failed();
			$json = array('success'   => $success,
						  'mensaje'   => $mensaje,
						  'titulo'    => $titulo,
						  'redirecto' => $redirecto,
						  'data'	  => $data);
			return json_encode($json);
		}
		$cantidad  = $request->input("cantidad");
		$imgController 	= new ImgController();
		$nombre_carpeta = "paquetes/img";
		for ($i=0 ; $i<$cantidad ;$i++){
			$nombreArchivo 		= $request->input("imagen".$i);
			if (!Imagenes::where('url_imagen',$nombreArchivo)->first()){
				$result   		= $imgController->create_thumbnails($nombreArchivo, $nombre_carpeta);
				if (!$result['success']){
					$data 	 		= array();
					$titulo			= "Error (11121)";
					$success 		= false;
					$redirecto  	= url("#");
					$mensaje 		= "Ha ocurrido un error, comuniquese con soporte técnico.";
					$json 	 		= array('success'     => $success,
											  'mensaje'   => $mensaje,
											  'titulo'	  => $titulo,
											  'redirecto' => $redirecto,
											  'data' 	  => $result['data']);
					return json_encode($json);
				}
				$imagen 			= new Imagenes();
				$imagen->url_imagen = $result['data']['nombreArchivo'];
				$imagen->id_paquete   = $id_paquete;
				$imagen->save();
			};
		};

		if ($request->has('video')){
			$imagen 						= new Imagenes();
			$imagen->tipo_archivo_imagen	= 0; //modo video 
			$imagen->url_imagen 			= $request->input('video');
			$imagen->id_paquete   			= $id_paquete;
			$imagen->save();			
		}
		$titulo         = "success";
		$data           = $request->input('video');
		$success        = true;
		$mensaje        = "";
		$redirecto      = url('/paquetes/registrado');
		$json = array('success'   => $success,
                      'mensaje'   => $mensaje,
                      'titulo'    => $titulo,
                      'redirecto' => $redirecto,
					  'data'      => $data);
		return json_encode($json);
	}


	public function PostDelImagen(Request $request){
		if (!\Session::has('paquete')){
			$redirecto     = url("/paquetes/index");
			$success 	   = false;
			$mensaje 	   = "La imagen no pudo ser eliminada, intentelo de nuevo y si el el problema continua consulte a soporte técnico.";
			$titulo  	   = "Disculpe!";
			$data 		   = array();
			$json 		   = array('success'   => $success,
								  'mensaje'   => $mensaje,
								  'titulo'    => $titulo,
								  'redirecto' => $redirecto,
								  'data'	  => $data);
			return json_encode($json);
		}
		$rules 	  = ['nombre' => 'required'];
		$v = Validator::make($request->all() , $rules);
		if ($v->fails()){
			$redirecto     = url("/paquetes/index");
			$success 	   = false;
			$mensaje 	   = "La imagen no pudo ser eliminada, intentelo de nuevo y si el el problema continua consulte a soporte técnico.";
			$titulo  	   = "Disculpe!";
			$data["erros"] = $v->messages();
			$data["fail"]  = $v->failed();
			$json = array('success'   => $success,
						  'mensaje'   => $mensaje,
						  'titulo'    => $titulo,
						  'redirecto' => $redirecto,
						  'data'	  => $data);
			return json_encode($json);
		}
		Imagenes::where('id_paquete',\Session::get('paquete'))
				->where('url_imagen', $request->input('nombre'))
				->delete();

		$prex_img_paquetes	= "paquetes/img";
        $imgController 		= new ImgController();
        $imgController->DeleteThumbnails($request->input('nombre'), $prex_img_paquetes);
		

		$redirecto     = url("#");
		$success 	   = true;
		$mensaje 	   = "";
		$titulo  	   = "";
		$data 		   = array();
		$json 		   = array('success'   => $success,
							  'mensaje'   => $mensaje,
							  'titulo'    => $titulo,
							  'redirecto' => $redirecto,
							  'data'	  => $data);
		return json_encode($json);
	}


	public function AgregarFinal(){
		$id = \Session::get('paquete');
		//$datos = Paquete::where("id_paquete",$id)->get();

		$datos = json_encode(\DB::table('t_paquetes')
				->select('t_paquetes.*',
						 't_tipo.nombre_tipo as tipo_paquete')
				->where('t_paquetes.id_paquete', $id)
				->join('t_tipo', 't_paquetes.id_tipo_paquete', '=' ,'t_tipo.id_tipo')
				->get());

		$imagenes = Imagenes::where("id_paquete",$id)
						->where("tipo_archivo_imagen", 1)
						->get(['url_imagen']);

		if (!$datos ||  !$id){
			return Redirect::to('/paquetes/index');
		}		
		//\Session::forget('hotel');
		return View::make('paquetes/agregar_final', compact('datos','imagenes'));
	}


	public function ListarPaquete()
	{
		$paquetes = Paquete::where('habilitado_paquete',1)->orderBy('id_paquete','desc')->paginate(15);
		return View::make('paquetes/listar_paquetes', compact('paquetes'));
	}


	public function EditPaquete($id){
		\Session::forget('paquete');
		\Session::put('paquete', $id);
		return \Redirect::to('/paquetes/agregar');
	}

	public function DelPaquete(Request $request){

		$rules 	  = ['id' => 'required|numeric'];
		$v = Validator::make($request->all() , $rules);
		if ($v->fails()){
			$redirecto     = url("/paqutes/index");
			$success 	   = false;
			$mensaje 	   = "El paquete no pudo ser eliminado, intentelo de nuevo y si el el problema continua consulte a soporte técnico.";
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

		Paquete::where('id_paquete',$request->input('id'))->update(
				array(
					'habilitado_paquete'=> 0,
					)
			);

		$redirecto     = url("#");
		$success 	   = true;
		$mensaje 	   = "El paquete a sido eliminado correctamente.";
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
