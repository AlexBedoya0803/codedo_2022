<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php require_once('editar_c.php');?>
<script type="text/javascript" src="../../../js/funciones.js"></script>
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo10 {color: #00007F; font-size: 16px; font-weight: bold; }
.Estilo8 {color: #FFFFFF}
-->
</style>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<fieldset style="border:#0000FF ridge">
<legend><span class="Estilo10">Informaci&oacute;n del docente</span></legend>
<form id="form1" name="form1" method="post" action="">
  <legend><span class="Estilo10"></span></legend>
  <table width="100%" border="0" align="center">
    <tr>
      <td width="167" bgcolor="#0A351C"><span class="Estilo8">Buscar por cedula </span></td>
      <td colspan="5" bgcolor="#ADC0B7"><label>
        <input name="bcedula" type="text" class=":integer :required" id="bcedula" onkeyup="PosicionarCombo(this,'bnombres')" value="<?php echo $formulario['bcedula'] ?>"/>
        <input name="buscar" type="submit" class="botonbuscar" id="buscar" value="_"/>
      <?php echo $error ?> </label>
      	<input name="cedulaOculta" id="cedulaOculta" type="hidden" value="<?php echo $formulario['cedula'] ?>"/>
      </td>
    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo8">Buscar por nombre </span></td>
      <td colspan="5" bgcolor="#ADC0B7"><select name="bnombres" id="bnombres" onchange="LeerCombo(this,'bcedula')">
          <option value="0" selected="selected">No esta guardado</option>
          <?php foreach($docentes as $doc) {
			  $value=$doc->getCedula();
			  $nombre=$doc->getApellido1()." ".$doc->getApellido2()." ".$doc->getNombre();
		  ?>
          <option value="<?php echo $value;  
			   if($formulario['bnombres']==$value) 
			   echo'"selected="selected"';?>"><?php echo $nombre ?> </option>
          <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo8">Buscar con informaci&oacute;n incompleta</span></td>
      <td colspan="5" bgcolor="#ADC0B7"><select name="binombres" id="binombres" onchange="LeerCombo(this,'bcedula')">
          <option value="0" selected="selected">No esta guardado</option>
          <?php foreach($docentesInc as $docI) {
			  $value=$docI->getCedula();
			  $nombre=$docI->getApellido1()." ".$docI->getApellido2()." ".$docI->getNombre();
		  ?>
          <option value="<?php echo $value;  
			   if($formulario['binombres']==$value) 
			   echo'"selected="selected"';?>"><?php echo $nombre ?> </option>
          <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo8">Nombres</span></td>
      <td colspan="5" bgcolor="#FFFFFF"><input name="nombres" type="text" id="nombres" value="<?php echo $formulario['nombres']?>" size="60"/></td>
    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo8">Apellido 1</span></td>
      <td colspan="5" bgcolor="#FFFFFF"><input name="apellido1" type="text" id="apellido1" value="<?php echo $formulario['apellido1']?>" size="60"/></td>
    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo8">Apellido 2</span></td>
      <td colspan="5" bgcolor="#FFFFFF"><input name="apellido2" type="text" id="apellido2" value="<?php echo $formulario['apellido2']?>" size="60"/></td>
    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo8">Facultad</span></td>
      <td colspan="5" bgcolor="#FFFFFF">
      	<select name="facultad" id="facultad">
              <option value="0" selected="selected">No esta guardado</option>
              <?php foreach($facultades as $fac) {
                  $value=$fac->getId();
                  $nombre=$fac->getNombre();
              ?>
              <option value="<?php echo $value; if($formulario['facultad']==$value) echo'"selected="selected"';?>"
              		><?php echo $nombre ?> </option>
              <?php } ?>
         </select>
      </td>
    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo8">Categoria</span></td>
      <td colspan="5" bgcolor="#FFFFFF">
      	 <select name="categoria" id="categoria">
              <?php foreach($categorias as $cat) {
                  $value=$cat->getId();
                  $nombre=$cat->getCategoria();
              ?>
              <option value="<?php echo $value; if($formulario['categoria']==$value) echo'"selected="selected"';?>">
			  					<?php echo $nombre ?> </option>
              <?php } ?>
         </select>
      </td>
    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo8">Dedicaci&oacute;n</span></td>
      <td colspan="5" bgcolor="#FFFFFF">
      	 <select name="dedicacion" id="dedicacion">
              <option value="0" selected="selected">No esta guardado</option>
              <?php foreach($dedicaciones as $ded) {
                  $value=$ded->getId();
                  $nombre=$ded->getNombre();
              ?>
              <option value="<?php echo $value; if($formulario['dedicacion']==$value) echo'"selected="selected"';?>"
              		><?php echo $nombre ?> </option>
              <?php } ?>
         </select>
      </td>
    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo8">Fecha de vinculaci&oacute;n</span></td>
      <td colspan="5" bgcolor="#FFFFFF"><input name="fechaVinculacion" type="text" id="fechaVinculacion" value="<?php echo $formulario['fechaVinculacion']?>" size="60"/></td>
    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo8">Sexo</span></td>
      <td colspan="5" bgcolor="#FFFFFF"><input name="sexo" type="text" id="sexo" value="<?php echo $formulario['sexo']?>" size="60"/></td>
    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo8">Centro de costo </span></td>
      <td colspan="5" bgcolor="#FFFFFF"><input name="ccosto" type="text" id="ccosto" value="<?php echo $formulario['ccosto']?> " size="60"/></td>
    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo8">Nombre de centro de costo</span></td>
      <td colspan="5" bgcolor="#FFFFFF"><input name="nccosto" type="text" id="nccosto" value="<?php echo $formulario['nccosto']?>" size="60"/></td>
    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo8">Correo electronico</span></td>
      <td colspan="5" bgcolor="#FFFFFF"><input name="correo" type="text" id="correo" value="<?php echo $formulario['correo']?>" size="60"/></td>
    </tr>
    <tr>
      <td bgcolor="#0A351C" class="Estilo8">Hoja de vida </td>
      <td colspan="5" bgcolor="#FFFFFF"><?php if($existe)echo $resume?></td>
    </tr>
    <tr>
      <td bgcolor="#0A351C" class="Estilo8">Historial</td>
      <td colspan="5" bgcolor="#FFFFFF">
	  <?php if($existe)
echo'<a href="historial.php?id='.$docente->getId().'"><img src="../../../imagenes/iconos/historial.jpg" width="16" height="16" border="0" /></a>';?></td>
    </tr>
    <tr>
      <td class="Estilo8">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#0A351C" class="Estilo8" colspan="6"><input src="../../../imagenes/acciones/modificar.png" id="bModificarDocente" name="bModificarDocente" width="30" height="30" border="0" type="image"/> Modificaci&oacute;n</td>
    </tr>
  </table>

</form>
</fieldset>
</body>
</html>
