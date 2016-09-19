<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Fpdf;
use App\Hotel;
use App\Paquete as Paquetes;
use App\Boleto as Boletos;
use App\Habitacion;
use App\Regimen;
use App\Imagenes;
use DB;
use View;
use Validator;
use Redirect;

define("IMP_HABITACIONES", 0);
define("IMP_PAQUETES", 0);
define("IMP_BOLETOS", 0);

class ClienteController extends Controller {

	public function Index(){
		return Redirect::to('/hoteles');
	}

	public function GetHoteles(){
		$data = Hotel::where("habilitado_hotel",1)->orderBy('id_hotel','desc')->paginate(16);
		return View::make('clientes/hotel_list', compact('data'));
	}

	public function GetPaquetes(){
		$data = Paquetes::where("habilitado_paquete",1)->orderBy('id_paquete','desc')->paginate(16);
		return View::make('clientes/paquete_list', compact('data'));
	}

	public function GetBoletos(){
		$data = Boletos::where("habilitado_boleto",1)->orderBy('id_boleto','desc')->paginate(16);
		return View::make('clientes/boleto_list', compact('data'));
	}



	public function DetailHoteles($id){
		$data 			= (string) Hotel::where("id_hotel",$id)->first();
		$habitaciones 	= (string) Habitacion::where("id_hotel",$id)->get();
		$galeria 		= Imagenes::where("id_hotel",$id)->where("tipo_archivo_imagen", 1)->get();
		$video 			= Imagenes::where("id_hotel",$id)->where("tipo_archivo_imagen", 0)->get();

		return View::make('clientes/hotel_detalle', compact('data','habitaciones','galeria','video','id'));
	}

	public function DetailPaquetes($id){
		$data 			= (string) Paquetes::where("id_paquete",$id)->first();
		$galeria 		= Imagenes::where("id_paquete",$id)->where("tipo_archivo_imagen", 1)->get();
		$video 			= Imagenes::where("id_paquete",$id)->where("tipo_archivo_imagen", 0)->get();
		return View::make('clientes/paquete_detalle', compact('data', 'galeria','video','id'));
	}

	public function DetailBoletos($id){
		$data = (string) Boletos::where("id_boleto",$id)->first();

		$data	= json_encode(\DB::table('t_boletos')
				->select('t_boletos.*',
						 't_aerolineas.nombre_aerolinea',
						 'origen.nombre_tipo as estado_origen',
						 'destino.nombre_tipo as estado_destino' )
				->where('t_boletos.id_boleto', '=' ,$id)
				->join('t_aerolineas', 't_boletos.id_aerolinea', '=' ,'t_aerolineas.id_aerolinea')
				->join('t_tipo as origen', 't_boletos.id_tipo_origen', '=' ,'origen.id_tipo')
				->join('t_tipo as destino', 't_boletos.id_tipo_destino', '=' ,'destino.id_tipo')
				->get());
		return View::make('clientes/boleto_detalle', compact('data','id'));
	}

	public function CotizacionHoteles($id){
		$data 			= (string) Hotel::where("id_hotel",$id)->first();
		$habitaciones 	= Habitacion::where("id_hotel",$id)->get();
		$regimenes	= json_encode(\DB::table('t_detalle_regimen')
				->where('t_detalle_regimen.id_hotel', '=' ,$id)
				->join('t_tipo', 't_detalle_regimen.id_tipo', '=' ,'t_tipo.id_tipo')
				->get());
		return View::make('clientes/hotel_cotizacion', compact('data','habitaciones','regimenes','id'));
	}	

	public function CotizacionBoletos($id){
		$data = (string) Boletos::where("id_boleto",$id)->first();
		$aerolinea = DB::table('t_aerolineas')->get();
		return View::make('clientes/boleto_cotizacion', compact('data','aerolinea','id'));
	}	

	public function CotizacionPaquetes($id){
		$data 			= (string) Paquetes::where("id_paquete",$id)->first();
		return View::make('clientes/paquete_cotizacion', compact('data','id'));
	}

