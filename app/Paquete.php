<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Paquete extends Model{

	protected $table = 't_paquetes';
	public $timestamps = false;
	

	public function getImagen(){
		$imagenes = Imagenes::where('id_paquete', $this->id_paquete)->first();
		if ($imagenes){
			return $imagenes->url_imagen;
		}
		return "";
	}
}