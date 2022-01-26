<?php
//session_start();
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
//require_once($path['modelo'].'validarMARES/validarUsuario.php');

$consulta = new Criteria("docentes");
$consulta->orderBy("apellido1","ASC");
$docentes=$consulta->execute();

$consulta = new Criteria("docentes");
$consulta->query = "SELECT * FROM docentes WHERE categoria_id=-1 or dedicacion_id=-1 or cCosto=0 or nCCosto='' ORDER BY apellido1 ASC";
$docentesInc=$consulta->executeDirect();

$consulta = new Criteria("facultades");
$facultades=$consulta->execute();

$consulta = new Criteria("categorias");
$consulta->orderBy("id","ASC");
$categorias=$consulta->execute();

$consulta = new Criteria("dedicaciones");
$dedicaciones=$consulta->execute();

$formulario=array('nombres'=>"",'apellido1'=>"",'apellido2'=>"",'facultad'=>"",'categoria'=>"",'dedicacion'=>"",'fechaVinculacion'=>"",'sexo'=>"",'ccosto'=>"",'nccosto'=>"",'correo'=>"");
$cedula = $_POST["bcedula"];
$docente = new DocenteDTO();
if(isset($_POST["buscar"]) && $cedula) {
	$docente->find($cedula);
	if(true) {	 //$usuario->EsDocente()==1 
		$formulario['bnombres']=$_POST["bnombres"]; 
		$formulario['cedula']=$docente->getCedula();
		$formulario['nombres']=$docente->getNombre();
		$formulario['apellido1']=$docente->getApellido1();
		$formulario['apellido2']=$docente->getApellido2();
		$formulario['facultad']=$docente->getFacultadId();
		$formulario['categoria']=$docente->getCategoriaId();
		$formulario['dedicacion']=$docente->getDedicacionId();
		$formulario['fechaVinculacion']=$docente->getFechaVinculacion();
		$formulario['sexo']=$docente->getSexo();
		$formulario['ccosto']=$docente->getCCosto();
		$formulario['nccosto']=$docente->getNCCosto();
		$formulario['correo']=$docente->getCorreo();
	}
	else {
		$error="No esta en la base de datos";
	}
}

if(isset($_POST['bModificarDocente_x'])) {
	if($_POST["cedulaOculta"]) {
		$docente->find($_POST["cedulaOculta"]);
		$docente->setNombre($_POST["nombres"]);
		$docente->setApellido1($_POST["apellido1"]);
		$docente->setApellido2($_POST["apellido2"]);
		$docente->setFacultadId($_POST["facultad"]);
		$docente->setCategoriaId($_POST["categoria"]);
		$docente->setDedicacionId($_POST["dedicacion"]);
		$docente->setFechaVinculacion($_POST["fechaVinculacion"]);
		$docente->setSexo($_POST["sexo"]);
		$docente->setCCosto($_POST["ccosto"]);
		$docente->setNCCosto($_POST["nccosto"]);
		$docente->setCorreo($_POST["correo"]);
		$docente->update();
	}
}

?>