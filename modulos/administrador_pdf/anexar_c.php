<?php
session_start();
if($_SESSION["usuario_id"]=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/index.php";</script>'; //muestra la vista general
require_once('pdf/concatenar.php');

$directorio="../documentos/98771892/";
$documentos=listar();

if( isset($_POST["anexar"]))
{
$anexar_documentos=array();
foreach ($documentos as $documento)
{  
	
	if($_POST[$documento]==1)
	{
	$anexar_documentos[]=$directorio."/".$documento.".pdf";
	}
}

	$pdf =& new concat_pdf();
	$pdf->setFiles($anexar_documentos);
	$pdf->concat();
	$pdf->Output("resume.pdf", 'F');
}

if( isset($_POST["borrar"]))
{
$anexar_documentos=array();
foreach ($documentos as $documento)
{  
	
	if($_POST[$documento]==1)
	{
	unlink($directorio."/".$documento.".pdf"); 
	}
}
$documentos=listar();
}


if( isset($_POST["renombrar"]))
{
$anexar_documentos=array();
foreach ($documentos as $documento)
{  
	
	if($_POST[$documento]==1)
	{
	$nuevo_mnombre=str_replace(" ", "_",$_POST["t".$documento]);
	rename($directorio."/".$documento.".pdf", $directorio."/".$nuevo_mnombre.".pdf");

	}
}
$documentos=listar();
}



//UPLOAD
if( isset($_POST["subir"]))
{

$nombre_carpeta = "98771892/";
if(!is_dir($nombre_carpeta)){@mkdir($nombre_carpeta, 0700);}
$tipo_archivo = $_FILES['file']['type'];
$nombre_archivo = $_FILES['file']['name']; 
if ($tipo_archivo=="application/pdf")
{
echo str_replace(" ", "",$nombre_archivo);
     if (move_uploaded_file($_FILES['file']['tmp_name'],$nombre_carpeta.str_replace(" ", "_",$nombre_archivo)))
		 {echo "El archivo ha sido cargado correctamente.";}
	 else{echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";}
 }
$documentos=listar();
 }
 
 
 
 
 
 function listar()
 {
  $documentos=array();
$directorio="../documentos/98771892/";
$handle = opendir($directorio);
	while ($file = readdir($handle))
	 {
	$extension = substr($file,strlen($file)-3,strlen($file));
		if($file!= "." && $file != ".." && $file!="Thumbs.db"&& $file!="resume.pdf" && $extension=="pdf"){
		$documentos[]=substr ($file, 0, strlen($file) - 4);
		}
	}
	return $documentos;
 }

 