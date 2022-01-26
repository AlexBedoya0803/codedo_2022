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
require_once($path['modelo'].'udea_ws_lib/info_valida_ws.php');
require_once($path['modelo'].'validarMARES/validarUsuario.php');

$consulta = new Criteria("docentes");
$consulta->orderBy("apellido1","ASC");
$docentes=$consulta->execute();

$existe=0;
$id=0;
$nueva="";
$prorroga="";
$modificacion="";
$formulario=array('nombre'=>"",'apellido'=>"",'cedula'=>"",'correo'=>"",'facultad'=>"",'centro'=>"",'bnombres'=>"0");
 if(isset( $_POST['bcedula']))$cedula = $_POST["bcedula"];
$verificar=false;
//$variableparaimprimircorreo = $_POST["correo"];



if(isset($_POST["buscar"]) && $cedula) {
	
	
	// Para cuando se tenga la facultad
	/*$info = new info_valida_ws();
	$usuario = $info->datosUsuarios($cedula);
	
	//$wsClienteMares = new WSClientInfoMares();
	//$usuario = $wsClienteMares->datosUsuario($cedula);
	
		if($usuario->EsDocente()==1) {
		
		$formulario['bcedula']=$cedula;  
		$formulario['bnombres']=$_POST["bnombres"]; 
		$formulario['nombre']=$usuario->Nombres();
		$formulario['apellido']=$usuario->Apellidos();
		$formulario['cedula']=$_POST["bcedula"];
		$formulario['correo']=$usuario->Correo();

		var_dump($formulario);
		//$formulario['variableparaimprimircorreo']=$_POST["correo"];

		
		$facultad = new FacultadDTO;
		$facultad->find($usuario->Facultad());
		$formulario['facultad']=$facultad->getNombre();
		$formulario['costo']=$usuario->CentroCosto();*/
		$error="";
		$docente=new DocenteDTO();
		$docente->setCedula($cedula);
		$id=$docente->findId($cedula);
		
		if(isset($id)){
			$docente=$docente->find($cedula);
			$formulario['bcedula']=$cedula;  
			$formulario['bnombres']=$_POST["bnombres"]; 
			$formulario['nombre']=$docente->getNombre();
			$formulario['apellido']=$docente->getApellido1()." ". $docente->getApellido2();
			$formulario['cedula']=$_POST["bcedula"];
			$formulario['correo']=$docente->getCorreo();
			$formulario['facultad']=$docente->getFacultad()->getNombre();
			$formulario['costo']=$docente->getCCosto();
			$sexo = $docente->getSexo();
			$existe=1;
			$resumeold=$path['upload'].$docente->getCedula()."/resume.pdf";
			$imagen=$path['imagenes']."iconos/pdf.png ";
			if (file_exists($resumeold)){
				$resume = '<a href="'.$resumeold.'"> <img src="'.$imagen.'" width="20" height="20" border="0" /></a>';
			}
			}
		
		
		if(!($id) && $formulario['nombre']) {
			$docente->setCedula($formulario['cedula']);
			$docente->setNombre($formulario['nombre']);
			$apellidos = explode(' ', $formulario['apellido']);
			$docente->setApellido1($apellidos[0]);
			$docente->setApellido2($apellidos[1]);
			$docente->setCorreo($formulario['correo']);
			$docente->setFacultadId($facultad->getId());
			$docente->setCCosto($formulario['costo']);
			
			$docente->save();
			//var_dump($docente);
			//echo "guardo el docente";
			//throw new Exception();
		}
		$docente = $docente->find($docente->getId());
		$sexo = $docente->getSexo();
		$verificar=true;

		$resumeold=$path['upload'].$docente->getCedula()."/resume.pdf";
		$imagen=$path['imagenes']."iconos/pdf.png ";
		if (file_exists($resumeold)){
			$resume = '<a href="'.$resumeold.'"> <img src="'.$imagen.'" width="20" height="20" border="0" /></a>';
		}
		
		$nueva='<a href="../comisiones/nueva.php?id='.$id.'">
		<img src="../../../imagenes/acciones/nueva.jpg" width="30" height="30" border="0" />Nueva</a>';
		if($docente->getNumeroComisiones()>0) {
			$prorroga='<a href="../comisiones/prorroga.php?id='.$id.'">
			<img src="../../../imagenes/acciones/prorroga.jpg" width="30" height="30" border="0" />Pr&oacute;rroga</a>';
			$modificacion='<a href="../comisiones/modificacion.php?id='.$id.'">
			<img src="../../../imagenes/acciones/modificar.png" width="30" height="30" border="0" />Modificaci&oacute;n</a>';
			$otras='<a href="../comisiones/otras.php?id='.$id.'">
			<img src="../../../imagenes/acciones/prorroga.jpg" width="30" height="30" border="0" />Otras</a>';
			
			$informe='<a href="../comisiones/informe.php?id='.$id.'">
			<img src="../../../imagenes/acciones/prorroga.jpg" width="30" height="30" border="0" />Informe</a>';
			
		}
	}
	else {
		$error="No se encuentra en el sistema";
		$existe=0;
		$nueva="";
        $prorroga="";
        $modificacion="";
	}
	


?>