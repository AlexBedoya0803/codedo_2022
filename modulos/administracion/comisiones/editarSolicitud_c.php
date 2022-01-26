<?php
	require_once('../../login/Session.php');
	$session = Session::getInstance();
	$idDocente=$session->getVal("usuario_id");
	if($idDocente=="" || $session->getVal("rol")!="docente") //si no hay ningun usuario registrado muestra la vista general
		echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
	require_once('../../../configuracion/path.php');
	$path=asignarPath(dirname(__FILE__));
	require_once($path['modelo'].'criteria.php');
	require_once($path['modelo'].'clasesDTO.php');
	require_once($path['modelo'].'procedimientos.php');
	require_once('UploadFiles.php');
	
	$idSolicitud= $_GET["id"];
	
	//Editar solicitud de nueva comisión.
	if(isset($_POST["guardarNueva"])){
		$solicitud = new SolicitudDTO();
		$solicitud = $solicitud->find($idSolicitud);
		if($session->getVal("rol")=="docente" && $solicitud->getDocenteId()== $idDocente){
			$motivo = $_POST["motivos"];
			$dedicacion = $_POST["dedicaciones"];
			$objetivo = html_entity_decode($_POST["Objetivo"]);
			$lugar = html_entity_decode($_POST["Lugar"]);
			$pais = $_POST["paises"];
			$fechaInicio = $_POST["fechaInicio"];
			$fechaTerminacion = $_POST["fechaTerminacion"];
			$comentarios= html_entity_decode($_POST["comentarios"]);
			
			$docente=new DocenteDTO();
			$docente=$docente->find($idDocente);
			
			$solicitud->setDocenteId($idDocente);
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
			$solicitud->setComentarios($comentarios);
			$solicitud->update2();
			$ruta = '../../../anexos/'.$idSolicitud;
				if(isset($idSolicitud)){
					if(!file_exists($ruta)) mkdir($ruta, 0777, true);
					if(isset($_FILES['cartaAceptacion'])){
						if (is_uploaded_file($_FILES['cartaAceptacion']['tmp_name'])) UploadFiles::saveAnexos($_FILES['cartaAceptacion'],$ruta);
						} 
					if(isset($_FILES['otros'])){
					 	if (is_uploaded_file($_FILES['otros']['tmp_name']))UploadFiles::saveAnexos($_FILES['otros'],$ruta);
					}
				}
			
			if($idSolicitud!=0){
				echo '
					<script>
						document.getElementById("recargar").innerHTML = true;
						document.getElementById("url").innerHTML = "../docentes/Informacion2.php";
						document.getElementById("name").innerHTML = "***";
						document.getElementById("msg").innerHTML = "La solicitud ha sido editada exitosamente";
						document.getElementById("myModal").style.display="block";
					</script>		
				';
			}	
		}else{
		echo '<script> alert("No tiene permiso")</script>';}
		
	}
	
	//Editar solicitud de prórroga.
	if(isset($_POST["guardarProrroga"])){
		$solicitud = new SolicitudDTO();
		$solicitud = $solicitud->find($idSolicitud);
		if($session->getVal("rol")=="docente" && $solicitud->getDocenteId()== $idDocente){
			
			$fechaInicio = $_POST["fechaInicio"];
			$fechaTerminacion = $_POST["fechaTerminacion"];
			$observaciones = html_entity_decode($_POST["observaciones"]);
				
			$solicitud->setFecha1($fechaInicio);
			$solicitud->setFecha2($fechaTerminacion);
			$solicitud->setObservaciones($observaciones);
			$solicitud->update2();
			$ruta = '../../../anexos/'.$idSolicitud;
			
			if(isset($idSolicitud)){
				if(!file_exists($ruta)) mkdir($ruta, 0777, true);
						if (is_uploaded_file($_FILES['cartaAceptacion']['tmp_name'])) UploadFiles::saveAnexos($_FILES['cartaAceptacion'],$ruta);
						if (is_uploaded_file($_FILES['informeActividades']['tmp_name'])) UploadFiles::saveAnexos($_FILES['informeActividades'],$ruta);
						if (is_uploaded_file($_FILES['informeTutor']['tmp_name'])) UploadFiles::saveAnexos($_FILES['informeTutor'],$ruta);
						if (is_uploaded_file($_FILES['calificaciones']['tmp_name'])) UploadFiles::saveAnexos($_FILES['calificaciones'],$ruta);
						} 
						
			}
		if($idSolicitud!=0){
			echo '
				<script>
					document.getElementById("recargar").innerHTML = true;
					document.getElementById("url").innerHTML = "../docentes/Informacion2.php";
					document.getElementById("name").innerHTML = "***";
					document.getElementById("msg").innerHTML = "La solicitud ha sido editada exitosamente";
					document.getElementById("myModal").style.display="block";
				</script>		
			';
		}
	}
	/**Editar solicitud de prórroga excepcional, Cancelación, Renuncia, Suspensión, Reintegro Anticipado Con Grados, 
		Reintegro Anticipado Sin Grados,Reintegro Sin Grados,Reintegro Con Grados.**/
	if(isset($_POST["guardarOtros"])){
		$solicitud = new SolicitudDTO();
		$solicitud = $solicitud->find($idSolicitud);
		if($session->getVal("rol")=="docente" && $solicitud->getDocenteId()== $idDocente){
			$fechaInicio = $_POST["fechaInicio"];
			$fechaTerminacion = $_POST["fechaTerminacion"];
			$observaciones = html_entity_decode($_POST["observaciones"]);
			
			$solicitud->setFecha1($fechaInicio);
			$solicitud->setFecha2($fechaTerminacion);
			$solicitud->setObservaciones($observaciones);
			$solicitud->update2();
			$ruta = '../../../anexos/'.$idSolicitud;
			
			if(isset($idSolicitud)){
				if(!file_exists($ruta)) mkdir($ruta, 0777, true);
				if (is_uploaded_file($_FILES['informeActividades']['tmp_name'])) UploadFiles::saveAnexos($_FILES['informeActividades'],$ruta);
				if (is_uploaded_file($_FILES['informeTutor']['tmp_name'])) UploadFiles::saveAnexos($_FILES['informeTutor'],$ruta);
				if (is_uploaded_file($_FILES['informeEstudiante']['tmp_name'])) UploadFiles::saveAnexos($_FILES['informeEstudiante'],$ruta);	
			}
						
		}
			if($idSolicitud!=0){
				echo '
					<script>
					document.getElementById("recargar").innerHTML = true;
					document.getElementById("url").innerHTML = "../docentes/Informacion2.php";
					document.getElementById("name").innerHTML = "***";
					document.getElementById("msg").innerHTML = "La solicitud ha sido editada exitosamente";
					document.getElementById("myModal").style.display="block";
				</script>		
				';
		}
	}
	//Editar solicitud de modificación
	if(isset($_POST["guardarModificacion"])){
		$solicitud = new SolicitudDTO();
		$solicitud = $solicitud->find($idSolicitud);
		if($session->getVal("rol")=="docente" && $solicitud->getDocenteId()== $idDocente){
			$motivo = $_POST["motivos"];
			$dedicacion = $_POST["dedicaciones"];
			$objetivo = html_entity_decode($_POST["Objetivo"]);
			$lugar = html_entity_decode($_POST["Lugar"]);
			$pais = $_POST["paises"];
			$fechaInicio = $_POST["fechaInicio"];
			$fechaTerminacion = $_POST["fechaTerminacion"];
			$observaciones = html_entity_decode($_POST["observaciones"]);
			
			$solicitud->setMotivoId($motivo);
			$solicitud->setDedicacionId($dedicacion);
			$solicitud->setObjetivo($objetivo);
			$solicitud->setLugar($lugar);
			$solicitud->setPaisId($pais);
			$solicitud->setFecha1($fechaInicio);
			$solicitud->setFecha2($fechaTerminacion);
			$solicitud->setObservaciones($observaciones);
			$solicitud->update2();
			$ruta = '../../../anexos/'.$idSolicitud;

			if(isset($idSolicitud)){
				if(!file_exists($ruta)) mkdir($ruta, 0777, true);
				if (is_uploaded_file($_FILES['motivacion']['tmp_name']))UploadFiles::saveAnexos($_FILES['motivacion'],$ruta);
			}
						
		}
			if($idSolicitud!=0){
				echo '
				<script>
					document.getElementById("recargar").innerHTML = true;
					document.getElementById("url").innerHTML = "../docentes/Informacion2.php";
					document.getElementById("name").innerHTML = "***";
					document.getElementById("msg").innerHTML = "La solicitud ha sido editada exitosamente";
					document.getElementById("myModal").style.display="block";
				</script>		
			';
		}
	}
	//Editar solicitud de Informe
	if(isset($_POST["guardarInforme"])){
		$solicitud = new SolicitudDTO();
		$solicitud = $solicitud->find($idSolicitud);
		if($session->getVal("rol")=="docente" && $solicitud->getDocenteId()== $idDocente){
			$fechaInicio = $_POST["fechaInicio"];
			$fechaTerminacion = $_POST["fechaTerminacion"];
			$Detalle = html_entity_decode($_POST["detalleInforme"]);
			$fechaReingreso = $_POST["fechaReingreso"];
			$obtuvoTitulo = $_POST["obtuvoTitulo"];
			$observaciones = html_entity_decode($_POST["observaciones"]);
			
			$solicitud->setFecha1($fechaInicio);
			$solicitud->setFecha2($fechaTerminacion);
			$solicitud->setInforme($Detalle);
			$solicitud->setFechaReingreso($fechaReingreso);
			if($_POST["obtuvoTitulo"]=="on") $solicitud->setObtuvoTitulo(1);
			else $solicitud->setObtuvoTitulo(0);
			$solicitud->setObservaciones($observaciones);
			$solicitud->update2();
			$ruta = '../../../anexos/'.$idSolicitud;

			if(isset($idSolicitud)){
				if(!file_exists($ruta)) mkdir($ruta, 0777, true);
				if (is_uploaded_file($_FILES['informeEstudiante']['tmp_name']))UploadFiles::saveAnexos($_FILES['informeEstudiante'],$ruta);
				if (is_uploaded_file($_FILES['informeTutor']['tmp_name']))UploadFiles::saveAnexos($_FILES['informeTutor'],$ruta);
				if (is_uploaded_file($_FILES['calificaciones']['tmp_name']))UploadFiles::saveAnexos($_FILES['calificaciones'],$ruta);
			}
						
		}
			if($idSolicitud!=0){
				echo '
				<script>
					document.getElementById("recargar").innerHTML = true;
					document.getElementById("url").innerHTML = "../docentes/Informacion2.php";
					document.getElementById("name").innerHTML = "***";
					document.getElementById("msg").innerHTML = "La solicitud ha sido editada exitosamente";
					document.getElementById("myModal").style.display="block";
				</script>		
			';
		}
			
	}
			
			
	
			

	

?>