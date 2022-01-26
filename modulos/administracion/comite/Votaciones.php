<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1 "  />
<title>Documento sin t&iacute;tulo</title>
<script type="text/javascript" src="../../../js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode :"textareas",
		theme :"simple",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true
	});
</script>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo2 {color: #000000}
-->
</style>
<?php require_once('Votaciones_c.php');  ?>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0">
    <tr>
      <td colspan="3" bgcolor="#000066" class="Estilo1"><div align="center">Votaciones</div></td>
    </tr>
    <tr>
      <td width="20%" bgcolor="#638CB5"><div align="left" class="Estilo1">Usuario</div></td>
      <td width="20%" bgcolor="#638CB5"><div align="left" class="Estilo1">Votaci&oacute;n</div></td>
      <td width="60%" bgcolor="#638CB5"><div align="left" class="Estilo1">Comentarios</div></td>
    </tr>
    <?php
		 while ($registro = mysql_fetch_array($result)){
			 $estadoVotacion;
			 $votacion="NULL";
			 $votacion=$registro["votacion"];
			 if(!is_null($votacion)){
				 
				 if($votacion==1){
					$estadoVotacion="si"; 
				 }else{
					$estadoVotacion="No"; 
				 }
			 }else{
				$estadoVotacion="No ha votado"; 
			 }
			echo '  <tr>
      					<td width="20%" bordercolor="0" bgcolor="#DDEDFF"><div align="left" class="Estilo2">'.$registro["nombre"].'</div></td>
		 				<td width="20%" bordercolor="0" bgcolor="#DDEDFF"><div align="left" class="Estilo2">'.$estadoVotacion.'</div></td>
						<td width="60%" bordercolor="0" bgcolor="#DDEDFF"><div align="left" class="Estilo2">'.$registro["comentarios"].'</div></td>
    				</tr>';
		 }
	?>
  </table>
  
  <?php
  		echo'
			</br>
			</br>
			</br>
		';
		
		if($session->getVal("rol")=="auxiliar"){
			echo '
				<table width="100%" border="0">
				<form id="form1" name="form1" method="post" action="./Votaciones.php?id='.$id.'">
						<tr>
							<td bgcolor="#638CB5" class="Estilo1">Recomendaci&oacute;n</td>
							<td bordercolor="0"><label>
								<textarea name="recomendacion" cols="90%" rows="5" id="recomendacion">'.$solicitud->getRecomendacion().'
								</textarea>
							</label></td>
						</tr>
						<tr></tr>
						<tr></tr>
						<tr></tr>
						<tr>
							<td>
							<input name="guardarRecomendacion" type="submit" class="button" id="guardarRecomendacion" value="Guardar Recomendaci&oacute;n" /> 
							</td>
						</tr>
				</form>';
				if($solicitud->getRespuestaId()==0 || $solicitud->getRespuestaId()==3){
					echo '
						<tr><td><br></br></td></tr>
						<form id="form1" name="form1" method="post" action="./Votaciones.php?id='.$id.'" style="width:100%">
							<tr>
								<td bgcolor="#638CB5" class="Estilo1">Se recomienda? </td>
								<td bordercolor="0">Si
									<input name="respuesta" type="radio" value="1" required/>
										No
									<input type="radio" name="respuesta" value="0" />
								</td>
							</tr>
							<tr>
								<td bgcolor="#638CB5" class="Estilo1">Comentarios</td>
								<td bordercolor="0"><label>
									<textarea name="comentarios" cols="90%" rows="5" id="comentarios">'.$solicitud->getComentarios().'</textarea>
									</label>
								</td>
							</tr>
							<tr></tr>
							<tr></tr>
							<tr></tr>
							<tr >
								<td colspan="3">
									<input name="guardar" type="submit" class="button" id="guardar" value="Guardar respuesta" /> 
								</td>
							</tr>
					</form>
					';	
				}
				//echo '</table>';
		}			
		
  ?>
</body>
</html>
