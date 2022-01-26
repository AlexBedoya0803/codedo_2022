<?php
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
$reporte= $_GET['reporte'];

if($reporte==1)
{
header("Pragma: ");
header('Cache-control: ');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Content-type: application/vnd.ms-excel");
header('Content-disposition: attachment; filename="datos.xls"');
}

if($reporte==2)
{
header("Content-Description: File Transfer");
//header("Content-Type: application/force-download; text/html; charset=UTF-8");
header("Content-Disposition: attachment; filename=acta_".$_GET[id].".doc");
}
$id = $_GET['id'];
require_once('../../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
require_once('../resoluciones/FormatoFecha.php');
require_once('Codificacion.php');
$numero = count($_GET);


if($numero) {
	$id = $_GET['id'];
	$acta = new ActaDTO();
	$acta=$acta->find($id);
	$consulta = new Criteria("solicitudes");
	$consulta->addFiltro("acta_id","=",$id);
	$consulta->orderBy("facultad_id","ASC");
	$solicitudes=$consulta->execute();
	if(count($solicitudes)>0){
	
		$txSalida = '';
		//$txSalida .= mb_detect_encoding($nom_completo);
		
		$txSalida .= '<p><strong>COMITE DE DESARROLLO DEL PERSONAL DOCENTE</strong></p>';
		//$txSalida .= '<p><strong>Acta: '.$id.' del '.strftime("%d de %B del %Y",strtotime($acta->getFecha())).'</strong></p>';
		$txSalida .= '<p><strong>Acta: '.$id.' del '.FormatoFecha::convertir($acta->getFecha()).'</strong></p>';
		foreach($solicitudes as $solicitud){
			//solución temporal al problema del pais españa
			if($solicitud->getPais()->getPais()=="ESPANA"){
				$solicitud->getPais()->setPais("ESPANA");
			}
			//obtiene el nombre de la facultad
			$txSalida .= '<p><strong>'.Codificacion::codificar($solicitud->getFacultad()->getNombre())."</strong></p>";
			
			
			$nom_completo = $solicitud->getDocente()->getApellido1().' '.$solicitud->getDocente()->getApellido2().' '.$solicitud->getDocente()->getNombre();
			$nom_completo = Codificacion::codificar($nom_completo);
			$txSalida .= '<p>'.$nom_completo.'</p><br>';
			$txSalida .= '<table>';
			$txSalida .= '<tr><td>Solicitud</td><td>'.$solicitud->getId()."</td></tr>";
			$txSalida .= '<tr><td>Tipo:</td><td>'.Codificacion::codificar($solicitud->getTiposolicitud()->getTipo())."</td></tr>";
			if(($solicitud->getTiposolicitudId()==4)&($solicitud->getObtuvoTitulo() )){
				$txSalida .= "<tr><td>Obtuvo el titulo</td></tr>";
			}
			$txSalida .= '<tr><td>Documento Identidad:</td><td>'.$solicitud->getDocente()->getCedula()."</td></tr>";
			$txSalida .= '<tr><td>Actividad:</td><td>'.Codificacion::codificar($solicitud->getObjetivo())."</td></tr>";
			$txSalida .= '<tr><td>Lugar:</td><td>'.Codificacion::codificar($solicitud->getLugar())."</td></tr>";
			$txSalida .= '<tr><td>País:</td><td>'.Codificacion::codificar($solicitud->getPais()->getPais())."</td></tr>";
			if($solicitud->getTiposolicitudId()!=4){
				//%A para dia
				$txSalida .= '<tr><td>Fecha Inicio:</td><td>'.FormatoFecha::convertir($solicitud->getFecha1())."</td></tr>";
			}else{
				$txSalida .= '<tr><td>Fecha Reintegro:</td><td>'.FormatoFecha::convertir($solicitud->getFecha1())."</td></tr>";	
			}
			if($solicitud->getTiposolicitudId()!=4){
				//$txSalida .= 'Fecha Final:'.'    '.$solicitud->getFecha2()."\\par ";
				$txSalida .= '<tr><td>Fecha Final:</td><td>'.FormatoFecha::convertir($solicitud->getFecha2())."</td></tr>";
			}
			$txSalida .= '<tr><td>Dedicación:</td><td>'.Codificacion::codificar($solicitud->getDedicacion()->getNombre())."</td></tr>";
			if($solicitud->getObservaciones()!='')
			
			
	
			$txSalida .='<tr><td valign="top">Observaciones:</td><td>'.Codificacion::codificar($solicitud->getObservaciones())."</td></tr>";
			
			if($solicitud->getComentarios()!='')
			$txSalida .= '<tr><td valign="top">Comentarios:</td><td>'.Codificacion::codificar($solicitud->getComentarios())."</td></tr>";
			if($solicitud->getRecomendacion()!='')		
			

 		
			$txSalida .='<tr><td valign="top">Recomendación:</td><td>'.Codificacion::codificar($solicitud->getRecomendacion())."</td></tr>";
			$txSalida .= "<tr><td valign='top'>Presenta:</td><td>";
			if($solicitud->getAvalCF()) {
				$txSalida .= "Aval consejo de facultad<br>";
			}
			if($solicitud->getSolicitudProfesor()) {
				$txSalida .= "Solicitud profesor<br>";
			}
			if($solicitud->getCartaAceptacion()) {
				$txSalida .= "Carta de aceptación<br>";
			}
			if($solicitud->getInformeEstudiante()) {
				$txSalida .= "Carta de Informe De Estudiante<br>";
			}
			if($solicitud->getInformeTutor()) {
				$txSalida .= "Informe de tutor<br>";
			}
			if($solicitud->getCalificaciones()) {
				$txSalida .= "Calificaciones<br>";
			}
			
			$txSalida .= "</td></tr></table>";
			
		}
		
		//$txSalida .= '<p><strong>ANEXOS</strong></p>';
		//$strAnexo = $acta->getAnexo();
		//$txSalida .= '<p>'.$strAnexo.'</p>';
		$txSalida .= '<p><strong>LUZ STELLA ISAZA MESA</strong><br/>
						Vicerrectora de Docencia</p>';
			

		
		
		
		echo utf8_decode($txSalida);
		
		
	}
}


?>