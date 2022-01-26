<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administrador de PDFS</title>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo2 {
	color: #527497;
	font-weight: bold;
}
.Estilo4 {color: #527497}
-->
</style>
</head>
<?php require_once('anexar_c.php');?>
<body>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
<table width="100%" border="1">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="28" valign="top" bgcolor="#527497"><span class="Estilo1">
  
    Subir Pdf 
      <input type="file" name="file" />
      <input name="subir" type="submit" id="subir" value="Agregar a la carpeta" />
    </span></td>
    <td width="31%" bgcolor="#527497"><p align="center" class="Estilo1">Documento Resultante </p>    </td>
  </tr>
  <tr>
    <td width="69%" height="187" valign="top">
      <div align="center">
        <p>
          <label></label>
          <span class="Estilo1 Estilo2"><span class="Estilo4">Documentos en la carpeta</span></span></p>
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
          <tr>
            <td colspan="2" bgcolor="#527497"><span class="Estilo1">Documento</span></td>
            <td width="41%" bgcolor="#527497" class="Estilo1">Selecci&ograve;n</td>
            </tr>
          <tr>
            <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <?php 
 $color="#FFFFFF";
  foreach ($documentos as $documento)
 {
 if($color=="#FFFFFF")
 $color="#DDEDFF";
 else
 $color="#FFFFFF";
 ?>
          <tr bgcolor="<?php echo $color ?>">
            <td width="26%"><div align="left"><a href="<?php echo $directorio."/".$documento ?>.pdf" target="_blank"><img src="../../imagenes/iconos/pdf.png" width="20" height="20" border="0" /> </a><?php echo $documento?></div></td>
            <td width="33%">
              <div align="left">
                <input name="t<?php echo $documento?>" type="text" id="t<?php echo $documento?>" value="<?php echo $documento ?>" size="30" />
                </div></td>
            <td>
              <input name="<?php echo $documento?>" type="checkbox" id="<?php echo $documento?>" value="1" checked="checked" />
              <select name="select">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select></td>
            </tr>
          <?php }?>
        </table>
        <table width="100%" border="1">
          <tr>
            <td width="32%"><div align="center">
              <input name="anexar" type="submit" class="button" id="anexar" value="Unir selecci&ograve;n" />
            </div></td>
            <td width="39%"><div align="center">
              <input name="renombrar" type="submit" class="button" id="renombrar" value="Renombrar selecci&ograve;n" />
            </div></td>
            <td width="29%"><div align="center">
              <input name="borrar" type="submit" class="button" id="borrar" value="Eliminar selecci&ograve;n" />
            </div></td>
          </tr>
        </table>
        </div>
  
    <p><label><div align="center">
    </label></td>
    <td><div align="center"><a href="resume.pdf" target="_blank"><img src="../../imagenes/iconos/pdf.png" width="103" height="103" border="0" /></a></div></td>
  </tr>
</table>
</form>
</body>
</html>
