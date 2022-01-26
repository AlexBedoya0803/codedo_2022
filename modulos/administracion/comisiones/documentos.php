<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
</head>
<?php require_once('documentos_c.php');?>
<body>
<form id="form1" name="form1" method="post" action=""enctype="multipart/form-data">
  <table width="100%" border="0">
    <tr>
      <td colspan="2" bgcolor="#638CB5"><span class="Estilo1">Solicitud </span><span class="Estilo1">
        <?php echo $solicitud->getId()?></span></td>
    </tr>
    <tr>
      <td>Documentos actuales </td>
      <td><?php $solicitud->documentos($path['imagenes'],$path['upload'],50,50)?>
        <a href="<?php echo $path['../../auxiliar/solicitudes/upload']."solicitudes/".$solicitud->getId()."/";?>"><img src="../../../imagenes/iconos/carpeta.jpg" width="50" height="50" border="0" /></a></td>
    </tr>
    <tr>
      <td width="18%"><label>Nueva documentaci&oacute;n </label></td>
      <td width="82%"><input name="file" type="file" class="file" id="file" onchange="validar_extension( 'file','errorFile')" value="" /></td>
    </tr>
    <tr>
      <td colspan="2"><input name="subir" type="submit" class="button" id="subir" value="Actualizar Hoja de vida" /></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
