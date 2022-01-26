<?php
$id = $_GET['id'];
require_once('../../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
setlocale(LC_TIME, 'es_ES');
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
		$pre = time();
		$fsalida = 'actas_rtf/'.$pre.$id.'.rtf';
		$plantilla = file_get_contents('ejemplo.rtf');
		$punt = fopen($fsalida, 'w');
		$txSalida = '';
		$txSalida .= '{\\qc {COMITE DE DESARROLLO DEL PERSONAL DOCENTE}\\par}';
		$txSalida .= '{\\qc {Acta: '.$id.' del '.strftime("%d de %B del %Y",strtotime($acta->getFecha())).'}\\par}';
		foreach($solicitudes as $solicitud){
			$nom_completo = $solicitud->getDocente()->getApellido1().' '.$solicitud->getDocente()->getApellido2().' '.$solicitud->getDocente()->getNombre();
			$txSalida .= '{\\ul Facultad de '.$solicitud->getFacultad()->getNombre()."}\\par ";
			$txSalida .= 'Solicitud:'.'    '.$solicitud->getId()."\\par ";
			$txSalida .= 'Tipo:'.'    '.$solicitud->getTiposolicitud()->getTipo()."\\par ";
			if(($solicitud->getTiposolicitudId()==4)&($solicitud->getObtuvoTitulo() )){
				$txSalida .= "Obtuvo el titulo\\par ";
			}
			$txSalida .= 'Docente:         '.$solicitud->getDocente()->getCedula().'    '.$nom_completo."\\par ";
			$txSalida .= 'Actividad:'.'    '.$solicitud->getObjetivo()."\\par ";
			$txSalida .= 'Lugar:'.'        '.$solicitud->getLugar()."\\par ";
			$txSalida .= 'Pais:'.'         '.$solicitud->getPais()->getPais()."\\par ";
			if($solicitud->getTiposolicitudId()!=4){
				//%A para dia
				$txSalida .= 'Fecha Inicio:'.'    '.strftime("%d de %B del %Y",strtotime($solicitud->getFecha1()))."\\par ";
			}else{
				$txSalida .= 'Fecha Reintegro:'.'    '.$solicitud->getFecha1()."\\par ";	
			}
			if($solicitud->getTiposolicitudId()!=4){
				//$txSalida .= 'Fecha Final:'.'    '.$solicitud->getFecha2()."\\par ";
				$txSalida .= 'Fecha Final:'.'    '.strftime("%d de %B del %Y",strtotime($solicitud->getFecha2()))."\\par ";
			}
			$txSalida .= 'Dedicacion:'.'    '.$solicitud->getDedicacion()->getNombre()."\\par ";
			if($solicitud->getObservaciones()!='')
			$txSalida .= '{\\qj {Observaciones:'.'    '.$solicitud->getObservaciones()."}\\par}";
			if($solicitud->getComentarios()!='')
			$txSalida .= '{\\qj {Comentarios:'.'    '.html_entity_decode(strip_tags($solicitud->getComentarios()))."}\\par}";
			if($solicitud->getRecomendacion()!='')
			$cadenas2='{\\qj {Recomendacion:'.'    '.html_entity_decode(strip_tags($solicitud->getRecomendacion()))."}\\par} ";
			 $cadenas2= strtr($cadenas2, array('á' => 'a'));
 /*$cadenas2= strtr($cadenas2, array('é' => 'e'));
  $cadenas2= strtr($cadenas2, array('í' => 'i'));
  $cadenas2=  strtr($cadenas2, array('ó' => 'o'));
  $cadenas2=  strtr($cadenas2, array('ú' => 'u'));
  $cadenas2=  strtr($cadenas2, array('Á' => 'A'));
  $cadenas2=  strtr($cadenas2, array('É' => 'E'));
  $cadenas2=  strtr($cadenas2, array('Í' => 'I'));
  $cadenas2=  strtr($cadenas2, array('Ó' => 'O'));
  $cadenas2=  strtr($cadenas2, array('Ú' => 'U'));
  $cadenas2=  strtr($cadenas2, array('ñ' => 'n'));

  $cadenas2=utf8_decode($cadenas2);
  
  $txSalida .=$cadenas2;
  */
			$txSalida .= '{\\qj {Recomendacion:'.'    '.html_entity_decode(strip_tags($solicitud->getRecomendacion()))."}\\par} ";
			$txSalida .= "{\\qj {Presenta: }\\par} ";
			if($solicitud->getAvalCF()) {
				$txSalida .= "{\\qj {Aval consejo de facultad}\\par} ";
			}
			if($solicitud->getSolicitudProfesor()) {
				$txSalida .= "{\\qj {Solicitud profesor}\\par} ";
			}
			if($solicitud->getCartaAceptacion()) {
				$txSalida .= "{\\qj {Carta de aceptacion}\\par} ";
			}
			if($solicitud->getInformeEstudiante()) {
				$txSalida .= "{\\qj {Carta de aceptacion}\\par} ";
			}
			if($solicitud->getInformeTutor()) {
				$txSalida .= "{\\qj {Informe de tutor}\\par} ";
			}
			if($solicitud->getCalificaciones()) {
				$txSalida .= "{\\qj {Calificaciones}\\par} ";
			}
			$txSalida .= "\\par ";
			
		}
		$consulta = new Criteria('informes');
		$consulta->addFiltro('actas_id','=',$id);
		$informes = $consulta->execute();
		$txSalida .= '{\\ul ANEXOS}\\par ';
			$strAnexo = $acta->getAnexo();
			//$strAnexo = preg_replace('@<(b|h)r[^>]*>@i',"\\par",$acta->getAnexo());
			$strAnexo = str_replace('<p>',"{\\qj{",$strAnexo);
			$strAnexo = str_replace('</p>',"}\\par}",$strAnexo);
			$strAnexo = str_replace('&ldquo;',"\"",$strAnexo);
			$strAnexo = str_replace('&rdquo;',"\"",$strAnexo);
			//$strAnexo = preg_replace('@<div[^>]*>(.*)</div>@i',"\\par".'$1'."\\par",$strAnexo); 
			$txSalida .= '{\\qj '.html_entity_decode(strip_tags($strAnexo)).'}\\par ';
			
			//$txSalida .= '{\\qj '.$strAnexo.'}\\par ';
		$txSalida = str_replace('#ACTA#',$txSalida, $plantilla);
		fputs($punt, $txSalida);
		fclose($punt);
		
		echo '<script>location.href="'.$fsalida.'"</script>';
		
		
	}
}
?>