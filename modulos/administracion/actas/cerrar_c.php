<?php
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
//require_once('../../../modelo/validarMARES/validarUsuario.php');
require_once('../../../modelo/criteria.php');
$numero = count($_GET);
if($numero) {

	$id = $_GET['id'];
	$acta = new ActaDTO();
	$acta=$acta->find($id);
	$sw_cierre = 1;
	if( isset($_POST["cerrar"])) {

		$criteria = new Criteria("solicitudes");
		$criteria->addFiltro("acta_id","=",$id);
		$solicitudes = $criteria->execute();
		//var_dump($solicitudes);
		//throw new Exception();

		foreach($solicitudes as $solicitud){

			//throw new Exception();
			//echo "**".$solicitud->getEstadoId();
			//throw new Exception();
			if($solicitud->getEstadoId()==3){
				//echo "entroEstado";

				//throw new Exception();
				/* valida que la solicitud sea nueva*/
				if($solicitud->getTipoSolicitudId()==1) {
					/*valida que la respuesta sea afirmativa*/
					//echo "nueva solicitud</br>";
					if($solicitud->getRespuestaId()==1) {
						/*se crea una nueva comision*/
						//echo "respuesta afirmativa </br>";
						$comision=new ComisionDTO();
						$comision->setId($solicitud->getId());
						$comision->setMotivoId($solicitud->getMotivoId());
						$comision->setDedicacionId($solicitud->getDedicacionId());
						$comision->setDocenteId($solicitud->getDocenteId());
						$comision->setLugar($solicitud->getLugar());
						$comision->setObjetivo($solicitud->getObjetivo());
						$comision->setObservaciones($solicitud->getObservaciones());
						$comision->setFecha1($solicitud->getFecha1());
						$comision->setFecha2($solicitud->getFecha2());
						$comision->setFechaf($solicitud->getFecha2());
						$comision->setPaisId($solicitud->getPaisId());
						$comision->setTipoComisionId($solicitud->getTipoComisionId());
						$comision->setActaId($solicitud->getActaId());
						$comision->setFacultadId($solicitud->getFacultadId());
						$comision->setEstadoId($solicitud->getEstadoId());
						$comision->save();
						/*actualizamos la solicitud*/
						$solicitud->setEstadoId(3);
						$solicitud->setComisionId($comision->getId());
						$solicitud->update();

					}elseif($solicitud->getRespuestaId()==2){
						$solicitud->setEstadoId(4);
						$solicitud->update();
					}else{
						$sw_cierre = 0;
					}
				}

				/* valida que la solicitud sea prorroga*/
				elseif($solicitud->getTiposolicitudId()==3) {
					//echo "entro por aqui</br>";
					//throw new Exception();
					if($solicitud->getRespuestaId()==1) {
						//echo "solicitudNueva </br>";
						/*se crea una nueva prorroga*/
						$prorroga=new ProrrogaDTO();
						$prorroga->setDedicacionId($solicitud->getDedicacionId());
						$prorroga->setFecha1($solicitud->getFecha1());
						$prorroga->setFecha2($solicitud->getFecha2());
						$prorroga->setComisionId($solicitud->getComisionId());
						$prorroga->setActaId($solicitud->getActaId());
						$prorroga->setFacultadId($solicitud->getFacultadId());
						$prorroga->save();
						/*se actualiza la comision*/
						$id=$prorroga->getComisionId();
						$comision=$prorroga->getComision();
						$comision->setFechaf($solicitud->getFecha2());
						$comision->update();
						/*se actualiza la solicitud*/
						$solicitud->setEstadoId(3);
						$solicitud->setComisionId($comision->getId());
						$solicitud->update();
					}elseif($solicitud->getRespuestaId()==2){
						$id=$solicitud->getId();
						$solicitud->setEstadoId(4);
						$solicitud->update();
					}else{
						$sw_cierre = 0;
					}
				}

				/* valida que la solicitud sea modificacion*/
				elseif($solicitud->getTiposolicitudId()==2){
					if($solicitud->getRespuestaId()==1) {
						/*se crea una nueva modificacion*/
						$modificacion=new ModificacionDTO();
						$modificacion->setMotivoId($solicitud->getMotivoId());
						$modificacion->setDedicacionId($solicitud->getDedicacionId());
						$modificacion->setLugar($solicitud->getLugar());
						$modificacion->setObjetivo($solicitud->getObjetivo());
						$modificacion->setFecha1($solicitud->getFecha1());
						$modificacion->setFecha2($solicitud->getFecha2());
						$modificacion->setPaisId($solicitud->getPaisId());
						$modificacion->setComisionId($solicitud->getComisionId());
						$modificacion->setActaId($solicitud->getActaId());
						$modificacion->setFacultadId($solicitud->getfacultadId());
						$modificacion->setTipoComisionId($solicitud->getTipoComisionId());
						$modificacion->save();
						/*se actualiza la comision*/
						$id=$modificacion->getComisionId();
						$comision=$modificacion->getComision();
						$comision->setMotivoId($solicitud->getMotivoId());
						$comision->setDedicacionId($solicitud->getDedicacionId());
						$comision->setDocenteId($solicitud->getDocenteId());
						$comision->setLugar($solicitud->getLugar());
						$comision->setObjetivo($solicitud->getObjetivo());
						$comision->setObservaciones($solicitud->getObservaciones());
						$comision->setFecha1($solicitud->getFecha1());
						$comision->setFecha2($solicitud->getFecha2());
						$comision->setPaisId($solicitud->getPaisId());
						$comision->setFacultadId($solicitud->getfacultadId());
						$comision->update();
						/*se actualiza la solicitud*/
						$id=$solicitud->getId();
						$solicitud->setEstadoId(3);
						$solicitud->setRespuestaId(1);
						$solicitud->setComisionId($comision->getId());
						$solicitud->update();
					}elseif($solicitud->getRespuestaId()==2){
						$id=$solicitud->getId();
						$solicitud->setEstadoId(4);
						$solicitud->setRespuestaId(1);
						$solicitud->update();
					}else{
						$sw_cierre = 0;
					}
				}else{
						//echo "entro 7</br>";
					//throw new Exception();
					if($solicitud->getRespuestaId()==1) {
						//echo "respuesta afirmativa </br>";
						/*se crea un nueva informe*/
						$informe=new InformeDTO();
						$informe->setActaId($solicitud->getActaId());
						$informe->setComisionId($solicitud->getComisionId());
						$informe->setActaCF($solicitud->getNumeroActaCF());
						$informe->setAvalCF($solicitud->getAvalCF());
						$informe->setObtuvoTitulo($solicitud->getObtuvoTitulo() );
						$informe->setInformeEstudiante($solicitud->getInformeEstudiante());
						$informe->setInformeTutor($solicitud->getInformeTutor());
						$informe->setCalificaciones($solicitud->getCalificaciones());
						$informe->setInforme($solicitud->getInforme());
						$informe->setFechaReingreso($solicitud->getFechaReingreso());
						$informe->setFecha($solicitud->getFecha1());
						//var_dump($informe);
						$informe->save();
						/*se actuliza la solicitud*/
						$id=$solicitud->getId();
						$solicitud->setEstadoId(3);
						$solicitud->update();

					}elseif($solicitud->getRespuestaId()==2){
						$id=$solicitud->getId();
						$solicitud->setEstadoId(4);
						$solicitud->update();
					}else{
						$sw_cierre = 0;
					}
				}
			}else{
				//echo "no entro ".$solicitud->getEstadoId()."</br>";
			}
		}

		echo $sw_cierre;
		if($sw_cierre){
			$acta->setAbierta(0);
		}
		$acta->update();
		
		/*echo "<script>location.href=\"lista.php\"</script>";*/

	}
}

?>
