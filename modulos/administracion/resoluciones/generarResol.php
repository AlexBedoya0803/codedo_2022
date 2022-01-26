<?php
/*
* Pagina encargada de seleccionar que tipo de resolucion hay que crear
* Autor LUIS FERNANDO OROZCO
*/
//session_start();
require_once('../../login/Session.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/index.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
require_once($path['modelo'].'clasesDTO.php');
require_once('Resolucion.php');
$numero = count($_GET);
if($numero)//solicitudes de una comision id
{
	$id = $_GET['id'];
	$solicitud = new SolicitudDTO();
	$solicitud->find($id);
	$tipo = $solicitud->getTipoSolicitudId();
	$respuesta = $solicitud->getRespuestaId();
	$motivo = $solicitud->getMotivoId();
	//echo "tipo: ".$tipo;;
	$resol = new Resolucion();
	if($respuesta=="1"){
		switch($tipo){
			case '1'; //Nueva
				//echo $motivo;
				switch($motivo){
					
					case '1'; //especializacion
					//corta duracion
						$resol->createResolucion("1",$solicitud);
					break;
					
					case '2'; //Maestria
						$resol->createResolucion("2",$solicitud);
					break;
					
					case '3'; //Doctorado
						$resol->createResolucion("2",$solicitud);
					break;
					
					case '4';//Postdoctorado
						$resol->createResolucion("1",$solicitud);
					break;
					
					case '5';//	Invitacion como docente/ponente
					//corta duracion
						$resol->createResolucion("1",$solicitud);
					break;
					
					case '6'; //Entrenamiento / Capacitacion
					//corta
						$resol->createResolucion("1",$solicitud);
					break;
					
					case '7'; //Participacion en evento
					//corta
						$resol->createResolucion("1",$solicitud);
					break;
					
					case '8'; //Gestiones academicas
					//corta
						$resol->createResolucion("1",$solicitud);
					break;
					
					case '9'; //Asesoria-Consultoria
					//corta
						$resol->createResolucion("1",$solicitud);
					break;
					
					case '10'; //Pasantia Investigativa
						$resol->createResolucion("1",$solicitud);
					break;
					
					case '11'; //Pasantia Administrativa
						$resol->createResolucion("1",$solicitud);
					break;
					
					case '13'; //Pasantia Investigativa
						$resol->createResolucion("1",$solicitud);
						echo "pasantia investigativa";
					break;
					
					case '14'; //Entrenamiento/capacitacion
					//corta
						$resol->createResolucion("1",$solicitud);
					break;
					
					case '15'; //subespecializacion
					//larga
						$resol->createResolucion("2",$solicitud);
					break;
					
					default;
					echo "motivo de estudios no soportado";
				}
			break;
			
			case '2'; //Modificacion
				$resol->createResolucion("5",$solicitud);
			break;
			
			case '3'; //Prorroga
				switch($motivo){
					case '1'; //especializacion
					//corta duracion
						$resol->createResolucion("3",$solicitud);
					break;
					
					case '2'; //Maestria
						$resol->createResolucion("4",$solicitud);
					break;
					
					case '3'; //Doctorado
						$resol->createResolucion("4",$solicitud);
					break;
					
					case '4';//Postdoctorado
						$resol->createResolucion("3",$solicitud);
					break;
					
					case '5';//	Invitacion como docente/ponente
					//corta duracion
						$resol->createResolucion("3",$solicitud);
					break;
					
					case '6'; //Entrenamiento / Capacitacion
					//corta
						$resol->createResolucion("3",$solicitud);
					break;
					
					case '7'; //Participacion en evento
					//corta
						$resol->createResolucion("3",$solicitud);
					break;
					
					case '8'; //Gestiones academicas
					//corta
						$resol->createResolucion("3",$solicitud);
					break;
					
					case '9'; //Asesoria-Consultoria
					//corta
						$resol->createResolucion("3",$solicitud);
					break;
					
					case '10'; //Pasantia Investigativa
						$resol->createResolucion("3",$solicitud);
					break;
					
					case '11'; //Pasantia Administrativa
						$resol->createResolucion("3",$solicitud);
					break;
					
					case '13'; //Pasantia Investigativa
						$resol->createResolucion("3",$solicitud);
					break;
					
					case '14'; //Entrenamiento/capacitacion
					//corta
						$resol->createResolucion("3",$solicitud);
					break;
					
					case '15'; //subespecializacion
					//larga
						$resol->createResolucion("4",$solicitud);
					break;
					
					default;
					echo "motivo de estudios no soportado";
					break;
				}
				break;
			case '7'; //Suspension
				$resol->createResolucion("6",$solicitud);
				//echo "suspencion";
			break;
			
			default;
			echo "Tipo Solicitud no permitida";	
		}
		echo '<script>location.href="Resolucion.docx";</script>';
	}else if($respuesta=="2"){
		echo "formato no disponible";	
	}
	
	//echo '<a href="Resolucion.docx">resol</a>';
}
?>