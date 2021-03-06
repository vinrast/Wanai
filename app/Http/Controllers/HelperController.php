<?php namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Mail;

class HelperController extends Controller {
	
	public static function Paginador($query , $count_items, $current_page){
		$total 			= count($query);
		$pages 			= ceil($total / $count_items);
		//print_r($query);
		if ($current_page>$pages){
			$current_page = 1;
		}		
		$index_start 	= ($current_page-1) * $count_items; 
		$consulta 		= array_slice($query, $index_start, $count_items);

		$data 			=(object) ["consulta"  		=> $consulta, 
								   "pages" 	 		=> $pages,
								   "current_page" 	=> $current_page,
									 ];
		return $data;
	}

	public static function SendEmail($receptor, $nombreReceptor, $asunto, $plantilla, $parametros){
		
		Mail::send($plantilla, $parametros , function($mensaje) use ($receptor, $nombreReceptor, $asunto){
			$mensaje->to($receptor, $nombreReceptor)->from("no-responder@wanaitravel.com")->subject($asunto);
		});		
	}
}
