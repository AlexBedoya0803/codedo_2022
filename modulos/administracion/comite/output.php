<?php
ob_start();
require_once('../../login/Session.php');
$session = Session::getInstance();

$tipo = isset($_REQUEST['t']) ? $_REQUEST['t'] : 'excel';
$extension = '.xls';

if($tipo == 'word') $extension = '.doc';

$id= $_GET['id'];


// Si queremos exportar a PDF
if($tipo == 'pdf'){
    require_once '../../../librerias/dompdf/dompdf_config.inc.php';

    $dompdf = new DOMPDF();
	$url=  "http://avido.udea.edu.co/dedo/modulos/administracion/comite/DetalleSolicitud.php?id=".$id; 
	
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	$content="<img src='../../../imagenes/comite.jpg' width='1000' height='125' style='position:center'>";
	$content.= curl_exec($ch);
	curl_close($ch);
	


	if($content!=false){
		$dompdf->load_html($content);
    	 $dompdf->render();
   		 $dompdf->stream("DetallesSolicitud.pdf");
		}else{
			echo "hubo un error";
		} 
   
} else{
    require_once './DetalleSolicitud.php';
	if (!headers_sent()) {
		header("Content-type: application/vnd.ms-$tipo");
		header("Content-Disposition: attachment; filename=DetallesSolicitud$extension");
		header("Pragma: no-cache");
		header("Expires: 0");
	}    
}
ob_end_flush();
?>

