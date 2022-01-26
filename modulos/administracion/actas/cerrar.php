<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once('cerrar_c.php');?>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cerrar Acta</title>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
<div align="center">
  <p>
    <input name="cerrar" type="submit" class="button" id="cerrar" value="cerrar acta  <?php echo $id ?>" />
  </p>
  <p>Acta <?php echo $id  ."de ".$acta->getFecha() ?></p>
  
</div>
</form>
</body>
</html>