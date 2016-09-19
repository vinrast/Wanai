<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ImgController;
use Illuminate\Http\Request;
use View;
use App\Plan;
use App\Tipo;
use App\Hotel;
use App\Imagenes;
use App\Regimen;
use App\Habitacion;
use Input;
use DB;
use Response;
use Redirect;
use Validator;

class HotelController extends Controller{

	public function Index(){
		$habitacion= DB::select('CALL p_t_hoteles(?,?)',array('cantidad_habitaciones_hoteles',''));
		$hotel= DB::select('CALL p_t_hoteles(?,?)',array('cantidad_hoteles_registrados_diarios',''));
		return View::make('hoteles/index', compact('habitacion','hotel'));
	}


	public function LinkAgregar(){
		\Session::forget('hotel');
		return \Redirect::to('/hoteles/agregar');
	}


	public function ListarHotel(){
		$hoteles = Hotel::where('habilitado_hotel',1)->orderBy('id_hotel','desc')->paginate(15);
		return View::make('hoteles/listar_hoteles', compact('hoteles'));
	}
	

	public function AgregarHotel(){
		$data = "";
        if(\Session::has('hotel')){
        	$id_hotel = \Session::get('hotel');
        	$data = (string) Hotel::where('id_hotel',$id_hotel)->first();
        };

        $servicio = (string) Tipo::where('id_maestro', '1')-> get();
        $estados  = Tipo::where('id_maestro', '2')->orderBy('nombre_tipo','asc')->get();

		return View::make('hoteles/agregar_hotel', compact('estados','servicio', 'data'));
	}


