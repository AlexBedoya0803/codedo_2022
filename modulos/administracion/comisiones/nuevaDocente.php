<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once('nuevaDocente_c.php');
	require_once('MsgError.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

<!--<link rel="stylesheet" href="../../auxiliar/actas_abiertas/_web.css" type="text/css" media="screen" />-->
<!--<link rel="stylesheet" href="../../auxiliar/actas_abiertas/style.css" type="text/css" media="screen" />-->
<link rel="stylesheet" href="../../../js/calendar/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="../../../js/calendar/mootools-1.2-core.js"></script>
<script type="text/javascript" src="../../../js/calendar/_class.datePicker.js"></script>
<script type="text/javascript" src="../../../js/calendar/funciones/fecha2.js"></script>
<script type="text/javascript" src="../../../js/funciones.js"></script>
<script type="text/javascript" src="../../../js/validarFilesDocente.js"></script>

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
.Estilo7 {color: #FF0000}
.Estilo8 {color: #FFFFFF}
.Estilo10 {color: #00007F; font-size: 16px; font-weight: bold; }
-->
</style>

<link rel="stylesheet" href="../../../estilos/cupertino/jquery-ui-1.8.12.custom.css">
<link rel="stylesheet" href="../../../estilos/demos.css">
<script src="../../../js/jquery-1.5.1.min.js"></script>
<script src="../../../js/jquery-ui-1.8.12.custom.min.js"></script>
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
					location.href="../docentes/informacion2.php";
				}
			}
		});
		$( "#error" ).dialog();
	});
</script>

<script type="application/javascript">
	function verificarTipo(e){
		var valor=e.value;
		if(!((valor=="1")||(valor=="2")||(valor=="3"))){
			alert("corta duracion");	
		}
	}
</script>

<!--Script para verificar y enviar los datos-->
</head>

<body>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="95%" border="0" align="center">
  	<tr>
    	<td>
      		<table width="100%" border="0" align="center">
        		<tr>
          			<td width="116" bgcolor="#527497" class="Estilo8"><?php echo $docente->getCedula()?></td>
          			<td width="207" bgcolor="#527497" class="Estilo8"><?php echo $docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2();?></td>
          			<td width="288" bgcolor="#527497" class="Estilo8"><?php echo $docente->getFacultad()->getNombre();?></td>
        		</tr>
      		</table>
        	<fieldset   style="border:#0000FF ridge">
          		<legend ><span class="Estilo10">Nueva comisi&oacute;n</span></legend>
          		<table width="100%" border="0" align="center">
          			<tr>
              			<td width="172" bgcolor="#527497"><span class="Estilo8">*Motivo:</span></td>
              			<td bgcolor="#FFFFFF">
                        	<select name="motivos" id="motivos" onchange="verificarTipo(this)" >
								<?php foreach($motivos as $motivo) { ?>
                                <option value="<?php echo $motivo->getId(); ?>"><?php echo $motivo->getMotivo()?> </option>
                                <?php } ?>
                          	</select></td>
            		</tr>
            		<tr>
              			<td bgcolor="#527497"><span class="Estilo8">*Dedicaci&oacute;n a la comisi&oacute;n:</span></td>
              			<td bgcolor="#FFFFFF">
                        	<select name="dedicaciones" id="dedicaciones">
								<?php foreach($dedicaciones as $dedicacion) { ?>
                              	<option value="<?php echo $dedicacion->getId(); ?>"><?php echo $dedicacion->getNombre()?> </option>
                              	<?php } ?>
                          	</select>
                        </td>
            		</tr>
            		<tr>
                      <td bgcolor="#527497"><span class="Estilo8">*Objetivo:</span></td>
                      <td bgcolor="#FFFFFF">
                      
                      <input name="objetivo" type="text" id="objetivo" value="" size="100" required/></td>
            		</tr>
            		<tr>
                      <td bgcolor="#527497"><span class="Estilo8">*Lugar</span></td>
                      <td bgcolor="#FFFFFF"><input name="lugar" type="text" id="lugar" value="" size="100" required/></td>
            		</tr>
                    <tr>
                      <td bgcolor="#527497"><span class="Estilo8">*Pa&iacute;s:</span></td>
                      <td bgcolor="#FFFFFF"><select name="paises" id="paises" onchange="cargaContenido(this.id)">
                          <?php foreach($paises as $pais) { ?>
                          <option value="<?php echo $pais->getId(); ?>"><?php echo $pais->getPais(); ?> </option>
                          <?php } ?>
                      </select></td>
            		</tr>
           			 <tr>
                        <td bgcolor="#527497"><span class="Estilo8">*Fecha de inicio:</span></td>
                        <td bgcolor="#FFFFFF"><input type="text" name="fecha1" id="fecha1" required/></td>
        			</tr>
        			<tr>
                      <td bgcolor="#527497"><span class="Estilo8">*Fecha de terminaci&oacute;n:</span></td>
                      <td bgcolor="#FFFFFF"><input type="text" name="fecha2" id="fecha2" required/></td>
