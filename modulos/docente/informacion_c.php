<?php
session_start();
require_once('../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
require_once($path['modelo'].'validarMARES/validarUsuario.php');

$existe=0;
$id=0;
$nueva="";
$prorroga="";
$modificacion="";
$formulario=array('nombre'=>"",'apellido'=>"",'cedula'=>"",'correo'=>"",'facultad'=>"",'centro'=>"");


$wsClienteMares = new WSClientInfoMares();
$usuario = $wsClienteMares->datosUsuario($_SESSION["cedula"]);
if($usuario->EsDocente()==1) {	

	$facultad=new FacultadDTO(); 
    $facultad->find($usuario->Facultad());
    $formulario['bcedula']=$_SESSION["cedula"];  
	$formulario['nombre']=$usuario->Nombres();
	$formulario['apellido']=$usuario->Apellidos();
	$formulario['cedula']=$_SESSION["cedula"];
	$formulario['correo']=$usuario->Correo();
	$formulario['facultad']=$facultad->getNombre();
	$formulario['centro']=$usuario->CentroCosto();
	$error="";
	$docente=new DocenteDTO();
	$docente->setCedula($_SESSION["cedula"]);
	$id=$docente->findId();
	if(!($id)) {
		$docente->setCedula($formulario['cedula']);
		$docente->setNombre($formulario['nombre']);
		$docente->setApellido1($formulario['apellido']);
		$docente->setApellido2($formulario['apellido']);
		$docente->setCorreo($formulario['correo']);
		$docente->setFacultadId($formulario['facultad']);
		$docente->setCosto($formulario['costo']);
		echo $docente->getCorreo()."*";
			//$docente->save();
	}
	$id=$docente->getId();
	//$resume=$docente->resume($path['imagenes'],$path['upload'],20,20);
	$existe=1;
	$nueva='<a href="../administracion/comisiones/nueva.php?id='.$id.'">
		<img src="../../imagenes/acciones/nueva.jpg" width="30" height="30" border="0" />Nueva</a>';
	if($docente->getNumeroComisiones()>0) {
		$prorroga='<a href="../administracion/comisiones/prorroga.php?id='.$id.'">
			<img src="../../imagenes/acciones/prorroga.jpg" width="30" height="30" border="0" />Pr&oacute;rroga</a>';
		$modificacion='<a href="../administracion/comisiones/modificacion.php?id='.$id.'">
			<img src="../../imagenes/acciones/modificar.png" width="30" height="30" border="0" />Modificaci&oacute;n</a>';
	}
}
else {
	$error="No esta en mares";
	$existe=0;
	$nueva="";
	$prorroga="";
	$modificacion="";
}
?>