<?php
	require_once('../../login/Session.php');
	$session = Session::getInstance();
	if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
		echo '<script>location.href="../../login/index.php";</script>';
	
	if(isset($_GET['eliminar'])){
		if($_GET['eliminar']=="true"){
			unlink($_GET['file']);		
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script type="text/javascript" src="../../../js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode :"textareas",
		theme :"simple",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true
	});
</script>

<script> 
var frase = $('#nombre').val()
var frase="frase con acentos: áéíóú"; 

function quitaAcentos(str){ 
for (var i=0;i<str.length;i++){ 
//Sustituye "á é í ó ú" 
if (str.charAt(i)=="á") str = str.replace(/á/,"a"); 
if (str.charAt(i)=="é") str = str.replace(/é/,"e"); 
if (str.charAt(i)=="í") str = str.replace(/í/,"i"); 
if (str.charAt(i)=="ó") str = str.replace(/ó/,"o"); 
if (str.charAt(i)=="ú") str = str.replace(/ú/,"u"); 
} 
return str; 
} 

alert(quitaAcentos(frase)) 

</script>


<!-- script type="text/javascript">
quitar_tildes($cadena) {
$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã"","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã"","Ã‹");
$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
$texto = str_replace($no_permitidas, $permitidas ,$cadena);
return $texto;
}
</script -->




<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo2 {color: #000000}
-->
</style>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0">
    <tr>
      <td  bgcolor="#0A351C" class="Estilo1"><div align="center">Anexos</div></td>
    </tr>

  
  <?php
	$numero = count($_GET);
	$contenido = "";
	if($numero) {
		$id = $_GET['id'];
		//echo $id;
		if(file_exists("../../../anexos/".$id)){
		$directorio = opendir("../../../anexos/".$id);
		while ($archivo = readdir($directorio)){
			if (is_dir($archivo)){
				
			}
			else{
				//if($id=="5665"){
					//unlink('../../../anexos/'.$id.'/'.$archivo);	
				//}
				echo '
					<tr><td class="Estilo2">
					<a href="../../../anexos/'.$id.'/'.$archivo.'"style="color:black">'.$archivo.'</a>
				</td>';
				if($session->getVal("rol")=="auxiliar"){
					echo '
						<td><a href="./ListarAnexos.php?id='.$_GET['id'].'&eliminar=true&file=../../../anexos/'.$id.'/'.$archivo.'"><img src="../../../imagenes/iconos/delete_icon.png" width="16" height="16" border="0" title="Eliminar archivo"/></td>
					';
				}
				
				echo '</tr>';
				
			}
		}
		
		}

	}	
  ?>
    </table>
</body>
</html>
