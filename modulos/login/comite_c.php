<?php  
require_once('../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
require_once($path['modelo'].'clasesDTO.php');
require_once('Session.php');

$session = Session::getInstance();
if( isset($_POST["ingresar"]))
{
$cedula=$_POST["cedula"];
$clave=$_POST["clave"];
$rol="comite";
$usuario = new UsuarioDTO();
$usuario->setCedula($cedula);
$usuario->setRol($rol);
$id =$usuario->findId();

if($id>0)
{
$usuario=$usuario->find($id);
	if($usuario->getClave()==$clave)
	{
	$session->setVal("usuario_id",$id);
	$session->setVal("rol","comite");
	$session->setVal("ultimoAcceso",date("Y-n-j H:i:s"));
	echo '<script>location.href="../marcos/marco_comite.php"</script>';
	}
	else{echo "Acceso denegado";}
}
else{echo "Acceso denegado";}
}

?>