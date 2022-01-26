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
<?php require_once('docente_c.php');?>
<body>
<table width="100%" border="0">
  <tr>
    <td width="14%" valign="top" bgcolor="#E2EAF1"><p align="center" class="Arial_12_B"><img src="../../imagenes/docente.png" width="75" height="100" /></p>
      <p align="center" class="Arial_12_B Estilo1">Docente</p>
      <p align="center" class="Arial_12_B">Iniciar sesi&ograve;n</p>
      <div align="center">
        <form id="form1" name="form1" method="post" action="">
          <table width="150" border="0" align="center" bordercolor="#EDEEF0">
            <tr>
              <td width="25%" class="Arial_12">Cedula</td>
              <td width="75%"><input name="cedula" type="text" id="cedula" class=":integer :required" size="20" /></td>
            </tr>
            <tr>
              <td class="Arial_12">Clave</td>
              <td><input name="clave" type="password" id="clave" class=":required" size="20" /></td>
            </tr>
          </table>
          <p>
            <input name="ingresar" type="submit" class="button" id="ingresar" value="Ingresar" />
          </p>
          <p><?php echo $error ?>&nbsp;</p>
        </form>
    </div></td>
    <td width="86%" valign="top"><iframe src="index.php" name="contenido" width="100%" height="560" scrolling="Auto" frameborder="0" id="contenido"><a href="../inicio/contenido"></a></iframe></td>
  </tr>
</table>
</body>
</html>
