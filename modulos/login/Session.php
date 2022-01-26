<?php
/*
* Esta clase se encarga del manejo de sesiones
* autor LUIS FERNANDO OROZCO
*/
error_reporting(E_ALL & ~E_NOTICE); 
	class Session{
		private static $instance;
		private $estado = false; //true inicion activa, false inactiva

		private function __construct(){}

		/*
		* Metodo para obtener una sesion activa
		*/
		public static function getInstance(){
			if(!isset(Session::$instance)){
				Session::$instance = new Session();
			}
			
			Session::$instance->iniciarSesion();
			$_SESSION['usuario_id']=="";
			$_SESSION['timeout']=1800;
			
			
			return Session::$instance;
		}

		/*
		* Metodo para iniciar la sesion
		*/
		public function iniciarSesion(){			
			if($this->estado==false){
        		$this->estado= session_start(); 
			}
		}

		/*
		* Metodo para cerrar la sesion
		*/
		
		public function cerrarSesion(){
			if($this->estado==true){
				$this->estado= !session_destroy();
			}
		}

		/*
		* Metodo para almacenar datos en la sesion
		*/
		
		public function setVal($clave,$valor){
			if($this->estado){
				$_SESSION[$clave]=$valor;
			}
		}

		/*
		* Metodo para obtener datos de la sesion
		*/
		public function getVal($clave){
			if($this->estado){
				return $_SESSION[$clave];
			}
		}
		
		/*
		* Metodo para eliminar variables de sesion
		*/
		public function destroyVar($var){
			if($this->estado){
				unset($_SESSION[$var]);	
			}
		}
	}
?>