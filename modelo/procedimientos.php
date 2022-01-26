<?php
require_once('clasesDAO.php');
require_once('clasesDTO.php');
require_once('criteria.php');

class Procedimientos {
	var $conexion;
	var $arraylist;
	
	function Procedimientos() {
		$dao=new ObjetoDAO();
		$this->conexion=$dao->getConexion();
	}

  function palabraClaveComision($palabra)
  {
  $select=" SELECT * FROM docentes, paises, motivos, comisiones
   WHERE comisiones.docente_id=docentes.id AND 
          comisiones.pais_id=paises.id AND
		  comisiones.motivo_id=motivos.id AND
		 (paises.pais LIKE '%$palabra%' OR
		 motivos.motivo LIKE '%$palabra%' OR
		  docentes.nombre LIKE '%$palabra%' OR
		  docentes.apellido2 LIKE '%$palabra%' OR 
		  docentes.apellido1 LIKE '%$palabra%' OR 
		  docentes.cedula LIKE '%$palabra%'  OR 
		  docentes.correo LIKE '%$palabra%'  OR
		  comisiones.objetivo LIKE '%$palabra%' OR
          comisiones.lugar LIKE '%$palabra%' OR
		  comisiones.observaciones LIKE '%$palabra%')
		  ORDER BY comisiones.id DESC";
		return $select;
	}
	
	function palabraClaveSolicitud($palabra) {
		$select=" SELECT * FROM tiposSolicitudes, docentes, paises, motivos, solicitudes
		WHERE  solicitudes.tiposolicitud_id=tiposSolicitudes.id AND 
			   solicitudes.docente_id=docentes.id AND 
			  solicitudes.pais_id=paises.id AND
			  solicitudes.motivo_id=motivos.id AND
			 (paises.pais LIKE '%$palabra%' OR
			  tiposSolicitudes.tipo LIKE '%$palabra%' OR
			  motivos.motivo LIKE '%$palabra%' OR
			  docentes.nombre LIKE '%$palabra%' OR
			  docentes.apellido2 LIKE '%$palabra%' OR 
			  docentes.apellido1 LIKE '%$palabra%' OR 
			  docentes.cedula LIKE '%$palabra%'  OR 
			  solicitudes.objetivo LIKE '%$palabra%' OR
			  solicitudes.lugar LIKE '%$palabra%' OR
			  solicitudes.observaciones LIKE '%$palabra%' OR
			  solicitudes.recomendacion LIKE '%$palabra%')
			  ORDER BY solicitudes.id DESC";
			return $select;
	}
	
  function palabraClaveDocente($palabra) {
	  $select=" SELECT docentes.cedula AS cedula,
					   docentes.nombre AS nombre,
					   docentes.apellido1 AS apellido1,
					   docentes.apellido2 AS apellido2,
					   docentes.correo AS correo,
					   docentes.categoria_id AS categoria_id,
					   docentes.dedicacion_id AS dedicacion_id,
					   docentes.facultad_id AS facultad_id,
					   docentes.fechaVinculacion AS fechaVinculacion,
					   facultades.nombre AS facultadNombre,
					   facultades.id AS facultadId,
					   facultades.correos AS facultadCorreo
			   	  FROM docentes,facultades
			     WHERE docentes.facultad_id=facultades.id AND 
					 (docentes.nombre LIKE'%$palabra%' OR
					  docentes.apellido2 LIKE '%$palabra%' OR 
					  docentes.apellido1 LIKE '%$palabra%' OR 
					  docentes.cedula LIKE '%$palabra%')
					  ORDER BY docentes.cedula";
		return $select;
	}
	
	function ultimaActa() {
		$query="SELECT * FROM actas WHERE Abierta=1 ORDER BY id DESC LIMIT 1;";
		$result=mysql_query($query,$this->conexion);
		$filas = mysql_fetch_assoc($result);
		$id=$filas['fecha'];
		return ($id);
	}
}
	
	
 

?>
