<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once('marco_auxiliar_c.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>


<link href="../../estilos/style.css" rel="stylesheet" type="text/css" />
<body>
<table width="100%" border="1">
  <tr>
    <td width="16%" valign="top"><p align="center"><span class="Arial_12_B"><img src="../../imagenes/comite.png" width="105" height="99" /></span></p>
      <p align="center">
        <?php  echo $usuario->getNombre()?>
      </p>
      <table width="100%" border="1">
      
      <tr>
        <td style="background-color:#0A351C"><a href="../administracion/comite/actas.php" target="contenido2">Evaluar Solicitudes </a></td>
      </tr>
      <tr>
        <td style="background-color:#0A351C">&nbsp;</td>
      </tr>
      <!--
      <tr>
        <td bgcolor="#527497"><a href="../administracion/solicitudes/consulta.php" target="contenido2">Solicitudes</a></td>
      </tr>
      <tr>
        <td bgcolor="#527497"><a href="../administracion/comisiones/consulta.php" target="contenido2">Comisiones</a></td>
      </tr>
      <tr>
        <td bgcolor="#527497"><a href="../administracion/actas/lista.php" target="contenido2">actas </a></td>
      </tr>
      <tr>
        <td bgcolor="#527497"><a href="../administracion/docentes/consulta.php" target="contenido2">Docentes</a></td>
      </tr>
      -->
      <tr>
          <td>
              <form id="logout" name="logout" method="post" action="">
                  <input name="logout" id="logout" type="submit" onclick="<?php closeSession(); ?>" value="Cerrar Sesi&oacute;n" />
              </form>
          </td>
      </tr>
    </table></td>
    <td width="84%" height="580" valign="top"><iframe src="../administracion/comite/actas.php" name="contenido2" width="100%" height="580" scrolling="Auto" frameborder="0" id="contenido2"><a href="../contenido"></a></iframe></td>
  </tr>
</table>
</body>
</html>
