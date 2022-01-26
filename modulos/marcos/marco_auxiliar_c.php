<?php

require_once('../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
require_once($path['modelo'].'clasesDTO.php');
require_once("../login/Session.php");
require_once('../login/AutocerradoSesion.php');
//session_start();
$session = Session::getInstance();

if($session->getVal("usuario_id")=="")
       echo '<script>location.href="../login/login-Copia.php";</script>';

$id=$session->usuario_id;
$usuario = new UsuarioDTO();
$usuario=$usuario->find($id);

function closeSession(){
    if (isset ($_POST["logout"])){
		$session = Session::getInstance();
		$session->setVal("rol","");
        $session->cerrarSesion();
        header("Location: https://aprendeenlinea.udea.edu.co/oauth/?action=logout&redirect_uri=http://avido.udea.edu.co/dedo/modulos/login/login-Copia.php");
    }  
}

?>