	public function PostAgregarHotel(Request $request){
		$mensaje	 = "El Hotel se registró exitosamente.";
		$titulo 	 = "Boleto registrado";
		$success 	 = true;
		$data        = array();
		$redirecto   = url("/hoteles/agregar-imagen");

		$rules 	  	 = ['i_nombre'			=>'required',
						'i_telefono'		=>'required',
						'i_telefono2' 		=>'',
						's_estado'			=>'required',
						'i_direccion'		=>'required',
						'sm_servicios'		=>'required',
						'i_categoria'		=>'required|numeric',
						'namefile'			=>'required'
						];

		$v = Validator::make($request->all() , $rules);

		if ( $v->fails() ){
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

		$nombreArchivo 	= Input::get('namefile');
		$rutaOrigen    	= "uploads/temp/".$nombreArchivo;
		$nombre_carpeta = "hoteles/img";

		$imgController 	= new ImgController();
		$result			= $imgController->create_thumbnails($nombreArchivo, $nombre_carpeta);
		
		if (!$result['success']){
			$data 	 	= array();
			$titulo		= "Error (11121)";
			$success 	= false;
			$redirecto  = url("#");
			$mensaje 	= "Ha ocurrido un error, comuniquese con soporte técnico.";
			$json 	 	= array('success'     => $success,
								  'mensaje'   => $mensaje,
								  'titulo'	  => $titulo,
								  'redirecto' => $redirecto,
								  'data' 	  => $data);
			return json_encode($json);
		}

		$hotel                   = new Hotel();
		$hotel->nombre_hotel     = Input::get('i_nombre');
		$hotel->telefono_hotel   = Input::get('i_telefono');
		$hotel->telefono_hotel_2 = Input::get('i_telefono2');
		$hotel->id_tipo_estado   = Input::get('s_estado');
		$hotel->direccion_hotel  = Input::get('i_direccion');
		$hotel->categoria_hotel  = Input::get('i_categoria');
		$hotel->id_tipo_servicio = Input::get('sm_servicios');
		$hotel->url_imagen_hotel = $result['data']['nombreArchivo'];
		$hotel->save();

		if ($hotel->id){
			\Session::put('hotel',$hotel->id);
		}else{
			$redirecto   = url("/hoteles/agregar");
			$success 	 = false;
			$mensaje 	 = "Por favor intentelo de nuevo.";
			$titulo  	 = "Disculpe!";
		}
		$data["servicios"] = Input::get('sm_servicios');
		$json = array('success'   => $success,
					  'mensaje'   => $mensaje,
					  'titulo'    => $titulo,
					  'redirecto' => $redirecto,
					  'data'	  => $data);

		return json_encode($json);
	}


	public function PostEditHotel(Request $request){
		$mensaje	 = "El Hotel se actualizado exitosamente.";
		$titulo 	 = "Boleto actualizado";
		$success 	 = true;
		$data        = array();
		$redirecto   = url("/hoteles/agregar-imagen");
		$id 		 = \Session::get('hotel',0);

		if (!$id){
			$redirecto   = url("/hoteles/index");
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

		$rules 	  = ['i_nombre'			=>'required',
					'i_telefono'		=>'required',
					'i_telefono2' 		=>'',
					's_estado'			=>'required',
					'i_direccion'		=>'required',
					'sm_servicios'		=>'required',
					'i_categoria'		=>'required|numeric',
					'namefile'			=>'required',
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
		
		$hotel = Hotel::where('id_hotel',$id)->first();
		$nombreArchivo 	= Input::get('namefile');

		if ($hotel->url_imagen_hotel == $nombreArchivo){

			$url_imagen = $hotel->url_imagen_hotel;
		}else{

			$rutaOrigen    	= "uploads/temp/".$nombreArchivo;
			$nombre_carpeta = "hoteles/img";
			$imgController 	= new ImgController();
			$result			= $imgController->create_thumbnails($nombreArchivo, $nombre_carpeta);
			
			if (!$result['success']){
				$data 	 	= array();
				$titulo		= "Error (11121)";
				$success 	= false;
				$redirecto  = url("#");
				$mensaje 	= "Ha ocurrido un error, comuniquese con soporte técnico.";
				$json 	 	= array('success'   => $success,
									'mensaje'   => $mensaje,
									'titulo'	=> $titulo,
									'redirecto' => $redirecto,
									'data' 	    => $data);
				return json_encode($json);
			}else{

				$url_imagen = $result['data']['nombreArchivo'];
			}
		}

		Hotel::where('id_hotel',$id)
				->update(
					array(
						'nombre_hotel' 		=> Input::get('i_nombre'),
						'telefono_hotel' 	=> Input::get('i_telefono'),
						'telefono_hotel_2' 	=> Input::get('i_telefono2'),
						'id_tipo_estado' 	=> Input::get('s_estado'),
						'direccion_hotel' 	=> Input::get('i_direccion'),
						'categoria_hotel' 	=> Input::get('i_categoria'),
						'id_tipo_servicio' 	=> Input::get('sm_servicios'),
						'url_imagen_hotel'	=> $url_imagen,
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
        if(\Session::has('hotel')){
        	$id_hotel = \Session::get('hotel');
        	$data = (string) Imagenes::where('id_hotel',$id_hotel)->get(['url_imagen', 'tipo_archivo_imagen']);
        };
		return View::make('hoteles/agregar_imagen', compact('data'));
	}


	public function PostAgregarImagen(Request $request){
		$id_hotel = \Session::get('hotel');
		if (!\Session::has('hotel')){
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
		$nombre_carpeta = "hoteles/img";
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
				$imagen->id_hotel   = $id_hotel;
				$imagen->save();
			};
		};

		if ($request->has('video')){
			$imagen 						= new Imagenes();
			$imagen->tipo_archivo_imagen	= 0; //modo video 
			$imagen->url_imagen 			= $request->input('video');
			$imagen->id_hotel   			= $id_hotel;
			$imagen->save();			
		}
		$titulo         = "success";
		$data           = $request->input('video');
		$success        = true;
		$mensaje        = "";
		$redirecto      = url('/hoteles/agregar-habitacion');
		$json = array('success'   => $success,
                      'mensaje'   => $mensaje,
                      'titulo'    => $titulo,
                      'redirecto' => $redirecto,
					  'data'      => $data);
		return json_encode($json);
	}


	public function PostDelImagen(Request $request){
		if (!\Session::has('hotel')){
			$redirecto     = url("/hoteles/index");
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
			$redirecto     = url("/hoteles/index");
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
		Imagenes::where('id_hotel',\Session::get('hotel'))
				->where('url_imagen', $request->input('nombre'))
				->delete();

		$prex_img_hoteles	= "hoteles/img";
        $imgController 		= new ImgController();
        $imgController->DeleteThumbnails($request->input('nombre'), $prex_img_hoteles);
		

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


    public function AgregarHabitacion(){
    	$id_hotel 	= \Session::get('hotel');
    	//agregar validacion
		$data		= json_encode(\DB::table('t_habitacion')
							->select(['id_habitacion',
										'nombre_habitacion',
										'costo_habitacion',
										'descripcion_habitacion'])
							->where('t_habitacion.id_hotel', '=' ,$id_hotel)
							->get());
		return View::make('hoteles/agregar_habitacion', compact('data'));
	}


	public function AgregarRegimen(){
		$id_hotel 		= \Session::get('hotel');
		$habitaciones 	= Habitacion::where("id_hotel",$id_hotel)->get();
		$regimenes 		= Tipo::where('id_maestro', 3)->get();//nombre _ tipo

		$data	= json_encode(\DB::table('t_detalle_regimen')
				->where('t_detalle_regimen.id_hotel', '=' ,$id_hotel)
				->join('t_habitacion', 't_detalle_regimen.id_habitacion', '=' ,'t_habitacion.id_habitacion')
				->join('t_tipo', 't_detalle_regimen.id_tipo', '=' ,'t_tipo.id_tipo')
				->get());
		return View::make('hoteles/agregar_regimen', compact('habitaciones','regimenes','data'));
	}


	public function AgregarFin(){
		$id = \Session::get('hotel');
		//$datos = Hotel::where('id_hotel',$id)->get();

		$datos = json_encode(\DB::table('t_hoteles')
				->select('t_hoteles.*',
						 't_tipo.nombre_tipo as estado')
				->where('t_hoteles.id_hotel', $id)
				->join('t_tipo', 't_hoteles.id_tipo_estado', '=' ,'t_tipo.id_tipo')
				->get());
				

		if (!$id){
			return Redirect::to('/hoteles/index');
		}
		//\Session::forget('hotel');
		return View::make('hoteles/agregar_final', compact('datos'));
	}
	
	
	public function EditHotel($id){
		\Session::put('hotel', $id);
		return Redirect::to('/hoteles/agregar');
	}


	public function DelHotel(Request $request){

		$rules 	  = ['id' => 'required|numeric'];
		$v = Validator::make($request->all() , $rules);
		if ($v->fails()){
			$redirecto     = url("/hoteles/index");
			$success 	   = false;
			$mensaje 	   = "El hotel no pudo ser eliminado, intentelo de nuevo y si el el problema continua consulte a soporte técnico.";
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

		Hotel::where('id_hotel',$request->input('id'))->update(
				array(
					'habilitado_hotel'=> 0,
					)
			);

		$redirecto     = url("#");
		$success 	   = true;
		$mensaje 	   = "El hotel a sido eliminado correctamente.";
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


