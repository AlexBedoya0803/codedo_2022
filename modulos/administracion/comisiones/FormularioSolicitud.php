<?php
	/*
	* Autor Luis Fernando Orozco
	* Esta clase sirve para generar el formulario de la solicitud, este cambiara dependiendo del tipo de solicitud
	*/
	require_once('../../../configuracion/path.php');
	$path=asignarPath(dirname(__FILE__));
	require_once($path['modelo'].'criteria.php');
	require_once($path['modelo'].'clasesDTO.php');
	
	class FormularioSolicitud{
		static function makeFormulario($tipo){
			echo'
				
			';
		}
		/*
		* Método que genera el formulario para crear una solicitud nueva
		* Retorma el string con el código html del formulario.
		*/
		static function makeNueva(){
			$formulario="";
			
			$formulario.=FormularioSolicitud::getMotivoField("");	
			$formulario.=FormularioSolicitud::getDedicacionComisionField("");
			$formulario.=FormularioSolicitud::getInputText("Objetivo","Objetivo","");
			$formulario.=FormularioSolicitud::getInputText(utf8_decode("Lugar o institución"),"Lugar","");
			$formulario.=FormularioSolicitud::getPaisField("");
			$formulario.=FormularioSolicitud::getInputDate("Fecha de Inicio","fechaInicio","");
			$formulario.=FormularioSolicitud::getInputDate(utf8_decode("Fecha Terminación"),"fechaTerminacion","");
			$formulario.=FormularioSolicitud::getInputFile(utf8_decode("Carta de Aceptación/Invitación (PDF)"),"cartaAceptacion");
			//$formulario.=FormularioSolicitud::getInputFileOptional(utf8_decode("Aval Unidad Académica"),"AvalUnidadAcademiaca");
			//$formulario.=FormularioSolicitud::getInputFileOptional(utf8_decode("Resolucion de Admision (PDF)"),"resolucionDeAdmision");
			$formulario.=FormularioSolicitud::getInputFileOptional(utf8_decode("Otro (PDF)"),"otros");
			//$formulario.=FormularioSolicitud::getInputFileOptional("Compromisos","contraprestaciones");
			$formulario.=FormularioSolicitud::getInputTextOptional("Observaciones","observaciones");
			$formulario.=FormularioSolicitud::getSubmit("Guardar solicitud","guardarSoicitud","cartaAceptacion","guardarNueva");
			return $formulario;
		}
		
		static function makeProrroga($id,$comision){
			$formulario = '';
			if(isset($comision)){
				$dateI = $comision->getFechaf();
				$dateI1 = str_replace('-', '/', $dateI);
				$fechaInicio = date('Y-m-d',strtotime($dateI1 . "+1 days"));
				
				$dateF = $comision->getFechaf();
				$dateF1 = str_replace('-', '/', $dateF);
				$fechaFin = date('Y-m-d',strtotime($dateF1 . "+1 year"));  
				//$fechaFinal = $fechaFin->format("d-m-Y"); 
				//var_dump($comision->getFechaf());
				//var_dump($fechaFin);
			
				$formulario.=FormularioSolicitud::getChooser($id,"display:none");
				$formulario.=FormularioSolicitud::getLabel("Facultad",$comision->getFacultad()->getNombre());
				$formulario.=FormularioSolicitud::getLabel("Motivo",$comision->getMotivo()->getMotivo());
				$formulario.=FormularioSolicitud::getLabel(utf8_decode("Tipo Comisión"),$comision->getTipoComision()->getTipo());
				$formulario.=FormularioSolicitud::getLabel(utf8_decode("Dedicación"),$comision->getDedicacion()->getNombre());
				$formulario.=FormularioSolicitud::getLabel("Objetivo",$comision->getObjetivo());
				$formulario.=FormularioSolicitud::getLabel(utf8_decode("Lugar o institución"),$comision->getLugar());
				$formulario.=FormularioSolicitud::getLabel(utf8_decode("País"),$comision->getPais()->getPais());
				$formulario.=FormularioSolicitud::getInputDate("Fecha de Inicio","fechaInicio",$fechaInicio);
				$formulario.=FormularioSolicitud::getInputDate(utf8_decode("Fecha de Terminación"),"fechaTerminacion",$fechaFin);
				//$formulario.=FormularioSolicitud::getInputFile(utf8_decode("Carta de Aceptación/Invitación"),"cartaAceptacion");
				$formulario.=FormularioSolicitud::getInputFile("Informe de Actividades (PDF)","informeActividades");
				$formulario.=FormularioSolicitud::getInputFileOptional("Informe del Tutor (PDF)","informeTutor");
				$formulario.=FormularioSolicitud::getInputFileOptional("Calificaciones (PDF)","calificaciones");
				$formulario.=FormularioSolicitud::getInputTextOptional("Observaciones","observaciones");
				$formulario.=FormularioSolicitud::getSubmit("Guardar solicitud","guardarSolicitud","informeActividades,informeTutor,calificaciones","guardarProrroga");
			}else{
				$formulario.=FormularioSolicitud::getChooser($id,"display:inline");	
			}
			return $formulario;
		}
		
		static function makeProrrogaExceptional($id,$comision,$tipo){
			$formulario='';
			//var_dump($comision);
			if(isset($comision)){
				$formulario.=FormularioSolicitud::getChooser($id,"display:none");
				$formulario.=FormularioSolicitud::getLabel("Facultad",$comision->getFacultad()->getNombre());
				$formulario.=FormularioSolicitud::getLabel("Motivo",$comision->getMotivo()->getMotivo());
				$formulario.=FormularioSolicitud::getLabel(utf8_decode("Tipo Comisión"),$comision->getTipoComision()->getTipo());
				$formulario.=FormularioSolicitud::getLabel(utf8_decode("Dedicación"),$comision->getDedicacion()->getNombre());
				$formulario.=FormularioSolicitud::getLabel("Objetivo",$comision->getObjetivo());
				$formulario.=FormularioSolicitud::getLabel(utf8_decode("Lugar o institución"),$comision->getLugar());
				$formulario.=FormularioSolicitud::getLabel(utf8_decode("País"),$comision->getPais()->getPais());
				$formulario.=FormularioSolicitud::getInputDate("Fecha de Inicio","fechaInicio",$comision->getFecha1());
				$formulario.=FormularioSolicitud::getInputDate(utf8_decode("Fecha de Terminación"),"fechaTerminacion",$comision->getFecha2());
				$formulario.=FormularioSolicitud::getInputFile("Informe del Estudiante (PDF)","informeEstudiante");
				$formulario.=FormularioSolicitud::getInputFile("Informe de Actividades (PDF)","informeActividades");
				$formulario.=FormularioSolicitud::getInputFile("Informe del Tutor (PDF)","informeTutor");
				//$formulario.=FormularioSolicitud::getInputFile("Justificacion Argumentada (PDF)","justificacionArgumentada");
				$formulario.=FormularioSolicitud::getInputTextOptional("Observaciones","observaciones");
				$formulario.=FormularioSolicitud::getSubmit("Guardar solicitud","guardarSoicitud","informeEstudiante,informeActividades,informeTutor","guardarOtros");
				$formulario.=FormularioSolicitud::getTextHidden("tipo",$tipo);
			}else{
				$formulario.=FormularioSolicitud::getChooser($id,"display:inline");	
			}
			return $formulario;
		}
		
		static function makeModificacion($id,$comision){
			$formulario='';
			
			if(isset($comision)){
				$formulario.=FormularioSolicitud::getChooser($id,"display:none");
				//echo $comision->getMotivoId();
				$formulario.=FormularioSolicitud::getMotivoField($comision->getMotivoId());	
				$formulario.=FormularioSolicitud::getDedicacionComisionField($comision->getDedicacionId());
				$formulario.=FormularioSolicitud::getInputText("Objetivo","Objetivo",$comision->getObjetivo());
				$formulario.=FormularioSolicitud::getInputText(utf8_decode("Lugar o institución"),"Lugar",$comision->getLugar());
				$formulario.=FormularioSolicitud::getPaisField("");
				$formulario.=FormularioSolicitud::getInputDate("Fecha de Inicio","fechaInicio",$comision->getFecha1());
				$formulario.=FormularioSolicitud::getInputDate(utf8_decode("Fecha Terminación"),"fechaTerminacion",$comision->getFecha2());
				$formulario.=FormularioSolicitud::getInputFile(utf8_decode("Motivación (PDF)"),"motivacion");
				$formulario.=FormularioSolicitud::getInputFileOptional("Compromisos (PDF)","contraprestaciones");
				$formulario.=FormularioSolicitud::getInputTextOptional("Observaciones","observaciones");
				$formulario.=FormularioSolicitud::getSubmit("Guardar solicitud","guardarSoicitud","motivacion","guardarModificacion");
			}else{
				$formulario.=FormularioSolicitud::getChooser($id,"display:inline");	
			}
			return $formulario;
		}
		
		static function makeInforme($id,$comision){
			$formulario = '';

			if(isset($comision)){
				$formulario.=FormularioSolicitud::getChooser($id,"display:none");
				$formulario.=FormularioSolicitud::getLabel("Facultad",$comision->getFacultad()->getNombre());
				$formulario.=FormularioSolicitud::getLabel("Motivo",$comision->getMotivo()->getMotivo());
				$formulario.=FormularioSolicitud::getLabel(utf8_decode("Tipo Comisión"),$comision->getTipoComision()->getTipo());
				$formulario.=FormularioSolicitud::getLabel(utf8_decode("Dedicación"),$comision->getDedicacion()->getNombre());
				$formulario.=FormularioSolicitud::getLabel("Objetivo",$comision->getObjetivo());
				$formulario.=FormularioSolicitud::getLabel(utf8_decode("Lugar o institución"),$comision->getLugar());
				$formulario.=FormularioSolicitud::getLabel(utf8_decode("País"),$comision->getPais()->getPais());
				$formulario.=FormularioSolicitud::getInputDate("Fecha de Inicio","fechaInicio",$comision->getFecha1());
				$formulario.=FormularioSolicitud::getInputDate(utf8_decode("Fecha de Terminación"),"fechaTerminacion",$comision->getFecha2());
				$formulario.=FormularioSolicitud::getInputFile("Informe del Estudiante (PDF)","informeEstudiante");
				$formulario.=FormularioSolicitud::getInputFile("Informe del Tutor (PDF)","informeTutor");
				$formulario.=FormularioSolicitud::getInputFile("Calificaciones (PDF)","calificaciones");
				$formulario.=FormularioSolicitud::getInputText("Detalle del Informe","detalleInforme","detalleInforme");
				$formulario.=FormularioSolicitud::getInputDate("Fecha de reingreso","fechaReingreso","");
				$formulario.=FormularioSolicitud::getCheck("obtuvoTitulo","obtuvoTitulo");-+
				$formulario.=FormularioSolicitud::getInputTextOptional("Observaciones","observaciones");
				$formulario.=FormularioSolicitud::getSubmit("Guardar solicitud","guardarSoicitud","informeEstudiante,informeTutor,calificaciones","guardarInforme");
			}else{
				$formulario.=FormularioSolicitud::getChooser($id,"display:inline");	
			}
			return $formulario;
		}
		
		
		/*
		* Método que retorna el elemento para elegir el motivo
		*/
		static function getMotivoField($val){
			$consulta = new Criteria("motivos");
			$consulta->addFiltro("vigente","=",1); //Se verifica que el motivo aún esté vigente (1 = Sí, 0 = No)
			$motivos=$consulta->execute();
			$salida = '
				<script type="application/javascript">
					function verificarTipo(e){
						var valor=e.selectedIndex;
							
						if(!((valor=="0")||(valor=="1")||(valor=="2"))){
							//alert("corta");
							contra = document.getElementById("contraprestacionestr").style="display:compact";
							document.getElementById("contraprestaciones").required=true;
							//alert(contra.style.display);
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
                        <select name="motivos" id="motivos" onchange="verificarTipo(this)" >';
			
			foreach($motivos as $motivo) {
				if($motivo->getId()==$val){
					$salida .= '
					<option value="'.$motivo->getId().'"selected>'.$motivo->getMotivo().'</option>';
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
				if($dedicacion->getId()==$val){
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
		
		static function getPaisField($val){
			$consulta = new Criteria("paises");
			$consulta->orderBy("pais", "asc");
			$paises=$consulta->execute();
			$salida = '
				<tr>
                	<td bgcolor="#0A351C"><span class="Estilo8">*Pa&iacute;s:</span></td>
                    <td bgcolor="#FFFFFF"><select name="paises" id="paises">';
					
        	foreach($paises as $pais) {
				if($pais->getId()){
					$salida.='<option value="'.$pais->getId().'"selected>'.$pais->getPais().'</option>';
				}else{
            		$salida.='<option value="'.$pais->getId().'">'.$pais->getPais().'</option>';
				}
			}
			$salida.='</select></td></tr>';
			return $salida;
		}
		
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
		
		static function getInputFile($name,$id){
				$salida='
				<tr>
                	<td bgcolor="#0A351C"><span class="Estilo8">*'.$name.':</span></td>
                    <td bgcolor="#FFFFFF"><input type="file" name="'.$id.'" id="'.$id.'" required accept="application/pdf" onchange="extension(\''.$id.'\')" />		</td>
          		</tr>';
			return $salida;
			
		}
		
		static function getInputFileOptional($name,$id){
			$salida='
				<tr id="'.$id."tr".'">
                	<td bgcolor="#0A351C"><span class="Estilo8">'.$name.':</span></td>
                    <td bgcolor="#FFFFFF"><input type="file" accept="application/pdf" name="'.$id.'" id="'.$id.'"  accept="application/pdf" onchange="extension(\''.$id.'\')"" />	</td>
          		</tr>
				
			';
			return $salida;
			
		}
		
		
		
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
		
		static function getTextHidden($id,$val){
			$salida='';
			$salida.='
				<tr style="display:none">
                    <td bgcolor="#FFFFFF">  
                    <input name="'.$id.'" type="text" id="'.$id.'" value="'.$val.'" size="100" required/></td>
				</tr>
			';	
			return $salida;
		}
	
		
		
	}
?>