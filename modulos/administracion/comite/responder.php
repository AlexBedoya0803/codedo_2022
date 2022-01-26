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
<?php require_once('responder_c.php');?>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<table width="100%" height="500" border="0">
    <tr>
      <td colspan="2" bgcolor="#000066" class="Estilo1"><div align="center">Datos del docente</div></td>
    </tr>
    <tr>
      <td width="20%" bgcolor="#638CB5"><div align="left" class="Estilo1">Facultad</div></td>
      <td width="80%" bordercolor="0" bgcolor="#DDEDFF"><div align="left" class="Estilo2"><?php echo $solicitud->getDocente()->getFacultad()->getNombre() ?></div></td>
    </tr>
    <tr>
      <td bgcolor="#638CB5"><span class="Estilo1">Cedula</span></td>
      <td bordercolor="0" bgcolor="#DDEDFF"><?php echo $solicitud->getDocente()->getCedula()?></td>
    </tr>
    <tr>
      <td bgcolor="#638CB5"><div align="left" class="Estilo1">Nombre</div></td>
      <td bordercolor="0" bgcolor="#DDEDFF"><div align="left"><?php echo $solicitud->getDocente()->getNombre()?></div></td>
    </tr>
    <tr>
      <td bgcolor="#638CB5" class="Estilo1">Correo</td>
      <td bordercolor="0" bgcolor="#DDEDFF"><?php echo $solicitud->getDocente()->getCorreo()?></td>
    </tr>
    <tr>
      <td bgcolor="#638CB5"><div align="left"><span class="Estilo1">Hoja de vida </span></div></td>
      <td bordercolor="0" bgcolor="#DDEDFF"><div align="left">
          <?php $resumeold=$path['upload'].$solicitud->getDocente()->getCedula()."/resume.pdf";
				$imagen=$path['imagenes']."iconos/pdf.png ";
				if (file_exists($resumeold)) {
					echo '<a href="'.$resumeold.'"> <img src="'.$imagen.'" width="20" height="20" border="0" /></a>';
				}  ?>
      <a href="../docentes/resume.php?id=<?php echo $solicitud->getDocenteId()?>"></a></div></td>
    </tr>
    <tr>
      <td bgcolor="#638CB5" class="Estilo1"><div align="left">Historial</div></td>
      <td bordercolor="0"><div align="left"> <a href="../docentes/historial.php?id=<?php echo $solicitud->getDocenteId()?>"><img src="../../../imagenes/iconos/historial.jpg" width="20" height="20" border="0" /></a></div></td>
    </tr>
    <tr>
    	<td bgcolor="#638CB5" class="Estilo1"><div align="left">Anexos</div></td>
      	<td bordercolor="0"><div align="left"> <a href="./ListarAnexos.php?id=<?php echo $solicitud->getId()?>"><img src="../../../imagenes/iconos/documentos.jpg" width="20" height="20" border="0" /></a></div></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#000066"><div align="center" class="Estilo1">Datos de la solicitud </div></td>
    </tr>

    <tr>
      <td bgcolor="#638CB5" class="Estilo1">Numero</td>
      <td bordercolor="0" bgcolor="#DDEDFF"><?php echo $solicitud->getId()?></td>
    </tr>
    <tr>
      <td bgcolor="#638CB5"><div align="left" class="Estilo1">Objetivo</div></td>
      <td bordercolor="0"><div align="left"><?php echo $solicitud->getObjetivo()?></div></td>
    </tr>
    <tr>
      <td bgcolor="#638CB5"><div align="left" class="Estilo1">Pa&iacute;s</div></td>
      <td bordercolor="0"><div align="left"><?php echo $solicitud->getPais()->getPais()?></div></td>
    </tr>
    <tr>
      <td bgcolor="#638CB5"><div align="left" class="Estilo1">Lugar</div></td>
      <td bordercolor="0"><div align="left"><?php echo $solicitud->getLugar()?></div></td>
    </tr>
    <tr>
      <td bgcolor="#638CB5"><div align="left" class="Estilo1">fecha de inicio </div></td>
      <td bordercolor="0"><div align="left"><?php echo $solicitud->getFecha1()?></div></td>
    </tr>
    <tr>
      <td bgcolor="#638CB5"><div align="left" class="Estilo1">Fecha de terminaci&ograve;n </div></td>
      <td bordercolor="0"><div align="left"><?php echo $solicitud->getFecha2()?></div></td>
    </tr>
    <tr>
      <td bgcolor="#638CB5" class="Estilo1">Motivo</td>
      <td bordercolor="0"><?php echo $solicitud->getMotivo()->getMotivo()?></td>
    </tr>
    <tr>
      <td bgcolor="#638CB5"><span class="Estilo1">Tipo </span></td>
      <td bordercolor="0"><?php echo $solicitud->getTiposolicitud()->getTipo()?></td>
    </tr>
    <tr>
      <td bgcolor="#638CB5"><span class="Estilo1">Estado </span></td>
      <td bordercolor="0"><?php echo $solicitud->getEstado()->getEstado()?></td>
    </tr>
    <tr>
      <td bgcolor="#638CB5"><span class="Estilo1">Acta</span></td>
      <td bordercolor="0"><?php echo $solicitud->getActaId()?></td>
    </tr>
    <tr>
      <td bgcolor="#638CB5"><span class="Estilo1">Observaciones</span></td>
      <td bordercolor="0"><?php echo $solicitud->getObservaciones()?></td>
    </tr>

    <tr>
      <td colspan="2" bgcolor="#FFFFFF" class="Estilo1">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#000066"><div align="center" class="Estilo1"> Respuesta</div></td>
    </tr>
    <tr>
      <td bgcolor="#638CB5" class="Estilo1">Se recomienda? </td>
      <td bordercolor="0">Sí
        <input name="respuesta" type="radio" value="1" <?php echo $si; ?> required/>
        No
        <input type="radio" name="respuesta" value="0" <?php echo $no; ?>/>
        <!--<input name="autocompletar" type="submit" class="button" id="autocompletar" value="autocompletar" /> 
        <input name="autocompletarAca" type="submit" class="button" id="autocompletarAca" value="autocompletar acad&eacute;mico" />
      	-->
      </td>
    </tr>
    <tr>
      <td bgcolor="#638CB5" class="Estilo1">Comentarios</td>
      <td bordercolor="0"><label>
        <textarea name="recomendacion" cols="90%" rows="5" id="recomendacion"><?php echo $contenido; ?></textarea>
      </label></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="Estilo1">&nbsp;</td>
      <td bordercolor="0"><input name="guardar" type="submit" class="button" id="guardar" value="Guardar respuesta" /> 
      
      <!--
      <input name="reagendar" type="submit" class="button" id="reagendar" value="Reagendar" />
         <select name="actas" id="actas" >
          <option value="" selected="selected"> </option>
          <?php foreach($actas as $acta) { ?>
          <option value="<?php echo $acta->getId(); ?>"><?php echo $acta->getId()." ..... ".$acta->getNumeroSolicitudes()?> </option>
          <?php } ?>
        </select> --></td>
    </tr>
  </table>
</form>
</body>
</html>
