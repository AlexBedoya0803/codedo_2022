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

<script>
	var id;
	function enviar(value){
		//alert(value);
		//alert(value);
		var valores  =  value.split(",");
		//alert(valores[0]);
		id=valores[0];
		document.getElementById("msg").innerHTML = "Deseas enviar notificación al profesor(a) "+valores[1]+", notificado(a) por última vez en "+valores[2];
		document.getElementById("myModal").style.display="block";
		//document.getElementById('cancelar').onclick = cancelar;
		//document.getElementById('continuar').addEventListener("click", continuar(), false);
		document.getElementById("continuar").onclick = continuar;
	}
	
	function continuar(){
			/////alert(id);
			//var boton = document.getElementById("continuar");
			location = "./NotificarDocente.php?id="+id;
	}
</script>
<?php 
	require_once('lista_c.php');
	require_once('./MsgNotificacion.php');
	MsgNotificacion::getMsgNotificacion("***","",'cancelar','continuar');
?>

<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />

</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td colspan="3" bgcolor="#6C9A06"><span class="Estilo1">Acciones</span></td>
    <td bgcolor="#6C9A06" class="Estilo1">Comision</td>
    <td bgcolor="#6C9A06" class="Estilo1">Facultad </td>
    <td bgcolor="#6C9A06" class="Estilo1">Cedula </td>
    <td bgcolor="#6C9A06" class="Estilo1">Nombre</td>
    <td bordercolor="#ECECFF" bgcolor="#6C9A06" class="Estilo1">Motivo</td>
    <td bordercolor="#ECECFF" bgcolor="#6C9A06" class="Estilo1">Fecha inicio </td>
    <td bordercolor="#ECECFF" bgcolor="#6C9A06" class="Estilo1">Fecha terminaci&oacute;n </td>
    <td bordercolor="#ECECFF" bgcolor="#6C9A06" class="Estilo1">Pa&iacute;s</td>
  	<td bordercolor="#ECECFF" bgcolor="#6C9A06" class="Estilo1">Fecha Notificaci&oacute;n</td>
  </tr>
  <tr>
    <td colspan="11" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <?php 
 $color="#FFFFFF";
 
  foreach ($comisiones as $comision)
 {
	
	$docente = $comision->getDocente(); 
	$resumeold=$path['upload'].$docente->getCedula()."/resume.pdf";
	$imagen=$path['imagenes']."iconos/pdf.png ";
	if (file_exists($resumeold)){
		$resume = '<a href="'.$resumeold.'"> <img src="'.$imagen.'" width="20" height="20" border="0" /></a>';
	} 
	$ruta=$path['upload'].$docente->getCedula()."/solicitud".$comision->getId().".pdf";
	$imagen=$path['imagenes']."iconos/pdf.png ";
	if(file_exists($ruta)){
		$documento = '<a href="'.$ruta.'"> <img src="'.$imagen.'" width="20" height="20" border="0" /></a>';
	}
	if($color=="#FFFFFF")
		$color="#DDEDFF";
	else
		$color="#FFFFFF";
 ?>
  <tr bgcolor="<?php echo $color ?>">
  	<? //print_r($comision); 
	//exit;?>
    <td width="39">
    <a href="ver.php?id=<?php echo $comision->getId() ?>"><img src="../../../imagenes/acciones/b_view.png" width="16" height="16" border="0" /></a><a href="../solicitudes/lista.php?id=<?php echo $comision->getId() ?>"><img src="../../../imagenes/iconos/zip.png" width="16" height="16" border="0" /></a><?php
    	if($session->getVal("boton")!=null){
			$idC = $comision->getId();
			$profesor = $comision->getDocente()->getNombre()." ".$comision->getDocente()->getApellido1();
			$fechaN = $comision->getFechaNotificacion();
			$param = "'".$idC.",".$profesor.",".$fechaN."'";
			echo '<img src="../../../imagenes/acciones/mail.png" width="16" id="'.$comision->getId().'" height="16" border="0" onClick="enviar('.$param.')"/>';
		}
	?></td>
	<td width="17"><?php echo $resume;//$comision->getDocente()->resume($path['imagenes'],$path['upload'],20,20)?></td>
    <td width="21"><?php echo $documento;//$comision->documentos($path['imagenes'],$path['upload'],20,20)?></td>
    <td width="67"><?php echo $comision->getId()?></td>
    <td width="63"><?php echo $comision->getDocente()->getFacultad()->getNombre()?></td>
    <td width="68"><?php echo $comision->getDocente()->getCedula()?></td>
    <td width="201"><?php echo $comision->getDocente()->getNombre()?> <?php echo $comision->getDocente()->getApellido1()?> <?php echo $comision->getDocente()->getApellido2()?></td>
    <td width="163"><?php echo $comision->getMotivo()->getMotivo()?></td>
    <td width="94"><?php echo $comision->getFecha1()?></td>
    <td width="66"><?php echo $comision->getFechaf()?></td>
    <td width="93"><?php echo $comision->getPais()->getPais()?></td>
  	<td width="66"><?php echo $comision->getFechaNotificacion()?></td>
  </tr>
  <?php }

  ?>
</table>

</body>
</html>
