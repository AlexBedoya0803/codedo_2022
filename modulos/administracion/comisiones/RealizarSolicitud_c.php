<?php
	/*
	* Autor Luis Fernando Orozco
	* Este script es el controlador de la vista RealizarSolicitud
	*/
	
	require_once('../../login/Session.php');
	require_once('../../mail/Mail.php');
	$session = Session::getInstance();
	if($session->getVal("usuario_id")=="" || $session->getVal("rol")!="docente") //si no hay ningun usuario registrado muestra la vista general
		echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
	
	require_once('../../../configuracion/path.php');
	$path=asignarPath(dirname(__FILE__));
	require_once($path['modelo'].'criteria.php');
	require_once($path['modelo'].'clasesDTO.php');
	require_once($path['modelo'].'procedimientos.php');
	require_once('UploadFiles.php');

	//Consulta las solicitudes que estan registradas (estado=1) pertenecientes al docente conectado
	$consulta = new Criteria("solicitudes");
	$consulta->addFiltro("estado_id","=","1");
	$consulta->addFiltro("docente_id","=",$session->getVal("usuario_id"));
	$solicitudes=$consulta->execute();
	$cantidadSolicitudesRegistradas= $consulta->_count();
	
	$tipoSolicitudesRegistradas[]= array();
	if($cantidadSolicitudesRegistradas>=1){
		for($i=0; $i<$cantidadSolicitudesRegistradas; $i++){
			$tipoSolicitudesRegistradas[$i]= $solicitudes[$i]->getTipoSolicitud()->getTipo();
			}
		}
	//var_dump($tipoSolicitudesRegistradas);
			
	$asunto = "Registro de Solicitud";
	$mensaje='
					<h1 style="color:#0A351C">Sistema del Comité de Desarrollo del Personal Docente</h1>
					</br>
					<hr width="100%" aling="center" /
					</br>';
					
	
	//$mensaje = "Señor(a) profesor se le informa que su solicitud en el sistema del comite de desarrollo de personal docente se encuentra registrada y lista para revisión";
	
	$docente = new DocenteDTO();
	$docente = $docente->find($session->getVal("usuario_id"));
	//echo $docente->getCorreo().'</br>';
	$email = $docente->getCorreo();
	
	
	$facultad = new FacultadDTO();
	$facultad = $facultad->find($docente->getFacultadId());
	//echo $facultad->getCorreos();
	$asuntoUnidad = "Solicitud pendiente";
	$mensajeUnidad='<html><body>
					<h1 style="color:#0A351C">Sistema del Comité de Desarrollo del Personal Docente</h1>
					</br>
					<hr width="100%" aling="center" /
					</br>';
	$emaiUnidad = $facultad->getCorreos();
	
	if(isset($_POST["guardarNueva"])){
		//echo "nueva";
		$motivo = html_entity_decode($_POST["motivos"]);
		$dedicacion = html_entity_decode($_POST["dedicaciones"]);
		$objetivo = html_entity_decode($_POST["Objetivo"]);
		$lugar = html_entity_decode($_POST["Lugar"]);
		$pais = html_entity_decode($_POST["paises"]);
		$fechaInicio = $_POST["fechaInicio"];
		$fechaTerminacion = $_POST["fechaTerminacion"];
		$docente=new DocenteDTO();
		$docente=$docente->find($session->getVal("usuario_id"));
		
		$solicitud = new SolicitudDTO();
		$solicitud->setDocenteId($session->getVal("usuario_id"));
		$solicitud->setEstadoId(1);
		$solicitud->setTiposolicitudId(1);
		$solicitud->setRespuestaId("0");
		$solicitud->setMotivoId($motivo);
		$solicitud->setDedicacionId($dedicacion);
		$solicitud->setPaisId($pais);
		$solicitud->setFacultadId($docente->getFacultadId());
		if($motivo == 1 || $motivo == 2 || $motivo == 3 || $motivo == 4 || $motivo == 6 || $motivo == 12 || $motivo == 14 || $motivo == 98 ){
			$solicitud->setTipoComisionId(1);
		}else{
			$solicitud->setTipoComisionId(2);
		}
		
		$solicitud->setObjetivo($objetivo);
		$solicitud->setLugar($lugar);
		$solicitud->setFecha1($fechaInicio);
		$solicitud->setFecha2($fechaTerminacion);
		$solicitud->setComentarios($_POST["comentarios"]);
		//$solicitud->setAvalCF("0");
		$solicitud->setSolicitudProfesor("0");
		$solicitud->setCartaAceptacion(1);
		$solicitud->setInformeEstudiante("0");
		$solicitud->setInformeTutor("0");
		$solicitud->setCalificaciones("0");
		$solicitud->setVotada("0");
		$solicitud->setObtuvoTitulo("0");
		$solicitud->setActaId(-1);
		$idSolicitud  = $solicitud->save2();
		$ruta = '../../../anexos/'.$idSolicitud;
		if(isset($idSolicitud)){
			//echo $ruta;
			if(!file_exists($ruta)) mkdir($ruta, 0777, true);
		UploadFiles::saveAnexos($_FILES['cartaAceptacion'],$ruta);
		UploadFiles::saveAnexos($_FILES['resolucionDeAdmision'],$ruta);
		UploadFiles::saveAnexos($_FILES['otros'],$ruta);
			
		}
		
		if($idSolicitud!=0){
			echo '
				<script>
					//alert("hello");
					document.getElementById("recargar").innerHTML = true;
					document.getElementById("url").innerHTML = "../docentes/Informacion2.php";
					document.getElementById("name").innerHTML = "***";
					document.getElementById("msg").innerHTML = "La solicitud se cre&oacute; exitosamente";
					document.getElementById("myModal").style.display="block";
					
					//window.location.href = "../../index.php";
				</script>		
			';
			
			$mensaje .= "<p style='color:black'>Señor(a) profesor(a) se le informa que su solicitud para una comisión de estudios nueva ha sido registrada de manera exitosa y se encuentra pendiente de ser analizada por el comité de desarrollo del personal docente quien emitirá su concepto. </p>";
			//$mensaje.='</body></html>';
			
			$mensajeUnidad .= "<p style='color:black'>".$facultad->getSaludo()." ".$facultad->getTituloDecano().",</p><p style='color:black'> Se le informa que el profesor(a) ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2()." realizó una solicitud de comisión de estudios nueva, la cual se encuentra a la espera de ser analizada por el consejo de su unidad académica, por lo tanto le solicitamos de manera acomedida emitir su concepto a esta solicitud en el sitio <a href='avido.udea.edu.co/dedo'>Codedo</a>.</p>";
			$mensajeUnidad .="</body></html>";
			//$mail = new Mail();

			Mail::enviar($asunto,$mensaje,$email); //Se envia correo al profesor
			Mail::enviar($asuntoUnidad,$mensajeUnidad,$emaiUnidad); //Se envia correo a la unidad
			//Enviar Mensaje
		}
		
		
	}
	if(isset($_POST["guardarProrroga"])){
			//var_dump($_POST);
			//var_dump($_FILES);
			
			$idComision = $_POST["comisiones"];
			$fechaInicio = $_POST["fechaInicio"];
			$fechaTerminacion = $_POST["fechaTerminacion"];
			$observaciones = utf8_encode($_POST["observaciones"]);
			//var_dump($comision);
			//throw new Exception();
			$comision = new ComisionDTO();
			$comision = $comision->find($idComision);
			//$solicitud=new SolicitudDTO();
			//$solicitud->setComisionId($idComision);
			
			/*
			Elementos de la tabla comisión.
			$formulario=array();
			$formulario['motivos']=$comision->getMotivoId(); 
			$formulario['dedicaciones']=$comision->getDedicacionId(); 
			$formulario['paises']=$comision->getPaisId(); 
			$formulario['facultades']=$comision->getFacultadId(); 
			$formulario['tipoComision']=$comision->getTipoComisionId(); 
			$formulario['objetivo']=$comision->getObjetivo(); 
			$formulario['lugar']=$comision->getLugar();
			$formulario['fecha1']=$comision->getFecha1();
			$formulario['fecha2']=$comision->getFecha2();
			$formulario['fechaf']=$comision->getFechaf();
			$formulario['observaciones']=$comision->getObservaciones();
			$formulario['comisiones']=$comision->getId();
			*/
			
			//$formulario['comentarios']=$solicitud->getComentarios();
			//$formulario['observaciones']=$solicitud->getObservaciones();
			//var_dump($comision);
			//throw new Exception();
			
			$solicitudRelacionada=new SolicitudDTO();
			$solicitudRelacionada->setComisionId($idComision);
			if($solicitudRelacionada->findId())
				$solicitudRelacionada=$solicitudRelacionada->find($solicitudRelacionada->findId());
			$solicitud=new SolicitudDTO();
			$solicitud->setDocenteId($session->getVal("usuario_id"));
			//$solicitud->setActaId(-1);
			
			$solicitud->setEstadoId(1);
			$solicitud->setTiposolicitudId(3);
			$solicitud->setRespuestaId("0");
			$solicitud->setComisionId($idComision);
			$solicitud->setMotivoId($comision->getMotivoId());
			$solicitud->setDedicacionId($comision->getDedicacionId());
			$solicitud->setPaisId($comision->getPaisId());
			$solicitud->setFacultadId($comision->getFacultadId());
			$solicitud->setTipoComisionId($comision->getTipoComisionId());
			$solicitud->setObjetivo($comision->getObjetivo());
			$solicitud->setLugar($comision->getLugar());
			$solicitud->setFecha1($fechaInicio);
			$solicitud->setFecha2($fechaTerminacion);
			//var_dump($solicitudRelacionada->getLugar());
			//var_dump($solicitudRelacionada->getPaisId());
			//var_dump($solicitudRelacionada);
			//throw new Exception();
			//$solicitud->setNumeroActaCF($actaCF);
			//$solicitud->setFechaActaCF($fechaActaCF);
			//if($_POST["avalCF"]=="on") $solicitud->setAvalCF(1);
			$solicitud->setAvalCF("0");
			//if($_POST["solicitudProfesor"]=="on") $solicitud->setSolicitudProfesor(1);
			$solicitud->setSolicitudProfesor("0");
			$solicitud->setCartaAceptacion(1);
			$solicitud->setInformeEstudiante(1);
			$solicitud->setInformeTutor(1);
			$solicitud->setCalificaciones(1);
			$solicitud->setComentarios($comision->getComentarios);
			$solicitud->setObservaciones($comision->getObservaciones());
			$solicitud->setVotada("0");
			$solicitud->setActaId(-1);
			//$idSolicitud=$solicitud->save();
			//var_dump($solicitud);
			$idSolicitud = $solicitud->save2();
			$ruta = '../../../anexos/'.$idSolicitud;
				//echo $solicitud->getId();
			//echo $ruta;
			//throw new Exception();
			if(!file_exists($ruta)) mkdir($ruta, 0777, true);
			if(isset($idSolicitud)){
				UploadFiles::saveAnexos($_FILES['cartaAceptacion'],$ruta);
				UploadFiles::saveAnexos($_FILES['informeActividades'],$ruta);
				UploadFiles::saveAnexos($_FILES['informeTutor'],$ruta);
				UploadFiles::saveAnexos($_FILES['calificaciones'],$ruta);
			}
		
		if($idSolicitud!=0){
			echo '
				<script>
					//alert("hello");
					document.getElementById("recargar").innerHTML = true;
					document.getElementById("url").innerHTML = "../docentes/Informacion2.php";
					document.getElementById("name").innerHTML = "***";
					document.getElementById("msg").innerHTML = "La solicitud se cre&oacute; exitosamente";
					document.getElementById("myModal").style.display="block";
					
					//window.location.href = "../../index.php";
				</script>		
			';
			$mensaje .= "<p style='color:black'>Señor(a) profesor(a) se le informa que su solicitud para prórroga de la comisión de estudios ha sido registrada de manera exitosa y se encuentra pendiente de ser analizada por el comité de desarrollo del personal docente quien emitirá su concepto.</p>";
			$mensaje.="</body></html>";
			
			$mensajeUnidad .= "<p style='color:black'>".$facultad->getSaludo()." ".$facultad->getTituloDecano().", </p><p style='color:black'>Se le informa que el profesor(a) ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2()." realizo una solicitud de prórroga a una comisión de estudios, la cual se encuentra a la espera de ser analizada por el consejo de su unidad académica, por lo tanto le solicitamos de manera acomedida emitir su concepto a esta solicitud en el sitio <a href='avido.udea.edu.co/dedo'>Codedo</a>.";
			$mensajeUnidad.="</body></html>";
			
			Mail::enviar($asunto,$mensaje,$email); //Se envia correo al profesor
			Mail::enviar($asuntoUnidad,$mensajeUnidad,$emaiUnidad); //Se envia correo a la unidad
			//Enviar Mensaje
		}
		
			
		}
		if(isset($_POST["guardarOtros"])){
			//var_dump($_POST);
			//throw new Exception();
			$tipo = $_POST["tipo"];
			$comision = $_POST["comisiones"];
			$fechaInicio = $_POST["fechaInicio"];
			$fechaTerminacion = $_POST["fechaTerminacion"];
			$observaciones = html_entity_decode($_POST["observaciones"]);
			
			$solicitudRelacionada=new SolicitudDTO();
			$solicitudRelacionada->setComisionId($comision);
			if($solicitudRelacionada->findId())
				$solicitudRelacionada=$solicitudRelacionada->find($solicitudRelacionada->findId());
			
			$solicitud=new SolicitudDTO();
			$solicitud->setDocenteId($session->getVal("usuario_id"));
			//$solicitud->setActaId(-1);
			$solicitud->setEstadoId(1);
			$solicitud->setTiposolicitudId($tipo);
			/*
			if($_POST["tiposSolicitudes"]==8||$_POST["tiposSolicitudes"]==9){
				$solicitud->setRespuestaId(1);
			}else{
				$solicitud->setRespuestaId(3);
			}
			*/
			  $solicitud->setEstadoId(1);
			$solicitud->setComisionId($comision);
			$solicitud->setMotivoId($solicitudRelacionada->getMotivoId());
			$solicitud->setDedicacionId($solicitudRelacionada->getDedicacionId());
			$solicitud->setPaisId($solicitudRelacionada->getPaisId());
			$solicitud->setFacultadId($solicitudRelacionada->getFacultadId());
			$motivo = $solicitudRelacionada->getMotivoId();
			if($motivo == 1 || $motivo == 2 || $motivo == 3 || $motivo == 4 || $motivo == 6 || $motivo == 12 || $motivo == 14 || $motivo == 98 ){
				$solicitud->setTipoComisionId(1);
			}else{
				$solicitud->setTipoComisionId(2);
			}
			$solicitud->setObjetivo($solicitudRelacionada->getObjetivo());
			$solicitud->setLugar($solicitudRelacionada->getLugar());
			$solicitud->setFecha1($fechaInicio);
			$solicitud->setFecha2($fechaTerminacion);
			//$solicitud->setNumeroActaCF($actaCF);
			//$solicitud->setFechaActaCF($fechaActaCF);
			$solicitud->setAvalCF("0");
			$solicitud->setSolicitudProfesor("0");
			$solicitud->setCartaAceptacion("0");
			$solicitud->setInformeEstudiante(1);
			$solicitud->setInformeTutor(1);
			$solicitud->setCalificaciones("0");
			$solicitud->setObservaciones($observaciones);
			$solicitud->setVotada("0");
			$solicitud->setRespuestaId("0");
			$solicitud->setActaId(-1);
			//$idSolicitud=$solicitud->save();
			$idSolicitud=$solicitud->save2();
			//echo $idSolicitud;
			//throw new Exception();
			
			$ruta = '../../../anexos/'.$idSolicitud;
			if(!file_exists($ruta)) mkdir($ruta, 0777, true);
			//echo $ruta;
			
			if(isset($idSolicitud)){
				UploadFiles::saveAnexos($_FILES['informeActividades'],$ruta);
				UploadFiles::saveAnexos($_FILES['informeTutor'],$ruta);
				UploadFiles::saveAnexos($_FILES['informeEstudiante'],$ruta);
				UploadFiles::saveAnexos($_FILES['justificacionArgumentada'],$ruta);

			}
		
			if($idSolicitud!=0){
				echo '
					<script>
						//alert("hello");
						document.getElementById("recargar").innerHTML = true;
						document.getElementById("url").innerHTML = "../docentes/Informacion2.php";
						document.getElementById("name").innerHTML = "***";
						document.getElementById("msg").innerHTML = "La solicitud se cre&oacute; exitosamente";
						document.getElementById("myModal").style.display="block";
						
						//window.location.href = "../../index.php";
					</script>		
				';
				switch($tipo){
					case 10;
						//Prorroga excepcional
						$mensaje .= "<p style='color:black'>Señor(a) profesor(a) se le informa que su solicitud para prórroga excepcional de la comisión de estudios ha sido registrada de manera exitosa y se encuentra pendiente de ser analizada por el comité de desarrollo del personal docente quien emitirá su concepto.</p>";
						$mensajeUnidad .= "<p style='color:black'>".$facultad->getSaludo()." ".$facultad->getTituloDecano().", </p><p style='color:black'>Se le informa que el profesor(a) ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2()." realizo una solicitud de prórroga excepcional a una comisión de estudios, la cual se encuentra a la espera de ser analizada por el consejo de su unidad académica, por lo tanto le solicitamos de manera acomedida emitir su concepto a esta solicitud en el sitio <a href='avido.udea.edu.co/dedo'>Codedo</a>.</p>";
						break;
					case 5;
						//cancelacion
						$mensaje .= "<p style='color:black'>Señor(a) profesor(a) se le informa que su solicitud para cancelación de la comisión de estudios ha sido registrada de manera exitosa y se encuentra pendiente de ser analizada por el comité de desarrollo del personal docente quien emitirá su concepto.</p>";
						$mensajeUnidad .= "<p style='color:black'>".$facultad->getSaludo()." ".$facultad->getTituloDecano().", </p><p style='color:black'>Se le informa que el profesor(a) ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2()." realizo una solicitud de cancelación a una comisión de estudios, la cual se encuentra a la espera de ser analizada por el consejo de su unidad académica, por lo tanto le solicitamos de manera acomedida emitir su concepto a esta solicitud en el sitio <a href='avido.udea.edu.co/dedo'>Codedo</a>.</p>";

						break;
					case 6;
						//renuncia
						$mensaje .= "<p style='color:black'>Señor(a) profesor(a) se le informa que su solicitud de renuncia de la comisión de estudios ha sido registrada de manera exitosa y se encuentra pendiente de ser analizada por el comité de desarrollo del personal docente quien emitirá su concepto.</p>";
						$mensajeUnidad .= "<p style='color:black'>".$facultad->getSaludo()." ".$facultad->getTituloDecano().", </p><p style='color:black'>Se le informa que el profesor(a) ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2()." realizo una solicitud de renuncia a una comisión de estudios, la cual se encuentra a la espera de ser analizada por el consejo de su unidad académica, por lo tanto le solicitamos de manera acomedida emitir su concepto a esta solicitud en el sitio <a href='avido.udea.edu.co/dedo'>Codedo</a>.</p>";

						break;
					case 7;
						//suspension
						$mensaje .= "<p style='color:black'>Señor(a) profesor(a) se le informa que su solicitud para suspensión de la comisión de estudios ha sido registrada de manera exitosa y se encuentra pendiente de ser analizada por el comité de desarrollo del personal docente quien emitirá su concepto.</p>";
						$mensajeUnidad .= "<p style='color:black'>".$facultad->getSaludo()." ".$facultad->getTituloDecano().", </p><p style='color:black'>Se le informa que el profesor(a) ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2()." realizo una solicitud de suspensión a una comisión de estudios, la cual se encuentra a la espera de ser analizada por el consejo de su unidad académica, por lo tanto le solicitamos de manera acomedida emitir su concepto a esta solicitud en el sitio <a href='avido.udea.edu.co/dedo'>Codedo</a>.</p>";

						break;
					case 8;
						//reintegro anticipado con grado
						$mensaje .= "<p style='color:black'>Señor(a) profesor(a) se le informa que su solicitud para reintegro anticipado con grado de la comisión de estudios ha sido registrada de manera exitosa y se encuentra pendiente de ser analizada por el comité de desarrollo del personal docente quien emitirá su concepto.</p>";
						$mensajeUnidad .= "<p style='color:black'>".$facultad->getSaludo()." ".$facultad->getTituloDecano().", </p><p style='color:black'>Se le informa que el profesor(a) ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2()." realizo una solicitud de reintegro anticipado con grado a una comisión de estudios, la cual se encuentra a la espera de ser analizada por el consejo de su unidad académica, por lo tanto le solicitamos de manera acomedida emitir su concepto a esta solicitud en el sitio <a href='avido.udea.edu.co/dedo'>Codedo</a>.</p>";

						break;
					case 9;
						//reintegro anticipado sin grado
						$mensaje .= "<p style='color:black'>Señor(a) profesor(a) se le informa que su solicitud para reintegro anticipado sin grado de la comisión de estudios ha sido registrada de manera exitosa y se encuentra pendiente de ser analizada por el comité de desarrollo del personal docente quien emitirá su concepto.</p>";
						$mensajeUnidad .= "<p style='color:black'>".$facultad->getSaludo()." ".$facultad->getTituloDecano().", </p><p style='color:black'>Se le informa que el profesor(a) ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2()." realizo una solicitud de reintegro anticipado sin grado a una comisión de estudios, la cual se encuentra a la espera de ser analizada por el consejo de su unidad académica, por lo tanto le solicitamos de manera acomedida emitir su concepto a esta solicitud en el sitio <a href='avido.udea.edu.co/dedo'>Codedo</a>. </p>";
						break;
					case 12;
						//reintegro sin grados
						$mensaje .= "<p style='color:black'>Señor(a) profesor(a) se le informa que su solicitud para reintegro sin grados de la comisión de estudios ha sido registrada de manera exitosa y se encuentra pendiente de ser analizada por el comité de desarrollo del personal docente quien emitirá su concepto.</p>";
						$mensajeUnidad .= "<p style='color:black'>".$facultad->getSaludo()." ".$facultad->getTituloDecano().", </p><p style='color:black'>Se le informa que el profesor(a) ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2()." realizo una solicitud de reintegro sin grados a una comisión de estudios, la cual se encuentra a la espera de ser analizada por el consejo de su unidad académica, por lo tanto le solicitamos de manera acomedida emitir su concepto a esta solicitud en el sitio <a href='avido.udea.edu.co/dedo'>Codedo</a>.</p>";

						break;
				}
				$mensaje.="</body></html>";
				$mensajeUnidad.="</body></html>";
				Mail::enviar($asunto,$mensaje,$email); //Se envia correo al profesor
				Mail::enviar($asuntoUnidad,$mensajeUnidad,$emaiUnidad); //Se envia correo a la unidad
				//Enviar Mensaje
			}
		}
		if(isset($_POST["guardarModificacion"])){
			//echo "modificacion";
			//var_dump($_POST);
			$comision = html_entity_decode($_POST["comisiones"]);
			$motivo = html_entity_decode($_POST["motivos"]);
			$dedicacion = html_entity_decode($_POST["dedicaciones"]);
			$objetivo = html_entity_decode($_POST["Objetivo"]);
			$lugar = html_entity_decode($_POST["Lugar"]);
			$pais = html_entity_decode($_POST["paises"]);
			$fechaInicio = $_POST["fechaInicio"];
			$fechaTerminacion = $_POST["fechaTerminacion"];
			$observaciones = html_entity_decode($_POST["observaciones"]);
			
			//echo $dedicacion."</br>";
			$docente=new DocenteDTO();
			$docente=$docente->find($session->getVal("usuario_id"));
			
			$solicitud=new SolicitudDTO();
			$solicitud->setDocenteId($session->getVal("usuario_id"));
			//$solicitud->setActaId(-1);
			$solicitud->setEstadoId(1);
			$solicitud->setTiposolicitudId(2);
			$solicitud->setRespuestaId("0");
			$solicitud->setComisionId($comision);
			$solicitud->setMotivoId($motivo);
			$solicitud->setDedicacionId($dedicacion);
			$solicitud->setPaisId($pais);
			$solicitud->setFacultadId($docente->getFacultadId());
			if($motivo == 1 || $motivo == 2 || $motivo == 3 || $motivo == 4 || $motivo == 6 || $motivo == 12 || $motivo == 14 || $motivo == 98 ){
				$solicitud->setTipoComisionId(1);
			}else{
				$solicitud->setTipoComisionId(2);
			}
			$solicitud->setObjetivo($objetivo);
			$solicitud->setLugar($lugar);
			$solicitud->setFecha1($fechaInicio);
			$solicitud->setFecha2($fechaTerminacion);
			//$solicitud->setNumeroActaCF($actaCF);
			//$solicitud->setFechaActaCF($fechaActaCF);
			$solicitud->setAvalCF("0");
			$solicitud->setSolicitudProfesor("0");
			$solicitud->setCartaAceptacion("0");
			$solicitud->setInformeEstudiante("0");
			$solicitud->setInformeTutor("0");
			$solicitud->setCalificaciones("0");
			//$solicitud->setComentarios($_POST["comentarios"]);
			$solicitud->setObservaciones($observaciones);
			$solicitud->setVotada("0");
			$solicitud->setEstadoId(1);
			$solicitud->setActaId(-1);
			//$idSolicitud=$solicitud->save();
			
			$idSolicitud = $solicitud->save2();
			
			$ruta = '../../../anexos/'.$idSolicitud;
				//echo $solicitud->getId();
				//echo $ruta;
			if(!file_exists($ruta)) mkdir($ruta, 0777, true);;
			if(isset($idSolicitud)){
				UploadFiles::saveAnexos($_FILES['motivacion'],$ruta);
			}
		
			if($idSolicitud!=0){
				echo '
					<script>
						//alert("hello");
						document.getElementById("recargar").innerHTML = true;
						document.getElementById("url").innerHTML = "../docentes/Informacion2.php";
						document.getElementById("name").innerHTML = "***";
						document.getElementById("msg").innerHTML = "La solicitud se cre&oacute; exitosamente";
						document.getElementById("myModal").style.display="block";
						
						//window.location.href = "../../index.php";
					</script>		
				';
				$mensaje .= "<p style='color:black'>Señor(a) profesor(a) se le informa que su solicitud para modificación la comisión de estudios ha sido registrada de manera exitosa y se encuentra pendiente de ser analizada por el comité de desarrollo del personal docente quien emitirá su concepto.</p>";
				$mensajeUnidad .= "<p style='color:black'>".$facultad->getSaludo()." ".$facultad->getTituloDecano().", </p><p style='color:black'>Se le informa que el profesor(a) ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2()." realizo una solicitud de modificación a una comisión de estudios, la cual se encuentra a la espera de ser analizada por el consejo de su unidad académica, por lo tanto le solicitamos de manera acomedida emitir su concepto a esta solicitud en el sitio <a href='avido.udea.edu.co/dedo'>Codedo</a>.</p>";
				
				$mensaje.="</body></html>";
				$mensajeUnidad.="</body></html>";
				Mail::enviar($asunto,$mensaje,$email); //Se envia correo al profesor
				Mail::enviar($asuntoUnidad,$mensajeUnidad,$emaiUnidad); //Se envia correo a la unidad
				//Enviar Mensaje
			}
			
		}
		if(isset($_POST["guardarInforme"])){
			//echo "informe";
			$comisiones = $_POST["comisiones"];
			//echo $comision;
			$fechaInicio = $_POST["fechaInicio"];
			$fechaTerminacion = $_POST["fechaTerminacion"];
			$Detalle = html_entity_decode($_POST["detalleInforme"]);
			$fechaReingreso = $_POST["fechaReingreso"];
			$obtuvoTitulo = $_POST["obtuvoTitulo"];
			$observaciones = html_entity_decode($_POST["observaciones"]);
			//var_dump($_POST);
			$solicitudRelacionada=new SolicitudDTO();
			$solicitudRelacionada->setComisionId($comisiones);
			if($solicitudRelacionada->findId())
				$solicitudRelacionada=$solicitudRelacionada->find($solicitudRelacionada->findId());
			
			
			$docente=new DocenteDTO();
			$docente=$docente->find($session->getVal("usuario_id"));
		
			$comision=new ComisionDTO();
			//$idComision = $_POST["comisiones"];
			$comision=$comision->find($_POST["comisiones"]);
			
			$solicitud=new SolicitudDTO();
			$solicitud->setDocenteId($session->getVal("usuario_id"));
			//$solicitud->setActaId(-1);
			$solicitud->setEstadoId(1);
			$solicitud->setTiposolicitudId(4);
			$solicitud->setRespuestaId("0");
			$solicitud->setComisionId($comisiones);
			$solicitud->setMotivoId($solicitudRelacionada->getMotivoId());
			$solicitud->setDedicacionId($comision->getDedicacionId());
			$solicitud->setPaisId($comision->getPaisId());
			$solicitud->setFacultadId($docente->getFacultadId());
			$solicitud->setTipoComisionId($comision->getTipoComisionId());
			$solicitud->setFechaReingreso($fechaReingreso);
			$solicitud->setObjetivo($comision->getObjetivo());
			$solicitud->setLugar($comision->getLugar());
			$solicitud->setFecha1($fechaInicio);
			$solicitud->setFecha2($fechaTerminacion);
			//$solicitud->setNumeroActaCF($actaCF);
			//$solicitud->setFechaActaCF($_POST['fechaActaCF']);
			$solicitud->setAvalCF("0");
			$solicitud->setSolicitudProfesor("0");
			$solicitud->setCartaAceptacion("0");
			$solicitud->setInformeEstudiante(1);
			$solicitud->setInformeTutor(1);
			$solicitud->setCalificaciones(1);
			if($_POST["obtuvoTitulo"]=="on") $solicitud->setObtuvoTitulo(1);
			else $solicitud->setObtuvoTitulo(0);
			
			
			$solicitud->setObservaciones($observaciones);
			$solicitud->setInforme($Detalle);
			//$idSolicitud=$solicitud->save();
			$solicitud->setVotada("0");
			$solicitud->setEstadoId(1);
			$solicitud->setActaId(-1);
			$idSolicitud = $solicitud->save2();
			$ruta = '../../../anexos/'.$idSolicitud;
			//echo $ruta;
			if(!file_exists($ruta)) mkdir($ruta, 0777, true);
			if(isset($idSolicitud)){
				UploadFiles::saveAnexos($_FILES['informeEstudiante'],$ruta);
				UploadFiles::saveAnexos($_FILES['informeTutor'],$ruta);
				UploadFiles::saveAnexos($_FILES['calificaciones'],$ruta);
				
			}
		
			if($idSolicitud!=0){
				echo '
					<script>
						//alert("hello");
						document.getElementById("recargar").innerHTML = true;
						document.getElementById("url").innerHTML = "../docentes/Informacion2.php";
						document.getElementById("name").innerHTML = "***";
						document.getElementById("msg").innerHTML = "La solicitud se cre&oacute; exitosamente";
						document.getElementById("myModal").style.display="block";
						
						//window.location.href = "../../index.php";
					</script>		
				';
				
				//Modificar los mensajes
				$mensaje .= "<p style='color:black'>Señor(a) profesor(a) se le informa que su solicitud para informe de la comisión de estudios ha sido registrada de manera exitosa y se encuentra pendiente de ser analizada por el comité de desarrollo del personal docente quien emitirá su concepto.</p>";
				$mensajeUnidad .= "<p style='color:black'>".$facultad->getSaludo()." ".$facultad->getTituloDecano().", </p><p style='color:black'>Se le informa que el profesor(a) ".$docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2()." realizó una solicitud de informe a una comisión de estudios, la cual se encuentra a la espera de ser analizada por el consejo de su unidad académica, por lo tanto le solicitamos de manera acomedida emitir su concepto a esta solicitud en el sitio <a href='avido.udea.edu.co/dedo'>Codedo</a>.</p>";

				$mensaje.="</body></html>";
				$mensajeUnidad.="</body></html>";
				Mail::enviar($asunto,$mensaje,$email); //Se envia correo al profesor
				Mail::enviar($asuntoUnidad,$mensajeUnidad,$emaiUnidad); //Se envia correo a la unidad
				//Enviar Correo
			}
		}
?>