<?php
/*
* Clase con los metodos necesarios para cambiar la codificación de una cadena de texto.
* Autor LUIS FERNANDO OROZCO
*/

class Codificacion{
	public static function codificar($texto){
		$salida = $texto;
		$encoding = mb_detect_encoding($texto);
		if($encoding=='UTF-8' or $encoding=='ASCII'){
			if(!mb_check_encoding ( $texto, $encoding )){
				$salida = utf8_encode($texto);
			}
		}else{
			//$salida=mb_detect_encoding($texto);				
		}			
	   $salida = utf8_encode($texto);
		$division=explode(" ",$salida);
		//$division=str_split($salida);
		$txSalida="";
		
	 	foreach($division as $valor)
		{
		$cadenas2=$valor;
		$cadenas2= strtr($cadenas2, array('á' => 'a'));
    	$cadenas2= strtr($cadenas2, array('é' => 'e'));
  		$cadenas2= strtr($cadenas2, array('í' => 'i'));
  		$cadenas2=  strtr($cadenas2, array('ó' => 'o'));
   		$cadenas2=  strtr($cadenas2, array('ú' => 'u'));
  		$cadenas2=  strtr($cadenas2, array('Á' => 'A'));
 		$cadenas2=  strtr($cadenas2, array('É' => 'E'));
 		$cadenas2=  strtr($cadenas2, array('Í' => 'I'));
  		$cadenas2=  strtr($cadenas2, array('Ó' => 'O'));
  		$cadenas2=  strtr($cadenas2, array('Ú' => 'U'));
  		$cadenas2=  strtr($cadenas2, array('ñ' => 'n'));
 		$cadenas2=  strtr($cadenas2, array('Ã¡' => 'a'));
 		$cadenas2=  strtr($cadenas2, array('Ã³' => 'o')); 
		$cadenas2=  strtr($cadenas2, array('´' => '')); 
		$cadenas2=  strtr($cadenas2, array('&oacute;' => 'o'));
		$cadenas2=  strtr($cadenas2, array('&Atilde;&iexcl;' => 'a'));
		$cadenas2=  strtr($cadenas2, array('&Atilde;&sup3;' => 'o'));
		$cadenas2=  strtr($cadenas2, array('Ã©' => 'e'));

		
		
		$txSalida.=" ".$cadenas2;			
		}	
			
		return $txSalida;
		
		
		
	}
}
?>