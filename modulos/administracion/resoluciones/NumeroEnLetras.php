<?php
/*
* Esta clase permite convertir un numero a letras
* Autor LUIS FERNANDO OROZCO
*/

class NumeroEnLetras{
	
	/*
	* Metodo que recive un numero y lo convierte a letras
	*/
	public static function convertir($numero){
		$texto="**";
		switch($numero){
			case 1;
				$texto = "un";
				break;
			case 2;
				$texto = "dos";
				break;
			case 3;
				$texto = "tres";
				break;
			case 4;
				$texto = "cuatro";
				break;
			case 5;
				$texto = "cinco";
				break;
			case 6;
				$texto = "seis";
				break;
			case 7;
				$texto = "siete";
				break;
			case 8;
				$texto = "ocho";
				break;
			case 9;
				$texto = "nueve";
				break;
			case 10;
				$texto = "diez";
				break;
			case 11;
				$texto = "once";
				break;
			case 12;
				$texto = "doce";
				break;
		}
		return $texto;
	}
}
?>