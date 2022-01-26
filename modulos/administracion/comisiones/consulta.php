<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script type="text/javascript" src="../../../js/funciones.js"></script>
<?php require_once('consulta_c.php');?>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../../../estilos/cupertino/jquery-ui-1.8.12.custom.css">
<link rel="stylesheet" href="../../../estilos/demos.css">
<script src="../../../js/jquery-1.5.1.min.js"></script>
<script src="../../../js/jquery-ui-1.8.12.custom.min.js"></script>
<script>
$(function() {$( "#fecha1Min" ).datepicker();});
$(function() {$( "#fecha1Max" ).datepicker();});
$(function() {$( "#fecha2Min" ).datepicker();});
$(function() {$( "#fecha2Max" ).datepicker();});
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0">
    <tr>
      <td width="14%" bgcolor="#0A351C"><span class="Estilo1">Tipo de consulta </span></td>
      <td width="86%" bgcolor="#0A351C"><span class="Estilo1">
        <label>
        <input name="Tipo" type="radio" onclick="Ocultar('compleja');Mostrar('simple');Ocultar('proximasVencer')" value="opci&oacute;n" />
Simple</label>
        <label></label>
        <label></label>
        <label>
        <input name="Tipo" type="radio" onclick="Mostrar('compleja');Ocultar('simple');Ocultar('proximasVencer')" value="opci&oacute;n" /> 
        Avanzada
</label>
        <label></label>
        
         <label>
        <input name="Tipo" type="radio" onclick="Ocultar('compleja');Mostrar('proximasVencer');Ocultar('simple')" value="opci&oacute;n" checked="checked" /> 
        Proximas a vencer</label>
        
        <label>
        <input name="Tipo" type="radio" onclick="Ocultar('compleja');Ocultar('simple')" value="opci&oacute;n" checked="checked" /> 
        Oculto</label>
      </span></td>
    </tr>
  </table>
  <table width="100%" border="0" id="simple" style="display:none">
    <tr>
      <td width="23%" bgcolor="#E8E8FF">Palabra clave </td>
      <td width="33%"><input name="palabra" type="text" id="palabra" size="50" /></td>
      <td width="44%"><input name="consulta_simple" type="submit" class="button" id="consulta_simple" value="Consultar" /></td>
    </tr>
  </table>
  
  <table width="100%" border="0" id="proximasVencer" style="display:none">
    <tr><td></br></td></tr>
    <tr>
    	<?php
			$date = date("Y-m-d");
		  	
		  	$fechaInicial =  strtotime ( '-3 month' , strtotime ( $date ) ) ;
			$fechaInicial = date ( 'Y-m-d' , $fechaInicial );
			
			$fechaFinal =  strtotime ( '+2 month' , strtotime ( $date ) ) ;
			$fechaFinal = date ( 'Y-m-d' , $fechaFinal );
			//echo $fechaInicial;
		?>
      <td width="5%" bgcolor="#E8E8FF">Desde</td>
      <td width="10%"><input name="fecha1" type="date" id="fecha1" size="50" value="<?php echo $fechaInicial?>"/></td>
      <td width="5%">Hasta</td>
      <td width="10%"><input name="fecha2" type="date" id="fecha2" size="50" value="<?php echo $fechaFinal?>"/></td>
      <td width="44%"><input name="consulta_proximas_vencer" type="submit" class="button" id="consulta_simple" value="Consultar" /></td>
    </tr>
  </table>
  
  <table width="100%" border="0" id="compleja" style="display:none">
    <tr>
      <td width="23%" bgcolor="#E8E8FF">Numero</td>
      <td colspan="2"><label>
        <input name="numero" type="text" id="numero" />
      </label></td>
    </tr>
    <tr>
      <td bgcolor="#E8E8FF">Cedula</td>
      <td colspan="2"><label>
        <input name="cedula" type="text" id="cedula" />
      </label></td>
    </tr>
    <tr>
      <td bgcolor="#E8E8FF">Nombre</td>
      <td colspan="2"><input name="nombre" type="text" id="nombre" size="50" /></td>
    </tr>
    <tr>
      <td bgcolor="#E8E8FF">Fecha inicio </td>
      <td colspan="2">
        <label>Desde: </label><input name="fecha1Min" type="text" id="fecha1Min" readonly="readonly"/>
        <label>Hasta: </label><input name="fecha1Max" type="text" id="fecha1Max" readonly="readonly"/>
      </td>
    </tr>
    <tr>
      <td bgcolor="#E8E8FF">Fecha terminaci&oacute;n </td>
      <td colspan="2">
        <label>Desde: </label><input name="fecha2Min" type="text" id="fecha2Min" readonly="readonly"/>
        <label>Hasta: </label><input name="fecha2Max" type="text" id="fecha2Max" readonly="readonly"/>
      </td>
    </tr>
    
    <tr>
      <td bgcolor="#E8E8FF">Estado</td>
      <td colspan="2"><select name="estados" id="estados" >
          <option value="" selected="selected"> </option>
          <?php foreach($estados as $estado) { ?>
          <option value="<?php echo $estado->getId(); ?>"><?php echo $estado->getEstado()?> </option>
          <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td bgcolor="#E8E8FF">Motivo</td>
      <td colspan="2"><select name="motivos" id="motivos" >
          <option value="" selected="selected"> </option>
          <?php foreach($motivos as $motivo) { ?>
          <option value="<?php echo $motivo->getId(); ?>"><?php echo $motivo->getMotivo()?> </option>
          <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td bgcolor="#E8E8FF">Dedicaci&oacute;n</td>
      <td colspan="2"><select name="dedicaciones" id="select" >
          <option value="" selected="selected"> </option>
          <?php foreach($dedicaciones as $dedicacion) { ?>
          <option value="<?php echo $dedicacion->getId(); ?>"><?php echo $dedicacion->getNombre()?> </option>
          <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td bgcolor="#E8E8FF">Pa&iacute;s</td>
      <td colspan="2"><select name="paises" id="paises" >
          <option value="" selected="selected"> </option>
          <?php foreach($paises as $pais) { ?>
          <option value="<?php echo $pais->getId(); ?>"><?php echo $pais->getPais()?> </option>
          <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="44%"><input name="consulta_compleja" type="submit" class="button" id="consulta_compleja" value="Consultar" /></td>
    </tr>
  </table>
</form>

<iframe src="lista.php" name="contenido3" width="99%" height="500" scrolling="Auto" frameborder="0" id="contenido2"></iframe>
</body>
</html>
