<?php
/*
* Esta clase permite que una sesion sea cerrada despues de 30 minutos de inactividad
* autor LUIS FERNANDO OROZCO
*/
$ruta = __FILE__;
$post = strpos($ruta, "modulos");
$rutaAbsoluta = substr($ruta, 0, $post);
$rutaAbsoluta = str_replace("\\", '/', $rutaAbsoluta);
$rutaAbsoluta .= 'modulos/login/Session.php';
//echo $rutaAbsoluta;
require_once($rutaAbsoluta);
//$path=asignarPath(dirname(__FILE__));
//require_once($path['modulos'].'login/Session.php');
//echo "hello";

$sesion = Session::getInstance();
$timeout=$sesion->getVal("timeout"); //segundos
$timeReload = $timeout*1000; //milisegundos

if ($sesion->getval("usuario_id")==""){
    header("Location: ".$path['modulos'].'/login/login-Copia.php');
} else {
    
    $fechaGuardada = $sesion->getval("ultimoAcceso");
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));


    if($tiempo_transcurrido >= $timeout) {
    	//$sesion->cerrarSesion();
		/*
        echo '<script language=javascript>
        self.location="'.$path['modulos'].'/login/login.php'.'"</script>';
    	*/
	}else {
    	$sesion->setval("ultimoAcceso",date("Y-n-j H:i:s"));
   	}
}

echo '<html>
<head>
    <script language=javascript> 
    function cerrar(){
       // alert("se cerrara la pagina");
        //location.reload();
    }
    </script>
</head>
<body onLoad="setInterval('."'cerrar()',".$timeReload.');">
</body>
</html>';
?>