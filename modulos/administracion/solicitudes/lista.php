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
<?php require_once('lista_c.php');?>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="64" bgcolor="#6C9A06"><span class="Estilo1">Acciones</span></td>
    <td width="17" bgcolor="#6C9A06"><span class="Estilo1">#</span></td>
    <td bgcolor="#6C9A06" class="Estilo1">Facultad </td>
    <td bgcolor="#6C9A06" class="Estilo1">Cedula </td>
    <td bgcolor="#6C9A06" class="Estilo1">Nombre</td>
    <td bordercolor="#ECECFF" bgcolor="#6C9A06" class="Estilo1">Motivo</td>
    <td bordercolor="#ECECFF" bgcolor="#6C9A06" class="Estilo1">Tipo</td>
    <td width="74" bordercolor="#ECECFF" bgcolor="#6C9A06" class="Estilo1">Pa&iacute;s</td>
    <td width="74" bordercolor="#ECECFF" bgcolor="#6C9A06" class="Estilo1">Estado</td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <?php 
 $color="#FFFFFF";
  foreach ($solicitudes as $solicitud)
 {
	$ruta=$path['upload'].$solicitud->getDocente()->getCedula()."/solicitud".$solicitud->getId().".pdf";
	$imagen=$path['imagenes']."iconos/pdf.png ";
	if(file_exists($ruta)){
		$documento = '<a href="'.$ruta.'"> <img src="'.$imagen.'" width="16" height="16" border="0" /></a>';
	}
 if($color=="#FFFFFF")
 $color="#DDEDFF";
 else
 $color="#FFFFFF";
 ?>
  <tr bgcolor="<?php echo $color ?>">
    <td>
	<a href="ver.php?id=<?php echo $solicitud->getId()?>">
	<img src="../../../imagenes/acciones/b_view.png" width="16" height="16" border="0" /></a>
	<a href="../documentos/solicitud.php?id=<?php echo $solicitud->getId() ?>">
	<img src="../../../imagenes/acciones/anexar.gif" width="16" height="16" border="0" /></a>
	<a href="../resoluciones/generarResol.php?id=<?php echo $solicitud->getId()?>">
    <img src="../../../imagenes/acciones/word.png" width="16" height="16" border="0"/></a>
    </a>
	<!--<?php echo $documento; ?>-->
	</td>
    <td><?php echo $solicitud->getId()?></td>
    <td width="97"><?php echo $solicitud->getFacultad()->getNombre()?></td>
    <td width="95"><?php echo $solicitud->getDocente()->getCedula()?></td>
    <td width="153"><?php echo $solicitud->getDocente()->getNombre()?> <?php echo $solicitud->getDocente()->getApellido1()?> <?php echo $solicitud->getDocente()->getApellido2()?></td>
    <td width="107"><?php echo $solicitud->getMotivo()->getMotivo()?></td>
    <td width="107"><?php echo $solicitud->getTiposolicitud()->getTipo()?></td>
    <td><?php echo $solicitud->getPais()->getPais()?></td>
    <td><a href="ver.php?id=<?php echo $solicitud->getId() ?>"><img src="../../../imagenes/estados/<?php echo $solicitud->getEstadoId() ?>.png" width="36" height="25" /></a></td>
  </tr>
  <?php }?>
</table>

</body>
</html>
