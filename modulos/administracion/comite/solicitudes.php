<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php require_once('solicitudes_c.php');?>
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
  <p>Acta   <?php echo $id  ."de ".$acta->getFecha() ?> <a name="inicio" id="inicio"></a></p>
  <p align="center">Solicitudes</p>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td width="77" bgcolor="#638CB5"><div align="left"><span class="Estilo1">Link</span></div></td>
      <td width="56" bgcolor="#638CB5"><a href="../../auxiliar/costos/nuevo.php">#</a></td>
      <td width="96" bgcolor="#638CB5"><span class="Estilo1">Tipo</span></td>
      <td width="167" bgcolor="#638CB5"><div align="left"><span class="Estilo1">Facultad</span></div></td>
      <td width="228" bordercolor="#ECECFF" bgcolor="#638CB5"><div align=
      "left"><span class="Estilo1">Nombre</span></div></td>
      <td width="147" bordercolor="#ECECFF" bgcolor="#638CB5" class="Estilo1"><div align="left">Cedula</div></td>
    </tr>
    <tr>
      <td colspan="6" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <?php 
 $color="#FFFFFF";
  foreach ($solicitudes as $solicitud)
 {
	//$imagen=null;
	$ok=$path['imagenes']."iconos/Checked.png ";
	$fallo=$path['imagenes']."iconos/Delete.png ";
	$wait=$path['imagenes']."iconos/Help.png";
	if($solicitud->getRespuestaId()==1){
		$imagen = '<img src="'.$ok.'"width="16"height="16"border="0"/>';
	}else if($solicitud->getRespuestaId()==2){
		$imagen = '<img src="'.$fallo.'"width="16"height="16"border="0"/>';
	}else {
		$imagen = '<img src="'.$wait.'"width="16"height="16"border="0"/>';
	}
	
	if($color=="#FFFFFF")
		$color="#DDEDFF";
	else
		$color="#FFFFFF";
	?>
    <tr bgcolor="<?php echo $color ?>">
      <td height="18"><div align="left"><span class="Estilo2"><a href="../comite/DetalleSolicitud.php?id=<?php echo $solicitud->getId() ?>"><img src="../../../imagenes/acciones/Spotlight.png" width="16" height="16" border="0" title="Ver solicitud"/></a> </span> <?php /*if($solicitud->getRespuestaId()==3)*/ //echo '<a href="responder.php?id='.$solicitud->getId().'" title="Realizar votación">
	  	//<img src="../../../imagenes/acciones/vote.png" width="16" height="16" border="0" /></a>'; ?>
	   <?php //if($solicitud->getRespuestaId()!=3) echo $imagen; ?>
       <?php 
	   		if($solicitud->getRespuestaId()==0 || $solicitud->getRespuestaId()==3){
		   		echo '<a href="responder.php?id='.$solicitud->getId().'" title="Realizar votaci&oacute;n">';
				echo $imagen.'</a>';
	   		}else{
				echo $imagen;	
			}
		?>
       <a href="./Votaciones.php?id=<?php echo $solicitud->getId()?>">
    	<img src="../../../imagenes/acciones/meeting.png" width="16" height="16" border="0" title="Ver votaciones"/></a>
      </a>
     
      </div>        
      <div align="left" class="Estilo2"></div></td>
      <td height="18"><?php echo $solicitud->getId()?></td>
      <td height="18"><?php echo $solicitud->getTiposolicitud()->getTipo()?></td>
      <td><div align="left"><span class="Estilo2"><?php echo $solicitud->getDocente()->getFacultad()->getNombre()?></span></div></td>
      <td><div align="left"><?php echo $solicitud->getDocente()->getNombre()?> <?php echo $solicitud->getDocente()->getApellido1()?> <?php echo $solicitud->getDocente()->getApellido2()?></div></td>
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
		$ruta=$path['upload'].$solicitud->getDocente()->getCedula()."/solicitud".$solicitud->getId().".pdf";
		$imagen=$path['imagenes']."iconos/pdf.png ";
		if(file_exists($ruta)){
			$documento = '<a href="'.$ruta.'"> <img src="'.$imagen.'" width="20" height="20" border="0" /></a>';
		} 
		$docente = $solicitud->getDocente();
		$resumeold=$path['upload'].$docente->getCedula()."/resume.pdf";
		$imagen=$path['imagenes']."iconos/pdf.png ";
		if (file_exists($resumeold)) {
			$resume = '<a href="'.$resumeold.'"> <img src="'.$imagen.'" width="20" height="20" border="0" /></a>';
		} ?>
  </p>
    <table width="100%" border="0">
      <tr>
        <td bgcolor="#000066"><div align="center"><?php if($solicitud->getRespuestaId()==0) echo '<a href="responder.php?id='.$solicitud->getId().'">
	  <img src="../../../imagenes/acciones/calificar.png" width="16" height="16" border="0" /></a>'; ?></div>
            <div align="center"></div></td>
        <td bgcolor="#000066"><a name="<?php echo $solicitud->getId()?>" id="<?php echo $solicitud->getId()?>"></a><a href="#inicio">Inicio</a></td>
        <td bordercolor="0" bgcolor="#000066"><div align="center"><span class="Estilo1"><?php echo $solicitud->getDocente()->getFacultad()->getNombre() ?></span></div></td>
      </tr>
      <tr>
        <td width="20%" colspan="2" bgcolor="#638CB5"><div align="left" class="Estilo1">Numero</div></td>
        <td width="80%" bordercolor="0" bgcolor="#DDEDFF"><div align="left"><?php echo $solicitud->getId()?></div></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#638CB5"><div align="left"><span class="Estilo1">Cedula</span></div></td>
        <td width="80%" bordercolor="0" bgcolor="#DDEDFF"><div align="left"><?php echo $solicitud->getDocente()->getCedula()?></div></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#638CB5"><div align="left" class="Estilo1">Nombre</div></td>
        <td bordercolor="0" bgcolor="#DDEDFF"><div align="left"><?php echo $solicitud->getDocente()->getNombre()?></div></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#638CB5"><div align="left" class="Estilo1">Objetivo</div></td>
        <td bordercolor="0"><div align="left"><?php echo $solicitud->getObjetivo()?></div></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#638CB5"><div align="left" class="Estilo1">Pa&iacute;s</div></td>
        <td bordercolor="0"><div align="left"><?php echo $solicitud->getPais()->getPais()?></div></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#638CB5"><div align="left" class="Estilo1">Lugar</div></td>
        <td bordercolor="0"><div align="left"><?php echo $solicitud->getLugar()?></div></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#638CB5"><div align="left" class="Estilo1">fecha de inicio </div></td>
        <td bordercolor="0"><div align="left"><?php echo $solicitud->getFecha1()?></div></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#638CB5"><div align="left" class="Estilo1">Fecha de terminaci&ograve;n </div></td>
        <td bordercolor="0"><div align="left"><?php echo $solicitud->getFecha2()?></div></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#638CB5"><div align="left"><span class="Estilo1">Documentaci&oacute;n</span></div></td>
        <td bordercolor="0"><div align="left"><a href="../docentes/historial.php?id=">
          <?php echo $documento; ?>
        </a></div></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#638CB5"><div align="left"><span class="Estilo1">Hoja de vida </span></div></td>
        <td bordercolor="0"><div align="left"><a href="../docentes/historial.php?id=">
          <?php echo $resume; ?>
        </a></div></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#638CB5" class="Estilo1"><div align="left">Historial</div></td>
        <td bordercolor="0"><div align="left"> <a href="../docentes/historial.php?id=<?php echo $solicitud->getDocenteId()?>"><img src="../../../imagenes/iconos/historial.jpg" width="20" height="20" border="0" /></a><a href="../docentes/historial.php?id=<?php echo $solicitud->getDocenteId()?>"></a></div></td>
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
    <table width="100%" border="0">
      <tr>
        <td><?php echo $acta->getAnexo() ?></td>
      </tr>
  </table>
    <p>&nbsp;</p>
</div>
-->
</body>
</html>