	public function PostCotizacionHoteles(Request $request){
		$mensaje	 = "Su cotizacion fue enviada correctamente.";
		$titulo 	 = "Envio exitoso";
		$success 	 = true;
		$data        = array();
		$redirecto   = url("/hoteles");

		$rules 	  	 = ['i_hotel'				=>'required|numeric',
						'i_habitacion'			=>'required|numeric',
						'i_regimen'				=>'required|numeric',
						'i_cantidad'			=>'required|numeric',
						'i_nombre'				=>'required',
						'i_correo'				=>'required|email',
						's_nacionalidad'		=>'required|numeric',
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



		//Data Correo
		$hotel 		= 	Hotel::where( "id_hotel", $request->input("i_hotel") )->first();
		$habitacion = 	Habitacion::where( "id_habitacion", $request->input("i_habitacion") )->first();
		$regimen 	= 	"Solo habitación";
		$costo_plan = 	0;
		if ($request->input("i_regimen") != 0){
			$regimen_raw =	\DB::table( 't_detalle_regimen' )
								->where('t_detalle_regimen.id_detalle_regimen', '=' ,$request->input("i_regimen"))
								->join('t_tipo', 't_detalle_regimen.id_tipo', '=' ,'t_tipo.id_tipo')
								->first();
			$regimen = $regimen_raw->nombre_tipo;
			$costo_plan = $regimen_raw->costo_detalle_regimen;
		}								
		$impuesto 	= 	0;
		if (intval($request->input("s_nacionalidad")) == 2){
			$impuesto 	= 	IMP_HABITACIONES; //-> SETEANDO EL IMPUESTO PARA EXTRANJEROS
		}
		$costo 		= 	( floatval($costo_plan) + floatval($habitacion->costo_habitacion) + $impuesto) * intval($request->input("i_cantidad"));
		

		HelperController::SendEmail($request->input("i_correo"),
									$request->input("i_nombre"),
									"Cotización de Hotel Wanaitravel",
									"emails.cotizacion_hotel",
									array( 	"nombre"	=> $request->input("i_nombre"),
											"email"		=> $request->input("i_correo"),
											"hotel"		=> $hotel,
											"habitacion"=> $habitacion,
											"regimen"	=> $regimen,
											"cantidad"	=> $request->input("i_cantidad"),
											"costo"		=> $costo, 
											"costo_regimen"=> $costo_plan,
											"impuesto"	=> $impuesto,
										)
									);

		$json = array('success'   => $success,
					  'mensaje'   => $mensaje,
					  'titulo'    => $titulo,
					  'redirecto' => $redirecto,
					  'data'	  => $data);

		return json_encode($json);


	}	

	public function PostCotizacionBoletos(Request $request){
		$mensaje	 = "Su cotizacion fue enviada correctamente.";
		$titulo 	 = "Envio exitoso";
		$success 	 = true;
		$data        = array();
		$redirecto   = url("/hoteles");

		$rules 	  	 = ['i_boleto'				=>'required|numeric',
						'i_cantidad'			=>'required|numeric',
						'i_nombre'				=>'required',
						'i_correo'				=>'required|email',
						's_nacionalidad'		=>'required|numeric',
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
		
		//Data Correo
		$boleto 		= 	Boletos::where( "id_boleto", $request->input("i_boleto") )->first();
									
		$impuesto 		= 	0;
		if (intval($request->input("s_nacionalidad")) == 2){
			$impuesto 	= 	IMP_BOLETOS; //-> SETEANDO EL IMPUESTO PARA EXTRANJEROS
		}
		$costo_adulto	= 	( floatval($boleto->costo_boleto_adulto) + $impuesto) * intval($request->input("i_cantidad"));
		$costo_bebe		= 	( floatval($boleto->costo_boleto_bebe) + $impuesto) * intval($request->input("i_cantidad"));
		$costo_infante	= 	( floatval($boleto->costo_boleto_infante) + $impuesto) * intval($request->input("i_cantidad"));


		HelperController::SendEmail($request->input("i_correo"),
									$request->input("i_nombre"),
									"Cotización de Boleto Wanaitravel",
									"emails.cotizacion_boleto",
									array( 	"nombre"		=> $request->input("i_nombre"),
											"email"			=> $request->input("i_correo"),
											"boleto"		=> $boleto,
											"cantidad"		=> $request->input("i_cantidad"),
											"costo_adulto"	=> $costo_adulto, 
											"costo_bebe"	=> $costo_bebe, 
											"costo_infante"	=> $costo_infante, 
											"impuesto"		=> $impuesto,
										)
									);

		$json = array('success'   => $success,
					  'mensaje'   => $mensaje,
					  'titulo'    => $titulo,
					  'redirecto' => $redirecto,
					  'data'	  => $data);

		return json_encode($json);
	}	
	

	public function PostCotizacionPaquetes(Request $request){
		$mensaje	 = "Su cotizacion fue enviada correctamente.";
		$titulo 	 = "Envio exitoso";
		$success 	 = true;
		$data        = array();
		$redirecto   = url("/hoteles");

		$rules 	  	 = ['i_paquete'				=>'required|numeric',
						'i_cantidad'			=>'required|numeric',
						'i_nombre'				=>'required',
						'i_correo'				=>'required|email',
						's_nacionalidad'		=>'required|numeric',
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

		//Data Correo
		$paquete 		= 	Paquetes::where( "id_paquete", $request->input("i_paquete") )->first();

		$impuesto 	= 	0;
		if (intval($request->input("s_nacionalidad")) == 2){
			$impuesto 	= 	IMP_PAQUETES; //-> SETEANDO EL IMPUESTO PARA EXTRANJEROS
		}
		$costo 		= 	( floatval($paquete->costo_paquete) + $impuesto) * intval($request->input("i_cantidad"));
		

		HelperController::SendEmail($request->input("i_correo"),
									$request->input("i_nombre"),
									"Cotización de Paquete Wanaitravel",
									"emails.cotizacion_paquete",
									array( 	"nombre"	=> $request->input("i_nombre"),
											"email"		=> $request->input("i_correo"),
											"paquete"	=> $paquete,
											"cantidad"	=> $request->input("i_cantidad"),
											"costo"		=> $costo, 
											"impuesto"	=> $impuesto,
										)
									);
		
		$data["paquete"] = (string) $paquete;
		$data["costo"] =  $costo;

		$json = array('success'   => $success,
					  'mensaje'   => $mensaje,
					  'titulo'    => $titulo,
					  'redirecto' => $redirecto,
					  'data'	  => $data);

		return json_encode($json);
	}	
	
}
