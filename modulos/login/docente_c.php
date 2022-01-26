<?php  
session_start(); 
require_once('../../modelo/validarMARES/validarUsuario.php');
if( isset($_POST["ingresar"]))
{
$cedula=$_POST["cedula"];
$clave=$_POST["clave"];
//if(validateUser($cedula,$clave))
//{

$wsClienteMares = new WSClientInfoMares();
$usuario = $wsClienteMares->datosUsuario($_POST["cedula"]);	  

if($usuario->EsDocente()==1)
{
$_SESSION["cedula"]=$cedula;
$_SESSION["usuario"]="docente";
echo '<script>location.href="../marcos/marco_docente.php"</script>';
}
else
{
$error="No esta registrado ";
}


}
?>