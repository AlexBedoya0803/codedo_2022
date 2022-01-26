<?php
require_once('clasesDAO.php');

class ActaDTO {
	
	private $id;
	private $fecha;
	private $abierta;
	private $resolucion;
	private $anexo;	

	function getFecha(){return $this->fecha;}
	function getAbierta(){return $this->abierta;}
	function getResolucion(){return $this->resolucion;}
	function getAnexo(){return $this->anexo;}
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
		
	function setId($nuevodato){$this->id=$nuevodato;}
	function setFecha($nuevodato){$this->fecha=$nuevodato;}
	function setAbierta($nuevodato){$this->abierta=$nuevodato;}
	function setResolucion($nuevodato){$this->resolucion=$nuevodato;}
	function setAnexo($nuevodato){$this->anexo=$nuevodato;}
	
	function save() {
		$odao = new ObjetoDAO();
		$odao->saveActa($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updateActa($this);
	}
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("actas",$this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("actas",$id);
		$this->id=$fila['id'];
		$this->fecha=$fila['fecha'];
		$this->anexo=$fila['anexo'];
		$this->abierta=$fila['abierta'];
		$this->resolucion=$fila['resolucion'];
		return $this;
	}
	
	function getNumeroSolicitudes(){			
		$odao = new ObjetoDAO();
		return $odao->numeroSolicitudes($this->getId());			
	}
	
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////

class ComisionDTO {
	
	private $id;
	private $motivoId;
	private $motivo;
	private $actaId;
	private $acta;
	private $docenteId;
	private $docente;
	private $tipoComisionId;
	private $tipoComision;
	private $dedicacionId;
	private $dedicacion;
	private $estadoId;
	private $estado;
	private $paisId;
	private $pais;
	private $facultadId;
	private $facultad;
	private $objetivo;
	private $lugar;
	private $fecha1;
	private $fecha2;
	private $fechaf;
	private $observaciones;
	private $fechaNotificacion;
	
	function getMotivoId() { return $this->motivoId; }
	function getActaId() { return $this->actaId; }
	function getDocenteId() { return $this->docenteId; }
	function getTipoComisionId() { return $this->tipoComisionId; }
	function getDedicacionId() { return $this->dedicacionId; }
	function getEstadoId() { return $this->estadoId; }
	function getPaisId() { return $this->paisId; }
	function getFacultadId() { return $this->facultadId; }
	function getObjetivo() { return $this->objetivo; }
	function getLugar() { return $this->lugar; }
	function getFecha1() { return $this->fecha1; }
	function getFecha2() { return $this->fecha2; }
	function getFechaf() { return $this->fechaf; }
	function getObservaciones() { return $this->observaciones; }
	function getFechaNotificacion(){return $this->fechaNotificacion;}
		
	function setId($nuevodato) { $this->id=$nuevodato; }
	function setMotivoId($nuevodato) { $this->motivoId=$nuevodato; }
	function setActaId($nuevodato) { $this->actaId=$nuevodato; }
	function setDocenteId($nuevodato) { $this->docenteId=$nuevodato; }
	function setTipoComisionId($nuevodato) { $this->tipoComisionId=$nuevodato; }
	function setDedicacionId($nuevodato) { $this->dedicacionId=$nuevodato; }
	function setEstadoId($nuevodato) { $this->estadoId=$nuevodato; }
	function setPaisId($nuevodato) { $this->paisId=$nuevodato; }
	function setFacultadId($nuevodato) { $this->facultadId=$nuevodato; }
	function setObjetivo($nuevodato) { $this->objetivo=$nuevodato; }
	function setLugar($nuevodato) { $this->lugar=$nuevodato; }
	function setFecha1($nuevodato) { $this->fecha1=$nuevodato; }
	function setFecha2($nuevodato) { $this->fecha2=$nuevodato; }
	function setFechaf($nuevodato) { $this->fechaf=$nuevodato; }
	function setObservaciones($nuevodato) { $this->observaciones=$nuevodato; }
	function setFechaNotificacion($fecha){$this->fechaNotificacion = $fecha;}
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}

	function getMotivo() {
		if($this->motivo) {return $this->motivo;}
		else {
			$obj = new MotivoDTO();
			$this->motivo=$obj->find($this->motivoId);
			return $this->motivo;
		}
	}
	
	function getActa() {
		if($this->acta) {return $this->acta;}
		else {
			$obj = new ActaDTO();
			$this->acta=$obj->find($this->actaId);
			return $this->acta;
		}
	}
	
	function getDocente() {
		if($this->docente) {return $this->docente;}
		else {
			$obj = new DocenteDTO();
			$this->docente=$obj->find($this->docenteId);
			return $this->docente;
		}
	}
	
	function getTipoComision() {
		if($this->tipoComision) {return $this->tipoComision;}
		else {
			$obj = new TipoComisionDTO();
			$this->tipoComision=$obj->find($this->tipoComisionId);
			return $this->tipoComision;
		}
	}

	function getDedicacion() {
		if($this->dedicacion) {return $this->dedicacion;}
		else {
			$obj = new DedicacionDTO();
			$this->dedicacion=$obj->find($this->dedicacionId);
			return $this->dedicacion;
		}
	}
	
	function getEstado() {
		if($this->estado) {return $this->estado;}
		else {
			$obj = new EstadoDTO();
			$this->estado=$obj->find($this->estadoId);
			return $this->estado;
		}
	}
	
	function getPais() {
		if($this->pais) {return $this->pais;}
		else {
			$obj = new PaisDTO();
			$this->pais=$obj->find($this->paisId);
			return $this->pais;
		}
	}
	
	function getFacultad() {
		if($this->facultad) {return $this->facultad;}
		else {
			$obj = new FacultadDTO();
			$this->facultad=$obj->find($this->facultadId);
			return $this->facultad;
		}
	}
	
	function save() {
		$odao = new ObjetoDAO();
		$odao->saveComision($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updateComision($this);
	}
	
	function update2(){
		$odao = new ObjetoDAO();
		$odao->updateComision2($this);
	}
	
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("comisiones", $this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("comisiones",$id);
		$this->id=$fila['id'];
		$this->motivoId=$fila['motivo_id'];
		$this->actaId=$fila['acta_id'];
		$this->docenteId=$fila['docente_id'];
		$this->tipoComisionId=$fila['tipoComision_id'];
		$this->dedicacionId=$fila['dedicacion_id'];
		$this->estadoId=$fila['estado_id'];
		$this->paisId=$fila['pais_id'];
		$this->facultadId=$fila['facultad_id'];
		$this->objetivo=$fila['objetivo'];
		$this->lugar=$fila['lugar'];
		$this->fecha1=$fila['fecha1'];
		$this->fecha2=$fila['fecha2'];
		$this->fechaf=$fila['fechaf'];
		$this->observaciones=$fila['observaciones'];
		$this->fechaNotificacion=$fila['fechaNotificacion'];
		return $this;
	}
	
	function findId(){
		$odao = new ObjetoDAO();
		return $odao->getId("comisiones", 'docente_id', $this->docenteId, 'acta_id', $this->actaId, 'objetivo', $this->objetivo);
	}
}

////////////////////////////////////////////////////////////////////////////////////

class DocenteDTO {

	private $id;
	private $facultadId;
	private $facultad;
	private $categoriaId;
	private $categoria;
	private $dedicacionId;
	private $dedicacion;
	private $cedula;
	private $nombre;
	private $apellido1;
	private $apellido2;
	private $fechaVinculacion;
	private $sexo;
	private $cCosto;
	private $nCCosto;
	private $correo;

	function getFacultadId(){return $this->facultadId;}
	function getCategoriaId(){return $this->categoriaId;}
	function getDedicacionId(){return $this->dedicacionId;}
	function getCedula(){return $this->cedula;}
	function getNombre(){return $this->nombre;}
	function getApellido1(){return $this->apellido1;}
	function getApellido2(){return $this->apellido2;}
	function getFechaVinculacion(){return $this->fechaVinculacion;}
	function getSexo(){return $this->sexo;}
	function getCCosto(){return $this->cCosto;}
	function getNCCosto(){return $this->nCCosto;}
	function getCorreo(){return $this->correo;}
	
	function getFacultad() {
		if($this->facultad) {return $this->facultad;}
		else {
			$obj = new FacultadDTO();
			$this->facultad=$obj->find($this->facultadId);
			return $this->facultad;
		}
	}
	
	function getCategoria() {
		if($this->categoria) {return $this->categoria;}
		else {
			$obj = new CategoriaDTO();
			$this->categoria=$obj->find($this->categoriaId);
			return $this->categoria;
		}
	}
	
	function getDedicacion() {
		if($this->dedicacion) {return $this->dedicacion;}
		else {
			$obj = new DedicacionDTO();
			$this->dedicacion=$obj->find($this->dedicacionId);
			return $this->dedicacion;
		}
	}
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
		
	function setId($nuevodato){$this->id=$nuevodato;}
	function setFacultadId($nuevodato){$this->facultadId=$nuevodato;}
	function setCategoriaId($nuevodato){$this->categoriaId=$nuevodato;}
	function setDedicacionId($nuevodato){$this->dedicacionId=$nuevodato;}
	function setCedula($nuevodato){$this->cedula=$nuevodato;}
	function setNombre($nuevodato){$this->nombre=$nuevodato;}
	function setApellido1($nuevodato){$this->apellido1=$nuevodato;}
	function setApellido2($nuevodato){$this->apellido2=$nuevodato;}
	function setFechaVinculacion($nuevodato){$this->fechaVinculacion=$nuevodato;}
	function setSexo($nuevodato){$this->sexo=$nuevodato;}
	function setCCosto($nuevodato){$this->cCosto=$nuevodato;}
	function setNCCosto($nuevodato){$this->nCCosto=$nuevodato;}
	function setCorreo($nuevodato){$this->correo=$nuevodato;}
	
	function save() {
		$odao = new ObjetoDAO();
		$odao->saveDocente($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updateDocente($this);
	}
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("docentes",$this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("docentes",$id);
		$this->id=$fila['id'];
		$this->facultadId=$fila['facultad_id'];
		$this->categoriaId=$fila['categoria_id'];
		$this->dedicacionId=$fila['dedicacion_id'];
		$this->cedula=$fila['cedula'];
		$this->nombre=$fila['nombre'];
		$this->apellido1=$fila['apellido1'];
		$this->apellido2=$fila['apellido2'];
		$this->fechaVinculacion=$fila['fechaVinculacion'];
		$this->sexo=$fila['sexo'];
		$this->cCosto=$fila['cCosto'];
		$this->nCCosto=$fila['nCCosto'];
		$this->correo=$fila['correo'];
		return $this;
	}
	
	function findId(){
		$odao = new ObjetoDAO();
		return $odao->getId("docentes","cedula",$this->cedula, NULL, NULL);	
	}
	
	function getNumeroComisiones(){
		$odao = new ObjetoDAO();
		return $odao->numeroComisiones($this->cedula);	
	}
	
	function getNumeroComisionesProxima(){
		$odao = new ObjetoDAO();
		return $odao->numeroComisionesProxima($this->cedula);	
	}
}

////////////////////////////////////////////////////////////////////////////////////

class EstadoDTO {

	private $id;
	private $estado;
	private $archivo;

	function getEstado() { return $this->estado; }
	function getArchivo() { return $this->archivo; }
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
		
	function setId($nuevodato) { $this->id=$nuevodato; }
	function setEstado($nuevodato) { $this->estado=$nuevodato; }
	function setArchivo($nuevodato) { $this->archivo=$nuevodato; }
	
	function save() {
		$odao = new ObjetoDAO();
		$odao->saveEstado($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updateEstado($this);
	}
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("estados", $this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("estados",$id);
		$this->id=$fila['id'];
		$this->estado=$fila['estado'];
		$this->archivo=$fila['archivo'];
		return $this;
	}
}

////////////////////////////////////////////////////////////////////////////////////

class InformeDTO {

	private $id;
	private $actaId;
	private $acta;
	private $comisionId;
	private $comision;
	private $fecha;
	private $actaCF;
	private $avalCF;
	private $informeEstudiante;
	private $informeTutor;
	private $calificaciones;
	private $obtuvoTitulo;
	private $informe;
	private $fechaReingreso;

	function getActaId() { return $this->actaId; }
	function getComisionId() { return $this->comisionId; }
	function getFecha() { return $this->fecha; }
	function getActaCF() { return $this->actaCF; }
	function getAvalCF() { return $this->avalCF; }
	function getInformeEstudiante() { return $this->informeEstudiante; }
	function getInformeTutor() { return $this->informeTutor; }
	function getCalificaciones() { return $this->calificaciones; }
	function getObtuvoTitulo() { return $this->obtuvoTitulo; }
	function getInforme() { return $this->informe; }
	function getFechaReingreso() { return $this->fechaReingreso; }
	
	function getActa() {
		if($this->acta) {return $this->acta;}
		else {
			$obj = new ActaDTO();
			$this->acta=$obj->find($this->actaId);
			return $this->acta;
		}
	}
	
	function getComision() {
		if($this->comision) {return $this->comision;}
		else {
			$obj = new ComisionDTO();
			$this->comision=$obj->find($this->comisionId);
			return $this->comision;
		}
	}
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
		
	function setId($nuevodato) { $this->id=$nuevodato; }
	function setActaId($nuevodato) { $this->actaId=$nuevodato; }
	function setComisionId($nuevodato) { $this->comisionId=$nuevodato; }
	function setFecha($nuevodato) { $this->fecha=$nuevodato; }
	function setActaCF($nuevodato) { $this->actaCF=$nuevodato; }
	function setAvalCF($nuevodato) { $this->avalCF=$nuevodato; }
	function setInformeEstudiante($nuevodato) { $this->informeEstudiante=$nuevodato; }
	function setInformeTutor($nuevodato) { $this->informeTutor=$nuevodato; }
	function setCalificaciones($nuevodato) { $this->calificaciones=$nuevodato; }
	function setObtuvoTitulo($nuevodato) { $this->obtuvoTitulo=$nuevodato; }
	function setInforme($nuevodato) { $this->informe=$nuevodato; }
	function setFechaReingreso($nuevodato) { $this->fechaReingreso=$nuevodato; }
	
	function save() {
		$odao = new ObjetoDAO();
		$odao->saveInforme($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updateInforme($this);
	}
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("informes",$this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("informes",$id);
		$this->id=$fila['id'];
		$this->actaId=$fila['acta_id'];
		$this->comisionId=$fila['comision_id'];
		$this->fecha=$fila['fecha'];
		$this->actaCF=$fila['actaCF'];
		$this->avalCF=$fila['avalCF'];
		$this->informeEstudiante=$fila['informeEstudiante'];
		$this->informeTutor=$fila['informeTutor'];
		$this->calificaciones=$fila['calificaciones'];
		$this->obtuvoTitulo=$fila['obtuvoTitulo'];
		$this->informe=$fila['informe'];
		$this->fechaReingreso=$fila['fechaReingreso'];
		return $this;
	}
}

////////////////////////////////////////////////////////////////////////////////////

class ModificacionDTO {
 
	private $id;
	private $dedicacionId;
	private $dedicacion;
	private $motivoId;
	private $motivo;
	private $tipoComisionId;
	private $tipoComision;
	private $actaId;
	private $acta;
	private $paisId;
	private $pais;
	private $comisionId;
	private $comision;
	private $facultadId;
	private $facultad;
	private $lugar;
	private $objetivo;
	private $fecha1;
	private $fecha2;

	function getDedicacionId() { return $this->dedicacionId; }
	function getMotivoId() { return $this->motivoId; }
	function getTipoComisionId() { return $this->tipoComisionId; }
	function getActaId() { return $this->actaId; }
	function getPaisId() { return $this->paisId; }
	function getComisionId() { return $this->comisionId; }
	function getFacultadId() { return $this->facultadId; }
	function getLugar() { return $this->lugar; }
	function getObjetivo() { return $this->objetivo; }
	function getFecha1() { return $this->fecha1; }
	function getFecha2() { return $this->fecha2; }
	
	function getDedicacion() {
		if($this->dedicacion) {return $this->dedicacion;}
		else {
			$obj = new DedicacionDTO();
			$this->dedicacion=$obj->find($this->dedicacionId);
			return $this->dedicacion;
		}
	}
	
	function getMotivo() {
		if($this->motivo) {return $this->motivo;}
		else {
			$obj = new MotivoDTO();
			$this->motivo=$obj->find($this->motivoId);
			return $this->motivo;
		}
	}
	
	function getTipoComision() {
		if($this->tipoComision) {return $this->tipoComision;}
		else {
			$obj = new TipoComisionDTO();
			$this->tipoComision=$obj->find($this->tipoComisionId);
			return $this->tipoComision;
		}
	}
	
	function getActa() {
		if($this->acta) {return $this->acta;}
		else {
			$obj = new ActaDTO();
			$this->acta=$obj->find($this->actaId);
			return $this->acta;
		}
	}
	
	function getPais() {
		if($this->pais) {return $this->pais;}
		else {
			$obj = new PaisDTO();
			$this->pais=$obj->find($this->paisId);
			return $this->pais;
		}
	}
	
	function getComision() {
		if($this->comision) {return $this->comision;}
		else {
			$obj = new ComisionDTO();
			$this->comision=$obj->find($this->comisionId);
			return $this->comision;
		}
	}
	
	function getFacultad() {
		if($this->facultad) {return $this->facultad;}
		else {
			$obj = new FacultadDTO();
			$this->facultad=$obj->find($this->facultadId);
			return $this->facultad;
		}
	}
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
		
	function setId($nuevodato) { $this->id=$nuevodato; }
	function setDedicacionId($nuevodato) { $this->dedicacionId=$nuevodato; }
	function setMotivoId($nuevodato) { $this->motivoId=$nuevodato; }
	function setTipoComisionId($nuevodato) { $this->tipoComisionId=$nuevodato; }
	function setActaId($nuevodato) { $this->actaId=$nuevodato; }
	function setPaisId($nuevodato) { $this->paisId=$nuevodato; }
	function setComisionId($nuevodato) { $this->comisionId=$nuevodato; }
	function setFacultadId($nuevodato) { $this->facultadId=$nuevodato; }
	function setLugar($nuevodato) { $this->lugar=$nuevodato; }
	function setObjetivo($nuevodato) { $this->objetivo=$nuevodato; }
	function setFecha1($nuevodato) { $this->fecha1=$nuevodato; }
	function setFecha2($nuevodato) { $this->fecha2=$nuevodato; }
	
	function save() {
		$odao = new ObjetoDAO();
		$odao->saveModificacion($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updateModificacion($this);
	}
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("modificaciones",$this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("modificaciones",$id);
		$this->id=$fila['id'];
		$this->dedicacionId=$fila['dedicacion_id'];
		$this->motivoId=$fila['motivo_id'];
		$this->tipoComisionId=$fila['tipoComision_id'];
		$this->actaId=$fila['acta_id'];
		$this->paisId=$fila['pais_id'];
		$this->comisionId=$fila['comision_id'];
		$this->facultadId=$fila['facultad_id'];
		$this->lugar=$fila['lugar'];
		$this->objetivo=$fila['objetivo'];
		$this->fecha1=$fila['fecha1'];
		$this->fecha2=$fila['fecha2'];
		return $this;
	}
}

////////////////////////////////////////////////////////////////////////////////////

class MotivoDTO {

	private $id;
	private $motivo;
	private $tipo;

	function getMotivo() { return $this->motivo; }
	function getTipo() { return $this->tipo; }
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
		
	function setId($nuevodato) { $this->id=$nuevodato; }
	function setMotivo($nuevodato) { $this->motivo=$nuevodato; }
	function setTipo($nuevodato) { $this->tipo=$nuevodato; }
	
	function save() {
		$odao = new ObjetoDAO();
		$odao->saveMotivo($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updateMotivo($this);
	}
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("motivos",$this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("motivos",$id);
		$this->id=$fila['id'];
		$this->motivo=$fila['motivo'];
		$this->tipo=$fila['tipo'];
		return $this;
	}
}

////////////////////////////////////////////////////////////////////////////////////

class ProrrogaDTO {

	private $id;
	private $dedicacionId;
	private $dedicacion;
	private $comisionId;
	private $comision;
	private $actaId;
	private $acta;
	private $facultadId;
	private $facultad;
	private $fecha1;
	private $fecha2;

	function getDedicacionId() { return $this->dedicacionId; }
	function getComisionId() { return $this->comisionId; }
	function getActaId() { return $this->actaId; }
	function getFacultadId() { return $this->facultadId; }
	function getFecha1() { return $this->fecha1; }
	function getFecha2() { return $this->fecha2; }
	
	function getDedicacion() {
		if($this->dedicacion) {return $this->dedicacion;}
		else {
			$obj = new DedicacionDTO();
			$this->dedicacion=$obj->find($this->dedicacionId);
			return $this->dedicacion;
		}
	}
	
	function getComision() {
		if($this->comision) {return $this->comision;}
		else {
			$obj = new ComisionDTO();
			$this->comision=$obj->find($this->comisionId);
			return $this->comision;
		}
	}
	
	function getActa() {
		if($this->acta) {return $this->acta;}
		else {
			$obj = new ActaDTO();
			$this->acta=$obj->find($this->actaId);
			return $this->acta;
		}
	}
	
	function getFacultad() {
		if($this->facultad) {return $this->facultad;}
		else {
			$obj = new FacultadDTO();
			$this->facultad=$obj->find($this->facultadId);
			return $this->facultad;
		}
	}
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
		
	function setId($nuevodato) { $this->id=$nuevodato; }
	function setDedicacionId($nuevodato) { $this->dedicacionId=$nuevodato; }
	function setComisionId($nuevodato) { $this->comisionId=$nuevodato; }
	function setActaId($nuevodato) { $this->actaId=$nuevodato; }
	function setFacultadId($nuevodato) { $this->facultadId=$nuevodato; }
	function setFecha1($nuevodato) { $this->fecha1=$nuevodato; }
	function setFecha2($nuevodato) { $this->fecha2=$nuevodato; }
	
	function save() {
		$odao = new ObjetoDAO();
		$odao->saveProrroga($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updateProrroga($this);
	}
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("prorrogas",$this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("prorrogas",$id);
		$this->id=$fila['id'];
		$this->dedicacionId=$fila['dedicacion_id'];
		$this->comisionId=$fila['comision_id'];
		$this->actaId=$fila['acta_id'];
		$this->facultadId=$fila['facultad_id'];
		$this->fecha1=$fila['fecha1'];
		$this->fecha2=$fila['fecha2'];
		return $this;
	}
}

////////////////////////////////////////////////////////////////////////////////////

class SolicitudDTO {

	private $id;
	private $motivoId;
	private $motivo;
	private $respuestaId;
	private $respuesta;
	private $tipoSolicitudId;
	private $tipoSolicitud;
	private $actaId;
	private $acta;
	private $docenteId;
	private $docente;
	private $estadoId;
	private $estado;
	private $dedicacionId;
	private $dedicacion;
	private $paisId;
	private $pais;
	private $comisionId;
	private $comision;
	private $facultadId;
	private $facultad;
	private $tipoComisionId;
	private $tipoComision;
	private $objetivo;
	private $lugar;
	private $fecha1;
	private $fecha2;
	private $numeroActaCF;
	private $fechaActaCF;
	private $avalCF;
	private $solicitudProfesor;
	private $cartaAceptacion;
	//private $resolucionDeAdmision
	private $informeEstudiante;
	private $informeTutor;
	private $calificaciones;
	private $comentarios;
	private $recomendacion;
	private $observaciones;
	private $votada;
	private $semaforo;
	private $obtuvoTitulo;
	private $informe;
	private $fechaReingreso;
	private $comentariosUnidad;
	private $resolucion;
	private $fechaResolucion;
	private $inicioResolucion;
	private $finResolucion;
	

	function getMotivoId() { return $this->motivoId; }
	function getRespuestaId() { return $this->respuestaId; }
	function getTipoSolicitudId() { return $this->tipoSolicitudId; }
	function getActaId() { return $this->actaId; }
	function getDocenteId() { return $this->docenteId; }
	function getEstadoId() { return $this->estadoId; }
	function getDedicacionId() { return $this->dedicacionId; }
	function getPaisId() { return $this->paisId; }
	function getComisionId() { return $this->comisionId; }
	function getFacultadId() { return $this->facultadId; }
	function getTipoComisionId() { return $this->tipoComisionId; }
	function getObjetivo() { return $this->objetivo; }
	function getLugar() { return $this->lugar; }
	function getFecha1() { return $this->fecha1; }
	function getFecha2() { return $this->fecha2; }
	function getNumeroActaCF() { return $this->numeroActaCF; }
	function getFechaActaCF() { return $this->fechaActaCF; }
	function getAvalCF() { return $this->avalCF; }
	function getSolicitudProfesor() { return $this->solicitudProfesor; }
	function getCartaAceptacion() { return $this->cartaAceptacion; }	
	//function getResolucionDeAdmision() { return $this->resolucionDeAdmision; }
	function getInformeEstudiante() { return $this->informeEstudiante; }
	function getInformeTutor() { return $this->informeTutor; }
	function getCalificaciones() { return $this->calificaciones; }
	function getComentarios() { return $this->comentarios; }
	function getRecomendacion() { return $this->recomendacion; }
	function getObservaciones() { return $this->observaciones; }
	function getVotada() { return $this->votada; }
	function getSemaforo() { return $this->semaforo; }
	function getObtuvoTitulo() { return $this->obtuvoTitulo; }
	function getFechaReingreso() { return $this->fechaReingreso; }
	function getInforme() { return $this->informe; }
	function getComentariosUnidad(){return $this->comentariosUnidad;}
	function getResolucion(){return $this->resolucion;}
	function getFechaResolucion(){return $this->fechaResolucion;}
	function getInicioResolucion(){return $this->inicioResolucion;}
	function getFinResolucion(){return $this->finResolucion;}

	

	
	function getMotivo() {
		if($this->motivo) {return $this->motivo;}
		else {
			$obj = new MotivoDTO();
			$this->motivo=$obj->find($this->motivoId);
			return $this->motivo;
		}
	}
	
	function getRespuesta() {
		if($this->respuesta) {return $this->respuesta;}
		else {
			$obj = new RespuestaDTO();
			$this->respuesta=$obj->find($this->respuestaId);
			return $this->respuesta;
		}
	}
	
	function getTipoSolicitud() {
		if($this->tipoSolicitud) {return $this->tipoSolicitud;}
		else {
			$obj = new TipoSolicitudDTO();
			$this->tipoSolicitud=$obj->find($this->tipoSolicitudId);
			return $this->tipoSolicitud;
		}
	}
	
	function getActa() {
		if($this->acta) {return $this->acta;}
		else {
			$obj = new ActaDTO();
			$this->acta=$obj->find($this->actaId);
			return $this->acta;
		}
	}
	
	function getDocente() {
		if($this->docente) {return $this->docente;}
		else {
			$obj = new DocenteDTO();
			$this->docente=$obj->find($this->docenteId);
			return $this->docente;
		}
	}
	
	function getEstado() {
		if($this->estado) {return $this->estado;}
		else {
			$obj = new EstadoDTO();
			$this->estado=$obj->find($this->estadoId);
			return $this->estado;
		}
	}
	
	function getDedicacion() {
		if($this->dedicacion) {return $this->dedicacion;}
		else {
			$obj = new DedicacionDTO();
			$this->dedicacion=$obj->find($this->dedicacionId);
			return $this->dedicacion;
		}
	}
	
	function getPais() {
		if($this->pais) {return $this->pais;}
		else {
			$obj = new PaisDTO();
			$this->pais=$obj->find($this->paisId);
			return $this->pais;
		}
	}
	
	function getComision() {
		if($this->comision) {return $this->comision;}
		else {
			$obj = new ComisionDTO();
			$this->comision=$obj->find($this->comisionId);
			return $this->comision;
		}
	}
	
	function getFacultad() {
		if($this->facultad) {return $this->facultad;}
		else {
			$obj = new FacultadDTO();
			$this->facultad=$obj->find($this->facultadId);
			return $this->facultad;
		}
	}
	
	function getTipoComision() {
		if($this->tipoComision) {return $this->tipoComision;}
		else {
			$obj = new TipoComisionDTO();
			$this->tipoComision=$obj->find($this->tipoComisionId);
			return $this->tipoComision;
		}
	}
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
	
	function getVotaciones(){
		$dao = new ObjetoDAO();
		return $dao->getVotaciones($this->id);
	}
	
	function getDuracion(){
		return 1;	
	}
		
	function setId($nuevodato) { $this->id=$nuevodato; }
	function setMotivoId($nuevodato) { $this->motivoId=$nuevodato; }
	function setRespuestaId($nuevodato) { $this->respuestaId=$nuevodato; }
	function setTipoSolicitudId($nuevodato) { $this->tipoSolicitudId=$nuevodato; }
	function setActaId($nuevodato) { $this->actaId=$nuevodato; }
	function setDocenteId($nuevodato) { $this->docenteId=$nuevodato; }
	function setEstadoId($nuevodato) { $this->estadoId=$nuevodato; }
	function setDedicacionId($nuevodato) { $this->dedicacionId=$nuevodato; }
	function setPaisId($nuevodato) { $this->paisId=$nuevodato; }
	function setComisionId($nuevodato) { $this->comisionId=$nuevodato; }
	function setFacultadId($nuevodato) { $this->facultadId=$nuevodato; }
	function setTipoComisionId($nuevodato) { $this->tipoComisionId=$nuevodato; }
	function setObjetivo($nuevodato) { $this->objetivo=$nuevodato; }
	function setLugar($nuevodato) { $this->lugar=$nuevodato; }
	function setFecha1($nuevodato) { $this->fecha1=$nuevodato; }
	function setFecha2($nuevodato) { $this->fecha2=$nuevodato; }
	function setNumeroActaCF($nuevodato) { $this->numeroActaCF=$nuevodato; }
	function setFechaActaCF($nuevodato) { $this->fechaActaCF=$nuevodato; }
	function setAvalCF($nuevodato) { $this->avalCF=$nuevodato; }
	function setSolicitudProfesor($nuevodato) { $this->solicitudProfesor=$nuevodato; }
	function setCartaAceptacion($nuevodato) { $this->cartaAceptacion=$nuevodato; }
	//function setResolucionDeAdmision($nuevodato) { $this->resolucionDeAdmision=$nuevodato; }
	function setInformeEstudiante($nuevodato) { $this->informeEstudiante=$nuevodato; }
	function setInformeTutor($nuevodato) { $this->informeTutor=$nuevodato; }
	function setCalificaciones($nuevodato) { $this->calificaciones=$nuevodato; }
	function setComentarios($nuevodato) { $this->comentarios=$nuevodato; }
	function setRecomendacion($nuevodato) { $this->recomendacion=$nuevodato; }
	//function setRecomendacion($nuevodato) { $this->recomendacion=$nuevodato; }
	function setObservaciones($nuevodato) { $this->observaciones=$nuevodato; }
	function setVotada($nuevodato) { $this->votada=$nuevodato; }
	function setSemaforo($nuevodato) { $this->semaforo=$nuevodato; }
	function setObtuvoTitulo($nuevodato) { $this->obtuvoTitulo=$nuevodato; }
	function setInforme($nuevodato) { $this->informe=$nuevodato; }
	function setFechaReingreso($nuevodato) { $this->fechaReingreso=$nuevodato; }
	function setComentariosUnidad($comentarios){$this->comentariosUnidad=$comentarios;}
	function setResolucion($nuevodato) { $this->resolucion=$nuevodato; }
	function setFechaResolucion($nuevodato) { $this->fechaResolucion=$nuevodato; }
	function setInicioResolucion($nuevodato) { $this->inicioResolucion=$nuevodato; }
	function setFinResolucion($nuevodato) { $this->finResolucion=$nuevodato; }


	
	function save() {
		$odao = new ObjetoDAO();
		return $odao->saveSolicitud($this);
	}
	
	function save2(){
		$odao = new ObjetoDAO();
		return $odao->saveSolicitud2($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updateSolicitud2($this);
	}
	function update2(){
		$odao = new ObjetoDAO();
		$odao->updateSolicitud2($this);
	}
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("solicitudes",$this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("solicitudes",$id);
		$this->id=$fila['id'];
		$this->motivoId=$fila['motivo_id'];
		$this->respuestaId=$fila['respuesta_id'];
		$this->tipoSolicitudId=$fila['tipoSolicitud_id'];
		$this->actaId=$fila['acta_id'];
		$this->docenteId=$fila['docente_id'];
		$this->estadoId=$fila['estado_id'];
		$this->dedicacionId=$fila['dedicacion_id'];
		$this->paisId=$fila['pais_id'];
		$this->comisionId=$fila['comision_id'];
		$this->facultadId=$fila['facultad_id'];
		$this->tipoComisionId=$fila['tipoComision_id'];
		$this->objetivo=$fila['objetivo'];
		$this->lugar=$fila['lugar'];
		$this->fecha1=$fila['fecha1'];
		$this->fecha2=$fila['fecha2'];
		$this->numeroActaCF=$fila['numeroActaCF'];
		$this->fechaActaCF=$fila['fechaActaCF'];
		$this->avalCF=$fila['avalCF'];
		$this->solicitudProfesor=$fila['solicitudProfesor'];
		$this->cartaAceptacion=$fila['cartaAceptacion'];
		//$this->resolucionDeAdmision=$fila['resolucionDeAdmision'];

		$this->informeEstudiante=$fila['informeEstudiante'];
		$this->informeTutor=$fila['informeTutor'];
		$this->calificaciones=$fila['calificaciones'];
		$this->comentarios=$fila['comentarios'];
		$this->recomendacion=$fila['recomendacion'];
		$this->observaciones=$fila['observaciones'];
		$this->votada=$fila['votada'];
		$this->semaforo=$fila['semaforo'];
		$this->obtuvoTitulo=$fila['obtuvoTitulo'];
		$this->informe=$fila['informe'];
		$this->fechaReingreso=$fila['fechaReingreso'];
		$this->resolucion=$fila['resolucion'];
		$this->fechaResolucion=$fila['fechaResolucion'];
		$this->inicioResolucion=$fila['inicioResolucion'];
		$this->finResolucion=$fila['finResolucion'];

		return $this;
	}
	
	function findId(){
		$odao = new ObjetoDAO();
		//return $odao->getId("solicitudes", 'docente_id', $this->docenteId, 'acta_id', $this->actaId, 'objetivo', $this->objetivo);
		return $odao->getId("solicitudes", 'comision_id', $this->comisionId);
	}
}

////////////////////////////////////////////////////////////////////////////////////

class DedicacionDTO {

	private $id;
	private $nombre;
	private $valor;

	function getNombre() { return $this->nombre; }
	function getValor() { return $this->valor; }
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
		
	function setId($nuevodato) { $this->id=$nuevodato; }
	function setNombre($nuevodato) { $this->nombre=$nuevodato; }
	function setValor($nuevodato) { $this->valor=$nuevodato; }
	
	function save() {
		$odao = new ObjetoDAO();
		$odao->saveDedicacion($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updateDedicacion($this);
	}
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("dedicaciones",$this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("dedicaciones",$id);
		$this->id=$fila['id'];
		$this->nombre=$fila['nombre'];
		$this->valor=$fila['valor'];
		return $this;
	}
}

////////////////////////////////////////////////////////////////////////////////////

class CategoriaDTO {

	private $id;
	private $categoria;

	function getCategoria() { return $this->categoria; }
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
		
	function setId($nuevodato) { $this->id=$nuevodato; }
	function setCategoria($nuevodato) { $this->categoria=$nuevodato; }
	
	function save() {
		$odao = new ObjetoDAO();
		$odao->saveCategoria($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updateCategoria($this);
	}
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("categorias",$this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("categorias",$id);
		$this->id=$fila['id'];
		$this->categoria=$fila['categoria'];
		return $this;
	}
	
	function findId(){
		$odao = new ObjetoDAO();
		return $odao->getId("categorias", "categoria", $this->categoria);
	}
}

////////////////////////////////////////////////////////////////////////////////////

class FacultadDTO {

	private $id;
	private $codigo;
	private $nombre;
	private $nombreDecano;
	private $apellido1Decano;
	private $apellido2Decano;
	private $tituloDecano;
	private $cargoDecano;
	private $correos;
	private $saludo;

	function getCodigo() { return $this->codigo; }
	function getNombre() { return $this->nombre; }
	function getNombreDecano() { return $this->nombreDecano; }
	function getApellido1Decano() { return $this->apellido1Decano; }
	function getApellido2Decano() { return $this->apellido2Decano; }
	function getTituloDecano() { return $this->tituloDecano; }
	function getCargoDecano() { return $this->cargoDecano; }
	function getCorreos() { return $this->correos; }
	function getSaludo() { return $this->saludo; }
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
		
	function setId($nuevodato) { $this->id=$nuevodato; }
	function setCodigo($nuevodato) { $this->codigo=$nuevodato; }
	function setNombre($nuevodato) { $this->nombre=$nuevodato; }
	function setNombreDecano($nuevodato) { $this->nombreDecano=$nuevodato; }
	function setApellido1Decano($nuevodato) { $this->apellido1Decano=$nuevodato; }
	function setApellido2Decano($nuevodato) { $this->apellido2Decano=$nuevodato; }
	function setTituloDecano($nuevodato) { $this->tituloDecano=$nuevodato; }
	function setCargoDecano($nuevodato) { $this->cargoDecano=$nuevodato; }
	function setCorreos($nuevodato) { $this->correos=$nuevodato; }
	function setSaludo($nuevodato) { $this->saludo=$nuevodato; }
	
	function save() {
		$odao = new ObjetoDAO();
		$odao->saveFacultad($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updateFacultad($this);
	}
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("facultades",$this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("facultades",$id);
		$this->id=$fila['id'];
		$this->codigo=$fila['codigo'];
		$this->nombre=$fila['nombre'];
		$this->nombreDecano=$fila['nombreDecano'];
		$this->apellido1Decano=$fila['apellido1Decano'];
		$this->apellido2Decano=$fila['apellido2Decano'];
		$this->tituloDecano=$fila['tituloDecano'];
		$this->cargoDecano=$fila['cargoDecano'];
		$this->correos=$fila['correos'];
		$this->saludo=$fila['saludo'];
		return $this;
	}
	
	function findId(){
		$odao = new ObjetoDAO();
		return $odao->getId("facultades", "codigo", $this->codigo);
	}
}

////////////////////////////////////////////////////////////////////////////////////

class PaisDTO {

	private $id;
	private $pais;

	function getPais() { return $this->pais; }
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
		
	function setId($nuevodato) { $this->id=$nuevodato; }
	function setPais($nuevodato) { $this->pais=$nuevodato; }
	
	function save() {
		$odao = new ObjetoDAO();
		$odao->savePais($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updatePais($this);
	}
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("paises",$this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("paises",$id);
		$this->id=$fila['id'];
		$this->pais=$fila['pais'];
		return $this;
	}
	
	function findId(){
		$odao = new ObjetoDAO();
		return $odao->getId("paises", "pais", $this->pais);
	}
}

////////////////////////////////////////////////////////////////////////////////////

class RespuestaDTO {

	private $id;
	private $respuesta;

	function getRespuesta() { return $this->respuesta; }
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
		
	function setId($nuevodato) { $this->id=$nuevodato; }
	function setRespuesta($nuevodato) { $this->respuesta=$nuevodato; }
	
	function save() {
		$odao = new ObjetoDAO();
		$odao->saveRespuesta($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updateRespuesta($this);
	}
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("respuestas",$this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("respuestas",$id);
		$this->id=$fila['id'];
		$this->respuesta=$fila['respuesta'];
		return $this;
	}
}

////////////////////////////////////////////////////////////////////////////////////

class UsuarioDTO {

	private $id;
	private $cedula;
	private $nombre;
	private $clave;
	private $rol;

	function getCedula() { return $this->cedula; }
	function getNombre() { return $this->nombre; }
	function getClave() { return $this->clave; }
	function getRol() { return $this->rol; }
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
		
	function setId($nuevodato) { $this->id=$nuevodato; }
	function setCedula($nuevodato) { $this->cedula=$nuevodato; }
	function setNombre($nuevodato) { $this->nombre=$nuevodato; }
	function setClave($nuevodato) { $this->clave=$nuevodato; }
	function setRol($nuevodato) { $this->rol=$nuevodato; }
	
	function save() {
		$odao = new ObjetoDAO();
		$odao->saveUsuario($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updateUsuario($this);
	}
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("usuarios",$this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("usuarios",$id);
		$this->id=$fila['id'];
		$this->cedula=$fila['cedula'];
		$this->nombre=$fila['nombre'];
		$this->clave=$fila['clave'];
		$this->rol=$fila['rol'];
		return $this;
	}
	
	function findId(){
		$odao = new ObjetoDAO();
		return $odao->getId("usuarios", "cedula", $this->cedula, "rol", $this->rol);
	}
	
	function findId2(){
		$oda = new ObjetoDAO();
		return $oda->getId("usuarios","cedula",$this->cedula);	
	}
	
	
}

////////////////////////////////////////////////////////////////////////////////////

class TipoSolicitudDTO {

	private $id;
	private $tipo;

	function getTipo() { return $this->tipo; }
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
		
	function setId($nuevodato) { $this->id=$nuevodato; }
	function setTipo($nuevodato) { $this->tipo=$nuevodato; }
	
	function save() {
		$odao = new ObjetoDAO();
		$odao->saveTipoSolicitud($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updateTipoSolicitud($this);
	}
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("tiposSolicitudes",$this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("tiposSolicitudes",$id);
		$this->id=$fila['id'];
		$this->tipo=$fila['tipo'];
		return $this;
	}
	
	function findId(){
		$odao = new ObjetoDAO();
		return $odao->getId("tiposSolicitudes", "tipo", $this->tipo);
	}
}

////////////////////////////////////////////////////////////////////////////////////

class TipoComisionDTO {

	private $id;
	private $tipo;

	function getTipo() { return $this->tipo; }
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
		
	function setId($nuevodato) { $this->id=$nuevodato; }
	function setTipo($nuevodato) { $this->tipo=$nuevodato; }
	
	function save() {
		$odao = new ObjetoDAO();
		$odao->saveTipoComision($this);
	}
	
	function update() {
		$odao = new ObjetoDAO();
		$odao->updateTipoComision($this);
	}
	
	function delete() {
		$odao = new ObjetoDAO();
		$odao->delete("tiposComisiones",$this->getId());
	}
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("tiposComisiones",$id);
		$this->id=$fila['id'];
		$this->tipo=$fila['tipo'];
		return $this;
	}
	
	function findId(){
		$odao = new ObjetoDAO();
		return $odao->getId("tiposComisiones", "tipo", $this->tipo);
	}
}

// 0 no ha votado, 1 voto que 
class VotacionDTO{
	private $solicitud_id;
	private $usuario_id;
	private $votacion;
	private $comentarios;
	
	function getSolicitud_id(){
		return $this->solicitud_id;
	}
	
	function getUsuario_id(){
		return $this->usuario_id;	
	}
	
	function getVotacion(){
		if($this->votacion){
			return $this->votacion;
		}/*else{
			$this->votacion = $this->findVotacion();
			return $this->votacion;
		}*/
	}
	
	function getComentarios(){
		return $this->comentarios;	
	}
	
	function setSolicitud_id($solicitud_id){
		$this->solicitud_id = $solicitud_id; 	
	}
	
	function setUsuario($usuario_id){
		$this->usuario_id =  $usuario_id;	
	}
	
	function setVotacion($votacion){
		$this->votacion=$votacion;	
	}
	
	function setComentarios($comentarios){
		$this->comentarios = $comentarios;	
	}
	
	//Completa la informacion por solicitud_id o por usuario_id
	function findVotacion(){
		$odao = new ObjetoDAO();
		if($this->solicitud_id and $this->usuario_id){
			return $odao->findVotacion($this->usuario_id,$this->getSolicitud_id());
		}else{
			return "";	
		}
	}
	
	function saveVotacion(){
		$dao = new ObjetoDAO();
		//echo "voto: ".$this->getVotacion();
		$dao->saveVotacion($this);
			
	}
	/*
	* Metodo encargado de verificar si una votacion ya existe
	* Retorna true si la votacion ya existe, de lo contrario false
	*/
	function verificarVotacion(){
		$dao = new ObjetoDAO();
		$votacion = $dao->findVotacion($this->solicitud_id,$this->getUsuario_id());	
		return false;
				
	}
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////
class CcostoXFacultadDTO {

	private $id;
	private $cCosto;
	private $nombreCCosto;
	private $facultad_id;


	function getCcosto() { return $this->cCosto; }
	function getNombreCcosto() { return $this->nombreCCosto; }
	function getFacultadId() { return $this->facultad_id; }
	
	function getId() {
		if($this->id) {
			return $this->id;
		}
		else { 
			$this->id=$this->findId();
			return $this->id;
		}
	}
	
		function getFacultad() {
		if($this->facultad) {return $this->facultad;}
		else {
			$obj = new FacultadDTO();
			$this->facultad=$obj->find($this->facultadId);
			return $this->facultad;
		}
	}
	function setId($nuevodato) { $this->id=$nuevodato; }
	function setCcosto($nuevodato) {  $this->cCosto=$nuevodato; }
	function setNombreCcosto($nuevodato) {  $this->nombreCCosto=$nuevodato; }
	function setFacultadId($nuevodato) {  $this->facultad_id=$nuevodato; }
	
	
	function find($id) {
		$odao = new ObjetoDAO();
		$fila=$odao->find("cCostoXfacultad",$id);
		$this->id=$fila['id'];
		$this->cCosto=$fila['cCosto'];
		$this->nombreCCosto=$fila['nombreCCosto'];
		$this->facultad_id=$fila['facultad_id'];
		
		return $this;
	}
	
	function findId(){
		$odao = new ObjetoDAO();
		return $odao->getId("cCostoXfacultad", "cCosto", $this->cCosto);
	}
	
}

?>