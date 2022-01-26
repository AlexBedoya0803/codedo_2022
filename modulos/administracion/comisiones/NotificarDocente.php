<?php
	require_once('../../login/Session.php');
	require_once('../../../configuracion/path.php');
	require_once('../../mail/Mail.php');
	require_once('../resoluciones/FormatoFecha.php');
	$path=asignarPath(dirname(__FILE__));
	require_once($path['modelo'].'clasesDTO.php');
	$session = Session::getInstance();
	//echo "prueba";
	//echo  $_GET['id'];
	if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
		echo '<script>location.href="../../login/login-Copia.php";</script>';
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		//echo "++" .$id;
		$comision = new ComisionDTO();
		$comision = $comision->find($id);
		$docente = new DocenteDTO();
		$docente = $docente->find($comision->getDocenteId());
		$email = $docente->getCorreo();
		//echo $email;
		
		
		$nombreDocente = $docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2();
		$motivo = $comision->getMotivo()->getMotivo();
		$fechaVencimiento = $comision->getFechaf();
		$fecha = FormatoFecha::convertir($fechaVencimiento);
		
		
		
		
		//throw new Exception();
		//echo $email;
		$asunto = "notificacion";
		$mensaje='
					<h1 style="color:#0A351C">Sistema del Comité de Desarrollo del Personal Docente</h1>
					</br>
					<hr width="100%" aling="center" /
					</br>';
		
		$mensaje.="<p style='color:black'>Profesor(a) $nombreDocente se le informa que su comisión de estudios para realizar $motivo se vencerá el $fecha, por favor tramitar la prórroga de la misma en su Unidad Académica.</p>";
		$mensaje.="<p style='color:black'>Muchas gracias por su atención.<p/>";
		
		$comision->setFechaNotificacion(date("Y-m-d"));
		$comision->update2();
		
		Mail::enviar($asunto,$mensaje,$email);
		echo '<script>location.href="./lista.php"</script>';
		//var_dump($comision);
			
	}
?>