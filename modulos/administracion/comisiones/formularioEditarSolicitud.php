<?php
	require_once('../../../configuracion/path.php');
	$path=asignarPath(dirname(__FILE__));
	require_once($path['modelo'].'criteria.php');
	require_once($path['modelo'].'clasesDTO.php');
	
	class formularioEditarSolicitud{
		static function editFormulario($tipo){
			echo'
				
			';
		}
		/*
		* Método que genera el formulario para editar una solicitud nueva
		* Retorma el string con el código html del formulario.
		*/
		static function editNueva($idSolicitud){
			$formulario='';
			$solicitud= new SolicitudDTO();
			$solicitud->find($idSolicitud);
			$formulario.=formularioEditarSolicitud::getMotivoField($solicitud->getMotivo());	
			$formulario.=formularioEditarSolicitud::getDedicacionComisionField($solicitud->getDedicacion());
			$formulario.=formularioEditarSolicitud::getInputText("Objetivo","Objetivo",$solicitud->getObjetivo());
			$formulario.=formularioEditarSolicitud::getInputText(utf8_decode("Lugar o institución"),"Lugar",$solicitud->getLugar());
			$formulario.=formularioEditarSolicitud::getPaisField($solicitud->getPais());
			$formulario.=formularioEditarSolicitud::getInputDate("Fecha de Inicio","fechaInicio",$solicitud->getFecha1());
			$formulario.=formularioEditarSolicitud::getInputDate(utf8_decode("Fecha Terminación"),"fechaTerminacion",$solicitud->getFecha2());
			$formulario.=formularioEditarSolicitud::getInputFile(utf8_decode("Carta de Aceptación/Invitación (PDF)"),"cartaAceptacion");
			$formulario.=formularioEditarSolicitud::getInputTextOptional("Observaciones","observaciones");
			$formulario.=formularioEditarSolicitud::getSubmit("Guardar solicitud","guardarSoicitud","cartaAceptacion","guardarNueva");
			return $formulario;
		}	
		/*
		* Método que genera el formulario para editar una solicitud de prorroga
		* Retorma el string con el código html del formulario.
		*/
		static function editProrroga($idSolicitud){
			$formulario = '';
			$solicitud= new SolicitudDTO();
			$solicitud->find($idSolicitud);
			
			if(isset($solicitud)){			
				$formulario.=formularioEditarSolicitud::getLabel("Facultad",$solicitud->getFacultad()->getNombre());
				$formulario.=formularioEditarSolicitud::getLabel("Motivo",$solicitud->getMotivo()->getMotivo());
				$formulario.=formularioEditarSolicitud::getLabel(utf8_decode("Tipo Comisión"),$solicitud->getTipoComision()->getTipo());
				$formulario.=formularioEditarSolicitud::getLabel(utf8_decode("Dedicación"),$solicitud->getDedicacion()->getNombre());
				$formulario.=formularioEditarSolicitud::getLabel("Objetivo",$solicitud->getObjetivo());
				$formulario.=formularioEditarSolicitud::getLabel(utf8_decode("Lugar o institución"),$solicitud->getLugar());
				$formulario.=formularioEditarSolicitud::getLabel(utf8_decode("País"),$solicitud->getPais()->getPais());
				$formulario.=formularioEditarSolicitud::getInputDate("Fecha de Inicio","fechaInicio",$solicitud->getFecha1());
				$formulario.=formularioEditarSolicitud::getInputDate(utf8_decode("Fecha de Terminación"),"fechaTerminacion",$solicitud->getFecha2());
				$formulario.=formularioEditarSolicitud::getInputFile("Informe de Actividades (PDF)","informeActividades");
				$formulario.=formularioEditarSolicitud::getInputFileOptional("Informe del Tutor (PDF)","informeTutor");
				$formulario.=formularioEditarSolicitud::getInputFileOptional("Calificaciones (PDF)","calificaciones");
				$formulario.=formularioEditarSolicitud::getInputTextOptional("Observaciones","observaciones");
				$formulario.=formularioEditarSolicitud::getSubmit("Guardar solicitud","guardarSolicitud","informeActividades,informeTutor,calificaciones","guardarProrroga");
			}
			return $formulario;
		}
		/*
		* Método que genera el formulario para editar una solicitud de prorroga excepcional 
		* Retorma el string con el código html del formulario.
		*/
		static function editOtros($idSolicitud){
			$formulario = '';
			$solicitud= new SolicitudDTO();
			$solicitud->find($idSolicitud);
			
			if(isset($solicitud)){		
				$formulario.=formularioEditarSolicitud::getLabel("Facultad",$solicitud->getFacultad()->getNombre());
				$formulario.=formularioEditarSolicitud::getLabel("Motivo",$solicitud->getMotivo()->getMotivo());
				$formulario.=formularioEditarSolicitud::getLabel(utf8_decode("Tipo Comisión"),$solicitud->getTipoComision()->getTipo());
				$formulario.=formularioEditarSolicitud::getLabel(utf8_decode("Dedicación"),$solicitud->getDedicacion()->getNombre());
				$formulario.=formularioEditarSolicitud::getLabel("Objetivo",utf8_decode($solicitud->getObjetivo()));
				$formulario.=formularioEditarSolicitud::getLabel(utf8_decode("Lugar o institución"),$solicitud->getLugar());
				$formulario.=formularioEditarSolicitud::getLabel(utf8_decode("País"),$solicitud->getPais()->getPais());
				$formulario.=formularioEditarSolicitud::getInputDate("Fecha de Inicio","fechaInicio",$solicitud->getFecha1());
				$formulario.=formularioEditarSolicitud::getInputDate(utf8_decode("Fecha de Terminación"),"fechaTerminacion",$solicitud->getFecha2());
				$formulario.=formularioEditarSolicitud::getInputFile("Informe del Estudiante (PDF)","informeEstudiante");
				$formulario.=formularioEditarSolicitud::getInputFileOptional("Informe de Actividades (PDF)","informeActividades");
				$formulario.=formularioEditarSolicitud::getInputFileOptional("Informe del Tutor (PDF)","informeTutor");
				$formulario.=formularioEditarSolicitud::getInputTextOptional("Observaciones","observaciones");
				$formulario.=formularioEditarSolicitud::getSubmit("Guardar solicitud","guardarSolicitud","informeEstudiante,informeActividades,informeTutor","guardarOtros");
			}
			return $formulario;
		}
		/*
		* Método que genera el formulario para editar una solicitud de modificacion
		* Retorma el string con el código html del formulario.
		*/
		static function makeModificacion($idSolicitud){
			$formulario='';
			$solicitud= new SolicitudDTO();
			$solicitud->find($idSolicitud);
		
			if(isset($solicitud)){
				$formulario.=formularioEditarSolicitud::getMotivoField($solicitud->getMotivo());	
				$formulario.=formularioEditarSolicitud::getDedicacionComisionField($solicitud->getDedicacion());
				$formulario.=formularioEditarSolicitud::getInputText("Objetivo","Objetivo",$solicitud->getObjetivo());
				$formulario.=formularioEditarSolicitud::getInputText(utf8_decode("Lugar o institución"),"Lugar",$solicitud->getLugar());
				$formulario.=formularioEditarSolicitud::getPaisField($solicitud->getPais());
				$formulario.=formularioEditarSolicitud::getInputDate("Fecha de Inicio","fechaInicio",$solicitud->getFecha1());
				$formulario.=formularioEditarSolicitud::getInputDate(utf8_decode("Fecha Terminación"),"fechaTerminacion",$solicitud->getFecha2());
				$formulario.=formularioEditarSolicitud::getInputFileOptional(utf8_decode("Motivación (PDF)"),"motivacion");
				$formulario.=formularioEditarSolicitud::getInputFile("Compromisos (PDF)","contraprestaciones");
				$formulario.=formularioEditarSolicitud::getInputTextOptional("Observaciones","observaciones");
				$formulario.=formularioEditarSolicitud::getSubmit("Guardar solicitud","guardarSoicitud","motivacion","guardarModificacion");
			}
			return $formulario;
		}
		/*
		* Método que genera el formulario para editar una solicitud de informe
		* Retorma el string con el código html del formulario.
		*/
		static function makeInforme($idSolicitud){
			$formulario='';
			$solicitud= new SolicitudDTO();
			$solicitud->find($idSolicitud);
		
			if(isset($solicitud)){
				$formulario.=formularioEditarSolicitud::getLabel("Facultad",$solicitud->getFacultad()->getNombre());
				$formulario.=formularioEditarSolicitud::getLabel("Motivo",$solicitud->getMotivo()->getMotivo());
				$formulario.=formularioEditarSolicitud::getLabel(utf8_decode("Tipo Comisión"),$solicitud->getTipoComision()->getTipo());
				$formulario.=formularioEditarSolicitud::getLabel(utf8_decode("Dedicación"),$solicitud->getDedicacion()->getNombre());
				$formulario.=formularioEditarSolicitud::getLabel("Objetivo",$solicitud->getObjetivo());
				$formulario.=formularioEditarSolicitud::getLabel(utf8_decode("Lugar o institución"),$solicitud->getLugar());
				$formulario.=formularioEditarSolicitud::getLabel(utf8_decode("País"),$solicitud->getPais()->getPais());
				$formulario.=formularioEditarSolicitud::getInputDate("Fecha de Inicio","fechaInicio",$solicitud->getFecha1());
				$formulario.=formularioEditarSolicitud::getInputDate(utf8_decode("Fecha de Terminación"),"fechaTerminacion",$solicitud->getFecha2());
				$formulario.=formularioEditarSolicitud::getInputFile("Informe del Estudiante (PDF)","informeEstudiante");
				$formulario.=formularioEditarSolicitud::getInputFile("Informe del Tutor (PDF)","informeTutor");
				$formulario.=formularioEditarSolicitud::getInputFile("Calificaciones (PDF)","calificaciones");
				$formulario.=formularioEditarSolicitud::getInputText("Detalle del Informe","detalleInforme",$solicitud->getInforme());
				$formulario.=formularioEditarSolicitud::getInputDate("Fecha de reingreso","fechaReingreso",$solicitud->getFechaReingreso());
				$formulario.=formularioEditarSolicitud::getCheck("obtuvoTitulo","obtuvoTitulo");-+
				$formulario.=formularioEditarSolicitud::getInputTextOptional("Observaciones","observaciones");
				$formulario.=formularioEditarSolicitud::getSubmit("Guardar solicitud","guardarSoicitud","informeEstudiante,informeTutor,calificaciones","guardarInforme");
			}
			return $formulario;
		}
		
		
		/*
		* Método que retorna el elemento para elegir el motivo
		*/
		static function getMotivoField($val){
			$consulta = new Criteria("motivos");
			$consulta->addFiltro("vigente","=",1); //Se verifica que el motivo aún esté vigente (1 = Sí, 0 = No)
			$motivos= $consulta->execute();
			$salida = '
				<script type="application/javascript">
					function verificarTipo(e){
						var valor=e.selectedIndex;
						if(!((valor=="0")||(valor=="1")||(valor=="2"))){
							contra = document.getElementById("contraprestacionestr").style="display:compact";
							document.getElementById("contraprestaciones").required=true;
						}else{
							contra = document.getElementById("contraprestacionestr").style="display:none";
							document.getElementById("contraprestaciones").required=false;				
						}
					}
				</script>
			';
			$salida .= '
				<tr><td width="172" bgcolor="#0A351C"><span class="Estilo8">*Motivo:</span></td>
              		<td bgcolor="#FFFFFF">
                        <select name="motivos" id="motivos" onchange="verificarTipo(motivos)" >';
			
			foreach($motivos as $motivo) {
				if($motivo->getId()== $val->getId()){	
					$salida .= '
					<option value="'.$motivo->getId().'" selected>'.$motivo->getMotivo().'</option>';
				}else{
            		$salida .= '
					<option value="'.$motivo->getId().'">'.$motivo->getMotivo().'</option>';
				}
			}
            $salida.= '
					</select>
                   		<label id=\'dTipo\'> De Estudios</label>
				</td></tr>';
			return $salida;
		}
		
		/*
		* Método que retorna un elemento para elegir la dedicación de la comision
		*/
		static function getDedicacionComisionField($val){
			$consulta = new Criteria("dedicaciones");
			$consulta->addFiltro("vigente","=",1); //Se verifica que la dedicación aún esté vigente (1 = Sí, 0 = No)
			$dedicaciones=$consulta->execute();
			
			$salida = '
				<tr>
              		<td bgcolor="#0A351C"><span class="Estilo8">*Dedicaci&oacute;n a la comisi&oacute;n:</span></td>
              		<td bgcolor="#FFFFFF">
                     	<select name="dedicaciones" id="dedicaciones">';
			
			foreach($dedicaciones as $dedicacion) {
				if($dedicacion->getId()==$val->getId()){
					$salida.='<option value="'.$dedicacion->getId().'"selected>'.$dedicacion->getNombre().'</option>';
				}else{
            		$salida.='<option value="'.$dedicacion->getId().'">'.$dedicacion->getNombre().'</option>';
				}
			}
			$salida.='</select></td></tr>';	
			return $salida;
		}
		
		/*
		* Método que retorna un elemento para ingresar texto, recibe como parametro el nombre del elemento
		*/
		static function getInputText($name,$id,$val){
			$salida = '
				<tr>
                	<td bgcolor="#0A351C"><span class="Estilo8">*'.$name.':</span></td>
                    <td bgcolor="#FFFFFF">  
                      <input name="'.$id.'" type="text" id="'.$id.'" value="'.$val.'" size="100" required/></td>
            		</tr>
			';
			return $salida;
		}
		
			
		/*
		* Método que retorna un elemento para ingresar texto opcional, recibe como parametro el nombre del elemento y el id
		*/
		static function getInputTextOptional($name,$id){
			$salida = '
				<tr>
                	<td bgcolor="#0A351C"><span class="Estilo8">'.$name.':</span></td>
                    <td bgcolor="#FFFFFF">  
                      <input name="'.$id.'" type="text" id="'.$id.'" value="" size="100" /></td>
            		</tr>
			';
			return $salida;	
		}
		
		/*
		* Método que retorna un elemento para seleccionar un pais
		*/
		static function getPaisField($val){
			$consulta = new Criteria("paises");
			$consulta->orderBy("pais", "asc");
			$paises=$consulta->execute();
			$salida = '
				<tr>
                	<td bgcolor="#0A351C"><span class="Estilo8">*Pa&iacute;s:</span></td>
                    <td bgcolor="#FFFFFF"><select name="paises" id="paises">';
			
        	foreach($paises as $pais) {
				if($pais->getId()=== $val->getId()){
					$salida.='<option value="'.$pais->getId().'" selected>'.$pais->getPais().'</option>';
				}else{
            		$salida.='<option value="'.$pais->getId().'">'.$pais->getPais().'</option>';
				}
			}
			$salida.='</select></td></tr>';
			return $salida;
		}
		
		/*
		* Método que retorna un elemento para seleccionar la fecha
		*/
		static function getInputDate($name,$id,$val){
			$salida='
				
			';
			$salida.='
				<tr>
                	<td bgcolor="#0A351C"><span class="Estilo8">*'.$name.':</span></td>
                    <td bgcolor="#FFFFFF"><input type="date" name="'.$id.'" id="'.$id.'" value='.$val.' required/></td>
        		</tr>';
			return $salida;	
		}
		
		/*
		* Método que retorna un elemento para seleccionar un archivo
		*/
		static function getInputFile($name,$id){
				$salida='
				<tr>
                	<td bgcolor="#0A351C"><span class="Estilo8">'.$name.':</span></td>
                    <td bgcolor="#FFFFFF"><input type="file" name="'.$id.'" id="'.$id.'" accept="application/pdf" onchange="extension(\''.$id.'\')" />		</td>
          		</tr>';
			return $salida;
			
		}
		
		static function getInputFileOptional($name,$id){
			$salida='
				<tr id="'.$id."tr".'">
                	<td bgcolor="#0A351C"><span class="Estilo8">'.$name.':</span></td>
                    <td bgcolor="#FFFFFF"><input type="file" accept="application/pdf" name="'.$id.'" id="'.$id.'" />		</td>
          		</tr>
				
			';
			return $salida;
			
		}
		
		/*
		* Método que retorna un elemento para eviar formulario
		*/
		static function getSubmit($text,$id,$files,$nameEnviar){
			$salida='
				<tr>
              		<td width="63%" colspan="2">
                    <div align="center">
                            <input style="background-color:#6C9A06" id="guardar2" type="button"  class="button" value="'.$text.'" onclick="enviar(\''.$files.'\')"/>
                			<input  name="'.$nameEnviar.'" type="submit" class="button" id="guardar"  value="Guardar solicitud" style="display:none"/>
              				</div>
                         </td>
            		</tr>
			';
			return $salida;
		}
		
		static function getChooser($id,$estado){
			$consulta = new Criteria("comisiones");
			$consulta->addFiltro("docente_id","=",$id);
			$consulta->orderBy("id","DESC");
			$comisiones=$consulta->execute();
			$salida='';
			$salida.='
				<tr><td width="178" bgcolor="#0A351C"><span class="Estilo8">*Comisiones:</span>
				<select name="comisiones" id="comisiones" onchange="PosicionarCombo(this,\'objetivos\')">
				';
				
				foreach($comisiones as $comision) {
					$value=$comision->getId();
					$text=$comision->getId().' '.$comision->getObjetivo();
			
					$salida.='<option value="'.$value.'">'.$text.'</option>';  
				}
				$salida.='</select>';
				$salida.='</td>';
				$salida.='<td><input name="buscar" type="submit" class="botonbuscar" id="buscar" value="_" style="'.$estado.'"/></td>';
				$salida.='</tr>';
				
				
			return $salida;	
		}
		
		static function getLabel($name,$text){
			$salida='';
			$salida.='
				<tr><td width="172" bgcolor="#0A351C">
					<span class="Estilo8">'.$name.':</span>
					</td><td width="638" bgcolor="#FFFFFF">'.$text.'</td>
				</tr>';
			return $salida;	
		}
		
		static function getCheck($name,$text){
			$salida='';
			$salida.='
				<tr>
      				<td bgcolor="#0A351C"><span class="Estilo8">*'.$text.':</span></td>
      				<td bgcolor="#FFFFFF"><input type="checkbox" name="'.$name.'" id="'.$name.'"/></td>
      			</tr>
			';
			return $salida;	
		}
		
	}
?>