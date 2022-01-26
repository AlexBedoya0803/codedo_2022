<?php
header('Content-type: application/msword');
header('Content-Disposition: inline; filename=ejemplo1.rtf');


		
		$txSalida = "{\\rtf1";
		$txSalida .= "este es el texto del rtf";
		$txSalida .= "}";
		 
		
	

		//echo $txSalida;
?>