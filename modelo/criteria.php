<?php
require_once('clasesDAO.php');
require_once('clasesDTO.php');

class Criteria
	{
		private $conexion;
		private $tabla;
		private $order;
		private $ordercampo;
		private $filtros;
		private $cont;
		private $arraylist;
		private $query;
		private $result;
		private $operador;
		
		function Criteria($tabla){
			$dao = new ObjetoDAO();
			$this->conexion=$dao->getConexion();
			$this->tabla=$tabla;
			$this->cont=0;
			$this->order="";
			$this->ordercampo="";
			$this->operador="AND";
			echo "<h1>HOLAAAAA</h1>";
		}
		
		function executeQuery($query){
			//echo $query;
			//throw new Exception();
			$resultado=mysqli_query($this->conexion, $query);			
			return $resultado;	
		}
		
		function orderBy($ordercampo,$order){
			$this->ordercampo=$ordercampo;
			$this->order=$order;
		}
		
		function addFiltro($campo,$op,$valor){	
			if($op=="LIKE")
				$criterio=$campo." LIKE '%".$valor."%' ";
			else
				$criterio=$campo." ".$op." '".$valor."'";	
			$this->filtros[$this->cont]=$criterio;
			$this->cont=$this->cont+1;
		}
		
		function generarQuery() {
			$where="";
			$orderby="";
			$select=" SELECT * FROM ".$this->tabla;
		
			if($this->cont > 0) {
				$where =" WHERE ";
				$bandera = 0;
				foreach ($this->filtros as $filtro) {
					if($bandera > 0){
						$where=$where." AND ".$filtro." ".$this->operador;
					} else {
						$where=$where." ".$filtro." ".$this->operador;
					}					
					$bandera += 1;
				}
				//$where = substr($where,0,strlen($where)-4);
			}
			
			if($this->ordercampo!="") $orderby=" ORDER BY ".$this->ordercampo." ".$this->order;
			$query=" $select $where $orderby;";
			$this->query=$query;
			return $this->query;
			
		}
		
		function generarArraylist() {
			$this->conexion = Conexion::Conectar();
		    $this->result=mysqli_query($this->conexion, $this->query);
			if(!($this->result))return array();
			$filas = mysqli_fetch_assoc($this->result);
			$numFilas= mysqli_num_rows($this->result);
			if($numFilas==0)
			return array();
			else
			return $this->traerConsulta($filas);
		}
		
		function _count() {
			$this->generarQuery();
			$this->conexion = Conexion::Conectar();
			$this->result = mysqli_query($this->conexion, $this->query);
			echo $this->query;
			foreach($this as $th){
				echo "<br>";
				print_r($th);
				echo $this->tabla;
			}
			@$numFilas= mysqli_num_rows($this->result);
			return $numFilas;
		}
		
		function execute() {
			$this->generarQuery();
			return $this->generarArraylist();
		}
		
		function executeDirect() {
			return $this->generarArraylist();
		}
		
		function traerConsulta($filas)
		{
		$cont2=0;
			if($this->tabla=="actas")
			{ do { 
				$registro = new ActaDTO();
				$registro->setId($filas['id']);
				$registro->setFecha($filas['fecha']);
				$registro->setAbierta($filas['abierta']);
				$registro->setResolucion($filas['resolucion']);
				$registro->setAnexo($filas['anexo']);
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			}
			if($this->tabla=="comisiones")
			{ do { 
				$registro = new ComisionDTO();
				$registro->setId($filas['id']);
				$registro->setMotivoId($filas['motivo_id']);
				$registro->setActaId($filas['acta_id']);
				$registro->setDocenteId($filas['docente_id']);
				$registro->setTipoComisionId($filas['tipoComision_id']);
				$registro->setDedicacionId($filas['dedicacion_id']);
				$registro->setEstadoId($filas['estado_id']);
				$registro->setPaisId($filas['pais_id']);
				$registro->setFacultadId($filas['facultad_id']);
				$registro->setObjetivo($filas['objetivo']);
				$registro->setLugar($filas['lugar']);
				$registro->setFecha1($filas['fecha1']);
				$registro->setFecha2($filas['fecha2']);
				$registro->setFechaf($filas['fechaf']);
				$registro->setObservaciones($filas['observaciones']);
				$registro->setFechaNotificacion($filas['fechaNotificacion']);
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			}
			if($this->tabla=="docentes")
			{ do { 
				$registro = new DocenteDTO();
				$registro->setId($filas['id']);
				$registro->setFacultadId($filas['facultad_id']);
				$registro->setCategoriaId($filas['categoria_id']);
				$registro->setDedicacionId($filas['dedicacion_id']);
				$registro->setCedula($filas['cedula']);
				$registro->setNombre($filas['nombre']);
				$registro->setApellido1($filas['apellido1']);
				$registro->setApellido2($filas['apellido2']);
				$registro->setFechaVinculacion($filas['fechaVinculacion']);
				$registro->setSexo($filas['sexo']);
				$registro->setCCosto($filas['cCosto']);
				$registro->setNCCosto($filas['nCCosto']);
				$registro->setCorreo($filas['correo']);
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			}
			if($this->tabla=="estados")
			{ do { 
				$registro = new EstadoDTO();
				$registro->setId($filas['id']);
				$registro->setEstado($filas['estado']);
				$registro->setArchivo($filas['archivo']);
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			}
			if($this->tabla=="informes")
			{ do { 
				$registro = new InformeDTO();
				$registro->setId($filas['id']);
				$registro->setActaId($filas['acta_id']);
				$registro->setComisionId($filas['comision_id']);
				$registro->setFecha($filas['fecha']);
				$registro->setActaCF($filas['actaCF']);
				$registro->setAvalCF($filas['avalCF']);
				$registro->setInformeEstudiante($filas['informeEstudiante']);
				$registro->setInformeTutor($filas['informeTutor']);
				$registro->setCalificaciones($filas['calificaciones']);
				$registro->setObtuvoTitulo($filas['obtuvoTitulo']);
				$registro->setInforme($filas['informe']);
				$registro->setFechaReingreso($filas['fechaReingreso']);
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			}
			if($this->tabla=="modificaciones")
			{ do { 
		      $registro = new ModificacionDTO();
				$registro->setId($filas['id']);
				$registro->setDedicacionId($filas['dedicacion_id']);
				$registro->setMotivoId($filas['motivo_id']);
				$registro->setTipoComisionId($filas['tipoComision_id']);
				$registro->setActaId($filas['acta_id']);
				$registro->setPaisId($filas['pais_id']);
				$registro->setComisionId($filas['comision_id']);
				$registro->setFacultadId($filas['facultad_id']);
				$registro->setLugar($filas['lugar']);
				$registro->setObjetivo($filas['objetivo']);
				$registro->setFecha1($filas['fecha1']);
				$registro->setFecha2($filas['fecha2']);
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			}
			if($this->tabla=="motivos")
			{ do { 
				$registro = new MotivoDTO();
				$registro->setId($filas['id']);
				$registro->setMotivo($filas['motivo']);
				$registro->setTipo($filas['tipo']);
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			}
			if($this->tabla=="prorrogas")
			{ do {
				$registro = new ProrrogaDTO();
				$registro->setId($filas['id']);
				$registro->setDedicacionId($filas['dedicacion_id']);
				$registro->setComisionId($filas['comision_id']);
				$registro->setActaId($filas['acta_id']);
				$registro->setFacultadId($filas['facultad_id']);
				$registro->setFecha1($filas['fecha1']);
				$registro->setFecha2($filas['fecha2']);
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			}
			if($this->tabla=="solicitudes")
			{ do { 
				$registro = new SolicitudDTO();
				$registro->setId($filas['id']);
				$registro->setMotivoId($filas['motivo_id']);
				$registro->setRespuestaId($filas['respuesta_id']);
				$registro->setTipoSolicitudId($filas['tipoSolicitud_id']);
				$registro->setActaId($filas['acta_id']);
				$registro->setDocenteId($filas['docente_id']);
				$registro->setEstadoId($filas['estado_id']);
				$registro->setDedicacionId($filas['dedicacion_id']);
				$registro->setPaisId($filas['pais_id']);
				$registro->setComisionId($filas['comision_id']);
				$registro->setFacultadId($filas['facultad_id']);
				$registro->setTipoComisionId($filas['tipoComision_id']);
				$registro->setObjetivo($filas['objetivo']);
				$registro->setLugar($filas['lugar']);
				$registro->setFecha1($filas['fecha1']);
				$registro->setFecha2($filas['fecha2']);
				$registro->setNumeroActaCF($filas['numeroActaCF']);
				$registro->setFechaActaCF($filas['fechaActaCF']);
				$registro->setAvalCF($filas['avalCF']);
				$registro->setSolicitudProfesor($filas['solicitudProfesor']);
				$registro->setCartaAceptacion($filas['cartaAceptacion']);
				$registro->setInformeEstudiante($filas['informeEstudiante']);
				$registro->setInformeTutor($filas['informeTutor']);
				$registro->setCalificaciones($filas['calificaciones']);
				$registro->setComentarios($filas['comentarios']);
				$registro->setRecomendacion($filas['recomendacion']);
				$registro->setObservaciones($filas['observaciones']);
				$registro->setVotada($filas['votada']);
				$registro->setSemaforo($filas['semaforo']);
				$registro->setObtuvoTitulo($filas['obtuvoTitulo']);
				$registro->setInforme($filas['informe']);
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			}
			if($this->tabla=="tipoSolicitudes")
			{ do { 
				$registro = new TipoSolicitudDTO();
				$registro->setId($filas['id']);
				$registro->setTipo($filas['tipo']);
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			}
			if($this->tabla=="dedicaciones")
			{ do { 
				$registro = new DedicacionDTO();
				$registro->setId($filas['id']);
				$registro->setNombre($filas['nombre']);
				$registro->setValor($filas['valor']);
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			}
			if($this->tabla=="categorias")
			{ do { 
				$registro = new CategoriaDTO();
				$registro->setId($filas['id']);
				$registro->setCategoria($filas['categoria']);
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			}
			if($this->tabla=="facultades")
			{ do { 
				$registro = new FacultadDTO();
				$registro->setId($filas['id']);
				$registro->setCodigo($filas['codigo']);
				$registro->setNombre($filas['nombre']);
				$registro->setNombreDecano($filas['nombreDecano']);
				$registro->setApellido1Decano($filas['apellido1Decano']);
				$registro->setApellido2Decano($filas['apellido2Decano']);
				$registro->setTituloDecano($filas['tituloDecano']);
				$registro->setCargoDecano($filas['cargoDecano']);
				$registro->setCorreos($filas['correos']);
				$registro->setSaludo($filas['saludo']);
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			}
			
			if($this->tabla=="paises")
			{ do { 
				$registro = new PaisDTO();
				$registro->setId($filas['id']);
				$registro->setPais($filas['pais']);
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			}
			
			
			if($this->tabla=="respuestas")
			{ do { 
				$registro = new RespuestaDTO();
				$registro->setId($filas['id']);
				$registro->setRespuesta($filas['nombre']);
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			}
			
			if($this->tabla=="usuarios")
			{ do { 
				$registro = new UsuarioDTO();
				$registro->setId($filas['id']);
				$registro->setNombre($filas['nombre']);
				$registro->setCedula($filas['cedula']);
				$registro->setRol($filas['rol']);
				$registro->setClave($filas['clave']);
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			 }
				
			if($this->tabla=="tiposComisiones")
			{ do { 
				$registro = new TipoComisionDTO();
				$registro->setId($filas['id']);
				$registro->setTipo($filas['tipo']);				
				$this->arraylist[$cont2]=$registro;
				$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			 }	
			 
			if($this->tabla=="tiposSolicitudes") { 
				do { 
					$registro = new TipoSolicitudDTO();
					$registro->setId($filas['id']);
					$registro->setTipo($filas['tipo']);		
					$this->arraylist[$cont2]=$registro;
					$cont2++;
				} while ($filas = mysqli_fetch_assoc($this->result)); 
			}		
	   	
			 
		return $this->arraylist;
		}
		
	}