<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script type="text/javascript" src="../../../js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode :"textareas",
		theme :"simple",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true
	});
</script>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo2 {color: #000000}
-->
</style>
<?php require_once('DetalleSolicitud_c.php');?>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" height="500" border="0">
    <tr>
      <td colspan="2" bgcolor="#0A351C" class="Estilo1"><div align="center">Datos del docente</div></td>
    </tr>
    <tr>
      <td width="20%" bgcolor="#6C9A06"><div align="left" class="Estilo1">Facultad</div></td>
      <td width="80%" bordercolor="0" bgcolor="#DDEDFF"><div align="left" class="Estilo2"><?php echo $solicitud->getDocente()->getFacultad()->getNombre() ?></div></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06"><span class="Estilo1">C&eacute;dula</span></td>
      <td bordercolor="0" bgcolor="#DDEDFF"><?php echo $solicitud->getDocente()->getCedula()?></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06"><div align="left" class="Estilo1">Nombre</div></td>
      <td bordercolor="0" bgcolor="#DDEDFF"><div align="left"><?php echo $solicitud->getDocente()->getNombre()?><?php echo " "?><?php echo $solicitud->getDocente()->getApellido1()?><?php echo " "?><?php echo $solicitud->getDocente()->getApellido2()?></div></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06"class="Estilo1">Correo</td>
      <td bordercolor="0" bgcolor="#DDEDFF"><?php echo $solicitud->getDocente()->getCorreo()?></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06"><div align="left"><span class="Estilo1">Hoja de vida </span></div></td>
      <td bordercolor="0" bgcolor="#DDEDFF"><div align="left">
          <?php $resumeold=$path['upload'].$solicitud->getDocente()->getCedula()."/resume.pdf";
				$imagen=$path['imagenes']."iconos/pdf.png ";
				if (file_exists($resumeold)) {
					echo '<a href="'.$resumeold.'"> <img src="'.$imagen.'" width="20" height="20" border="0" /></a>';
				}  ?>
      <a href="../docentes/resume.php?id=<?php echo $solicitud->getDocenteId()?>"></a></div></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06"class="Estilo1"><div align="left">Historial</div></td>
      <td bordercolor="0"><div align="left"> <a href="../docentes/historial.php?id=<?php echo $solicitud->getDocenteId()?>"><img src="../../../imagenes/iconos/historial.jpg" width="20" height="20" border="0" /></a></div></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#0A351C"><div align="center" class="Estilo1">Datos de la solicitud </div></td>
    </tr>

    <tr>
      <td bgcolor="#6C9A06"class="Estilo1">Numero</td>
      <td bordercolor="0" bgcolor="#DDEDFF"><?php echo $solicitud->getId()?></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06"><div align="left" class="Estilo1">Objetivo</div></td>
      <td bordercolor="0"><div align="left"><?php echo $solicitud->getObjetivo()?></div></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06"><div align="left" class="Estilo1">Pa&iacute;s</div></td>
      <td bordercolor="0"><div align="left"><?php echo $solicitud->getPais()->getPais()?></div></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06"><div align="left" class="Estilo1">Lugar</div></td>
      <td bordercolor="0"><div align="left"><?php echo $solicitud->getLugar()?></div></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06"><div align="left" class="Estilo1">fecha de inicio </div></td>
      <td bordercolor="0"><div align="left"><?php echo $solicitud->getFecha1()?></div></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06"><div align="left" class="Estilo1">Fecha de terminaci&oacute;n </div></td>
      <td bordercolor="0"><div align="left"><?php echo $solicitud->getFecha2()?></div></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06"class="Estilo1">Motivo</td>
      <td bordercolor="0"><?php echo $solicitud->getMotivo()->getMotivo()?></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06"><span class="Estilo1">Tipo </span></td>
      <td bordercolor="0"><?php echo $solicitud->getTiposolicitud()->getTipo()?></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06"><span class="Estilo1">Estado </span></td>
      <td bordercolor="0"><?php echo $solicitud->getEstado()->getEstado()?></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06"><span class="Estilo1">Acta</span></td>
      <td bordercolor="0"><?php echo $solicitud->getActaId()?></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06"><span class="Estilo1">Observaciones</span></td>
      <td bordercolor="0"><?php echo $solicitud->getObservaciones()?></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06"><span class="Estilo1">Comentarios</span></td>
      <td bordercolor="0"><?php echo $solicitud->getComentarios()?></td>
    </tr>
    
    <tr>
    	<td bgcolor="#6C9A06"class="Estilo1"><div align="left">Anexos</div></td>
      	<td bordercolor="0"><div align="left"> <a href="./ListarAnexos.php?id=<?php echo $solicitud->getId()?>"><img src="../../../imagenes/iconos/documentos.jpg" width="20" height="20" border="0" /></a></div></td>
    </tr>

    <tr>
      <td colspan="2" bgcolor="#FFFFFF" class="Estilo1">&nbsp;</td>
    </tr>
     <tr>
      <td colspan="2" bgcolor="#0A351C"><div align="center" class="Estilo1"> Respuesta Consejo de Facultad</div></td>
    </tr>
    <tr>
      <td bgcolor="#6C9A06" class="Estilo1">La Unidad Académica concede el aval? </td>
      <td bordercolor="0"><?php 
	  if ($solicitud->getAvalCF() == 1){
		  echo "Sí";
	  }else{
		  echo "No";
	  }?></td>      	
      </td>
    </tr>
    
    <tr height="100%">      
    	<td bgcolor="#6C9A06"><span class="Estilo1">Nro. Acta:</span></td>
        <td bordercolor="0"><?php echo $solicitud->getNumeroActaCF()?></td>
    </tr>
    
    <tr>
    	<td bgcolor="#6C9A06"><span class="Estilo1">Fecha Acta:</span></td>
        <td bordercolor="0"><?php echo $solicitud->getFechaActaCF()?></td>
    </tr>
     <tr>
    	<td bgcolor="#6C9A06"><span class="Estilo1">Resolucion:</span></td>
        <td bordercolor="0"><?php echo $solicitud->getResolucion()?></td>
    </tr>
     <tr>
    	<td bgcolor="#6C9A06"><span class="Estilo1">Fecha de resolucion:</span></td>
        <td bordercolor="0"><?php echo $solicitud->getFechaResolucion()?></td>
    </tr>
     <tr>
    	<td bgcolor="#6C9A06"><span class="Estilo1">Fecha de inicio:</span></td>
        <td bordercolor="0"><?php echo $solicitud->getInicioResolucion()?></td>
    </tr>
     <tr>
    	<td bgcolor="#6C9A06"><span class="Estilo1">Fecha de terminaci&oacute;n:</span></td>
        <td bordercolor="0"><?php echo $solicitud->getFinResolucion()?></td>
    </tr>
    
    <tr>
    	<td bgcolor="#6C9A06"><span class="Estilo1">Comentarios:</span></td>
        <td bordercolor="0"><?php echo $solicitud->getComentariosUnidad()?></td>
    </tr>
  </table>
   <a style="color:#999; font-weight:bold" href="output.php?t=pdf&id=<?php echo $solicitud->getId()?>" target="_blank">Exportar</a>
</body>
</html>
