<?php
/*
* Esta clase permite controlar el formato de las fechas para las resoluciones
* Autor LUIS FERNANDO OROZCO
*/
	class FormatoFecha{
		public static function convertir($fecha){
			$retorno;
			$datos = explode("-",$fecha);
			return $datos[2]." de ".FormatoFecha::getMes($datos[1])." de ".$datos[0];	
		}
		
		static function getMes($mes){
			switch($mes){
				case '01';
					return "Enero";
					break;	
				case '02';
					return "Febrero";
					break;	
				case '03';
					return "Marzo";
					break;	
				case '04';
					return "Abril";
					break;	
				case '05';
					return "Mayo";
					break;
				case '06';
					return "Junio";
					break;
				case '07';
					return "Julio";
					break;
				case '08';
					return "Agosto";
					break;
				case '09';
					return "Septiembre";
					break;
				case '10';
					return "Octubre";
					break;
				case '11';
					return "Noviembre";
					break;
				case '12';
					return "Diciembre";
					break;
				default;
					return "**";
			}
		}
	}
?>