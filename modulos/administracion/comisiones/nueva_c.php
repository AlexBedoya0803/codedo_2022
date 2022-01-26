<?php
//session_start();
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
//echo "aqui".$session->getVal("usuario_id");


require_once('../../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
//require_once($path['modelo'].'validarMARES/validarUsuario.php');
require_once($path['modelo'].'procedimientos.php');
require_once('UploadFiles.php');

$consulta = new Criteria("paises");
$consulta->orderBy("pais", "asc");
$paises=$consulta->execute();
$consulta = new Criteria("actas");
$consulta->addFiltro("abierta","=",1);
$actas=$consulta->execute();
$consulta = new Criteria("motivos");
$motivos=$consulta->execute();
$consulta = new Criteria("dedicaciones");
$dedicaciones=$consulta->execute();
$consulta = new Criteria("docentes");
$consulta->orderBy("nombre","ASC");
$docentes=$consulta->execute();
$procedimiento=new Procedimientos();
$ultima_acta=$procedimiento->ultimaActa();
$numero = count($_GET);
if($numero) {
	//echo $numero;
	//throw new Exception();
	$id = $_GET['id'];
	$_SESSION["id"]=$id;
	$consulta = new Criteria("comisiones");
	$consulta->addFiltro("docente_id","=",$id);
	$consulta->orderBy("id","ASC");
	$comisiones=$consulta->execute();
	$docente=new DocenteDTO();
	$docente=$docente->find($id);
	$motivo=utf8_encode($_POST["motivos"]);
	$facultad = utf8_encode($_POST["facultades"]);
	$dedicacion = utf8_encode($_POST["dedicaciones"]);
	$pais = utf8_encode($_POST["paises"]);
	$lugar = utf8_encode($_POST["lugar"]);
	$objetivo = utf8_encode($_POST["objetivo"]);
	$fecha1 = $_POST["fecha1"];
	$fecha2 = $_POST["fecha2"];
	$actaCF = $_POST["actaCF"];
	$fechaActaCF = $_POST["fechaActaCF"];
	//var_dump($_POST);
	if(isset($_POST["guardar"]) &&  $dedicacion && $pais && $lugar && $objetivo && $fecha1 && $fecha2 && $actaCF && $fechaActaCF) {
		//echo "guardar";
		//throw new Exception();
		$procedimiento = new Procedimientos();
		$solicitud = new SolicitudDTO();
		$solicitud->setDocenteId($_SESSION["id"]);
		$solicitud->setActaId(-1);
		$solicitud->setEstadoId(5);
		$solicitud->setTiposolicitudId(1);
		$solicitud->setRespuestaId(3);
		$solicitud->setComisionId(0);
		$solicitud->setMotivoId($motivo);
		$solicitud->setDedicacionId($dedicacion);
		$solicitud->setPaisId($pais);
		$solicitud->setFacultadId($docente->getFacultadId());
		if($motivo == 1 || $motivo == 2 || $motivo == 3 || $motivo == 4 || $motivo == 6 || $motivo == 12 || $motivo == 14 || $motivo == 98 ){
			$solicitud->setTipoComisionId(1);
		}else{
			$solicitud->setTipoComisionId(2);
		}
		
		$solicitud->setObjetivo($_POST["objetivo"]);
		$solicitud->setLugar($lugar);
		$solicitud->setFecha1($fecha1);
		$solicitud->setFecha2($fecha2);
		$solicitud->setNumeroActaCF($actaCF);
		$solicitud->setFechaActaCF($fechaActaCF);
		if($_POST["avalCF"]=="on") $solicitud->setAvalCF(1);
		else $solicitud->setAvalCF(0);
		if($_POST["solicitudProfesor"]=="on") $solicitud->setSolicitudProfesor(1);
		else $solicitud->setSolicitudProfesor(0);
		if($_POST["cartaAceptacion"]=="on") $solicitud->setCartaAceptacion(1);
		else $solicitud->setCartaAceptacion(0);
		if($_POST["informeEstudiante"]=="on") $solicitud->setInformeEstudiante(1);
		else $solicitud->setInformeEstudiante(0);
		if($_POST["informeTutor"]=="on") $solicitud->setInformeTutor(1);
		else $solicitud->setInformeTutor(0);
		if($_POST["calificaciones"]=="on") $solicitud->setCalificaciones(1);
		else $solicitud->setCalificaciones(0);
		$solicitud->setComentarios($_POST["comentarios"]);
		$solicitud->setObservaciones($_POST["observaciones"]);
		
		$solicitud->setVotada(0);
		$solicitud->setObtuvoTitulo(0);
		
		$idSolicitud =  $solicitud->save();
		
		$ruta = '../../../anexos/'.$idSolicitud;
		//echo $solicitud->getId();
		//$contador = 1;
		//foreach ($_file as $_FILES['anexos']){
				//$nombre_archivo = $contador;
					//mkdir($ruta, 0777, true);
					//UploadFiles::saveAnexos($_file,$ruta);
				//	$contador = $contador +1;
			//}

		mkdir($ruta, 0777, true);
		UploadFiles::saveAnexos($_FILES['anexos'],$ruta);
		
		

		
		
		echo '<div id="dialog" title="solicitud">
			<p>Se creó la solicitud exitosamente.</p>
		</div>';
		
		
	}
	elseif(isset($_POST["guardar"])) echo '<div id="error" title="error">
			<p>Verifique los datos.</p>
		</div>';
}

?>