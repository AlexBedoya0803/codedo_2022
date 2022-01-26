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
<style type="text/css">
<!--
.Estilo7 {color: #FF0000}
-->
</style>
</head>
<?php require_once('solicitud_c.php');?>
<body>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="100%" border="0" align="center">
    <tr>
      <td width="219" bgcolor="#527497"><span class="Estilo1">Adjuntar Documentaci&oacute;n </span></td>
      <td width="663" bgcolor="#D6E0EB"><input name="file" type="file" class="file" id="file" onchange="validar_extension( 'file','errorFile')" value="" />
          <div class="Arial_12_B Estilo7" id="errorFile" style="display:none">Debe ser .pdf</div>
      <input name="guardar" type="submit" class="button" id="guardar" value="Guardar" /></td>
    </tr>
    <tr>
      <td bgcolor="#527497"><span class="Estilo1">Documento Actual </span></td>
      <td bgcolor="#D6E0EB"><?php echo $documento;//$solicitud->documento($path['imagenes'],$path['upload'],20,20)?></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
