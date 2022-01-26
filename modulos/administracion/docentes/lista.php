<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<?php require_once('lista_c.php');?>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style></head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td colspan="4" bgcolor="#6C9A06"><span class="Estilo1"><a href="../../auxiliar/costos/nuevo.php">Acciones</a></span></td>
    <td width="70" bgcolor="#6C9A06"><span class="Estilo1">Cedula</span></td>
    <td width="246" bordercolor="#ECECFF" bgcolor="#6C9A06"><span class="Estilo1 Estilo1">Nombre</span></td>
    <td width="239" bordercolor="#ECECFF" bgcolor="#6C9A06"><span class="Estilo1">Facultad</span></td>
    <td width="98" bordercolor="#ECECFF" bgcolor="#6C9A06"><span class="Estilo1">Correo</span></td>
    <td width="99" bordercolor="#ECECFF" bgcolor="#6C9A06"><div align="right"><span class="Estilo1">Solicitudes</span></div></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  
  <?php 
 $color="#FFFFFF";
  foreach ($docentes as $docente)
 {
	 $consulta1 = new Criteria("solicitudes");
	 $consulta1->addFiltro("docente_id","=",$docente->getId());
	 $numeroSolicitudes = $consulta1->_count();
 if($color=="#FFFFFF")
 $color="#DDEDFF";
 else
 $color="#FFFFFF";
 ?>
  <tr bgcolor="<?php echo $color ?>">
    <td width="23"><a href="historial.php?id=<?php echo $docente->getId() ?>"><img src="../../../imagenes/acciones/b_view.png" width="16" height="16" border="0" /></a></td>
    <td width="11"><?php //echo $docente->resume($path['imagenes'],$path['upload'],20,20)?></td>
    <td width="12">&nbsp;</td>
    <td width="31"><div align="left"><a href="../documentos/anexar.php?id=<?php echo $docente->getId() ?>"><img src="../../../imagenes/iconos/actualizardoc.png" width="20" height="16" border="0" /></a></div></td>
    <td><?php echo $docente->getCedula()?></td>
    <td><?php echo $docente->getNombre()?> <?php echo $docente->getApellido1()?> <?php echo $docente->getApellido2()?></td>
    <td><?php echo $docente->getFacultad()->getNombre()?></td>
    <td><?php echo $docente->getCorreo()?></td>
    <td><div align="right"><?php echo $numeroSolicitudes?></div></td>
  </tr>
  <?php }?>
</table>
</body>
</html>
