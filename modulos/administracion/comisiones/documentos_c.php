<?php
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'clasesDTO.php');
$numero = count($_GET);
$id = $_GET['id'];
$solicitud=new SolicitudDTO();
$solicitud=$solicitud->find($id);
if( isset($_POST["subir"]))
 {
//datos del arhivo
$nombre_archivo = $_FILES['file']['name'];
$tipo_archivo = $_FILES['file']['type'];
//compruebo si las características del archivo son las que deseo
   if(move_uploaded_file($_FILES['file']['tmp_name'],$path['upload']."solicitudes/".$solicitud->getId().".pdf")){
       echo "El archivo ha sido cargado correctamente.";
    }else{
       echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
    }
}
?>