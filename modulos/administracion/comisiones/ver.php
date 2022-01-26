<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo2 {color: #000000}
-->
</style>
<?php require_once('ver_c.php');?>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" height="500" border="1">
  <tr>
    <td colspan="2" bgcolor="#000066"><div align="center" class="Estilo1">Datos del docente </div></td>
  </tr>
  <tr>
    <td width="20%" bgcolor="#638CB5"><div align="left" class="Estilo1">Facultad</div></td>
    <td width="80%" bordercolor="0" bgcolor="#DDEDFF"><div align="left" class="Estilo2"><?php echo $comision->getDocente()->getFacultad()->getNombre() ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><span class="Estilo1">Cedula</span></td>
    <td bordercolor="0" bgcolor="#DDEDFF"><?php echo $comision->getDocente()->getCedula()?></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><div align="left" class="Estilo1">Nombre</div></td>
    <td bordercolor="0" bgcolor="#DDEDFF"><div align="left"><?php echo $comision->getDocente()->getNombre()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5" class="Estilo1">Correo</td>
    <td bordercolor="0" bgcolor="#DDEDFF"><?php echo $comision->getDocente()->getCorreo()?></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><div align="left"><span class="Estilo1">Hoja de vida </span></div></td>
    <td bordercolor="0" bgcolor="#DDEDFF"><div align="left">
        <?php $documento?>
        <a href="../docentes/resume.php?id=<?php echo $comision->getDocenteId()?>"><img src="../../../imagenes/acciones/anexar.gif" width="16" height="16" border="0" /></a></div></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5" class="Estilo1"><div align="left">Historial</div></td>
    <td bordercolor="0"><div align="left"> <a href="../../../imagenes/iconos/historial.jpg?id=<?php echo $comision->getDocenteId()?>"><img src="../../../imagenes/iconos/historial.jpg" width="16" height="16" border="0" /></a></div></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><div align="left" class="Estilo1"></div>      <div align="left"></div></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#000066"><div align="center" class="Estilo1">Datos de la comision </div></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5" class="Estilo1">Numero</td>
    <td bordercolor="0" bgcolor="#DDEDFF"><?php echo $comision->getId()?></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><div align="left" class="Estilo1">Objetivo</div></td>
    <td bordercolor="0"><div align="left"><?php echo $comision->getObjetivo()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><div align="left" class="Estilo1">Pa&iacute;s</div></td>
    <td bordercolor="0"><div align="left"><?php echo $comision->getPais()->getPais()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><div align="left" class="Estilo1">Lugar</div></td>
    <td bordercolor="0"><div align="left"><?php echo $comision->getLugar()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><div align="left" class="Estilo1">fecha de inicio </div></td>
    <td bordercolor="0"><div align="left"><?php echo $comision->getFecha1()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><div align="left" class="Estilo1">Fecha de terminaci&ograve;n </div></td>
    <td bordercolor="0"><div align="left"><?php echo $comision->getFechaf()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5" class="Estilo1">Motivo</td>
    <td bordercolor="0"><?php echo $comision->getMotivo()->getMotivo()?></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5" class="Estilo1">Observaciones</td>
    <td bordercolor="0"><?php echo $comision->getObservaciones()?></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5" class="Estilo1">Pr&oacute;rrogas</td>
    <td bordercolor="0"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td width="134" bgcolor="#638CB5"><span class="Estilo1">Acta </span></td>
        <td width="135" bgcolor="#638CB5"><span class="Estilo1">Fecha de inicio </span></td>
        <td width="159" bordercolor="#ECECFF" bgcolor="#638CB5"><span class="Estilo1">Fecha de finalizacion </span></td>
        <td width="298" bordercolor="#ECECFF" bgcolor="#638CB5"><span class="Estilo1">Dedicaci&oacute;n</span></td>
      </tr>
      <?php 
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
    <td bgcolor="#638CB5" class="Estilo1">Modificaciones</td>
    <td bordercolor="0"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td width="46" bgcolor="#638CB5"><span class="Estilo1">Acta</span></td>
        <td width="79" bgcolor="#638CB5" class="Estilo1">Motivo</td>
        <td width="109" bgcolor="#638CB5" class="Estilo1">Dedicaci&oacute;n</td>
        <td width="89" bgcolor="#638CB5" class="Estilo1">Inicio</td>
        <td width="65" bgcolor="#638CB5" class="Estilo1">Final</td>
        <td width="228" bgcolor="#638CB5" class="Estilo1">Estudios</td>
        <td width="90" bgcolor="#638CB5" class="Estilo1">Lugar</td>
      </tr>
      <?php 
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
</body>
</html>
