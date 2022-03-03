<?php
//session_start();
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once('../../../'.$path['modelo'].'criteria.php');
//require_once($path['modelo'].'validarMARES/validarUsuario.php');

$consulta = new Criteria("docentes");
$consulta->orderBy("apellido1","ASC");
$docentes=$consulta->execute();

$existe=0;
$id=0;
$nueva="";
$prorroga="";
$modificacion="";
//$cedula = $_POST["bcedula"];
$verificar=false;
//$variableparaimprimircorreo = $_POST["correo"];

	//$wsClienteMares = new WSClientInfoMares();
	//$usuario = $wsClienteMares->datosUsuario($cedula);
	
	//var_dump($usuario);
	
	//if($usuario->EsDocente()==1) {
		$cedula=$session->getVal("usuario_id");
		$docente=new DocenteDTO();
		$docente->setCedula($cedula);
		$id=$docente->findId();
		$docente=$docente->find($id);	
		
		//echo "**".$docente->getCedula();
		//$formulario['variableparaimprimircorreo']=$_POST["correo"];
		
		$facultad = new FacultadDTO;
		$facultad->find($docente->getFacultadId());
		$error="";
		
		//$docente = $docente->find($docente->getId());
		$sexo = $docente->getSexo();
		$dedicacion = $docente->getDedicacionId();
		$categoria = $docente->getCategoriaId();
		$fecha= $docente->getFechaVinculacion();
		$verificar=TRUE;

		$resumeold=$path['upload'].$docente->getCedula()."/resume.pdf";
		$imagen=$path['imagenes']."iconos/pdf.png ";
		if (file_exists($resumeold)){
			$resume = '<a href="'.$resumeold.'"> <img src="'.$imagen.'" width="20" height="20" border="0" /></a>';
		}
		$existe=1;
		$nueva='<a href="../comisiones/nuevaDocente.php?id='.$id.'">
		<img src="../../../imagenes/acciones/nueva.jpg" width="30" height="30" border="0" />Nueva</a>';
		if($docente->getNumeroComisiones()>0) {
			$prorroga='<a href="../comisiones/prorrogaDocente.php?id='.$id.'">
			<img src="../../../imagenes/acciones/prorroga.jpg" width="30" height="30" border="0" />Pr&oacute;rroga</a>';
			$modificacion='<a href="../comisiones/modificacionDocente.php?id='.$id.'">
			<img src="../../../imagenes/acciones/modificar.png" width="30" height="30" border="0" />Modificaci&oacute;n</a>';
			$otras='<a href="../comisiones/otrasDocente.php?id='.$id.'">
			<img src="../../../imagenes/acciones/prorroga.jpg" width="30" height="30" border="0" />Otras</a>';
			
			$informe='<a href="../comisiones/informeDocente.php?id='.$id.'">
			<img src="../../../imagenes/acciones/prorroga.jpg" width="30" height="30" border="0" />Informe</a>';
			
		}
	
?>