<!--
          			<tr>
                      <td bgcolor="#527497"><span class="Estilo8">Acta consejo de facultad:</span></td>
                      <td bgcolor="#FFFFFF"><input type="text" name="actaCF" id="actaCF" required/></td>
          			</tr>
          			<tr>
                      <td bgcolor="#527497"><span class="Estilo8">*Fecha del Acta:</span></td>
                      <td bgcolor="#FFFFFF"><input type="text" name="fechaActaCF" id="fechaActaCF" required/></td>
          			</tr>
                    <tr>
                      <td bgcolor="#527497"><span class="Estilo8">*Aval Consejo de Facultad:</span></td>
                      <td bgcolor="#FFFFFF"><input type="file" name="avalCF" id="avalCF" required/></td>
          			</tr>-->
                    <tr>
                      <td bgcolor="#527497"><span class="Estilo8">*Solicitud de Docente:</span></td>
                      <td bgcolor="#FFFFFF"><input type="file" name="solicitudProfesor" id="solicitudProfesor" required/></td>
          			</tr>
                    <tr>
                      <td bgcolor="#527497"><span class="Estilo8">*Carta Aceptaci&oacute;n/Invitaci&oacute;n:</span></td>
                      <td bgcolor="#FFFFFF"><input type="file" name="cartaAceptacion" id="cartaAceptacion" required/></td>
          			</tr>
                    <tr style="display:none">
                      <td bgcolor="#527497"><span class="Estilo8">Compromisos:</span></td>
                      <td bgcolor="#FFFFFF"><input type="file" name="compromisos" id="compromisos" /></td>
          			</tr>       
                    
                    <tr>
                      <td width="168" bgcolor="#527497"><span class="Estilo8">Comentarios:</span></td>
                      <td width="642" bgcolor="#FFFFFF"><textarea name="comentarios" cols="50" id="comentarios"></textarea></td>
		            </tr>     
            		<tr>
                      <td width="168" bgcolor="#527497"><span class="Estilo8">Observaciones:</span></td>
                      <td width="642" bgcolor="#FFFFFF"><textarea name="observaciones" cols="50" id="observaciones"></textarea></td>
		            </tr>
            		<tr>
              			<td width="63%" colspan="2">
                        	<div align="center">
                            <input id="guardar2" type="button"  class="button" value="Guardar Solicitud" onclick="enviar('solicitudProfesor,cartaAceptacion')"/>
                			<input name="guardar" type="submit" class="button" id="guardar"  value="Guardar solicitud" style="display:none"/>
              				</div>
                         </td>
            		</tr>
          		</table>
        	</fieldset>
      </td>
    </tr>
  </table>
</form>
<?php
	MsgError::getMsgError("Error","");
?>
</body>
</html>
