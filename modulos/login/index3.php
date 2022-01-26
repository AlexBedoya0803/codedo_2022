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
<?php require_once('login_c.php');
	require_once('Session.php');
	$session;
    $session = Session::getInstance();
    if ($session->getVal("usuario_id")!=""){
		switch($session->getVal("rol")){
				case 'auxiliar';
					echo '<script>location.href="../marcos/marco_auxiliar.php"</script>';   	
				break;
				case 'comite'; 
					echo '<script>location.href="../marcos/marco_comite.php"</script>';
				break;
				case 'unidad';
					echo '<script>location.href="../marcos/marco_unidad.php"</script>';
				break;
					default; $session->cerrarSesion();
					echo '<script>location.href="../login/index.php"</script>';
				
			}
	}
?>
<body>
<table width="100%" border="0">
  <tr>
    <td width="14%" valign="top" bgcolor="#E2EAF1"><p align="center" class="Arial_12_B"><img src="../../imagenes/comite.png" width="93" height="99" /></p>
      
      <p align="center" class="Arial_12_B">Iniciar sesi&ograve;n</p>
      <form id="form1" name="form1" method="post" action="">
        <table width="150" border="0" align="center" bordercolor="#EDEEF0">
          <tr>
            <td width="25%" class="Arial_12">Usuario</td>
            <td width="75%"><input name="cedula" type="text" id="cedula" class=":required" size="20" /></td>
          </tr>
          <tr>
            <td class="Arial_12">Clave</td>
            <td><input name="clave" type="password" id="clave" class=":required" size="20" /></td>
          </tr>
        </table>

        <div align="center">
          <input name="ingresar" type="submit" class="button" id="ingresar" value="Ingresar" />
        </div>
      </form>
      <p>&nbsp;</p></td>
    <td width="86%" valign="top"><iframe src="index.php" name="contenido" width="100%" height="560" scrolling="Auto" frameborder="0" id="contenido"><a href="../inicio/contenido"></a></iframe></td>
  </tr>
</table>
</body>
</html>
