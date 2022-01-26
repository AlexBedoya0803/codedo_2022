<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" href="../../auxiliar/actas_abiertas/_web.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../../auxiliar/actas_abiertas/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../../../js/calendar/style.css" type="text/css" media="screen" />
<?php require_once('actas_c.php');?>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style></head>
<body>
<p align="center" class="Arial_12_B">actas Abiertas </p>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="56" bgcolor="#0A351C"><span class="Estilo1"><a href="../../auxiliar/costos/nuevo.php">Calificar</a></span></td>
    <td width="77" bgcolor="#0A351C"><span class="Estilo1">#</span></td>
    <td width="117" bordercolor="#ECECFF" bgcolor="#0A351C"><span class="Estilo1">Fecha</span></td>
    <td width="155" bordercolor="#ECECFF" bgcolor="#0A351C" class="Estilo1">Solcitudes Aprobadas </td>
    <td width="147" bordercolor="#ECECFF" bgcolor="#0A351C" class="Estilo1">Solcitudes No Aprobadas</td>
    <td width="132" bordercolor="#ECECFF" bgcolor="#0A351C" class="Estilo1">Solcitudes Sin evaluar </td>
    <td width="104" bordercolor="#ECECFF" bgcolor="#0A351C" class="Estilo1"> Total Solcitudes</td>
  </tr>
  <tr>
    <td colspan="7" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  
  <?php 
 $color="#FFFFFF";
  foreach ($actas as $acta) {
	$consulta1 = new Criteria("solicitudes");
	$consulta1->addFiltro("acta_id", "=", $acta->getId());
	$consulta1->addFiltro("estado_id","=",3);
	$numeroAprobadas = $consulta1->_count();
	$consulta1 = new Criteria("solicitudes");
	$consulta1->addFiltro("acta_id", "=", $acta->getId());
	$consulta1->addFiltro("estado_id","=",4);
	$numeroNoAprobadas = $consulta1->_count();
	$consulta=new Criteria("solicitudes");
	$consulta->addFiltro("acta_id","=",$acta->getId());
	$numeroSolicitudes = ($consulta->_count());
	$consulta=new Criteria("solicitudes");
	$consulta->addFiltro("acta_id","=",$acta->getId());
	$consulta->addFiltro("estado_id","=",6);
	$numeroSolicitudesAprobadas = ($consulta->_count());
	$consulta=new Criteria("Solicitudes");
	$consulta->addFiltro("acta_id","=",$acta->getId());
	$consulta->addFiltro("estado_id","=",7);
	$numeroSolicitudesNoAprobadas = ($consulta->_count());
 if($color=="#FFFFFF")
 $color="#DDEDFF";
 else
 $color="#FFFFFF";
 ?>
  <tr bgcolor="<?php echo $color ?>">
    <td><div align="center"><a href="solicitudes.php?id=<?php echo $acta->getId() ?>"><img src="../../../imagenes/acciones/calificar.jpg" width="16" height="16" border="0" title="Ver acta"/></a></div></td>
    <td><?php echo $acta->getId()?></td>
    <td><?php echo $acta->getFecha()?></td>
    <td><div align="center"><?php echo $numeroAprobadas?></div>
    <div align="center"></div></td>
    <td><div align="center"><?php echo $numeroNoAprobadas?></div>    </td>
    <td>
	  <div align="center">
	    <?php $sin_evaluar=$numeroSolicitudes-$numeroAprobadas-$numeroNoAprobadas;
echo $sin_evaluar?>
    </div></td>
    <td><div align="center"><?php echo $acta->getNumeroSolicitudes()?></div></td>
  </tr>
  <?php }?>
</table>
</body>
</html>
