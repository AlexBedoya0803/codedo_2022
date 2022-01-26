<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="../../../js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode :"textareas",
		theme :"advanced",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true
	});
</script>
<?php require_once('ver_c.php');?>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo2 {color: #000000}
-->
</style>
</head>
<body>
<div align="center">
  <p>Acta   <?php echo $id." de ".$acta->getFecha() ?> <a name="inicio" id="inicio"></a></p>
  <p align="center">Solicitudes</p>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td width="52" bgcolor="#0A351C"><div align="left"><span class="Estilo1">Link</span></div></td>
      <td width="63" bgcolor="#0A351C"><a href="../../auxiliar/costos/nuevo.php">Numero</a></td>
      <td width="234" bgcolor="#0A351C"><div align="left"><span class="Estilo1">Facultad</span></div></td>
      <td width="167" bordercolor="#ECECFF" bgcolor="#0A351C"><div align="left"><span class="Estilo1">Nombre</span></div></td>
      <td width="133" bordercolor="#ECECFF" bgcolor="#0A351C" class="Estilo1"><div align="left">Cedula</div></td>
    </tr>
    <tr>
      <td colspan="5" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <?php 
 $color="#FFFFFF";
  foreach ($solicitudes as $solicitud)
 {
	
	$ok="../../../imagenes/iconos/Checked.png ";
	$fallo="../../../imagenes/iconos/Delete.png ";
	$wait="../../../imagenes/iconos/Help.png";
	if($solicitud->getRespuestaId()==1){ 
		$imagen = '<img src="'.$ok.'"width="16"height="16"border="0"/>';
	}else if($solicitud->getRespuestaId()==2){
		$imagen = '<img src="'.$fallo.'"width="16"height="16"border="0"/>';
	}else{
		$imagen = '<img src="'.$wait.'"width="16"height="16"border="0"/>';
	}
 if($color=="#FFFFFF")
 $color="#DDEDFF";
 else
 $color="#FFFFFF";
 ?>
    <tr bgcolor="<?php echo $color ?>">
      <td height="18">
      	<a href="../solicitudes/ver.php?id=<?php echo $solicitud->getId() ?>">
        </a>
        <a href="../comite/DetalleSolicitud.php?id=<?php echo $solicitud->getId()?>" title="Ver Solicitud"><img src="../../../imagenes/acciones/Spotlight.png" width="16" height="16" border="0"/></a>
        <?php if($acta->getAbierta()) {?><a href="../edicion/solicitud.php?id=<?php echo $solicitud->getId() ?>"><img src="../../../imagenes/acciones/Pencil.png" width="16" height="16" border="0" title="Editar la solicitud"/><?php }?>
        </a> 
       <a href="../edicion/solicitudResolucion.php?id=<?php echo $solicitud->getId() ?>"><img src="../../../imagenes/acciones/Pencil.png" width="16" height="16" border="0" title="Editar la solicitud"/>
        </a> 
        <a href="../resoluciones/generarResol.php?id=<?php echo $solicitud->getId()?>">
    	<img src="../../../imagenes/acciones/word.png" width="16" height="16" border="0" title="Generar Resoluci&oacute;n"/></a>
    	</a>
        
        
        <a href="../comite/Votaciones.php?id=<?php echo $solicitud->getId()?>">
    	<img src="../../../imagenes/acciones/meeting.png" width="16" height="16" border="0" title="Ver votaciones"/></a>
    	</a>
        <?php echo $imagen;?> 
      </td>
      <td height="18"><?php echo $solicitud->getId()?></td>
      <td><div align="left"><span class="Estilo2"><?php echo utf8_encode($solicitud->getFacultad()->getNombre())?></span></div></td>
      <td><div align="left"><span class="Estilo2"><?php echo utf8_encode($solicitud->getDocente()->getNombre()." ".$solicitud->getDocente()->getApellido1()." ".$solicitud->getDocente()->getApellido2()); ?></span></div></td>
      <td><div align="left"><span class="Estilo2"><?php echo $solicitud->getDocente()->getCedula()?></span></div></td>
    </tr>
    <?php }?>
  </table>
<!--
    <table width="100" border="1">
      <tr>
        <td bgcolor="#638CB5"><div align="center"><a href="#anexos">Anexos</a></div></td>
      </tr>
    </table>
    <p>
      <?php foreach ($solicitudes as $solicitud){
		  $docente = $solicitud->getDocente(); 
		  $resumeold=$path['upload'].$docente->getCedula()."/resume.pdf";
		  $imagen=$path['imagenes']."iconos/pdf.png ";
		  if (file_exists($resumeold)) {
			  $resume = '<a href="'.$resumeold.'"> <img src="'.$imagen.'" width="20" height="20" border="0" /></a>';
		  } 
		  $ruta=$path['upload'].$solicitud->getDocente()->getCedula()."/solicitud".$solicitud->getId().".pdf";
		  $imagen=$path['imagenes']."iconos/pdf.png ";
		  if(file_exists($ruta)){
			  $documento = '<a href="'.$ruta.'"> <img src="'.$imagen.'" width="20" height="20" border="0" /></a>';
		  } ?>
    </p>
    <table width="100%" border="1">
      <tr>
        <td bgcolor="#000066"><div align="center"><a name="<?php echo $solicitud->getId()?>" id="<?php echo $solicitud->getId()?>"></a><a href="#inicio">Inicio</a></div>
            <div align="center"></div></td>
        <td bordercolor="0" bgcolor="#000066"><div align="center"><span class="Estilo1"><?php echo $solicitud->getFacultad()->getNombre() ?></span></div></td>
      </tr>
      <tr>
        <td width="20%" bgcolor="#638CB5"><div align="left" class="Estilo1">Numero</div></td>
        <td width="80%" bordercolor="0" bgcolor="#DDEDFF"><div align="left"><?php echo $solicitud->getId()?></div></td>
      </tr>
      <tr>
        <td bgcolor="#638CB5"><div align="left"><span class="Estilo1">Cedula</span></div></td>
        <td width="80%" bordercolor="0" bgcolor="#DDEDFF"><div align="left"><?php echo $solicitud->getDocente()->getCedula()?></div></td>
      </tr>
      <tr>
        <td bgcolor="#638CB5"><div align="left" class="Estilo1">Nombre</div></td>
        <td bordercolor="0" bgcolor="#DDEDFF"><div align="left"><?php echo utf8_encode($solicitud->getDocente()->getApellido1().' '.$solicitud->getDocente()->getApellido2().' '.$solicitud->getDocente()->getNombre())?></div></td>
      </tr>
      <tr>
        <td bgcolor="#638CB5"><div align="left"><span class="Estilo1">Documentaci&oacute;n</span></div></td>
        <td bordercolor="0"><div align="left"><a href="../docentes/historial.php?id=">
          <?php echo $documento; ?>
        </a></div></td>
      </tr>
      <tr>
        <td bgcolor="#638CB5"><div align="left"><span class="Estilo1">Hoja de vida </span></div></td>
        <td bordercolor="0"><div align="left"><a href="../docentes/historial.php?id=">
          <?php echo $resume; ?>
        </a></div></td>
      </tr>
      <tr>
        <td bgcolor="#638CB5" class="Estilo1"><div align="left">Historial</div></td>
        <td bordercolor="0"><div align="left">
		<a href="../docentes/historial.php?id=<?php echo $solicitud->getDocenteId()?>"><img src="../../../imagenes/iconos/historial.jpg" width="16" height="16" border="0" /></a></div></td>
      </tr>
    </table>
    <p>
      <?php } ?>
    </p>
    <p class="Arial_12_B"><a name="anexos" id="anexos"></a>Anexos</p>
    <table width="100" border="1">
      <tr>
        <td bgcolor="#000066"><div align="center"><a href="#inicio">Inicio</a></div></td>
      </tr>
    </table>
    <table width="100%" border="1">
      <tr>
        <td><?php echo $acta->getAnexo() ?></td>
      </tr>
    </table>
    <p>&nbsp;</p>
</div>
-->
</body>
</html>
