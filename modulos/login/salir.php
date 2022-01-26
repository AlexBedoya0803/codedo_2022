  <?php
        require_once 'Session.php';
        $session = Session::getInstance();
        $session->cerrarSesion();
		
		$self = $_SERVER['PHP_SELF']; //Obtenemos la página en la que nos encontramos
		header("refresh:1; url=$self"); //Refrescamos cada 300 segundos
  ?>