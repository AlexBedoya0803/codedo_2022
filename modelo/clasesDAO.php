<?php
class ObjetoDAO {

	private $conexion;

	function ObjetoDAO() {

		$host = "localhost";
		//$db   = "dbDedo";
		//$user = "root";
		//$pass = "";
		
		$db = "dbDedo";
		$user = "dbaAndresD";
		$pass = "db4AnD3sClave";
		
		$conexion = mysql_pconnect($host,$user, $pass)or trigger_error(mysql_error(),E_USER_ERROR);
		mysql_select_db($db,$conexion);
		mysql_query("SET NAMES 'ISO-8859-1'");
		mysql_select_db($db,$conexion);
		$this->conexion=$conexion;
	}

	function getConexion(){
		return $this->conexion;
	}

	//funciones de Acta
	function saveActa($objeto){
		$query = "INSERT INTO actas (fecha, abierta, resolucion, anexo)
		values ('".$objeto->getFecha()."',
				".$objeto->getAbierta().",
				'".$objeto->getResolucion()."',
				'".$objeto->getAnexo()."');";
		$result=mysql_query($query,$this->conexion);
	}

	function updateActa($objeto){
		$query = "UPDATE actas SET
				fecha = '".$objeto->getFecha()."',
				abierta = ".$objeto->getAbierta().",
				resolucion = '".$objeto->getResolucion()."',
				anexo = '".addslashes($objeto->getAnexo())."'
				WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);
	}

	function numeroSolicitudes($idActa){
		$query="SELECT * FROM solicitudes WHERE acta_id = ".$idActa;
		$resultado=mysql_query($query,$this->conexion);
		return mysql_num_rows($resultado);
	}
	//funciones de Comisiones

	function saveComision($objeto){
		$query = "INSERT INTO comisiones(id, motivo_id, acta_id, docente_id, tipoComision_id, dedicacion_id, estado_id, pais_id, facultad_id, objetivo, lugar, fecha1, fecha2, fechaf, observaciones)
		values (".$objeto->getId().",
				".$objeto->getMotivoId().",
				".$objeto->getActaId().",
				".$objeto->getDocenteId().",
				".$objeto->getTipoComisionId().",
				".$objeto->getDedicacionId().",
				".$objeto->getEstadoId().",
				".$objeto->getPaisId().",
				".$objeto->getFacultadId().",
				'".$objeto->getObjetivo()."',
				'".$objeto->getLugar()."',
				'".$objeto->getFecha1()."',
				'".$objeto->getFecha2()."',
				'".$objeto->getFechaf()."',
				'".$objeto->getObservaciones()."');";
		$result=mysql_query($query,$this->conexion);
		echo mysql_error();
	}

	function updateComision($objeto){
		$query = "UPDATE comisiones SET
			motivo_id= ".$objeto->getMotivoId().",
			acta_id= ".$objeto->getActaId().",
			docente_id= ".$objeto->getDocenteId().",
			tipoComision_id= ".$objeto->getTipoComisionId().",
			dedicacion_id= ".$objeto->getDedicacionId().",
			estado_id= ".$objeto->getEstadoId().",
			pais_id= ".$objeto->getPaisId().",
			facultad_id= ".$objeto->getFacultadId().",
			objetivo= '".$objeto->getObjetivo()."',
			lugar= '".$objeto->getLugar()."',
			fecha1= '".$objeto->getFecha1()."',
			fecha2= '".$objeto->getFecha2()."',
			fechaf= '".$objeto->getFechaf()."',
			observaciones = '".$objeto->getObservaciones()."'
			WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);
	}
	
	function updateComision2($objeto){
		$query = "UPDATE comisiones SET
			motivo_id= ".$objeto->getMotivoId().",
			acta_id= ".$objeto->getActaId().",
			docente_id= ".$objeto->getDocenteId().",
			tipoComision_id= ".$objeto->getTipoComisionId().",
			dedicacion_id= ".$objeto->getDedicacionId().",
			estado_id= ".$objeto->getEstadoId().",
			pais_id= ".$objeto->getPaisId().",
			facultad_id= ".$objeto->getFacultadId().",
			objetivo= '".$objeto->getObjetivo()."',
			lugar= '".$objeto->getLugar()."',
			fecha1= '".$objeto->getFecha1()."',
			fecha2= '".$objeto->getFecha2()."',
			fechaf= '".$objeto->getFechaf()."',
			observaciones = '".$objeto->getObservaciones()."',
			fechaNotificacion = '".$objeto->getFechaNotificacion()."'
			WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);
	}

	//funciones docentes
	function saveDocente($objeto){
		if(!$objeto->getCategoriaId()) $objeto->setCategoriaId(-1);
		if(!$objeto->getDedicacionId()) $objeto->setDedicacionId(-1);
		$query = "INSERT INTO docentes(id, facultad_id, categoria_id, dedicacion_id, cedula, nombre, apellido1, apellido2, fechaVinculacion, sexo, cCosto, nCCosto, correo)
		values (".$objeto->getCedula().",
				".$objeto->getFacultadId().",
				".$objeto->getCategoriaId().",
				".$objeto->getDedicacionId().",
				'".$objeto->getCedula()."',
				'".$objeto->getNombre()."',
				'".$objeto->getApellido1()."',
				'".$objeto->getApellido2()."',
				'".$objeto->getFechaVinculacion()."',
				'".$objeto->getSexo()."',
				'".$objeto->getCCosto()."',
				'".$objeto->getNCCosto()."',
				'".$objeto->getCorreo()."');";

		//echo $query;
		//throw new Exception();
		$result=mysql_query($query,$this->conexion);



	}

	function updateDocente($objeto){
		$query = "UPDATE docentes SET
				id = ".$objeto->getCedula().",
				facultad_id = ".$objeto->getFacultadId().",
				categoria_id = ".$objeto->getCategoriaId().",
				dedicacion_id = ".$objeto->getDedicacionId().",
				cedula = '".$objeto->getCedula()."',
				nombre = '".$objeto->getNombre()."',
				apellido1 = '".$objeto->getApellido1()."',
				apellido2 = '".$objeto->getApellido2()."',
				fechaVinculacion = '".$objeto->getFechaVinculacion()."',
				sexo = '".$objeto->getSexo()."',
				cCosto = '".$objeto->getCCosto()."',
				nCCosto = '".$objeto->getNCCosto()."',
				correo = '".$objeto->getCorreo()."'
				WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);

	}

	function numeroComisiones($cedulaDocente){
		$query = "SELECT * FROM comisiones WHERE docente_id = '".$cedulaDocente."'";
		$resultado=mysql_query($query,$this->conexion);
		return mysql_num_rows($resultado);
	}
	
	function numeroComisionesProxima($cedulaDocente){
		$fechahoy=date("Y-n-j" );
		$query = "SELECT * FROM comisiones WHERE docente_id = '".$cedulaDocente."' and fechaf >= '" .$fechahoy. "'";
		$resultado=mysql_query($query,$this->conexion);
		return mysql_num_rows($resultado);
	}

	//funciones estado
	function saveEstado($objeto) {
		$query = "INSERT INTO estados(estado, archivo)
		values ('".$objeto->getEstado()."',
				'".$objeto->getArchivo()."');";
		$result=mysql_query($query,$this->conexion);
	}

	function updateEstado($objeto) {
		$query = "UPDATE estados SET
			estado = '".$objeto->getEstado()."',
			archivo = '".$objeto->getArchivo()."'
			WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);
	}

	//funciones informes
	function saveInforme($objeto) {
		$query = "INSERT INTO informes(acta_id, comision_id, fecha, actaCF, avalCF, informeEstudiante, informeTutor, calificaciones, obtuvoTitulo, informe, fechaReingreso)
		values (".$objeto->getActaId().",
				".$objeto->getComisionId().",
				'".$objeto->getFecha()."',
				'".$objeto->getActaCF()."',
				".$objeto->getAvalCF().",
				".$objeto->getInformeEstudiante().",
				".$objeto->getInformeTutor().",
				".$objeto->getCalificaciones().",
				".$objeto->getObtuvoTitulo().",
				'".$objeto->getInforme().",
				'".$objeto->getFechaReingreso()."');";
		$result=mysql_query($query,$this->conexion);
	}

	function updateInforme($objeto) {
		$query = "UPDATE informe SET
			acta_id = ".$objeto->getActaId().",
			comision_id = ".$objeto->getComisionId().",
			fecha = '".$objeto->getFecha()."',
			actaCF = '".$objeto->getActaCF()."',
			avalCF = ".$objeto->getAvalCF().",
			informeEstudiante = ".$objeto->getInformeEstudiante().",
			informeTutor = ".$objeto->getInformeTutor().",
			calificaciones = ".$objeto->getCalificaciones().",
			obtuvoTitulo = ".$objeto->getObtuvoTitulo().",
			informe = '".$objeto->getInforme()."',
			fechaReingreso = '".$objeto->getFechaReingreso()."'
			WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);
	}


	//funciones modificacion
	function saveModificacion($objeto) {
		$query = "INSERT INTO modificaciones(dedicacion_id, motivo_id, tipoComision_id, acta_id, pais_id, comision_id, facultad_id, lugar, objetivo, fecha1, fecha2)
		values (".$objeto->getDedicacionId().",
				".$objeto->getMotivoId().",
				".$objeto->getTipoComisionId().",
				".$objeto->getActaId().",
				".$objeto->getPaisId().",
				".$objeto->getComisionId().",
				".$objeto->getFacultadId().",
				'".$objeto->getLugar()."',
				'".$objeto->getObjetivo()."',
				'".$objeto->getFecha1()."',
				'".$objeto->getFecha2()."');";
		$result=mysql_query($query,$this->conexion);
	}

	function updateModificacion($objeto) {
		$query = "UPDATE modificaciones SET
			dedicacion_id = ".$objeto->getDedicacionId().",
			motivo_id = ".$objeto->getMotivoId().",
			tipoComision_id = ".$objeto->getTipoComisionId().",
			acta_id = ".$objeto->getActaId().",
			pais_id = ".$objeto->getPaisId().",
			comision_id = ".$objeto->getComisionId().",
			facultad_id = ".$objeto->getFacultadId().",
			lugar = '".$objeto->getLugar()."',
			objetivo = '".$objeto->getObjetivo()."',
			fecha1 = '".$objeto->getFecha1()."',
			fecha2 = '".$objeto->getFecha2()."'
			WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);
	}


	//funciones motivos
	function saveMotivo($objeto) {
		$query = "INSERT INTO motivos(motivo, tipo)
		values ('".$objeto->getMotivo()."', ".$objeto->getTipo().");";
		$result=mysql_query($query,$this->conexion);
	}

	function updateMotivo($objeto) {
		$query = "UPDATE motivos SET
		motivo = '".$objeto->getMotivo()."',
		tipo = ".$objeto->getTipo()."
		WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);
	}


	//funciones Prorrogas
	function saveProrroga($objeto) {
		$query = "INSERT INTO prorrogas(dedicacion_id, comision_id, acta_id, facultad_id, fecha1, fecha2)
		values (".$objeto->getDedicacionId().",
				".$objeto->getComisionId().",
				".$objeto->getActaId().",
				".$objeto->getFacultadId().",
				'".$objeto->getFecha1()."',
				'".$objeto->getFecha2()."');";
		$result=mysql_query($query,$this->conexion);
	}

	function updateProrroga($objeto) {
		$query = "UPDATE prorrogas SET
		dedicacion_id = ".$objeto->getDedicacionId().",
		comision_id = ".$objeto->getComisionId().",
		acta_id = ".$objeto->getActaId().",
		facultad_id = ".$objeto->getFacultadId().",
		fecha1 = '".$objeto->getFecha1()."',
		fecha2 = '".$objeto->getFecha2()."'
		WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);
	}


	//funciones solicitudes
	function saveSolicitud($objeto) {
		if(!$objeto->getMotivoId()) $objeto->setMotivoId(0);
		if(!$objeto->getRespuestaId()) $objeto->setRespuestaId(3);
		if(!$objeto->getTipoComisionId()) $objeto->setTipoComisionId(0);
		if(!$objeto->getSolicitudProfesor()) $objeto->setSolicitudProfesor(0);
		if(!$objeto->getCartaAceptacion()) $objeto->setCartaAceptacion(0);
		//if(!$objeto->getResolucionDeAdmision()) $objeto->setResolucionDeAdmision(0);

		if(!$objeto->getInformeEstudiante()) $objeto->setInformeEstudiante(0);
		if(!$objeto->getInformeTutor()) $objeto->setInformeTutor(0);
		if(!$objeto->getVotada()) $objeto->setVotada(0);
		if(!$objeto->getObtuvoTitulo()) $objeto->setObtuvoTitulo(0);
		if(!$objeto->getCalificaciones()) $objeto->setCalificaciones(0);
				
		/*$query = "INSERT INTO solicitudes(motivo_id, respuesta_id, tipoSolicitud_id, acta_id, docente_id, estado_id, dedicacion_id, pais_id, comision_id, facultad_id, tipoComision_id, objetivo, lugar, fecha1, fecha2, numeroActaCF, fechaActaCF, avalCF, solicitudProfesor, cartaAceptacion, resolucionDeAdmision, informeEstudiante, informeTutor, calificaciones, comentarios, recomendacion, observaciones, votada, semaforo,fechaReingreso,informe ,obtuvoTitulo)
		values (".$objeto->getMotivoId().",
				".$objeto->getRespuestaId().",
				".$objeto->getTiposolicitudId().",
				".$objeto->getActaId().",
				".$objeto->getDocenteId().",
				".$objeto->getEstadoId().",
				".$objeto->getDedicacionId().",
				".$objeto->getPaisId().",
				".$objeto->getComisionId().",
				".$objeto->getFacultadId().",
				".$objeto->getTipoComisionId().",
				'".$objeto->getObjetivo()."',
				'".$objeto->getLugar()."',
				'".$objeto->getFecha1()."',
				'".$objeto->getFecha2()."',
				'".$objeto->getNumeroActaCF()."',
				'".$objeto->getFechaActaCF()."',
				".$objeto->getAvalCF().",
				".$objeto->getSolicitudProfesor().",
				".$objeto->getCartaAceptacion().",
				".$objeto->getResolucionDeAdmision().",
				".$objeto->getInformeEstudiante().",
				".$objeto->getInformeTutor().",
				".$objeto->getCalificaciones().",
				'".$objeto->getComentarios()."',
				'".$objeto->getRecomendacion()."',
				'".$objeto->getObservaciones()."',
				".$objeto->getVotada().",
				'".$objeto->getSemaforo()."',
				'".$objeto->getFechaReingreso()."',
				'".$objeto->getInforme()."',
				".$objeto->getObtuvoTitulo().");";
		$result=mysql_query($query,$this->conexion);
		echo mysql_error();
		echo '</br>'.$query;
		//throw new Exception();
		return mysql_insert_id();
	}*/
		$query = "INSERT INTO solicitudes(motivo_id, respuesta_id, tipoSolicitud_id, acta_id, docente_id, estado_id, dedicacion_id, pais_id, comision_id, facultad_id, tipoComision_id, objetivo, lugar, fecha1, fecha2, numeroActaCF, fechaActaCF, avalCF, solicitudProfesor, cartaAceptacion, informeEstudiante, informeTutor, calificaciones, comentarios, recomendacion, observaciones, votada, semaforo,fechaReingreso,informe ,obtuvoTitulo ,resolucion ,fechaResolucion ,inicioResolucion ,finResolucion)
		values (".$objeto->getMotivoId().",
				".$objeto->getRespuestaId().",
				".$objeto->getTiposolicitudId().",
				".$objeto->getActaId().",
				".$objeto->getDocenteId().",
				".$objeto->getEstadoId().",
				".$objeto->getDedicacionId().",
				".$objeto->getPaisId().",
				".$objeto->getComisionId().",
				".$objeto->getFacultadId().",
				".$objeto->getTipoComisionId().",
				'".$objeto->getObjetivo()."',
				'".$objeto->getLugar()."',
				'".$objeto->getFecha1()."',
				'".$objeto->getFecha2()."',
				'".$objeto->getNumeroActaCF()."',
				'".$objeto->getFechaActaCF()."',
				".$objeto->getAvalCF().",
				".$objeto->getSolicitudProfesor().",
				".$objeto->getCartaAceptacion().",
				".$objeto->getInformeEstudiante().",
				".$objeto->getInformeTutor().",
				".$objeto->getCalificaciones().",
				'".$objeto->getComentarios()."',
				'".$objeto->getRecomendacion()."',
				'".$objeto->getObservaciones()."',
				".$objeto->getVotada().",
				'".$objeto->getSemaforo()."',
				'".$objeto->getFechaReingreso()."',
				'".$objeto->getInforme()."',
				".$objeto->getObtuvoTitulo()."),
				'".$objeto->getResolucion()."',
				'".$objeto->getFechaResolucion()."',
				'".$objeto->getInicioResolucion()."',
				'".$objeto->getFinResolucion()."';";
		$result=mysql_query($query,$this->conexion);
		echo mysql_error();
		echo '</br>'.$query;
		//throw new Exception();
		return mysql_insert_id();
	}

	function saveSolicitud2($objeto){
		$query = "INSERT INTO solicitudes(motivo_id, respuesta_id, tipoSolicitud_id, acta_id, docente_id, estado_id, dedicacion_id, pais_id, comision_id, facultad_id, tipoComision_id, objetivo, lugar, fecha1, fecha2, numeroActaCF, fechaActaCF, avalCF, solicitudProfesor, cartaAceptacion, informeEstudiante, informeTutor, calificaciones, comentarios, recomendacion, observaciones, votada, semaforo,fechaReingreso,informe,obtuvoTitulo,resolucion ,fechaResolucion ,inicioResolucion ,finResolucion)
		values (";
		$query.=($objeto->getMotivoId()!=NULL)?'"'.$objeto->getMotivoId().'"':'NULL'; $query.=',';
		$query.=($objeto->getRespuestaId()!=NULL)?'"'.$objeto->getRespuestaId().'"':'NULL';$query.=',';
		$query.=($objeto->getTiposolicitudId()!=NULL)?'"'.$objeto->getTiposolicitudId().'"':'NULL';$query.=',';
		$query.=($objeto->getActaId()!=NULL)?'"'.$objeto->getActaId().'"':'NULL';$query.=',';
		$query.=($objeto->getDocenteId()!=NULL)?'"'.$objeto->getDocenteId().'"':'NULL';$query.=',';
		$query.=($objeto->getEstadoId()!=NULL)?'"'.$objeto->getEstadoId().'"':'NULL';$query.=',';
		$query.=($objeto->getDedicacionId()!=NULL)?'"'.$objeto->getDedicacionId().'"':'NULL';$query.=',';
		$query.=($objeto->getPaisId()!=NULL)?'"'.$objeto->getPaisId().'"':'NULL';$query.=',';
		$query.=($objeto->getComisionId()!=NULL)?'"'.$objeto->getComisionId().'"':'NULL';$query.=',';
		$query.=($objeto->getFacultadId()!=NULL)?'"'.$objeto->getFacultadId().'"':'NULL';$query.=',';
		$query.=($objeto->getTipoComisionId()!=NULL)?'"'.$objeto->getTipoComisionId().'"':'NULL';$query.=',';
		$query.=($objeto->getObjetivo()!=NULL)?'"'.$objeto->getObjetivo().'"':'NULL';$query.=',';
		$query.=($objeto->getLugar()!=NULL)?'"'.$objeto->getLugar().'"':'NULL';$query.=',';
		$query.=($objeto->getFecha1()!=NULL)?'"'.$objeto->getFecha1().'"':'NULL';$query.=',';
		$query.=($objeto->getFecha2()!=NULL)?'"'.$objeto->getFecha2().'"':'NULL';$query.=',';
		$query.=($objeto->getNumeroActaCF()!=NULL)?'"'.$objeto->getNumeroActaCF().'"':'NULL';$query.=',';
		$query.=($objeto->getFechaActaCF()!=NULL)?'"'.$objeto->getFechaActaCF().'"':'NULL';$query.=',';
		$query.=($objeto->getAvalCF()!=NULL)?'"'.$objeto->getAvalCF().'"':'NULL';$query.=',';
		$query.=($objeto->getSolicitudProfesor()!=NULL)?'"'.$objeto->getSolicitudProfesor().'"':'NULL';$query.=',';
		$query.=($objeto->getCartaAceptacion()!=NULL)?'"'.$objeto->getCartaAceptacion().'"':'NULL';$query.=',';
		$query.=($objeto->getInformeEstudiante()!=NULL)?'"'.$objeto->getInformeEstudiante().'"':'NULL';$query.=',';
		$query.=($objeto->getInformeTutor()!=NULL)?'"'.$objeto->getInformeTutor().'"':'NULL';$query.=',';
		$query.=($objeto->getCalificaciones()!=NULL)?'"'.$objeto->getCalificaciones().'"':'NULL';$query.=',';
		$query.=($objeto->getComentarios()!=NULL)?'"'.$objeto->getComentarios().'"':'NULL';$query.=',';
		$query.=($objeto->getRecomendacion()!=NULL)?'"'.$objeto->getRecomendacion().'"':'NULL';$query.=',';
		$query.=($objeto->getObservaciones()!=NULL)?'"'.$objeto->getObservaciones().'"':'NULL';$query.=',';
		$query.=($objeto->getVotada()!=NULL)?'"'.$objeto->getVotada().'"':'NULL';$query.=',';
		$query.=($objeto->getSemaforo()!=NULL)?'"'.$objeto->getSemaforo().'"':'NULL';$query.=',';
		$query.=($objeto->getFechaReingreso()!=NULL)?'"'.$objeto->getFechaReingreso().'"':'NULL';$query.=',';
		$query.=($objeto->getInforme()!=NULL)?'"'.$objeto->getInforme().'"':'NULL';$query.=',';
		$query.=($objeto->getObtuvoTitulo()!=NULL)?'"'.$objeto->getObtuvoTitulo().'"':'NULL';$query.=',';
		$query.=($objeto->getResolucion()!=NULL)?'"'.$objeto->getResolucion().'"':'NULL';$query.=',';
		$query.=($objeto->getFechaResolucion()!=NULL)?'"'.$objeto->getFechaResolucion().'"':'NULL';$query.=',';
		$query.=($objeto->getInicioResolucion()!=NULL)?'"'.$objeto->getInicioResolucion().'"':'NULL';$query.=',';
		$query.=($objeto->getFinResolucion()!=NULL)?'"'.$objeto->getFinResolucion().'"':'NULL';
		$query.=");";
		$result=mysql_query($query,$this->conexion);
		//echo $query;
		//echo mysql_error();
		//throw new Exception();
		return mysql_insert_id();
		
		/*
		$query = "INSERT INTO solicitudes(motivo_id, respuesta_id, tipoSolicitud_id, acta_id, docente_id, estado_id, dedicacion_id, pais_id, comision_id, facultad_id, tipoComision_id, objetivo, lugar, fecha1, fecha2, numeroActaCF, fechaActaCF, avalCF, solicitudProfesor, cartaAceptacion, resolucionDeAdmision, informeEstudiante, informeTutor, calificaciones, comentarios, recomendacion, observaciones, votada, semaforo,fechaReingreso,informe,obtuvoTitulo)
		values (";
		$query.=($objeto->getMotivoId()!=NULL)?'"'.$objeto->getMotivoId().'"':'NULL'; $query.=',';
		$query.=($objeto->getRespuestaId()!=NULL)?'"'.$objeto->getRespuestaId().'"':'NULL';$query.=',';
		$query.=($objeto->getTiposolicitudId()!=NULL)?'"'.$objeto->getTiposolicitudId().'"':'NULL';$query.=',';
		$query.=($objeto->getActaId()!=NULL)?'"'.$objeto->getActaId().'"':'NULL';$query.=',';
		$query.=($objeto->getDocenteId()!=NULL)?'"'.$objeto->getDocenteId().'"':'NULL';$query.=',';
		$query.=($objeto->getEstadoId()!=NULL)?'"'.$objeto->getEstadoId().'"':'NULL';$query.=',';
		$query.=($objeto->getDedicacionId()!=NULL)?'"'.$objeto->getDedicacionId().'"':'NULL';$query.=',';
		$query.=($objeto->getPaisId()!=NULL)?'"'.$objeto->getPaisId().'"':'NULL';$query.=',';
		$query.=($objeto->getComisionId()!=NULL)?'"'.$objeto->getComisionId().'"':'NULL';$query.=',';
		$query.=($objeto->getFacultadId()!=NULL)?'"'.$objeto->getFacultadId().'"':'NULL';$query.=',';
		$query.=($objeto->getTipoComisionId()!=NULL)?'"'.$objeto->getTipoComisionId().'"':'NULL';$query.=',';
		$query.=($objeto->getObjetivo()!=NULL)?'"'.$objeto->getObjetivo().'"':'NULL';$query.=',';
		$query.=($objeto->getLugar()!=NULL)?'"'.$objeto->getLugar().'"':'NULL';$query.=',';
		$query.=($objeto->getFecha1()!=NULL)?'"'.$objeto->getFecha1().'"':'NULL';$query.=',';
		$query.=($objeto->getFecha2()!=NULL)?'"'.$objeto->getFecha2().'"':'NULL';$query.=',';
		$query.=($objeto->getNumeroActaCF()!=NULL)?'"'.$objeto->getNumeroActaCF().'"':'NULL';$query.=',';
		$query.=($objeto->getFechaActaCF()!=NULL)?'"'.$objeto->getFechaActaCF().'"':'NULL';$query.=',';
		$query.=($objeto->getAvalCF()!=NULL)?'"'.$objeto->getAvalCF().'"':'NULL';$query.=',';
		$query.=($objeto->getSolicitudProfesor()!=NULL)?'"'.$objeto->getSolicitudProfesor().'"':'NULL';$query.=',';
		$query.=($objeto->getCartaAceptacion()!=NULL)?'"'.$objeto->getCartaAceptacion().'"':'NULL';$query.=',';
		$query.=($objeto->getResolucionDeAdmision()!=NULL)?'"'.$objeto->getResolucionDeAdmision().'"':'NULL';$query.=',';
		$query.=($objeto->getInformeEstudiante()!=NULL)?'"'.$objeto->getInformeEstudiante().'"':'NULL';$query.=',';
		$query.=($objeto->getInformeTutor()!=NULL)?'"'.$objeto->getInformeTutor().'"':'NULL';$query.=',';
		$query.=($objeto->getCalificaciones()!=NULL)?'"'.$objeto->getCalificaciones().'"':'NULL';$query.=',';
		$query.=($objeto->getComentarios()!=NULL)?'"'.$objeto->getComentarios().'"':'NULL';$query.=',';
		$query.=($objeto->getRecomendacion()!=NULL)?'"'.$objeto->getRecomendacion().'"':'NULL';$query.=',';
		$query.=($objeto->getObservaciones()!=NULL)?'"'.$objeto->getObservaciones().'"':'NULL';$query.=',';
		$query.=($objeto->getVotada()!=NULL)?'"'.$objeto->getVotada().'"':'NULL';$query.=',';
		$query.=($objeto->getSemaforo()!=NULL)?'"'.$objeto->getSemaforo().'"':'NULL';$query.=',';
		$query.=($objeto->getFechaReingreso()!=NULL)?'"'.$objeto->getFechaReingreso().'"':'NULL';$query.=',';
		$query.=($objeto->getInforme()!=NULL)?'"'.$objeto->getInforme().'"':'NULL';$query.=',';
		$query.=($objeto->getObtuvoTitulo()!=NULL)?'"'.$objeto->getObtuvoTitulo().'"':'NULL';
		$query.=");";
		$result=mysql_query($query,$this->conexion);
		//echo $query;
		//echo mysql_error();
		//throw new Exception();
		return mysql_insert_id();*/
	}


	function updateSolicitud($objeto) {
		$query = "UPDATE solicitudes SET
			 motivo_id= ".$objeto->getMotivoId().",
			 respuesta_id = ".$objeto->getRespuestaId().",
			 tipoSolicitud_id = ".$objeto->getTiposolicitudId().",
			 acta_id = ".$objeto->getActaId().",
			 docente_id = ".$objeto->getDocenteId().",
			 estado_id = ".$objeto->getEstadoId().",
			 dedicacion_id = ".$objeto->getDedicacionId().",
			 pais_id = ".$objeto->getPaisId().",
			 comision_id = ".$objeto->getComisionId().",
			 facultad_id = ".$objeto->getFacultadId().",
			 tipoComision_id = ".$objeto->getTipoComisionId().",
			 objetivo = '".$objeto->getObjetivo()."',
			 lugar = '".$objeto->getLugar()."',
			 fecha1 = '".$objeto->getFecha1()."',
			 fecha2 = '".$objeto->getFecha2()."',
			 numeroActaCF = '".$objeto->getNumeroActaCF()."',
			 fechaActaCF = '".$objeto->getFechaActaCF()."',
			 avalCF = ".$objeto->getAvalCF().",
			 solicitudProfesor = ".$objeto->getSolicitudProfesor().",
			 cartaAceptacion = ".$objeto->getCartaAceptacion().",
			 informeEstudiante = ".$objeto->getInformeEstudiante().",
			 informeTutor = ".$objeto->getInformeTutor().",
			 calificaciones = ".$objeto->getCalificaciones().",
			 comentarios = '".$objeto->getComentarios()."',
			 recomendacion = '".$objeto->getRecomendacion()."',
			 observaciones = '".$objeto->getObservaciones()."',
			 votada = ".$objeto->getVotada().",
			 semaforo = '".$objeto->getSemaforo()."',
			 obtuvoTitulo= ".$objeto->getObtuvoTitulo().",
			 fechaReingreso = '".$objeto->getFechaReingreso()."',
			 informe= '".$objeto->getInforme()."',
			 resolucion= '".$objeto->getResolucion()."',
			 fechaResolucion= '".$objeto->getFechaResolucion()."',
			 inicioResolucion= '".$objeto->getInicioResolucion()."',
			 finResolucion= '".$objeto->getFinResolucion()."'
			 WHERE id = ".$objeto->getId();
		$result=mysql_query($query,$this->conexion);
		/*
		$query = "UPDATE solicitudes SET
			 motivo_id= ".$objeto->getMotivoId().",
			 respuesta_id = ".$objeto->getRespuestaId().",
			 tipoSolicitud_id = ".$objeto->getTiposolicitudId().",
			 acta_id = ".$objeto->getActaId().",
			 docente_id = ".$objeto->getDocenteId().",
			 estado_id = ".$objeto->getEstadoId().",
			 dedicacion_id = ".$objeto->getDedicacionId().",
			 pais_id = ".$objeto->getPaisId().",
			 comision_id = ".$objeto->getComisionId().",
			 facultad_id = ".$objeto->getFacultadId().",
			 tipoComision_id = ".$objeto->getTipoComisionId().",
			 objetivo = '".$objeto->getObjetivo()."',
			 lugar = '".$objeto->getLugar()."',
			 fecha1 = '".$objeto->getFecha1()."',
			 fecha2 = '".$objeto->getFecha2()."',
			 numeroActaCF = '".$objeto->getNumeroActaCF()."',
			 fechaActaCF = '".$objeto->getFechaActaCF()."',
			 avalCF = ".$objeto->getAvalCF().",
			 solicitudProfesor = ".$objeto->getSolicitudProfesor().",
			 cartaAceptacion = ".$objeto->getCartaAceptacion().",
			 resolucionDeAdmision = ".$objeto->getResolucionDeAdmision().",
			 informeEstudiante = ".$objeto->getInformeEstudiante().",
			 informeTutor = ".$objeto->getInformeTutor().",
			 calificaciones = ".$objeto->getCalificaciones().",
			 comentarios = '".$objeto->getComentarios()."',
			 recomendacion = '".$objeto->getRecomendacion()."',
			 observaciones = '".$objeto->getObservaciones()."',
			 votada = ".$objeto->getVotada().",
			 semaforo = '".$objeto->getSemaforo()."',
			 obtuvoTitulo= ".$objeto->getObtuvoTitulo().",
			 fechaReingreso = '".$objeto->getFechaReingreso()."',
			 informe= '".$objeto->getInforme()."'
			 WHERE id = ".$objeto->getId();
		$result=mysql_query($query,$this->conexion);*/
		//echo mysql_error();
		//echo $query;  
		//throw new Exception();
	}

	function updateSolicitud2($objeto){
		$query = "UPDATE solicitudes SET ";
		$query.=($objeto->getMotivoId()!=NULL)?'motivo_id="'.$objeto->getMotivoId().'"':'';
		$query.=($objeto->getRespuestaId()!=NULL)?',respuesta_id="'.$objeto->getRespuestaId().'"':'';
		$query.=($objeto->getTiposolicitudId()!=NULL)?',tipoSolicitud_id="'.$objeto->getTiposolicitudId().'"':'';
		$query.=($objeto->getActaId()!=NULL)?',acta_id="'.$objeto->getActaId().'"':'';
		$query.=($objeto->getDocenteId()!=NULL)?',docente_id="'.$objeto->getDocenteId().'"':'';
		$query.=($objeto->getEstadoId()!=NULL)?',estado_id="'.$objeto->getEstadoId().'"':'';
		$query.=($objeto->getDedicacionId()!=NULL)?',dedicacion_id="'.$objeto->getDedicacionId().'"':'';
		$query.=($objeto->getPaisId()!=NULL)?',pais_id="'.$objeto->getPaisId().'"':'';
		$query.=($objeto->getComisionId()!=NULL)?',comision_id="'.$objeto->getComisionId().'"':'';
		$query.=($objeto->getFacultadId()!=NULL)?',facultad_id="'.$objeto->getFacultadId().'"':'';
		$query.=($objeto->getTipoComisionId()!=NULL)?',tipoComision_id="'.$objeto->getTipoComisionId().'"':'';
		$query.=($objeto->getObjetivo()!=NULL)?',objetivo="'.$objeto->getObjetivo().'"':'';
		$query.=($objeto->getLugar()!=NULL)?',lugar="'.$objeto->getLugar().'"':'';
		$query.=($objeto->getFecha1()!=NULL)?',fecha1="'.$objeto->getFecha1().'"':'';
		$query.=($objeto->getFecha2()!=NULL)?',fecha2="'.$objeto->getFecha2().'"':'';
		$query.=($objeto->getNumeroActaCF()!=NULL)?',numeroActaCF="'.$objeto->getNumeroActaCF().'"':'';
		$query.=($objeto->getFechaActaCF()!=NULL)?',fechaActaCF="'.$objeto->getFechaActaCF().'"':'';
		$query.=($objeto->getAvalCF()!=NULL)?',avalCF="'.$objeto->getAvalCF().'"':'';
		$query.=($objeto->getSolicitudProfesor()!=NULL)?',solicitudProfesor="'.$objeto->getSolicitudProfesor().'"':'';
		$query.=($objeto->getCartaAceptacion()!=NULL)?',cartaAceptacion="'.$objeto->getCartaAceptacion().'"':'';
		//$query.=($objeto->getResolucionDeAdmision()!=NULL)?',resolucionDeAdmision="'.$objeto->getResolucionDeAdmision().'"':'';
		$query.=($objeto->getInformeEstudiante()!=NULL)?',informeEstudiante="'.$objeto->getInformeEstudiante().'"':'';
		$query.=($objeto->getInformeTutor()!=NULL)?',informeTutor="'.$objeto->getInformeTutor().'"':'';
		$query.=($objeto->getCalificaciones()!=NULL)?',calificaciones="'.$objeto->getCalificaciones().'"':'';
		$query.=($objeto->getComentarios()!=NULL)?',comentarios="'.$objeto->getComentarios().'"':'';
		$query.=($objeto->getRecomendacion()!=NULL)?',recomendacion="'.$objeto->getRecomendacion().'"':'';
		$query.=($objeto->getObservaciones()!=NULL)?',observaciones="'.$objeto->getObservaciones().'"':'';
		$query.=($objeto->getVotada()!=NULL)?',votada="'.$objeto->getVotada().'"':'';
		$query.=($objeto->getSemaforo()!=NULL)?',semaforo="'.$objeto->getSemaforo().'"':'';
		$query.=($objeto->getInforme()!=NULL)?',informe="'.$objeto->getInforme().'"':'';
		$query.=($objeto->getFechaReingreso()!=NULL)?',fechaReingreso="'.$objeto->getFechaReingreso().'"':'';
		$query.=($objeto->getObtuvoTitulo()!=NULL)?',obtuvoTitulo="'.$objeto->getObtuvoTitulo().'"':'';
		$query.=($objeto->getComentariosUnidad()!=NULL)?',comentariosUnidad="'.$objeto->getComentariosUnidad().'"':'';
		$query.=($objeto->getResolucion()!=NULL)?',resolucion="'.$objeto->getResolucion().'"':'';
		$query.=($objeto->getFechaResolucion()!=NULL)?',fechaResolucion="'.$objeto->getFechaResolucion().'"':'';
		$query.=($objeto->getInicioResolucion()!=NULL)?',inicioResolucion="'.$objeto->getInicioResolucion().'"':'';
		$query.=($objeto->getFinResolucion()!=NULL)?',finResolucion="'.$objeto->getFinResolucion().'"':'';

		$query.=" where id=".$objeto->getId().";";
		var_dump($query);
		$result=mysql_query($query,$this->conexion);
		//echo $query;
		//echo mysql_error();
		//throw new Exception();
	}


	//funciones tipoSolicitud
	function saveTipoSolicitud($objeto) {
		$query = "INSERT INTO tiposSolicitudes(tipo)
		values ('".$objeto->getTipo()."');";
		$result=mysql_query($query,$this->conexion);
	}

	function updateTipoSolicitud($objeto) {
		$query = "UPDATE tiposSolicitudes SET
		tipo = '".$objeto->getTipo()."'
		WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);
	}

	//funciones tipoComision
	function saveTipoComision($objeto) {
		$query = "INSERT INTO tiposComisiones(tipo)
		values ('".$objeto->getTipo()."');";
		$result=mysql_query($query,$this->conexion);
	}

	function updateTipoComision($objeto) {
		$query = "UPDATE tiposComisiones SET
		tipo = '".$objeto->getTipo()."'
		WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);
	}


	//funciones dedicacion
	function saveDedicacion($objeto) {
		$query = "INSERT INTO dedicaciones(nombre, valor)
		values ('".$objeto->getNombre()."', '".$objeto->getValor()."');";
		$result=mysql_query($query,$this->conexion);
	}

	function updateDedicacion($objeto) {
		$query = "UPDATE dedicaciones SET
		nombre = '".$objeto->getNombre()."',
		valor = '".$objeto->getValor()."'
		WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);
	}


	//funciones categoria
	function saveCategoria($objeto) {
		$query = "INSERT INTO categorias(categoria)
		values ('".$objeto->getCategoria()."');";
		$result=mysql_query($query,$this->conexion);
	}

	function updateCategoria($objeto) {
		$query = "UPDATE categorias SET
		categoria = '".$objeto->getCategoria()."'
		WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);
	}


	//funciones facultad
	function saveFacultad($objeto) {
		$query = "INSERT INTO facultades(codigo, nombre, nombreDecano, apellido1Decano, apellido2Decano, tituloDecano, cargoDecano, correos, saludo)
		values ('".$objeto->getCodigo()."',
				'".$objeto->getNombre()."',
				'".$objeto->getNombreDecano()."',
				'".$objeto->getApellido1Decano()."',
				'".$objeto->getApellido2Decano()."',
				'".$objeto->getTituloDecano()."',
				'".$objeto->getCargoDecano()."',
				'".$objeto->getCorreos()."',
				'".$objeto->getSaludo()."');";
		$result=mysql_query($query,$this->conexion);
	}

	function updateFacultad($objeto) {
		$query = "UPDATE facultades SET
		codigo = '".$objeto->getCodigo()."',
		nombre = '".$objeto->getNombre()."',
		nombreDecano = '".$objeto->getNombreDecano()."',
		apellido1Decano = '".$objeto->getApellido1Decano()."',
		apellido2Decano = '".$objeto->getApellido2Decano()."',
		tituloDecano = '".$objeto->getTituloDecano()."',
		cargoDecano = '".$objeto->getCargoDecano()."',
		correos = '".$objeto->getCorreos()."',
		saludo = '".$objeto->getSaludo()."'
		WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);
	}

	//funciones paises
	function savePais($objeto) {
		$query = "INSERT INTO paises(pais)
		values ('".$objeto->getNombre()."');";
		$result=mysql_query($query,$this->conexion);
	}

	function updatePais($objeto) {
		$query = "UPDATE paises SET
		pais = '".$objeto->getNombre()."'
		WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);
	}


	//funciones respuesta
	function saveRespuesta($objeto) {
		$query = "INSERT INTO respuestas(respuesta)
		values ('".$objeto->getNombre()."');";
		$result=mysql_query($query,$this->conexion);
	}

	function updateRespuesta($objeto) {
		$query = "UPDATE respuestas SET
		respuesta = '".$objeto->getNombre()."'
		WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);
	}

	//funciones usuario
	function saveUsuario($objeto) {
		$query = "INSERT INTO usuarios(cedula, nombre, clave, rol)
		values ('".$objeto->getCedula()."',
				'".$objeto->getNombre()."',
				'".$objeto->getClave()."',
				'".$objeto->getRol().");";
		$result=mysql_query($query,$this->conexion);
	}

	function updateUsuario($objeto) {
		$query = "UPDATE usuarios SET
		cedula = '".$objeto->getCedula()."',
		nombre = '".$objeto->getNombre()."',
		clave = '".$objeto->getClave()."',
		rol = '".$objeto->getRol()."'
		WHERE id = ".$objeto->getId().";";
		$result=mysql_query($query,$this->conexion);
	}

	////////////////////////////////////////////////////////////////////////////////////////
	//funciones para todas las tablas
	function delete($tabla,$id) {
		$query = "DELETE FROM ".$tabla."  WHERE id = '".$id."' " ;
		$result = mysql_query($query,$this->conexion);
	}

	function find($tabla,$id) {
		$query = "SELECT * FROM ".$tabla." WHERE id = '".$id."'";
		//echo $query;
		//throw new Exception();
		$result=mysql_query($query,$this->conexion);
		if(!$result){
			echo "error: ".mysql_error();
		}
		$fila = mysql_fetch_assoc($result);
		return $fila;
	}



	function getId($tabla, $campo1, $valor1, $campo2=null, $valor2=null, $campo3=null, $valor3=null) {
		$query = "SELECT *
		FROM ".$tabla;
		$query .= " WHERE ".$campo1." = '".$valor1."'";
		if($campo2) {
			$query .= " AND ".$campo2." = '".$valor2."'";
			if($campo3)
				$query .= " AND ".$campo3." = '".$valor3."'";
		}
		$query .= ";";
		$result=mysql_query($query,$this->conexion);
		$resultado=mysql_num_rows($result);
		$fila = mysql_fetch_assoc($result);

		return $fila['id'];
	}

	//funciones usuariosolicitudes
	function saveVotacion($votacion){
		$voto = $votacion->getVotacion();
		if(!$voto){
			$voto = 0;
		}
		$query = "INSERT INTO votaciones(solicitud_id,usuario_id,votacion,comentarios)
		values (".$votacion->getSolicitud_id().",
				".$votacion->getUsuario_id().",
				".$voto.",
				'".$votacion->getComentarios()."'
				)
				ON DUPLICATE KEY UPDATE
				votacion=$voto, comentarios='".$votacion->getComentarios()."';";
		//echo $query."</br>";
		$result=mysql_query($query,$this->conexion);
		//echo mysql_error();
		//echo $voto;
	}

	function updateVotacion($votacion){
		$query = "UPDATE votaciones SET
		solicitud_id = '".$votacion->getSolicitud_id()."',
		usuario_id = '".$votacion->getUsuario_id()."',
		votacion = '".$votacion->getVotacion()."',
		comentarios = '".$votacion->getComentarios()."'
		WHERE usuario_id = ".$votacion->getUsuario_id()." and solicitud_id = ".$votacion->getSolicitud_id().";";
		$result=mysql_query($query,$this->conexion);
	}

	function findVotacion($usuario_id, $solicitud_id){
	 	$query = "select * from votaciones where usuario_id= '$usuario_id' and solicitud_id = '$solicitud_id';";
		$result=mysql_query($query,$this->conexion);

		if(!$result){
			echo "no se puede ejecutar".mysql_error();
		}
		$resultado=mysql_num_rows($result);
		$fila = mysql_fetch_array($result);
		return $fila['votacion'];

	}

	function getVotaciones($soliciudId){
		$query = "select * from votaciones where solicitud_id = $soliciudId";
		$resultado = mysql_query($query,$this->conexion);
		return $resultado;
	}


}
?>
