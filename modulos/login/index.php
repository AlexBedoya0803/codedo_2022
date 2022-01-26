<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
        require_once('Session.php');
		//require_once 'AutocerradoSesion.php';

        $session = Session::getInstance();
        if ($session->getVal("usuario_id")==""){
		}else{		 
			$session->setVal("ultimoAcceso",date("Y-n-j H:i:s"));	
		}
    ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>modulos_login_index</title>
<link href="../../estilos/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td width="30%" style="font-size:14px" ><p align="center"><span style="font-family:'Times New Roman', Times, serif"></span></p>
      <p align="center"><img src="../../imagenes/docentes.jpg" height="350" width="550" id="ctl0_body_imgHome" /></p></td>
    </tr>
  
    <tr>
     <td width="74%" style="font-size:16px"><p style="font-family:'Times New Roman', Times, serif">
     <p align="center"><b>¿Qué es una comisión de estudio?</b></p>

Un profesor se encuentra en comisión de estudio cuando la 
Universidad lo autoriza para separarse parcial o totalmente 
de sus funciones, y adelantar estudios de posgrado en las 
condiciones y modalidades que estipulen los reglamentos.
</p><p>
 Además, en aquellos eventos en que se autoriza la realización 
 de pasantías o de entrenamientos que se requieran para cualificar
  la formación de posgrado que ya posee el docente 
(Numeral 2 del artículo 107 del Estatuto Profesoral).
Para crear una solicitud de comisión de estudio, solo debe 
identificarse con su usuario y contraseña del Portal Web 
Universitario, y diligenciar el formulario de solicitud agregando 
además los documentos de soporte necesarios. </p></td>
    </tr>
    <!--tr>
      <td colspan="2"><p>
        <iframe src="estadisticas.php" name="contenido" width="100%" height="500" scrolling="Auto" frameborder="0" id="contenido"><a href="../inicio/contenido"></a></iframe>
      </p>
      </td>
    </tr -->  
  </tbody>
</table>
</body>
</html>
