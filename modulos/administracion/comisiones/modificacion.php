<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Modificacion</title>
<?php require_once('modificacion_c.php');?>
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
$(document).ready(function(){
	$("#motivos").change(function () {
		val = $("#motivos option:selected").val();
		if(val == 1 || val == 2 || val == 3 || val == 4 || val == 6 || val == 10 || val == 11 || val == 12 || val == 13 ||val == 14 || val == 98){  
			$("#dTipo").text(' De Estudio');
		}
		else{
			$("#dTipo").text(' De Servicio');	
		}
	})
	.trigger('change');
});
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
<script type="text/javascript" src="../../../js/funciones.js"></script>
</head>

<body>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
<table width="100%" border="0" align="center">
    <tr><td width="183" bgcolor="#527497" class="Estilo8">
        <?php echo $docente->getCedula()?>
    </td><td width="256" bgcolor="#527497" class="Estilo8">
		<?php echo $docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2();?>
    </td><td width="391" bgcolor="#527497" class="Estilo8">
		<?php echo $docente->getFacultad()->getNombre();?>
    </td></tr>
</table>

<fieldset   style="border:#0000FF ridge">
<legend ><span class="Estilo3">Modificaci&oacute;n  </span></legend>
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
	<tr><td width="178" bgcolor="#527497">
    	<span class="Estilo8">Motivo:</span>
    </td><td bgcolor="#FFFFFF">
		<select name="motivos" id="motivos" >
    	<?php foreach($motivos as $motivo) { ?>
    		<option value="<?php echo $motivo->getId(); 
    		if($formulario['motivos']==$motivo->getId()) 
    			echo '"  selected="selected';?>"><?php echo $motivo->getMotivo()?> </option>
   		<?php } ?>
		</select><label id='dTipo'></label></td></tr>
	<tr><td bgcolor="#527497">
    	<span class="Estilo8">Dedicaci&oacute;n a la comisi&oacute;n:</span>
    </td><td bgcolor="#FFFFFF">
		<select name="dedicaciones" id="dedicaciones">
    	<?php foreach($dedicaciones as $dedicacion) { ?>
    		<option value="<?php echo $dedicacion->getId(); 
    		if($formulario['dedicaciones']==$dedicacion->getId()) 
    			echo ' "selected="selected"';?>"><?php echo $dedicacion->getNombre()?> </option>
   		<?php } ?>
		</select>
	</td></tr>
	<tr><td bgcolor="#527497">
	  <span class="Estilo8">Objetivo:</span>
	  </td><td bgcolor="#FFFFFF">
	    <input name="objetivo" type="text" id="objetivo" value="<?php echo $formulario['objetivo'] ?>" size="100" />
      </td></tr>
	<tr><td bgcolor="#527497">
    	<span class="Estilo8">Lugar</span>
    </td><td bgcolor="#FFFFFF">
    	<input name="lugar" type="text" id="lugar" value="<?php echo $formulario['lugar'] ?>" size="100" />
    </td></tr>
    <tr><td bgcolor="#527497"><span class="Estilo8">
    	Pa&iacute;s:</span>
    </td><td bgcolor="#FFFFFF">
    	<select name="paises" id="paises" onchange="cargaContenido(this.id)">
		<?php foreach($paises as $pais) { ?>
			<option value="<?php echo $pais->getId(); 
			if($formulario['paises']==$pais->getId()) 
				echo ' "selected="selected"';?>"><?php echo $pais->getPais(); ?> </option>
		<?php } ?>
		</select>
    </td></tr>
	<tr><td bgcolor="#527497">
    	<span class="Estilo8">Fecha de inicio:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="text" name="fecha1" id="fecha1" value="<?php echo $formulario['fecha1'] ?>"/>
    </td></tr>
	<tr><td bgcolor="#527497">
    	<span class="Estilo8">Fecha de terminaci&oacute;n:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="text" name="fecha2" id="fecha2" value="<?php echo $formulario['fecha2'] ?>"/>
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
    <tr><td width="178" bgcolor="#527497">
    	<span class="Estilo8">Comentarios:</span>
    </td><td width="642" bgcolor="#FFFFFF">
    	<textarea name="comentarios" cols="50" id="comentarios"><?php echo $formulario['comentarios'] ?></textarea>
    </td></tr>     
    <tr><td width="178" bgcolor="#527497">
    	<span class="Estilo8">Observaciones:</span>
    </td><td width="642" bgcolor="#FFFFFF">
    	<textarea name="observaciones" cols="50" id="observaciones"><?php echo $formulario['observaciones'] ?></textarea>
    </td></tr>
    
                        <tr>
                     	<td width="168" bgcolor="#527497"><span class="Estilo8">Anexos:</span></td>
                        <td width="642" bgcolor="#FFFFFF"><input name="anexos[]" type="file" multiple="true" id="anexos"/>
                       
                        </td>
		            </tr>
    
     <tr><td width="178" colspan="2">
        <div align="center">
        <input name="modificar" type="button" class="button" id="modificar" onclick="enviar()" value="Guardar solicitud" />
        </div>
    </td></tr>
    
    <tr><td width="178" colspan="2">
        <div align="center">
        <input style="display:none" name="modificar" type="submit" class="button" id="guardar" onclick="validar_extension( 'file','errorFile')" value="Guardar solicitud" />
        </div>
    </td></tr>
    <?php } ?>
</table>
</fieldset>
</form>
</body>
</html>
