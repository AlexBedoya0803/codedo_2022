<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

<link rel="stylesheet" href="../../../js/calendar/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="../../../js/calendar/mootools-1.2-core.js"></script>
<script type="text/javascript" src="../../../js/calendar/_class.datePicker.js"></script>
<script type="text/javascript" src="../../../js/calendar/funciones/fecha3.js"></script>
<script type="text/javascript" src="../../../js/funciones.js"></script>
<?php require_once('lista_c.php');?>
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
</style>
<link rel="stylesheet" href="../../../estilos/cupertino/jquery-ui-1.8.12.custom.css">
<link rel="stylesheet" href="../../../estilos/demos.css">
<script src="../../../js/jquery-1.5.1.min.js"></script>
<script src="../../../js/jquery-ui-1.8.12.custom.min.js"></script>
<script>
$(function() {$( "#fecha" ).datepicker();});
$(function() {$( "#fecha1" ).datepicker();});
$(function() {$( "#fecha2" ).datepicker();});
</script>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0" align="center">
    <tr>
      <td width="16%" bgcolor="#0A351C"><span class="Estilo1">Estado </span></td>
      <td width="34%" bgcolor="#ADC0B7"><label>
        <input name="estado" type="radio" value="1" />
Abierta</label>
        <label>
        <input type="radio" name="estado" value="0" />
Cerrada
<input name="estado" type="radio" value="null" checked="checked" />
Cualquiera
      </label></td>
      <td width="23%" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="27%" bgcolor="#0A351C"><div align="center"><span class="Estilo1">Crear Acta nueva </span></div></td>
    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo1">Numero </span></td>
      <td bgcolor="#ADC0B7">Entre
        <select name="actas1" id="actas1" onchange="PosicionarCombo(this,'actas2')">
		 <option value="" selected="selected"> </option>
          <?php foreach($actas1 as $acta) { ?>
          <option value="<?php echo $acta->getId(); ?>"><?php echo $acta->getId()?> </option>
          <?php } ?>
        </select>
       y 
       <select name="actas2" id="actas2"onchange="Validar('actas1','actas2')">
	   <option value="" selected="selected"> </option>
         <?php foreach($actas1 as $acta) { ?>
         <option value="<?php echo $acta->getId(); ?>"><?php echo $acta->getId()?> </option>
         <?php } ?>
       </select></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#ADC0B7">
        <div align="center">Fecha del acta</div></td>
    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo1">Fecha</span></td>
      <td bgcolor="#ADC0B7">Entre
      <input name="fecha1" type="text" id="fecha1" size="20" readonly="readonly"/>
      y
      <input name="fecha2" type="text" id="fecha2" size="20" readonly="readonly"/></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#ADC0B7">
        <div align="center">
          <input type="text" name="fecha" id="fecha"/>
      </div></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#ADC0B7"><div align="center">
        <input style="background-color:#6C9A06" name="consulta" type="submit" class="button" id="consulta" value="Realizar consulta" />
      </div></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#ADC0B7"><div align="center">
        <input style="background-color:#6C9A06"name="nuevo" type="submit" class="button" id="nuevo" value="Crear Acta " />
      </div></td>
    </tr>
  </table>
</form>


<table width="101%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td colspan="3" bgcolor="#6C9A06"><span class="Estilo1"><a href="../../auxiliar/costos/nuevo.php">Acciones</a></span></td>
    <td width="73" bgcolor="#6C9A06"><span class="Estilo1">Numero</span></td>
    <td width="93" bordercolor="#ECECFF" bgcolor="#6C9A06"><span class="Estilo1">Fecha</span></td>
    <td width="618" bordercolor="#ECECFF" bgcolor="#6C9A06"><span class="Estilo1">Estado</span></td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  
  <?php 
 $color="#FFFFFF";
  foreach ($actas as $acta)
 {
 if($color=="#FFFFFF")
 $color="#DDEDFF";
 else
 $color="#FFFFFF";
 ?>
  <tr bgcolor="<?php echo $color ?>">
    <td width="38"><a href="ver.php?id=<?php echo $acta->getId() ?>"><img src="../../../imagenes/acciones/b_view.png" width="16" height="16" border="0" title="Ver acta"/></a><a href="actaHtml_c.php?id=<?php echo $acta->getId() ?>&reporte=2" target="_blank"><img src="../../../imagenes/iconos/icono_word.gif" width="16" height="16" border="0" title="Descargar acta"/></a></td>
    <td width="21"><a href="editar.php?id=<?php echo $acta->getId() ?>"><img src="../../../imagenes/acciones/b_edit.png" width="16" height="16" border="0" title="Editar acta"/></a></td>
    <td width="59">
	<?php $solicitudes=$acta->getNumeroSolicitudes();
	 if($solicitudes<1)
	{?>
	<div align="left"><a href="borrar.php?id=<?php echo $acta->getId() ?>">
	<img src="../../../imagenes/acciones/b_drop.png" width="16" height="16" border="0" />
	</a></div>
	<?php }
	elseif($acta->getAbierta()) {
		{?>
	<div align="left"><a href="cerrar.php?id=<?php echo $acta->getId() ?>">
	<img src="../../../imagenes/acciones/lock.png" width="16" height="16" border="0" title="cerrar acta"/>
	</a></div>
	<?php }
	}?>
	</td>
    <td><?php echo $acta->getId();?></td>
    <td><?php echo $acta->getFecha();?></td>
    <td><?php if($acta->getAbierta()==1){
						echo 'Abierta';
					}else {
						echo 'Cerrada';
						}?></td>
  </tr>
  <?php }?>
</table>
</body>
</html>
