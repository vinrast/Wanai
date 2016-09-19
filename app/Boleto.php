<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Boleto extends Model{

	protected $table = 't_boletos';
	public $timestamps = false;
	

	public function getAerolinea(){
		return Aerolinea::where('id_aerolinea', $this->id_aerolinea)->first()->nombre_aerolinea;
	}
	public function getOrigen(){
		return Tipo::where('id_tipo', $this->id_tipo_origen)->first()->nombre_tipo;	
	}

	public function getDestino(){
		return Tipo::where('id_tipo', $this->id_tipo_destino)->first()->nombre_tipo;	
	}	
}