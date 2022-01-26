<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
</head>
<?php require_once('anexar_c.php');?>
<body>
<table width="100%" border="1">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="40%" valign="top" bgcolor="#527497"><span class="Estilo1">Documentos en la carpeta del docente </span></td>
    <td width="60%" bgcolor="#527497"><p align="center" class="Estilo1">Hoja de vida del docente </p>    </td>
  </tr>
  <tr>
    <td width="40%" valign="top"><form id="form1" name="form1" method="post" action="">
    <label>
      <div align="center">
      </label>
      <div align="center">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
          <tr>
            <td width="34%" bgcolor="#527497"><span class="Estilo1">Documento</span></td>
            <td width="66%" bgcolor="#527497" class="Estilo1">Anexar</td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <?php 
 $color="#FFFFFF";
 $select = 0;
 if($documentos)
  foreach ($documentos as $documento) {
	    $resumeold=$path['upload'].$docente->getCedula()."/resume.pdf";
		$imagen=$path['imagenes']."iconos/pdf.png ";
		if (file_exists($resumeold)) {
			$resume = '<a href="'.$resumeold.'"> <img src="'.$imagen.'" width="100" height="100" border="0" /></a>';
		}
		if($color=="#FFFFFF")
			$color="#DDEDFF";
		else
			$color="#FFFFFF";
		?>
          <tr bgcolor="<?php echo $color ?>">
            <td><div align="left"><a href="<?php echo $directorio."/".$documento ?>.pdf"><img src="../../../imagenes/iconos/pdf.png" width="20" height="20" border="0" /> </a><?php echo $documento?></div></td>
            <td>
              <select name="select<?php echo $select; ?>" id="select<?php echo $select; ?>">
              		<option value=""></option>
              	<?php for($i=1; $i<$n; $i++) { ?>
					<option value="<?php echo $i?>"><?php echo $i?></option>	
				<?php } ?>
              </select>           </td>
          </tr>
          <?php $select++; }?>
        </table>
        <p>
          <input name="anexar" type="submit" class="button" id="anexar" value="Crear hoja de vida" />
        </p>
      </div>
    </form>
    <p><label><div align="center">
    </label></td>
    <td><div align="center">
      <?php echo $resume; ?>
    </a></div></td>
  </tr>
</table>
</body>
</html>
