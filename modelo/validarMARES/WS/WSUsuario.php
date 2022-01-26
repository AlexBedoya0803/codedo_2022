<?php

	class WSUsuario
	{
		private $_nombres = "";
		private $_apellidos = "";
		private $_correo = "";
		private $_activo = false;
		private $_facultad = 0;
		private $_centrocosto = 0;
		private $_esdocente = false;

		public function Nombres ($value = NULL){
			if ($value === NULL){ return $this->_nombres;}
			else {$this->_nombres = $value;}
		}

		public function Apellidos ($value = NULL){
			if ($value === NULL){ return $this->_apellidos;}
			else {$this->_apellidos = $value;}
		}

		public function Correo ($value = NULL){
			if ($value === NULL){ return $this->_correo;}
			else {$this->_correo = $value;}
		}

		public function Activo ($value = NULL){
			if ($value === NULL){ return $this->_activo;}
			else {$this->_activo = $value;}
		}

		public function Facultad ($value = NULL){
			if ($value === NULL){ return $this->_facultad;}
			else {$this->_facultad = $value;}
		}

		public function CentroCosto ($value = NULL){
			if ($value === NULL){ return $this->_centrocosto;}
			else {$this->_centrocosto = $value;}
		}

		public function EsDocente ($value = NULL){
			if ($value === NULL){ return $this->_esdocente;}
			else {$this->_esdocente = $value;}
		}
		
		public function Apellido1 (){
			$valores = explode(' ', $this->Apellidos());
			return $valores[0];
		}

		public function Apellido2 (){
			$valores = explode(' ', $this->Apellidos());
			$res = '';
			if (count($valores) > 1) {					
				for ($i = 1; $i < count($valores); $i++){
					$res .= $valores[$i] . ' ';
				}
			}
			return trim($res);
		}

	}
?>