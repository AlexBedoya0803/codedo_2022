<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Modificacion</title>
<?php require_once('solicitud_c.php');?>
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
<script type="text/javascript" src="../../../js/funciones.js"></script>


<script>
	$(function() {$( "#fecha1" ).datepicker();});
	$(function() {$( "#fecha2" ).datepicker();});
	$(function() {$( "#fechaResolucion" ).datepicker();});
	$(function() {$( "#inicioResolucion" ).datepicker();});
	$(function() {$( "#finResolucion" ).datepicker();});
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
  <legend ><span class="Estilo3"><?php echo $formulario['tiposolicitud']; ?> </span></legend>
<table width="100%" border="0" align="center">
	<tr><td width="178" bgcolor="#527497">&nbsp;</td><td colspan="2" bgcolor="#527497">&nbsp;</td></tr>
    <?php if($formulario['tiposolicitudId']>4) { ?>
  	<tr>
      <td width="178" bgcolor="#527497">
    	<span class="Estilo8">Tipo de solicitud:</span>
    </td>
      <td bgcolor="#FFFFFF">
		<select name="tiposSolicitudes" id="tiposSolicitudes" >
    	<?php foreach($tiposSolicitudes as $tipoSolicitud) { 
			if($tipoSolicitud->getId()!=1 && $tipoSolicitud->getId()!=2 && $tipoSolicitud->getId()!=3 && $tipoSolicitud->getId()!=4) { ?>
    		<option value="<?php echo $tipoSolicitud->getId(); 
			if($formulario['tiposolicitudId']==$tipoSolicitud->getId()) 
    			echo ' "selected="selected"';?>">
			<?php echo $tipoSolicitud->getTipo()?> </option>
   		<?php } 
			} ?>
		</select>
    </td></tr><?php } ?>
	<tr><td width="172" bgcolor="#527497">
    	<span class="Estilo8">Motivo:</span>
    </td><td bgcolor="#FFFFFF">
		<select name="motivos" id="motivos" >
    	<?php foreach($motivos as $motivo) { ?>
    		<option value="<?php echo $motivo->getId(); 
    		if($formulario['motivos']==$motivo->getId()) 
    			echo ' "selected="selected"';?>"><?php echo $motivo->getMotivo()?> </option>
   		<?php } ?>
		</select>
    </td></tr>
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
    <tr><td width="172" bgcolor="#527497">
    	<span class="Estilo8">Facultad:</span>
    </td><td width="638" bgcolor="#FFFFFF">
		<select name="facultades" id="facultades" >
		<?php foreach($facultades as $facultad) { ?>
			<option value="<?php echo $facultad->getId(); 
			if($formulario['facultades']==$facultad->getId()) 
				echo ' "selected="selected"';?>"><?php echo $facultad->getNombre()?> </option>
		<?php } ?>
		</select>
    </td></tr>
	<tr><td bgcolor="#527497">
    	<span class="Estilo8">Tipo de comisi&oacute;n </span>
    </td><td width="638" bgcolor="#FFFFFF">
		<select name="tipos" id="tipos" >
		<?php foreach($tiposComisiones as $tipoComision) { ?>
			<option value="<?php echo $tipoComision->getId(); 
			if($formulario['tipoComision']==$tipoComision->getId()) 
				echo ' "selected="selected"';?>"><?php echo $tipoComision->getTipo()?> </option>
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
      <td bgcolor="#FFFFFF"><input type="text" name="actaCF" id="actaCF" value="<?php echo $formulario['numeroActaCF'] ?>"/></td>
    </tr>
    <tr>
      <td bgcolor="#527497"><span class="Estilo8">Fecha del Acta:</span></td>
      <td bgcolor="#FFFFFF"><input type="text" name="fechaActaCF" id="fechaActaCF" value="<?php echo $formulario['fechaActaCF'] ?>"/></td>
    </tr>
    <tr><td bgcolor="#527497">
    	<span class="Estilo8">Aval Consejo de Facultad:</span>
    </td><td bgcolor="#FFFFFF">
    	<input name="avalCF" type="checkbox" id="avalCF" <?php if(@$solicitud->getAvalCF()) echo ' checked="checked"'; ?>/>
    </td></tr>
    <tr><td bgcolor="#527497">
    	<span class="Estilo8">Solicitud de Docente:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="checkbox" name="solicitudProfesor" id="solicitudProfesor" <?php if(@$solicitud->getSolicitudProfesor()) echo ' checked="checked"'; ?>/>
    </td></tr>
    <tr><td bgcolor="#527497">
    	<span class="Estilo8">Carta Aceptaci&oacute;n:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="checkbox" name="cartaAceptacion" id="cartaAceptacion" <?php if(@$solicitud->getCartaAceptacion()) echo ' checked="checked"'; ?>/>
    </td></tr>    
    <tr><td bgcolor="#527497">
    	<span class="Estilo8">Informe Estudiante:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="checkbox" name="informeEstudiante" id="informeEstudiante" <?php if(@$solicitud->getInformeEstudiante()) echo ' checked="checked"'; ?>/>
    </td></tr>  
    <tr><td bgcolor="#527497">
    	<span class="Estilo8">Informe Tutor:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="checkbox" name="informeTutor" id="informeTutor" <?php if(@$solicitud->getInformeTutor()) echo ' checked="checked"'; ?>/>
    </td></tr> 
    <tr><td bgcolor="#527497">
    	<span class="Estilo8">Calificaciones:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="checkbox" name="calificaciones" id="calificaciones" <?php if(@$solicitud->getCalificaciones()) echo ' checked="checked"'; ?>/>
    </td></tr> 
    
    <tr><td bgcolor="#527497">
    	<span class="Estilo8">Resolucion:</span>
    </td><td bgcolor="#FFFFFF">
    	<input name="resolucion" type="resolucion" id="resolucion" value="<?php echo $formulario['resolucion'] ?>" size="100" />
    </td></tr>
    
    <tr><td bgcolor="#527497">
    	<span class="Estilo8">Fecha de resolucion:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="text" name="fechaResolucion" id="fechaResolucion" value="<?php echo $formulario['fechaResolucion'] ?>"/>
    </td></tr>
    
    <tr><td bgcolor="#527497">
    	<span class="Estilo8">Fecha de inicio:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="text" name="inicioResolucion" id="inicioResolucion" value="<?php echo $formulario['inicioResolucion'] ?>"/>
    </td></tr>
    
      <tr><td bgcolor="#527497">
    	<span class="Estilo8">Fecha de terminacion:</span>
    </td><td bgcolor="#FFFFFF">
    	<input type="text" name="finResolucion" id="finResolucion" value="<?php echo $formulario['finResolucion'] ?>"/>
    </td></tr>
    
    
    
    <tr><td width="168" bgcolor="#527497">
    	<span class="Estilo8">Comentarios:</span>
    </td><td width="642" bgcolor="#FFFFFF">
    	<textarea name="comentarios" cols="50" id="comentarios"><?php echo $formulario['comentarios'] ?></textarea>
    </td></tr>     
    <tr><td width="168" bgcolor="#527497">
    	<span class="Estilo8">Observaciones:</span>
    </td><td width="642" bgcolor="#FFFFFF">
    	<textarea name="observaciones" cols="50" id="observaciones"><?php echo $formulario['observaciones'] ?></textarea>
    </td></tr>
    
    <tr>
                     	<td width="168" bgcolor="#527497"><span class="Estilo8">Anexos:</span></td>
                        <td width="642" bgcolor="#FFFFFF"><input name="anexos[]" type="file" multiple="true" id="anexos"/>
                       
                        </td>
		            </tr>
                    
    <tr><td width="63%" colspan="2">
        <div align="center">
        <input name="modificar" type="button" class="button" id="modificar" onclick="enviar()" value="Modificar solicitud" />
        </div>
    </td></tr>                
   <tr><td width="63%" colspan="2">
        <div align="center">
        <input style="display:none" name="modificar" type="submit" class="button" id="guardar"  value="Modificar solicitud" />
        </div>
    </td></tr>

</table>
</fieldset>
</form>
</body>
</html>
