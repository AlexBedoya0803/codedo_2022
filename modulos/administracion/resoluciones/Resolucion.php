<?php
	require_once('plantillas/NuevaCortaDuracionMayor3M.php');
	require_once('plantillas/NuevaSolicitud.php');
	require_once('plantillas/NuevaCortaDuracionMenor3M.php');
	require_once('plantillas/Prorroga.php');
	require_once('plantillas/ProrrogaCortaDuracionMayor3M.php');
	require_once('plantillas/Modificacion.php');
	require_once('plantillas/Suspension.php');
	require_once('plantillas/Terminacion.php');
	/*
	*	Esta clase permite crear resoluciones nuevas a partir de las plantillas
		Autor LUIS FERNANDO OROZCO
	*/
	class Resolucion{
		
		//Crea una resolucion nueva dependiendo del tipo
		/*
			1 Nueva corta duracion
			2 Nueva Larga duracion
			3 Prorroga corta duracion
			4 Prorroga Larga duracion
			5 Modificacion
			6 Suspencion
			7 Terminacion
			8 Nueva corta duracion menor a tres meses
		*/
		function createResolucion($tipo,$solicitud){
			switch($tipo){
				case '1': //nueva corta duracion
					echo "Nueva corta duración";
					$resol = new NuevaCortaDuraccionMayor3M();
					$resol->setSolicitud($solicitud);
					$resol->crear();
					break;
				
				case '2'; //Nueva larga duracion
					echo "Nueva larga duración";
 					$resol = new NuevaSolicitud();
					$resol->setSolicitud($solicitud);
					$resol->crear();
					break;
					
				case '3'; //Prorroga corta duracion
					echo "Prorroga corta duración";
					$resol = new ProrrogaCortaDuracionMayor3M();
					$resol->setSolicitud($solicitud);
					$resol->crear();
					break;
					
				case '4'; //Prorroga larga duracion
					echo "Prorroga Larga duración";
					$resol = new Prorroga();
					$resol->setSolicitud($solicitud);
					$resol->crear();
					break;
				
				case '5'; //modificacion
					echo "Modificación";
					$resol = new Modificacion();
					$resol->setSolicitud($solicitud);
					$resol->crear();
					break;
					
				case '6'; //Suspencion
					echo "Suspención";
					$resol = new Suspension();
					$resol->setSolicitud($solicitud);
					$resol->crear();
					break;
					
				case '7'; //Terminacion
					echo "Terminación";
					$resol=new Terminacion();
					$resol->setSolicitud($solicitud);
					$resol->crear();
					break;
				case '8'; //Nueva corta duracion menor tres meses
					echo "Nueva Corta duración menor tres meses";
					$resol=new NuevaCorttaDuracionMenor3M();
					$resol->setSolicitud($solicitud);
					$resol->crear();
					break;
				default;
					echo "tipo resol no valido";
			}
		}
	}
?>