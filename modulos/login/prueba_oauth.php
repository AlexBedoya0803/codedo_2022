
<body>
<table width="100%" border="0">
  <tr>
    <td width="14%" valign="top" bgcolor="#E2EAF1"> <a class="button" href="https://aprendeenlinea.udea.edu.co/oauth/?action=auth&client_id=deFDj24IQpBBuN5dy6hCScodedoI5M&redirect_uri=http://avido.udea.edu.co/dedo/redirect.php&scope=profile%20email&response_type=code"><img src="../../imagenes/escudo.png" width="80%" height="100%" style="margin-top:20px;">
  </a></td>
 <p style="color:#C00; font-weight:bold" > <?php if(isset($_SESSION['status']) && $_SESSION['status']== false) echo "Acceso denegado, el usuario no es docente";?></p>
    <td width="86%" valign="top"><iframe src="index.php" name="contenido" width="100%" height="560" scrolling="Auto" frameborder="0" id="contenido"><a href="../inicio/contenido"></a></iframe></td>
  </tr>
</table>
</body>