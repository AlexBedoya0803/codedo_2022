<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php require_once('informacion_c.php');?>
<script type="text/javascript" src="../../../js/funciones.js"></script>
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo10 {color: #00007F; font-size: 16px; font-weight: bold; }
.Estilo8 {color: #FFFFFF}
-->
</style>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
a:link {
	color: #FFFFFF;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #FFFFFF;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
.Estilo11 {color: #FF0000}
-->
</style></head>

<body>
<fieldset style="border:#0000FF ridge">
<legend><span class="Estilo10">Informaci&oacute;n del docente</span></legend>
<form id="form1" name="form1" method="post" action="">
  <legend><span class="Estilo10"></span></legend>
  <table width="100%" border="0" align="center">
    <tr>
      <td width="167" bgcolor="#527497"><span class="Estilo8">Nombre</span></td>
      <td colspan="3" bgcolor="#FFFFFF"><label>
        <input name="nombre" type="text" id="nombre" value="<?php echo $formulario['nombre'] ?>" size="40" readonly="readonly" />
      </label></td>
    </tr>
    <tr>
      <td bgcolor="#527497"><span class="Estilo8">Apellido</span></td>
      <td colspan="3" bgcolor="#FFFFFF"><input name="apellido" type="text" id="apellido" value="<?php echo $formulario['apellido']?>" size="40" readonly="readonly"/></td>
    </tr>
    <tr>
      <td bgcolor="#527497"><span class="Estilo8">Cedula</span></td>
      <td colspan="3" bgcolor="#FFFFFF"><input name="cedula" type="text" id="cedula" value="<?php echo $formulario['cedula'] ?>" size="40" readonly="readonly"/></td>
    </tr>
    <tr>
      <td bgcolor="#527497"><span class="Estilo8">Facultad</span></td>
      <td colspan="3" bgcolor="#FFFFFF"><input name="facultad" type="text" id="facultad" value="<?php echo $formulario['facultad']?>" size="40" readonly="readonly"/></td>
    </tr>
    <tr>
      <td bgcolor="#527497"><span class="Estilo8">Email</span></td>
      <td colspan="3" bgcolor="#FFFFFF"><input name="correo" type="text" id="correo" value="<?php echo $formulario['correo']?>" size="40" readonly="readonly"/></td>
    </tr>
    <tr>
      <td bgcolor="#527497"><span class="Estilo8">Centro de costo </span></td>
      <td colspan="3" bgcolor="#FFFFFF"><input name="costo" type="text" id="costo" value="<?php echo $formulario['centro']?> " size="40" readonly="readonly"/></td>
    </tr>
    <tr>
      <td bgcolor="#527497" class="Estilo8">Hoja de vida </td>
      <td colspan="3" bgcolor="#FFFFFF"><?php if($existe)echo $resume?></td>
    </tr>
    <tr>
      <td bgcolor="#527497" class="Estilo8">Historial</td>
      <td colspan="3" bgcolor="#FFFFFF">
	  <?php if($existe)
echo'<a href="historial.php?id='.$docente->getId().'"><img src="../../imagenes/iconos/historial.jpg" width="16" height="16" border="0" /></a>';?></td>
    </tr>
    <tr>
      <td bgcolor="#527497" class="Estilo8">Comisiones solicitadas  </td>
      <td colspan="3" bgcolor="#FFFFFF"><?php if($existe)echo $docente->getNumeroComisiones()?></td>
    </tr>
    <tr>
      <td colspan="4" class="Estilo11"><?php if($existe)echo $error?></td>
    </tr>
    <tr>
      <td bgcolor="#527497" class="Estilo8">Solicitud</td>
      <td width="198" bgcolor="#527497"> <?php echo $nueva;?></td>
      <td width="202" bgcolor="#527497"> <?php echo $prorroga;?></td>
      <td width="302" bgcolor="#527497"> <?php echo $modificacion;?></td>
    </tr>
  </table>

</form>
<p>&nbsp;</p>
</fieldset>
</body>
</html>
