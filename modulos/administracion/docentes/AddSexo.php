<?php
	require_once('../../../modelo/clasesDTO.php');
	require_once('../../login/Session.php');
	$session = Session::getInstance();
	
	$cedula= $session->getVal("usuario_id");
	
	if(isset($_POST['sex']) && isset($cedula) && isset($_POST['categoria']) && isset($_POST['dedicacion']) && isset($_POST['fecha'])){
		
		$sexo = $_POST['sex'];
		$categoria_id = $_POST['categoria'];
		$dedicacion_id= $_POST['dedicacion'];
		$fecha= $_POST['fecha'];
		
		$docente = new DocenteDTO();
		$docente=$docente->find($cedula);
		$docente->setSexo($sexo);
		$docente->setCategoriaId($categoria_id);
		$docente->setDedicacionId($dedicacion_id);
		$docente->setFechaVinculacion($fecha);
		$docente->update();
		echo '<script>location.href="./Informacion2.php"</script>';
	}
?>