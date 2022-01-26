<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pr&oacute;rroga</title>
<?php require_once('prorroga_c.php');?>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo3 {
	color: #0000FF;
	font-size: 16px;
	font-weight: bold;
}
.Estilo8 {color: #FFFFFF}
-->
</style>
<link rel="stylesheet" href="../../../estilos/cupertino/jquery-ui-1.8.12.custom.css">
<link rel="stylesheet" href="../../../estilos/demos.css">
<script src="../../../js/jquery-1.5.1.min.js"></script>
<script src="../../../js/jquery-ui-1.8.12.custom.min.js"></script>
<script type="text/javascript" src="../../../js/validarFiles.js"></script>
<script>
	$(function() {$( "#fecha1" ).datepicker();});
	$(function() {$( "#fecha2" ).datepicker();});
	$(function() {$( "#fechaActaCF" ).datepicker();});
	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
	
		$( "#dialog" ).dialog({
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
					location.href="../docentes/informacion.php";
				}
			}
		});
		$( "#error" ).dialog();
	});
</script>
</head>

<body>

<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data"> 
<fieldset   style="border:#0000FF ridge">
<legend ><span class="Estilo3">Pr&oacute;rroga</span></legend>
<table width="100%" border="0" align="center">
	<tr><td width="178" bgcolor="#527497"><span class="Estilo8">Comisiones:</span>
		<select name="comisiones" id="comisiones" onchange="PosicionarCombo(this,'objetivos')">
		<?php foreach($comisiones as $comision) {
			$value=$comision->getId();
			$text=$comision->getId();
			?>
			<option value="<?php echo $value;  
			if($formulario['comisiones']==$value) 
				echo'"selected="selected"';?>"><?php echo $text ?> </option>
		<?php } ?>
		</select>
	</td><td colspan="2" bgcolor="#527497">
		<select name="objetivos" id="objetivos" onchange="PosicionarCombo(this,'comisiones')">
		<?php foreach($comisiones as $comision) {
			$value=$comision->getId();
			$text=substr($comision->getObjetivo(),0,50);
			?>
			<option value="<?php echo $value;  
			if($formulario['objetivo']==$value) 
				echo'"selected="selected"';?>"><?php echo $text ?> </option>
		<?php } ?>
		</select>
		<input name="buscarcomision" type="submit" class="botonbuscar" id="buscarcomision" value="_" />
	</td></tr>
    <?php if($puedeGuardar) { ?>
	<tr><td width="172" bgcolor="#527497">
    	<span class="Estilo8">Facultad:</span>
    </td><td width="638" bgcolor="#FFFFFF">
    	<?php echo $comision->getFacultad()->getNombre(); ?>
    </td></tr>
    <tr><td width="172" bgcolor="#527497">
    	<span class="Estilo8">Motivo:</span>
    </td><td bgcolor="#FFFFFF">
        <?php echo $comision->getMotivo()->getMotivo(); ?>
    </td></tr>
    <tr><td bgcolor="#527497">
    	<span class="Estilo8">Tipo de comision </span>
    </td><td width="638" bgcolor="#FFFFFF">
    	<?php echo $comision->getTipoComision()->getTipo(); ?>
    </td></tr>
	<tr><td bgcolor="#527497">
    	<span class="Estilo8">Dedicaci&oacute;n a la comisi&oacute;n:</span>
    </td><td bgcolor="#FFFFFF">
    	<?php echo $comision->getDedicacion()->getNombre(); ?>
	</td></tr>
	
    
	
	<tr><td bgcolor="#527497">
    	<span class="Estilo8">Objetivo:</span>
    </td><td bgcolor="#FFFFFF">
    	<?php echo $formulario['objetivo'] ?>
    </td></tr>
	<tr><td bgcolor="#527497">
    	<span class="Estilo8">Lugar</span>
    </td><td bgcolor="#FFFFFF">
    	<?php echo $formulario['lugar'] ?>
    </td></tr>
    <tr><td bgcolor="#527497"><span class="Estilo8">
    	Pa&iacute;s:</span>
    </td><td bgcolor="#FFFFFF">
    	<?php echo $comision->getPais()->getPais(); ?>
    </td></tr>
	<tr>
    <td bgcolor="#527497">
    	<span class="Estilo8">Fecha de inicio de la pr&oacute;rroga:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="text" name="fecha1" id="fecha1" value="<?php echo $formulario['fechaf'] ?>"/>
    </td></tr>
    
	<tr>
    <td bgcolor="#527497">
    	<span class="Estilo8">Fecha de terminaci&oacute;n de la pr&oacute;rroga:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="text" name="fecha2" id="fecha2" value="<?php echo $fechaf2; ?>"/>
    </td></tr>
    <tr>
      <td bgcolor="#527497"><span class="Estilo8">Acta consejo de facultad:</span></td>
      <td bgcolor="#FFFFFF"><input type="text" name="actaCF" id="actaCF"/></td>
    </tr>
    <tr>
      <td bgcolor="#527497"><span class="Estilo8">Fecha del Acta:</span></td>
      <td bgcolor="#FFFFFF"><input type="text" name="fechaActaCF" id="fechaActaCF"/></td>
    </tr>
    <tr><td bgcolor="#527497">
    	<span class="Estilo8">Aval Consejo de Facultad:</span>
    </td><td bgcolor="#FFFFFF">
    	<input name="avalCF" type="checkbox" id="avalCF"/>
    </td></tr>
    <tr><td bgcolor="#527497">
    	<span class="Estilo8">Solicitud de Docente:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="checkbox" name="solicitudProfesor" id="solicitudProfesor"/>
    </td></tr>
    <tr><td bgcolor="#527497">
    	<span class="Estilo8">Carta Aceptaci&oacute;n:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="checkbox" name="cartaAceptacion" id="cartaAceptacion"/>
    </td></tr>    
    <tr><td bgcolor="#527497">
    	<span class="Estilo8">Informe Estudiante:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="checkbox" name="informeEstudiante" id="informeEstudiante"/>
    </td></tr>  
    <tr><td bgcolor="#527497">
    	<span class="Estilo8">Informe Tutor:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="checkbox" name="informeTutor" id="informeTutor"/>
    </td></tr> 
    <tr><td bgcolor="#527497">
    	<span class="Estilo8">Calificaciones:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="checkbox" name="calificaciones" id="calificaciones"/>
    </td></tr> 
    <tr><td width="168" bgcolor="#527497">
    	<span class="Estilo8">Comentarios:</span>
    </td><td width="642" bgcolor="#FFFFFF">
    	<?php echo $formulario['comentarios'] ?>
    </td></tr>     
    <tr><td width="168" bgcolor="#527497">
    	<span class="Estilo8">Observaciones:</span>
    </td><td width="642" bgcolor="#FFFFFF">
    	<?php echo $formulario['observaciones'] ?>
    </td></tr>
    <tr>
                     	<td width="168" bgcolor="#527497"><span class="Estilo8">Anexos:</span></td>
                        <td width="642" bgcolor="#FFFFFF"><input name="anexos[]" type="file" multiple="true" id="anexos"/>
                       
                        </td>
		            </tr>
    <tr><td width="63%" colspan="2">
        <div align="center">
        <input name="prorrogar" type="button" class="button" id="prorrogar" onclick="enviar()" value="Guardar solicitud" />
        </div>
    </td></tr>
                    
    <tr><td width="63%" colspan="2">
        <div align="center">
        <input style="display:none" name="prorrogar" type="submit" class="button" id="guardar" onclick="validar_extension( 'file','errorFile')" value="Guardar solicitud" />
        </div>
    </td></tr>
    <?php } ?>
</table>
</fieldset>
  </form>
</body>
</html>
