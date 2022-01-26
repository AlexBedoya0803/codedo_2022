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
<?php require_once('texto_c.php');?>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--

-->
</style>
</head>
<body>
<div align="center" class="Estilo11">
  <p align="left" class="Estilo6"><span class="Estilo9"><strong><span class="Estilo15">C</span><span class="Estilo16">OMIT&Eacute; DE DESARROLLO DEL PERSONAL DOCENTE</span></strong><span class="Estilo16"><br />
Acta: <?php echo $id  ." de ".$acta->getFecha() ?></span></span></p>
  <p class="Estilo16">
      <?php foreach ($solicitudes as $solicitud){ 
	  	$docente = $solicitud->getDocente(); 
		$resumeold=$path['upload'].$docente->getCedula()."/resume.pdf";
		$imagen=$path['imagenes']."iconos/pdf.png ";
		if (file_exists($resumeold)){
			$resume = '<a href="'.$resumeold.'"> <img src="'.$imagen.'" width="20" height="20" border="0" /></a>';
		} 
		$ruta=$path['upload'].$solicitud->getDocente()->getCedula()."/solicitud".$solicitud->getId().".pdf";
		$imagen=$path['imagenes']."iconos/pdf.png ";
		if(file_exists($ruta)){
			$documento = '<a href="'.$ruta.'"> <img src="'.$imagen.'" width="20" height="20" border="0" /></a>';
		} ?>
  <HR width=100% align="left">
  <div align="left" class="Estilo16">
    <div><span ">Facultad de <?php echo $solicitud->getFacultad()->getNombre() ?>  </span> </div>
  </div>
  <HR width=100% align="left"> 
  <span class="Estilo16"><span style="text-decoration: underline;">  </span>
  <table width="100%" border="0">
    <tr>
      <td width="16%" height="20" bgcolor="#FFFFFF" class="Estilo16"><div align="center" class="Estilo17">
          <div align="left">Solicitud # </div>
      </div>          </td>
      <td width="84%" height="20" bgcolor="#FFFFFF" class="Estilo16"><div align="left"><?php echo $solicitud->getId()?></div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="Estilo4"><div align="left">Docente: </div></td>
      <td bordercolor="0" bgcolor="#FFFFFF" class="Estilo16"><div align="left"><?php echo $solicitud->getDocente()->getCedula()?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2(); ?></div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="Estilo1 Estilo11 Estilo15"><div align="left">Actividad:</div></td>
      <td bordercolor="0" bgcolor="#FFFFFF" class="Estilo16"><div align="left"><?php echo $solicitud->getObjetivo()?></div></td>
    </tr>
    <tr>
      <td height="20" bgcolor="#FFFFFF" class="Estilo16"><div align="left"></div></td>
      <td bordercolor="0" bgcolor="#FFFFFF" class="Estilo16"><div align="left"></div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="Estilo16"><div align="left" class="Estilo1 Estilo19">
        <div align="left">Lugar:</div>
      </div></td>
      <td bordercolor="0" bgcolor="#FFFFFF" class="Estilo16"><div align="left"><?php echo $solicitud->getLugar()?></div></td>
    </tr>
    <tr>
      <td height="20" bgcolor="#FFFFFF" class="Estilo4"><div align="left">Pa&iacute;s: </div></td>
      <td bordercolor="0" bgcolor="#FFFFFF" class="Estilo16"><div align="left"><?php echo $solicitud->getPais()->getPais()?></div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="Estilo4"><div align="left">Tipo: </div></td>
      <td bordercolor="0" bgcolor="#FFFFFF" class="Estilo16"><div align="left"><?php echo $solicitud->getTiposolicitud()->getTipo()?></div></td>
    </tr>
    <tr>
      <td height="20" bgcolor="#FFFFFF" class="Estilo4"><div align="left">Fecha de inicio: </div></td>
      <td bordercolor="0" bgcolor="#FFFFFF" class="Estilo16"><div align="left"><?php echo $solicitud->getFecha1()?></div></td>
    </tr>
    <tr>
      <td height="20" bgcolor="#FFFFFF" class="Estilo16"><div align="left" class="Estilo6">
        <div align="left">Fecha de terminaci&ograve;n: </div>
      </div></td>
      <td bordercolor="0" bgcolor="#FFFFFF" class="Estilo16"><div align="left"><?php echo $solicitud->getFecha2()?></div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="Estilo4"><div align="left">Dedicaci&oacute;n:</div></td>
      <td bordercolor="0" bgcolor="#FFFFFF" class="Estilo16"><div align="left"><?php echo $solicitud->getDedicacion()->getNombre()?></div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" ><div align="left">Observaciones:</div></td>
      <td bordercolor="0" bgcolor="#FFFFFF" ><div align="left"><?php echo $solicitud->getObservaciones()?></div></td>
    </tr>
    <tr>
      <td><div align="left">Recomendaci&oacute;n:</div></td>
      <td><div align="left"><span class="Estilo16"><?php echo $solicitud->getRecomendacion()?></span></div></td>
    </tr>
    
    
  </table>
  <p class="Estilo16">
  <?php } ?>
</p>

  <p class="Estilo16">&nbsp;</p>
</div>
</body>
</html>
