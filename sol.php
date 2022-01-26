<?php
  		require_once './modulos/login/Session.php';
  		$session = Session::getInstance();
		$frame = "modulos/login/index.php";
		//require_once 'modulos/login/AutocerradoSesion.php';
        if ($session->getVal("usuario_id")!=""){
			$sesion->setVal("ultimoAcceso",date("Y-n-j H:i:s"));
			$url='modulos/marcos/';
			switch($session->getVal("rol")){
				case 'auxiliar';
					$url=$url."marco_auxiliar.php";
				break;
				case 'docente';
					$url = $url."marco_docente.php";
				break;
				case 'comite';
					$url=$url."marco_comite.php";
				break;
			}
			//echo $url;
			echo '<script>
			var url = "'.$url.'";
			var frame = document.getElementById("contenido");
			frame.setAttribute("src",url);
			</script>';
		} 	
    ?>