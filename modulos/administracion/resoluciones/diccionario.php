<?php
	/*
	* Retorna el articulo de una palabra
	* Autor LUIS FERNANDO OROZCO
	*/
	class diccionario{
		function getPalabra($texto){
			$texto = $str = strtolower($texto);
			switch($texto){
				case 'universidad';	return 'la';	break;
				case 'instituto';	return 'el';	break;
				case 'doctorado';	return 'el';	break;
				case 'maestría';	return 'La';	break;
				case 'pasantía investigativa';	return 'la';	break;
				default;			return '**';	break;
			}
		}
		
		function getGeneroDocente($sexo){
			$sexo = $str = strtolower($sexo);
			if($sexo=='m'){
				return "el profesor";	
			}else{
				//echo "***";
				return "la profesora";	
			}
		}
		
		function getSeñor($sexo){
			$sexo = $str = strtolower($sexo);
			if($sexo=='m'){
				return "al señor";	
			}else{
				return "a la señora";	
			}
		}
		
		function getPalIdentificacion($sexo){
			$sexo = $str = strtolower($sexo);
			if($sexo=='m'){
				return "identificado";	
			}else{
				return "identificada";	
			}
		}
		
		function getAdscrito($sexo){
			$sexo = $str = strtolower($sexo);
			if($sexo=='m'){
				return "adscrito";	
			}else{
				return "adscrita";	
			}
		}
		
		function getEste($sexo){
			$sexo = $str = strtolower($sexo);
			if($sexo=='m'){
				return "éste";	
			}else{
				return "ésta";	
			}
		}
		
		function getProfesor($sexo){
			$sexo = $str = strtolower($sexo);
			if($sexo=='m'){
				return "profesor";	
			}else{
				return "profesora";	
			}
		}
		
		function getDel($sexo){
			$sexo = $str = strtolower($sexo);
			if($sexo=='m'){
				return "del";	
			}else{
				return "de la";	
			}
		}
	}
?>