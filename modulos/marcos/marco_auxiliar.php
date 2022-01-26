<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once('marco_auxiliar_c.php');?>
<title>marco_auxiliar</title>
<link href="../../estilos/style.css" rel="stylesheet" type="text/css" />
</head>
<style type="text/css">
<!--
body {
	background-color: #E8F0FF;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<body>
<table width="100%" border="0">
  <tr>
    <td width="15%" valign="top"><table width="100%" border="0">
      <tr>
        <td><p align="center"><img src="../../imagenes/auxiliar.png" width="100" height="100" /></p>
          <p align="center">Administrador</p>
          <div align="center"><?php  echo $usuario->getNombre()?></div></td>
      </tr>
      <tr>
        <td  style="background-color:#0A351C"><a href="../administracion/docentes/informacion.php" target="contenido2">Realizar solicitud </a></td>
      </tr>
      <tr>
        <td style="background-color:#0A351C"><a href="../administracion/solicitudes/agendar.php" target="contenido2">Agendar</a></td>
      </tr>
      <tr>
        <td style="background-color:#0A351C">&nbsp;</td>
      </tr>
      <tr>
        <td style="background-color:#0A351C"><a href="../administracion/comisiones/consulta.php" target="contenido2">Comisiones</a></td>
      </tr>
      <tr>
        <td style="background-color:#0A351C"><a href="../administracion/solicitudes/consulta.php" target="contenido2">Solicitudes</a></td>
      </tr>
       <tr>
        <td style="background-color:#0A351C"><a href="../administracion/solicitudes/consulta1.php" target="contenido2">Avales pendientes</a></td>
      </tr>
      
      <tr>
        <td style="background-color:#0A351C"><a href="../administracion/actas/lista.php" target="contenido2">Actas </a></td>
      </tr>
      <tr>
        <td style="background-color:#0A351C"><a href="../administracion/docentes/consulta.php" target="contenido2">Docentes</a></td>
      </tr>
      <tr>
        <td style="background-color:#0A351C"><a href="../administracion/docentes/editar.php" target="contenido2">Modificar docentes</a></td>
      </tr>
	  <tr>
        <td style="background-color:#0A351C"><a href="../../anexos/renombrar_anexo_0.php" target="contenido2">Renombrar Anexo</a></td>
      </tr>      
      <tr>
          <td>
              <form id="logout" name="logout" method="post" action="">
                  <input name="logout" id="logout" type="submit" onclick="<?php closeSession(); ?>" value="Cerrar Sesi&oacute;n" />
              </form>
          </td>
      </tr>
    </table></td>
    <td width="85%" height="580" valign="top"><iframe src="../administracion/docentes/informacion.php" name="contenido2" width="100%" height="580" scrolling="Auto" frameborder="0" id="contenido2"><a href="../contenido"></a></iframe></td>
  </tr>
</table>
</body>
</html>
