<?php

namespace App;
use App\Custom;

use Illuminate\Database\Eloquent\Model;

class Utiles
{
    public static function limpiarTexto($texto, $uppercase = false){

        $buscar = array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
        $reemplazar = array ("a","e","i","o","u","A","E","I","O","U","n","N","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");

        $texto = str_replace($buscar, $reemplazar, trim($texto));

        if($uppercase)
        {
            return mb_strtoupper($texto, 'UTF-8');
        }
		return $texto;
	}



	public static function getIp(){
		$ip = null;
		try { 
			$ip = $_SERVER['REMOTE_ADDR'];
			if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
		} catch (\Exception $e) {
			Custom::error('Utiles', 'getIp', $e);
		}
		
		return $ip;
	}
}
