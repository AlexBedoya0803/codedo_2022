<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="../../../js/funciones.js"></script>
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
<?php require_once('agendar_c.php');?>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td colspan="3" bgcolor="#0A351C"><span class="Estilo1">Acciones</span></td>
    <td bgcolor="#0A351C" class="Estilo1">#</td>
    <td bgcolor="#0A351C" class="Estilo1">Facultad </td>
    <td bgcolor="#0A351C" class="Estilo1">Cedula </td>
    <td bgcolor="#0A351C" class="Estilo1">Nombre</td>
    <td bordercolor="#ECECFF" bgcolor="#0A351C" class="Estilo1">Agendar al acta </td>
  </tr>
  <tr>
    <td colspan="8" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  
  <?php 
 $color="#FFFFFF";
  foreach ($solicitudes as $solicitud)
 {
 $id=$solicitud->getId();
 if($color=="#FFFFFF")
 $color="#DDEDFF";
 else
 $color="#FFFFFF";
 ?>
  <tr bgcolor="<?php echo $color ?>">
    <td width="24"><a href="ver.php?id=<?php echo $id ?>"><img src="../../../imagenes/acciones/b_view.png" width="16" height="16" border="0" /></a></a></td>
    <td width="26"><?php //$solicitud->getDocente()->resume($path['imagenes'],$path['upload'],20,20)?></td>
    <td width="18"><?php //$solicitud->documento($path['imagenes'],$path['upload'],20,20)?></td>
    <td width="28"><?php echo $solicitud->getId()?></td>
    <td width="110"><?php echo $solicitud->getFacultad()->getNombre()?></td>
    <td width="84"><?php echo $solicitud->getDocente()->getCedula()?></td>
    <td width="136"><?php echo $solicitud->getDocente()->getNombre()?> <?php echo $solicitud->getDocente()->getApellido1()?> <?php echo $solicitud->getDocente()->getApellido2()?></td>
    <td>
	<select name="actas<?php echo $id?>" id="actas<?php echo $id?>" >
          <option value="" selected="selected"> </option>
          <?php foreach($actas as $acta) { ?>
          <option value="<?php echo $acta->getId(); ?>"><?php echo $acta->getId()." ..... ".$acta->getNumeroSolicitudes()?> </option>
          <?php } ?>
    </select>
   	<input name="agendar<?php echo $id?>" type="submit" class="button" id="agendar" value="Agendar" />
    <input name="noAgendar<?php echo $id?>" type="submit" class="button" id="noAgendar" value="No Agendar"/>
    </td>
  </tr>
 
  <?php }?>
</table>
 </form>
</body>
</html>
