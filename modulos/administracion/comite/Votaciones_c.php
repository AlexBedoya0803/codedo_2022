<?php

/*
* Esta clase controla las votaciones que se muestran por cada solicitud
* Autor LUIS FERNANDO OROZCO
*/

require_once('../../login/Session.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="" || !($session->getVal("rol")=="comite"||$session->getVal("rol")=="auxiliar")) //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
require_once('../../../modelo/clasesDTO.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
$result;

$numero = count($_GET);


if(isset($_GET["id"])){
	if($numero) {
		$id = $_GET['id'];
		$consulta = new Criteria("votaciones");
		$result = $consulta->executeQuery('select nombre,votacion,comentarios from (select * from (select * from votaciones where solicitud_id='.$id.') as voto
		right outer join usuarios
		on voto.usuario_id = usuarios.id) as users where users.rol="comite";');
		//echo mysql_error();
		
		$solicitud = new SolicitudDTO();
		$solicitud=$solicitud->find($id);
	}
}

if( isset($_POST["guardar"])) {
	
	$tipo;
	if($solicitud->getTipoSolicitud()==10){
		$tipo = "autocompletarAca";
	}else{
		$tipo = "autocompletar";	
	}

	if($_POST["respuesta"]) {

		todosVotanSi($tipo,$solicitud);
	}else{
		todosVotanNo($tipo,$solicitud);
	}
}
if( isset($_POST["guardarRecomendacion"])) {
	if(isset($_POST['recomendacion'])){
		$solicitud->setRecomendacion($_POST['recomendacion']);
		$solicitud->update();
		echo "<script>location.href=\"../actas/ver.php?id=".$solicitud->getActaId()."\"</script>";
			
	}
}

/*function autocompletar($tipo,$respuesta,$solicitud){
	
	if( $tipo=="autocompletar") {
		if($respuesta=="si")  {
			$concede = "";
			$si='checked="checked"';
			$no='';
		}
		else {
			$concede = "no ";
			$no='checked="checked"';
			$si='';
		}
		if($solicitud->getTipoComisionId()==1) 
			$tipoComision = "estudios";
		else 
			$tipoComision = "servicios";
			
		if($solicitud->getTipoSolicitudId()==1)
			$tipo = "comisi&oacute;n";
		elseif($solicitud->getTiposolicitudId()==2)
			$tipo = "modificaci&oacute;n de su comisi&oacute;n";
		else
			$tipo = "prorroga de su comisi&oacute;n";
		$docente = $solicitud->getDocente();
		$contenido = "La Vicerrectora de Docencia ".$concede."concede a ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2().", ".$tipo." de ".$tipoComision." remunerada con el 100% de su salario b&aacute;sico mensual, equivalente a tiempo completo de su vinculaci&oacute;n, para realizar ".$solicitud->getObjetivo()." en ".$solicitud->getLugar().", ".$solicitud->getPais()->getPais().', desde el '.$solicitud->getFecha1().' hasta el '.$solicitud->getFecha2();
	}
	if( $tipo=="autocompletarAca") {
		if($respuesta=="si")  {
			$concede = "";
			$si='checked="checked"';
			$no='';
		}
		else {
			$concede = "no ";
			$no='checked="checked"';
			$si='';
		}
		if($solicitud->getTipocomision()==1) 
			$tipoComision = "estudios";
		else 
			$tipoComision = "servicios";
			
		if($solicitud->getTiposolicitudId()==1)
			$tipo = "comisi&oacute;n";
		elseif($solicitud->getTiposolicitudId()==2)
			$tipo = "modificaci&oacute;n de su comisi&oacute;n";
		else
			$tipo = "prorroga de su comisi&oacute;n";
		$docente = $solicitud->getDocente();
		$contenido = "Al consejo acad&eacute;mico ".$concede."concede a ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2().", ".$tipo." de ".$tipoComision." remunerada con el 100% de su salario b&aacute;sico mensual, equivalente a tiempo completo de su vinculaci&oacute;n, para realizar ".$solicitud->getObjetivo()." en ".$solicitud->getLugar().", ".$solicitud->getPais()->getPais().', desde el '.$solicitud->getFecha1().' hasta el '.$solicitud->getFecha2();
	}
	return $contenido;
}
*/
function autocompletar($tipo,$respuesta,$solicitud){ //Genera la recomendación para el acta
	if( $tipo=="autocompletar") {
		if($respuesta=="si")  {
			$concede = "";
			$si='checked="checked"';
			$no='';
		}
		else {
			$concede = "no ";
			$no='checked="checked"';
			$si='';
		}
		if($solicitud->getTipoComisionId()==1) 
			$tipoComision = "de estudios ";
		else 
			$tipoComision =  "posdoctoral";
		
		switch($solicitud->getTiposolicitudId()){ //verifica que tipo de solicitud es
			case 1:
				$tipo = "comisión ";
				break;
			case 2:
				$tipo = "modificación de su comisión ";
				break;
			case 3:
				$tipo = "prórroga de su comisi&oacute;n ";
				break;
			case 4:
				$tipo = "informe de su comisión";
				break;
			case 5:
				$tipo = "cancelación de su comisión";
				break;
			case 6:
				$tipo = "renuncia de su comisión";
				break;
			case 7:
				$tipo = "suspensión de su comisión";
				break;
			case 8:
				$tipo = "reintegro anticipado con grado de su comisión";
				break;
			case 9:
				$tipo = "reintegro anticipado sin grado de su comisión";
				break;
			case 10:
				$tipo = "prórroga excepcional de su comisión";
				break;
			case 11:
				$tipo = "plazo para cumplir compromisos de su comisión";
				break;
			case 12:
				$tipo = "reintegro sin grado de su comisión";
				break;
			case 13:
				$tipo = "prórroga de la suspención de su comisión";
				break;	
			}
			
		$docente = $solicitud->getDocente();
		
		if($solicitud->getTiposolicitudId()==10){ //Verifica si es prórroga excepcional
			$contenido = "El Consejo Académico ".$concede."concede a ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2().", ".$tipo." ".$tipoComision.",  remunerada con el 100% de su salario básico mensual, con una dedicación del 100% de su jornada, para realizar ".$solicitud->getObjetivo()." en ".$solicitud->getLugar().", ".$solicitud->getPais()->getPais().', desde el '.$solicitud->getFecha1().' hasta el '.$solicitud->getFecha2().".";
		}else{
			$contenido = "La Vicerrectora de Docencia ".$concede."concede a ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2().", ".$tipo." ".$tipoComision.",  remunerada con el 100% de su salario básico mensual, con una dedicación del 100% de su jornada, para realizar ".$solicitud->getObjetivo()." en ".$solicitud->getLugar().", ".$solicitud->getPais()->getPais().', desde el '.$solicitud->getFecha1().' hasta el '.$solicitud->getFecha2().".";
		}		
	}
	return $contenido;
}

function todosVotanSi($tipo,$solicitud){
	if($solicitud->getRespuestaId()==0 || $solicitud->getRespuestaId()==3){
		$recomendacion = autocompletar($tipo,"si",$solicitud);
		//echo "todos votan si";
		$id=$solicitud->getId();
		$solicitud->setRespuestaId(1);
		$solicitud->setEstadoId(3);
		$solicitud->setRecomendacion($recomendacion);
		if(isset($_POST['comentarios'])){
			$solicitud->setComentarios($_POST['comentarios']);
		}
		$solicitud->update();
	}
	//echo "<script>location.href=\"../actas/ver.php?id=".$solicitud->getActaId()."\"<script>";
}

function todosVotanNo($tipo,$solicitud){
	if($solicitud->getRespuestaId()==0 || $solicitud->getRespuestaId()==3){
		$recomendacion = autocompletar($tipo,"no",$solicitud);
		//echo "todos votan no";
		$id=$solicitud->getId();
		$solicitud->setRespuestaId(2);
		$solicitud->setEstadoId(4);
		$solicitud->setRecomendacion($recomendacion);
		$solicitud->update($id);
	}
	
	echo "<script>location.href=\"../actas/ver.php?id=".$solicitud->getActaId()."\"</script>";
}


/*
select nombre,votacion from (select * from (select * from votaciones where solicitud_id=5604) as voto
right outer join usuarios
on voto.usuario_id = usuarios.id) as users where users.rol="comite"
*/
?>