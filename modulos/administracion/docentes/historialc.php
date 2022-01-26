<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<?php require_once('historialc_c.php');?>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo2 {color: #000000}
-->
</style>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<p><a name="inicio" id="inicio"></a></p>
<table width="100%" border="0" align="center">
  <tr>
    <td width="193" bgcolor="#ECECFF">Nombre</td>
    <td width="297" bgcolor="#FFFFFF"><?php echo $docente->getNombre()?></td>
  </tr>
  <tr>
    <td bgcolor="#ECECFF">Apellido</td>
    <td width="297" bgcolor="#FFFFFF"><?php echo $docente->getApellido1()?> <?php echo $docente->getApellido2()?>
  </tr>
  <tr>
    <td bgcolor="#ECECFF">Cedula</td>
    <td bgcolor="#FFFFFF"><?php echo $docente->getCedula();?></td>
  </tr>
  <tr>
    <td bgcolor="#ECECFF">Facultad</td>
    <td bgcolor="#FFFFFF"><?php echo $docente->getFacultad()->getNombre()?></td>
  </tr>
  <tr>
    <td bgcolor="#ECECFF">Email</td>
    <td bgcolor="#FFFFFF"><?php echo $docente->getCorreo()?></td>
  </tr>
  <tr>
    <td bgcolor="#ECECFF">Hoja de vida </td>
    <td bgcolor="#FFFFFF"><?php echo  $docente->resume($path['imagenes'],$path['upload'],40,40)?>
	</td>
  </tr>
</table>
<p align="center" class="Arial_12_B">Comisiones</p>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="52" bgcolor="#638CB5"><div align="left"><span class="Estilo1">Link</span></div></td>
    <td width="63" bgcolor="#638CB5" class="Estilo1">Numero</td>
    <td width="117" bgcolor="#638CB5" class="Estilo1"><div align="left">Objetivo</div></td>
    <td width="117" bgcolor="#638CB5" class="Estilo1">Pa&iacute;s</td>
    <td width="167" bordercolor="#ECECFF" bgcolor="#638CB5"><div align="left"><span class="Estilo1">Fecha de Inicio </span></div></td>
    <td width="133" bordercolor="#ECECFF" bgcolor="#638CB5" class="Estilo1"><div align="left">Fecha de Finalizaci&oacute;n </div></td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <?php 
 $color="#FFFFFF";
  foreach ($comisiones as $comision)
 {
 if($color=="#FFFFFF")
 $color="#DDEDFF";
 else
 $color="#FFFFFF";
 ?>
  <tr bgcolor="<?php echo $color ?>">
    <td height="18"><div align="left"><span class="Estilo2"><a href="#<?php echo $comision->getId() ?>"><img src="../../../imagenes/acciones/b_view.png" width="16" height="16" border="0" /></a> </span> </div>
        <div align="left" class="Estilo2"></div></td>
    <td height="18"><?php echo $comision->getId()?></td>
    <td><div align="left"><span class="Estilo2"><?php echo $comision->getObjetivo()?></span></div></td>
    <td><span class="Estilo2"><?php echo $comision->getPais()->getPais()
?></span></td>
    <td><div align="left"><span class="Estilo2"><?php echo $comision->getFecha1()?></span></div></td>
    <td><div align="left"><span class="Estilo2"><?php echo $comision->getFecha2()?></span></div></td>
  </tr>
  <?php }?>
</table>
<p>
  <?php foreach ($comisiones as $comision){?>
<table width="100%" height="320" border="1">
  <tr>
    <td colspan="2" bgcolor="#000066"><div align="center" class="Estilo1"><?php echo $comision->getObjetivo()?></div></td>
  </tr>
  <tr>
    <td width="20%" height="22" bgcolor="#638CB5" class="Estilo1">Numero</td>
    <td width="80%" bordercolor="0" bgcolor="#DDEDFF"><?php echo $comision->getId()?></td>
  </tr>
  <tr>
    <td height="22" bgcolor="#638CB5"><div align="left" class="Estilo1">Objetivo</div></td>
    <td bordercolor="0"><div align="left"><?php echo $comision->getObjetivo()?></div></td>
  </tr>
  <tr>
    <td height="22" bgcolor="#638CB5"><div align="left" class="Estilo1">Pa&iacute;s</div></td>
    <td bordercolor="0"><div align="left"><?php echo $comision->getPais()->getPais()?></div></td>
  </tr>
  <tr>
    <td height="22" bgcolor="#638CB5"><div align="left" class="Estilo1">Lugar</div></td>
    <td bordercolor="0"><div align="left"><?php echo $comision->getLugar()?></div></td>
  </tr>
  <tr>
    <td height="22" bgcolor="#638CB5"><div align="left" class="Estilo1">fecha de inicio </div></td>
    <td bordercolor="0"><div align="left"><?php echo $comision->getFecha1()?></div></td>
  </tr>
  <tr>
    <td height="22" bgcolor="#638CB5"><div align="left" class="Estilo1">Fecha de terminaci&ograve;n </div></td>
    <td bordercolor="0"><div align="left"><?php echo $comision->getFecha2()?></div></td>
  </tr>
  <tr>
    <td height="22" bgcolor="#638CB5" class="Estilo1">Motivo</td>
    <td bordercolor="0"><?php echo $comision->getMotivo()->getMotivo()?></td>
  </tr>
  <tr>
    <td height="22" bgcolor="#638CB5" class="Estilo1">Observaciones</td>
    <td bordercolor="0"><?php echo $comision->getObservaciones()?></td>
  </tr>
  <tr>
    <td height="40" bgcolor="#638CB5" class="Estilo1">Pr&oacute;rrogas</td>
    <td bordercolor="0"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td width="134" bgcolor="#638CB5"><span class="Estilo1">Acta </span></td>
        <td width="135" bgcolor="#638CB5"><span class="Estilo1">Fecha de inicio </span></td>
        <td width="159" bordercolor="#ECECFF" bgcolor="#638CB5"><span class="Estilo1">Fecha de finalizacion </span></td>
        <td width="298" bordercolor="#ECECFF" bgcolor="#638CB5"><span class="Estilo1">Dedicaci&oacute;n</span></td>
      </tr>
      <?php 
	
	$consulta = new Criteria("prorrogas");
	$consulta->addFiltro("comision_id","=",$comision->getId() );
	$prorrogas=$consulta->execute(); 
    $color="#FFFFFF";
  foreach ($prorrogas as $prorroga)
 {
 if($color=="#FFFFFF")
 $color="#DDEDFF";
 else
 $color="#FFFFFF";
 ?>
      <tr bgcolor="<?php echo $color ?>">
        <td><?php echo $prorroga->getActaId()?></td>
        <td><?php echo $prorroga->getFecha1()?></td>
        <td><?php echo $prorroga->getFecha2()?></td>
        <td><?php echo $prorroga->getDedicacion()->getNombre()?></td>
      </tr>
      <?php }?>
    </table></td>
  </tr>
  <tr>
    <td height="40" bgcolor="#638CB5" class="Estilo1">Modificaciones</td>
    <td bordercolor="0"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td width="94" bgcolor="#638CB5"><span class="Estilo1">Acta</span></td>
        <td width="97" bgcolor="#638CB5" class="Estilo1">Motivo</td>
        <td width="99" bgcolor="#638CB5" class="Estilo1">Dedicaci&oacute;n</td>
        <td width="81" bgcolor="#638CB5" class="Estilo1">Inicio</td>
        <td width="85" bgcolor="#638CB5" class="Estilo1">Final</td>
        <td width="146" bgcolor="#638CB5" class="Estilo1">Objetivo</td>
        <td width="138" bgcolor="#638CB5" class="Estilo1">Lugar</td>
      </tr>
      <?php 
	$consulta = new Criteria("modificaciones");
	$consulta->addFiltro("comision_id","=",$comision->getId() );
	$modificaciones=$consulta->execute(); 
    $color="#FFFFFF";
  foreach ($modificaciones as $modificacion)
 {
 if($color=="#FFFFFF")
 $color="#DDEDFF";
 else
 $color="#FFFFFF";
 ?>
      <tr bgcolor="<?php echo $color ?>">
        <td><?php echo $modificacion->getActaId()?></td>
        <td><?php echo $modificacion->getMotivo()->getMotivo()?></td>
        <td><?php echo $modificacion->getDedicacion()->getNombre()?></td>
        <td><?php echo $modificacion->getFecha1()?></td>
        <td><?php echo $modificacion->getFecha2()?></td>
        <td><?php echo $modificacion->getObjetivo()?></td>
        <td><?php echo $modificacion->getLugar()?></td>
      </tr>
      <?php }?>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>
  <?php } ?>
</p>
</body>
</html>
