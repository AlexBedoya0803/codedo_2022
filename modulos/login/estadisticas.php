<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="../../estilos/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
</head>
<?php require_once('estadisticas_c.php');?>
<body><fieldset><legend class="Arial_12_B">Comisiones vigentes a <?php echo $hoy ?></legend>
<table width="100%" border="0">
  <tr>
    <td width="33%" valign="top"><table width="100%" border="0">
      <tr>
        <td style="background-color:#0A351C" width="209" bgcolor="#000066"><span class="Estilo1">Motivo</span></td>
        <td style="background-color:#0A351C" width="65" bgcolor="#000066"><span class="Estilo1">cant</span></td>
        <td style="background-color:#0A351C" width="70" align="right" bgcolor="#000066"><span style="background-color:#0A351C"class="Estilo1">%</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><div align="right"></div></td>
      </tr>
	  <?php 
 $color="#FFFFFF";
    for($i = 1; $i <= 11; $i += 1)
	{
    if($color=="#FFFFFF") $color="#DDEDFF"; else $color="#FFFFFF";
	 ?>
	  <tr bgcolor="<?php echo $color ?>">
		<td><?php echo $nombres[$i]?></td>
		<td><div align="right"><?php echo $valores[$i]?></div>		  </td>
	    <td><div align="right">
	      <?php $porc=$valores[$i]/$total*100 ; echo substr($porc, 0, 3); ?>
	      %</div></td>
	  </tr>
	  <?php }?>
  
      <tr>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF"><div align="right"></div></td>
      </tr>
      <tr>
        <td bgcolor="#DDDDFF" class="Arial_12_B">Total</td>
        <td bgcolor="#DDDDFF"><div align="right"><?php echo $total?></div></td>
        <td bgcolor="#DDDDFF"><div align="right">100%</div></td>
      </tr>

    </table></td>
    <td width="67%"><div align="center"><img src="../../imagenes/estadisticas/grafico.png" width="550" height="300" /></div></td>
  </tr>
</table>
</fieldset>
</body>
</html>
