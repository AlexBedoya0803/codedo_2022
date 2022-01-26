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
<table width="100%" height="579" border="1">
  <tr>
    <td colspan="4" bgcolor="#0A351C"><div align="center" class="Estilo1">Datos del docente </div></td>
  </tr>
  <tr>
    <td width="13%" bgcolor="#6C9A06"><div align="left" class="Estilo1">Facultad</div></td>
    <td colspan="3" bordercolor="0" bgcolor="#DDEDFF"><div align="left" class="Estilo2"><?php echo $solicitud->getDocente()->getFacultad()->getNombre()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><span class="Estilo1">Cedula</span></td>
    <td colspan="3" bordercolor="0" bgcolor="#DDEDFF"><?php echo $solicitud->getDocente()->getCedula()?></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><div align="left" class="Estilo1">Nombre</div></td>
    <td colspan="3" bordercolor="0" bgcolor="#DDEDFF"><div align="left"><?php echo $solicitud->getDocente()->getNombre()?><?php echo " "?><?php echo $solicitud->getDocente()->getApellido1()?><?php echo " "?><?php echo $solicitud->getDocente()->getApellido2()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06" class="Estilo1">Correo</td>
    <td colspan="3" bordercolor="0" bgcolor="#DDEDFF"><?php echo $solicitud->getDocente()->getCorreo()?></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><div align="left"><span class="Estilo1">Hoja de vida </span></div></td>
    <td colspan="3" bordercolor="0" bgcolor="#DDEDFF"><div align="left">
        <?php echo $documento; ?>
        <a href="../docentes/resume.php?id=<?php echo $solicitud->getDocenteId()?>"><img src="../../../imagenes/acciones/anexar.gif" width="16" height="16" border="0" /></a></div></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06" class="Estilo1"><div align="left">Historial</div></td>
    <td colspan="3" bordercolor="0"><div align="left"> <a href="../docentes/historial.php?id=<?php echo $solicitud->getDocenteId()?>"><img src="../../../imagenes/iconos/historial.jpg" width="16" height="16" border="0" /></a></div></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#FFFFFF"><div align="left" class="Estilo1"></div>      <div align="left"></div></td>
  </tr>
  <tr>
    <td height="26" colspan="4" bgcolor="#0A351C"><div align="center" class="Estilo1">Datos de la solicitud </div></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06" class="Estilo1">Numero</td>
    <td colspan="2" bordercolor="0" bgcolor="#DDEDFF"><?php echo $solicitud->getId()?></td>
    <td width="62%" rowspan="9" bordercolor="0" bgcolor="#FFFFFF"><!--<div align="center"><img src="../../../imagenes/estados/<?php echo $solicitud->getEstadoId()?>.png" width="500" height="195" /></div>--></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06" class="Estilo1">Tipo </td>
    <td width="14%" bordercolor="0"><?php echo $solicitud->getTiposolicitud()->getTipo()?></td>
    <td width="11%" bordercolor="0" bgcolor="#6C9A06"><?php echo $link_comision?></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><div align="left" class="Estilo1">Acta</div></td>
    <td colspan="2" bordercolor="0"><div align="left"><?php echo $solicitud->getActaId()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><span class="Estilo1">Fecha de inicio </span></td>
    <td colspan="2" bordercolor="0"><?php echo $solicitud->getFecha1()?></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><div align="left" class="Estilo1">Fecha de terminaci&ograve;n </div></td>
    <td colspan="2" bordercolor="0"><div align="left"><?php echo $solicitud->getFecha2()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><span class="Estilo1">Estado </span></td>
    <td colspan="2" bordercolor="0"><?php echo $solicitud->getEstado()->getEstado()?></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><div align="left" class="Estilo1">Dedicaci&oacute;n</div></td>
    <td colspan="2" bordercolor="0"><div align="left"><?php echo $solicitud->getDedicacion()->getNombre()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><span class="Estilo1">Pa&iacute;s </span></td>
    <td colspan="2" bordercolor="0"><?php echo $solicitud->getPais()->getPais()?></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06" class="Estilo1">Motivo</td>
    <td colspan="3" bordercolor="0"><?php echo $solicitud->getMotivo()->getMotivo()?></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><div align="left" class="Estilo1">Lugar</div></td>
    <td colspan="3" bordercolor="0"><div align="left"><?php echo $solicitud->getLugar()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><span class="Estilo1">Objetivo</span></td>
    <td colspan="3" bordercolor="0"><?php echo html_entity_decode($solicitud->getObjetivo())?></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><span class="Estilo1">Respuesta</span></td>
    <td colspan="3" bordercolor="0"><?php echo $solicitud->getRespuesta()->getRespuesta()?></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><span class="Estilo1">Observaciones</span></td>
    <td colspan="3" bordercolor="0"><?php echo $solicitud->getObservaciones()?></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><span class="Estilo1">Recomendacion</span></td>
    <td colspan="3" bordercolor="0"><?php echo $solicitud->getRecomendacion()?></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><span class="Estilo1">Resolucion</span></td>
    <td colspan="3" bordercolor="0"><?php echo $solicitud->getResolucion()?></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><span class="Estilo1">Fecha Resolucion</span></td>
    <td colspan="3" bordercolor="0"><?php echo $solicitud->getFechaResolucion()?></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><span class="Estilo1">Inicio Resolucion</span></td>
    <td colspan="3" bordercolor="0"><?php echo $solicitud->getInicioResolucion()?></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06"><span class="Estilo1">Fin Resolucion</span></td>
    <td colspan="3" bordercolor="0"><?php echo $solicitud->getFinResolucion()?></td>
  </tr>
  <tr>
    <td bgcolor="#6C9A06" class="Estilo1"><div align="left">Anexos</div></td>
    <td bordercolor="0"><div align="left"> <a href="../comite/ListarAnexos.php?id=<?php echo $solicitud->getId()?>"><img src="../../../imagenes/iconos/documentos.jpg" width="20" height="20" border="0" /></a></div></td>
  </tr>
  
</table>
</body>
</html>
