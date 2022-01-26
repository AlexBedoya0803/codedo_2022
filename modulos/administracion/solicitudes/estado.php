<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<?php require_once('estado_c.php');?>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td><img src="<?php echo $imagen ?>" width="736" height="328" /></td>
  </tr>
  <tr>
    <td><p>El proceso se encuentra en el estado <?php echo $solicitud->getEstadoId() ?></p>
    <p>Observaciones</p>
    <p><?php echo $solicitud->getObservaciones() ?></p></td>
  </tr>
</table>
</body>
</html>
