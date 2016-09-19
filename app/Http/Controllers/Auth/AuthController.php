<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Input;
use Redirect;
use App\Usuario;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}
	//metodo a sobreescribir
	public function postLogin(){
		
		$auth = Usuario::where('correo_usuario', \Input::get('email'))
						->where('clave_usuario', \Input::get('password'))
						->first();
		$data = array("auth"=>$auth, "inputs"=>Input::all());
        if(count($auth) == 0){
        	$titulo    = "Disculpe!";
			$msj 	   = "Usuario o Contraseña son incorrectos";
			$success   = false;
			$redirecto = "#";
			$json 	   = array('success'  => $success,
							  'mensaje'   => $msj,
							  'titulo'    => $titulo,
							  'redirecto' => $redirecto,
							  'data' 	  => $data);
        }else{
            \Session::put('usuario', $auth->correo_usuario);
            \Session::put('id', 	 $auth->id_usuario);
            $titulo    = "login success";
            $msj 	   = "logeado";
            $success   = true;
            $redirecto = url("/hoteles/index");
			$json 	   = array('success' => $success,
							  'mensaje'  => $msj,
							  'titulo'   => $titulo,
							  'redirecto'=> $redirecto,
							  'data' 	 => $data);
        }
        return json_encode($json);
	}

	//metodo a sobreescribir
	public function postRegister(Request $request){
		$validator = $this->registrar->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}

		$this->auth->login($this->registrar->create($request->all()));

		return redirect($this->redirectPath());
	}
	public function CerrarSesion(){
		\Session::flush();
		return View::make('auth/login');
	}

}
