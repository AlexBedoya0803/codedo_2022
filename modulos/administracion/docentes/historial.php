<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<?php require_once('historial_c.php');?>
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
    <td bgcolor="#FFFFFF"><?php echo $resume; ?>
	</td>
  </tr>
</table>
<p align="center" class="Arial_12_B">Solicitudes</p>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="52" bgcolor="#638CB5"><div align="left"></div></td>
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
  foreach ($solicitudes as $solicitud)
 {
 if($color=="#FFFFFF")
 $color="#DDEDFF";
 else
 $color="#FFFFFF";
 ?>
  <tr bgcolor="<?php echo $color ?>">
    <td height="18"><div align="left"><span class="Estilo2"><a href="../solicitudes/ver.php?id=<?php echo $solicitud->getId() ?>"><img src="../../../imagenes/acciones/b_view.png" width="16" height="16" border="0" /></a>
    <?php
		$imgEstado="../../../imagenes/iconos/";
		$estado = $solicitud->getEstadoId();
		if($estado == 3){
			$imgEstado = $imgEstado."Checked.png";
		}else if($estado==4){
			$imgEstado = $imgEstado."Delete.png";
		}else{
			$imgEstado = $imgEstado."wait3.png";	
		}
	?>
    <img src="<?php echo $imgEstado;?>" width="16" height="16" border="0" />
     </span> </div>
        <div align="left" class="Estilo2"></div></td>
    <td height="18"><?php echo $solicitud->getId()?></td>
    <td><div align="left"><span class="Estilo2"><?php echo $solicitud->getObjetivo()?></span></div></td>
    <td><span class="Estilo2"><?php echo $solicitud->getPais()->getPais()
?></span></td>
    <td><div align="left"><span class="Estilo2"><?php echo $solicitud->getFecha1()?></span></div></td>
    <td><div align="left"><span class="Estilo2"><?php echo $solicitud->getFecha2()?></span></div></td>
  </tr>
  <?php }?>
</table>
<!--
<p>
  <?php foreach ($solicitudes as $solicitud){?>
</p>
<table width="100%" border="1">
  <tr>
    <td width="20%" bgcolor="#000066"><div align="center"><a name="<?php echo $solicitud->getId()?>" id="<?php echo $solicitud->getId()?>"></a><a href="#inicio" class="Estilo1">Inicio</a></div>
        <div align="center"></div></td>
    <td colspan="2" bordercolor="0" bgcolor="#000066"><div align="center"><span class="Estilo1"><?php echo $solicitud->getDocente()->getFacultad()->getNombre() ?></span></div></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><span class="Estilo1">Tipo de solicitud </span></td>
    <td width="30%" bordercolor="0"><?php echo $solicitud->getTiposolicitud()->getTipo()?></td>
    <td width="50%" rowspan="7" bordercolor="0"><div align="center"><img src="../../../imagenes/estados/<?php echo $solicitud->getEstadoId()?>.png" width="500" height="214" /></div></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><div align="left" class="Estilo1 Estilo1">Acta</div></td>
    <td bordercolor="0"><div align="left"><?php echo $solicitud->getActaId()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><div align="left" class="Estilo1 Estilo1">Fecha de inicio </div></td>
    <td bordercolor="0"><div align="left"><?php echo $solicitud->getFecha1()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><div align="left" class="Estilo1 Estilo1">Fecha de terminaci&ograve;n </div></td>
    <td bordercolor="0"><div align="left"><?php echo $solicitud->getFecha2()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><div align="left" class="Estilo1 Estilo1"><span class="Estilo1">Dedicaci&ograve;n</span></div></td>
    <td bordercolor="0"><div align="left"><?php echo $solicitud->getDedicacion()->getNombre()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><div align="left" class="Estilo1 Estilo1">Estado</div></td>
    <td bordercolor="0"><div align="left"><?php echo $solicitud->getEstado()->getEstado()?></div></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><span class="Estilo1">Pa&iacute;s</span></td>
    <td bordercolor="0"><?php echo $solicitud->getPais()->getPais()?></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><span class="Estilo1 Estilo1"><span class="Estilo1">Lugar</span></span></td>
    <td colspan="2" bordercolor="0"><?php echo $solicitud->getLugar()?></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><span class="Estilo1">Objetivo</span></td>
    <td colspan="2" bordercolor="0"><?php echo $solicitud->getObjetivo()?></td>
  </tr>
  <tr>
    <td bgcolor="#638CB5"><span class="Estilo1">Motivo</span></td>
    <td colspan="2" bordercolor="0"><?php echo $solicitud->getMotivo()->getMotivo()?></td>
  </tr>
</table>
<p>
  <?php } ?>
</p>
-->
</body>
</html>
