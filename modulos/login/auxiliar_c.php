<?php 
require_once('../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
require_once('./Session.php');
//require_once('./AutocerradoSesion.php');
require_once($path['modelo'].'clasesDTO.php');

if(isset($_POST["ingresar"])) 
    ingresar ();
/**
 * Funcion para generar la sesion de usuario, validando que no
 * haya ninguna sesion iniciada actualmente, y si no se ha instanciado
 * ninguna sesion se verfician los datos de usuario de manera segura y
 * procede a instanciar la nueva sesion de usuario transversal a toda
 * la aplicacion CODEDO.
 * 
 */
function ingresar() {
    //echo "ingresar";
    $session;
    $session = Session::getInstance();
    if ($session->getVal("usuario_id")!=""){
		$session->cerrarSesion();
	}

    // Obtener los datos ingresados y verificar !SQL
    $cedula=$_POST["cedula"];
    $clave=$_POST["clave"];
    $rol="auxiliar";
    // Empacar los datos extraidos para facil uso
    $usuario = new UsuarioDTO();
    $usuario->setCedula($cedula);
	
	
    $usuario->setClave($cedula);
    $usuario->setRol($rol);
    $id = $usuario->getId();
    $usuario=$usuario->find($id);
    
    // Comparacion segura a nivel binario de la clave [Case Sensitive]
    // Check if passwords match
    #echo $usuario->getClave()."<br />";
    #echo sha1($clave)."<br />";
	
    if(strcmp($usuario->getClave(),$clave)==0){
        $session->setVal("usuario_id",$id);
		$session->setVal("rol",$usuario->getRol());
		$session->setVal("ultimoAcceso",date("Y-n-j H:i:s"));
        echo '<script>location.href="../marcos/marco_auxiliar.php"</script>';   
    }
    // Passwd Doesn't Match
    else
        echo "Acceso denegado";
}