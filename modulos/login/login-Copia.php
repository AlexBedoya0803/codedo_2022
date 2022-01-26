<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../../estilos/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/validacion/jquery.min.js"></script>
<script type="text/javascript" src="../../js/validacion/vanadium.js"></script>
<style type="text/css">
<!--
.Estilo1 {font-size: 14px}
-->
</style>
</head>
<?php //require_once('login_c.php');
	require_once('Session.php');
	$session;
    $session = Session::getInstance();
	$user_agent = $_SERVER['HTTP_USER_AGENT']; //obtiene el navegador que usa el usuario
if(isset($_SESSION['status'])==false) echo '<script>location.href="../../index.php";</script>';/**echo '<script>location.href="https://aprendeenlinea.udea.edu.co/oauth/?action=auth&client_id=deFDj24IQpBBuN5dy6hCScodedoI5M&redirect_uri=http://avido.udea.edu.co/dedo/redirect.php&scope=profile%20email&response_type=code";</script>';**/
	if((strpos($user_agent, 'Chrome') ||  strpos($user_agent, 'Firefox'))== FALSE){
		
?>
 <div class="modal-wrapper" id="navegador">
   <div class="popup-contenedor">
      <p>Para una mejor experiencia con la aplicación, se recomienda el uso del navegador Google Chrome.</p>
      <a class="popup-cerrar" href="#" onClick="ocultar()">X</a>
   </div>
</div>
 <script type="text/javascript">
      function ocultar(){
        document.getElementById("navegador").style.visibility = 'hidden';
      }
    </script>
<?php } ?>
<body>
<table width="100%" border="0">
	<tr>
    <td width="14%" valign="top" bgcolor="#E2EAF1"> <a class="button" style="background-color:#E2EAF1" href="../../index.php"><img src="../../imagenes/escudo.png" width="80%" height="100%" style="margin-top:20px;"></a> <p style="color:#C00; font-weight:bold" > <?php if(isset($_SESSION['status']) && $_SESSION['status']== "false") echo "Acceso denegado, el usuario no es docente";?></p></td>
	
      
   <td width="86%" valign="top"><iframe src="index.php" name="contenido" width="100%" height="560" scrolling="Auto" frameborder="0" id="contenido"><a href="../inicio/contenido"></a></iframe></td>
  </tr>
</table>
</body>
</html>
