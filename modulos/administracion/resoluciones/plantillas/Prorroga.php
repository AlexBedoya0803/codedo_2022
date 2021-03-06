<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
	require_once('../../../configuracion/path.php');
	require_once($path['modelo'].'clasesDTO.php');
	require_once('../../../librerias/PHPWord_0.6.2/PHPWord.php');
	require_once('diccionario.php');
	require_once('NumeroEnLetras.php');
	require_once('FormatoFecha.php');
	
	class Prorroga{
		private $facultad="null";
		private $fechaReunion="null";
		private $acta1="null";
		private $acta2="null";
		private $fechaActa2="null";
		private $profesor="null";
		private $cedula="null";
		private $estudio="null";
		private $tipoEsutidio="null";
		private $duracion="null";
		private $universidad="null";
		private $pais="null";
		private $comite="null";
		private $fechaInicial="null";
		private $fechaFinal="null";
		private $dedicasion;
		private $fechaProrroga = "**";
		
		private $sexoProfesor;
		private $diccionario;
		private $generoDocente;
		
		private $letrasDuracion;
		
	//Este metodo permite organizar las cadenas de texto con la codificacion correcta para que se vea bien en el documento
	function codificar($cadena){
		$encoding = mb_detect_encoding($cadena); 
		if(mb_detect_encoding($cadena)=="UTF-8" or mb_detect_encoding($cadena)=="ASCII"){
			if(!mb_check_encoding ( $cadena, $encoding )){
				$cadena = utf8_encode($cadena);
			}
			return $cadena;	
			
		}else{
			return utf8_encode($cadena);
				
		}
	}
	
	//Se envia un objeto de tipo solicitud con toda la informacion.
	function setSolicitud($solicitud){
		$this->diccionario = new diccionario();
		
		$this->facultad = $this->codificar($solicitud->getFacultad()->getNombre());
		$this->fechaReunion = $solicitud->getFechaActaCF();
		$this->acta1 = $solicitud->getNumeroActaCF();
		$this->acta2 = $solicitud->getActa()->getId();
		$this->fechaActa2 = $solicitud->getActa()->getFecha();
		$this->profesor =  mb_strtoupper($this->codificar($solicitud->getDocente()->getNombre()." ".$solicitud->getDocente()->getApellido1()." ".$solicitud->getDocente()->getApellido2() ),'UTF-8');
		$this->cedula = $solicitud->getDocenteId();
		$this->estudio =$this->codificar($solicitud->getObjetivo());
		$this->estudio =  $this->codificar(str_replace('.','',$solicitud->getObjetivo()));
		$this->tipoEsutidio = $this->codificar($solicitud->getMotivo()->getMotivo());
		$this->duracion= $solicitud->getDuracion();
		$this->universidad = $this->codificar(str_replace('.','',$solicitud->getLugar()));
		$this->pais =  $this->codificar($solicitud->getPais()->getPais());
		$this->comite = "Desarrollo Personal Docente";
		$this->fechaInicial = $solicitud->getFecha1();
		$this->fechaFinal = $solicitud->getFecha2();
		$this->sexoProfesor = ($solicitud->getDocente()->getSexo());
		$this->generoDocente = $this->diccionario->getGeneroDocente($this->sexoProfesor);
		$this->fechaProrroga = $solicitud->getActa()->getFecha();
		
		$datetime1 = date_create($this->fechaInicial);
		$datetime2 = date_create($this->fechaFinal);
		$interval = date_diff($datetime1, $datetime2);
		$this->duracion = $interval->format('%a');
		$this->duracion = intval($this->duracion/30);
		$this->dedicasion = intval($solicitud->getDedicacion()->getValor())*100;
		
		//para poner mes o meses
		if($this->duracion>=12){
			$this->duracion = intval($this->duracion/12);	
			
			//para poner a??o o a??os
			if($this->duracion>1){
				$this->letrasDuracion = "a??os";		
			}else{
				$this->letrasDuracion = "a??o";	
			}
			
		}else{
			if($this->duracion>1){
				$this->letrasDuracion = "meses";	
			}else{
				$this->letrasDuracion = "mes";	
			}
				
		}
		
		$this->fechaInicial = FormatoFecha::convertir($this->fechaInicial);
		$this->fechaFinal = FormatoFecha::convertir($this->fechaFinal);
		$this->fechaActa2 = FormatoFecha::convertir($this->fechaActa2);
		$this->fechaReunion = FormatoFecha::convertir($this->fechaReunion);
		$this->fechaProrroga = FormatoFecha::convertir($this->fechaProrroga);
		
		
	}
	
	//Se crea el documento .doc y se guarda
	function crear(){

		$PHPWord = new PHPWord();
		$PHPWord->addParagraphStyle('title', array('align'=>'center', 'spaceAfter'=>100));
		$PHPWord->addParagraphStyle('right', array('align'=>'right', 'spaceAfter'=>100));
		$PHPWord->addParagraphStyle('left', array('align'=>'left', 'spaceAfter'=>100));
		$PHPWord->addParagraphStyle('justify', array('align'=>'both', 'spaceAfter'=>100));
		$PHPWord->addParagraphStyle('firma', array('align'=>'left', 'spaceAfter'=>0));
		
		$section = $PHPWord->createSection();
		
		//se crae un encabezado
		$header = $section->createHeader();
		$table = $header->addTable();
		$table->addRow();
		//$table->addCell(4500)->addText(utf8_decode("Resoluci??n Rectoral"));
		$table->addCell(10000)->addImage('../../../imagenes/udea.jpg', array('width'=>100, 'height'=>100, 'align'=>'center'));
		
		//se crea el cuerpo del documento
		$section->addText(utf8_decode("RESOLUCI??N DE VICERRECTOR??A DE DOCENCIA"),null,'title');
		$section->addTextBreak(1);
		$section->addText(utf8_decode("Por la cual se concede pr??rroga a una comisi??n de estudios"),null,'title');
		$section->addText(utf8_decode("LA VICERRECTORA DE DOCENCIA DE LA UNIVERSIDAD DE ANTIOQUIA, en uso de sus facultades legales y estatutarias y en especial la conferida por el literal c,"
										." art??culo 1 de la Resoluci??n Rectoral 37544 del 19 de julio de 2013."));
	
		
		$section->addTextBreak(1);
		$section->addText("CONSIDERANDO",null,'title');
		$section->addTextBreak(1);

		$section->addText(utf8_decode("1.	Que mediante la Resoluci??n de Vicerrector??a de Docencia 8296 del 26 de agosto de 2014, se le concedi?? ". $this->diccionario->getSe??or($this->sexoProfesor)
											." $this->profesor, ". $this->diccionario->getPalIdentificacion($this->sexoProfesor)." con la c??dula de ciudadan??a $this->cedula, ". substr($this->generoDocente,2,10)." de tiempo completo, "
											.$this->diccionario->getAdscrito($this->sexoProfesor)." a la $this->facultad, comisi??n de estudios, remunerada con el 100% de su salario b??sico mensual,"
											." con una dedicaci??n del $this->dedicasion % de su jornada laboral, desde $this->fechaInicial hasta $this->fechaFinal,"
											." con el fin de que realice estudios de $this->estudio, en ".$this->diccionario->getPalabra(substr($this->universidad,0,strpos($this->universidad,' ')))." $this->universidad, $this->pais. El tiempo estimado para la culminaci??n de los estudios es de ".NumeroEnLetras::convertir($this->duracion)." ($this->duracion) $this->letrasDuracion."),null,'justify');
		$section->addTextBreak(1);
		$section->addText(utf8_decode("2.	Que dicha comisi??n se ha venido prorrogando hasta el $this->fechaProrroga mediante la Resoluci??n"
											." Vicerrector??a de Docencia 9038 del 16 de julio de 2015."),null,'justify');
										
		$section->addTextBreak(1);
		$section->addText(utf8_decode("3.	**, ".$this->diccionario->getGeneroDocente($this->sexoProfesor)." $this->profesor, present?? al Consejo de $this->facultad, solicitud de pr??rroga de la comisi??n de estudios con el fin de continuar sus estudios de $this->tipoEsutidio."),null,'justify');
											
		$section->addTextBreak(1);
		$section->addText(utf8_decode("4.	Que en comunicado **, el Consejo de $this->faculta, informa que en su sesi??n"
											." de $this->fechaReunion, Acta $this->acta1, recomend?? la pr??rroga de la comisi??n de estudios para el"
											." $this->profesor."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("5.	Que el Comit?? de Desarrollo del Personal Docente, en el Acta 876 del 8 de agosto de 2012, conceptu?? favorablemente"
											." sobre la pr??rroga de la comisi??n de estudios para ".$this->generoDocente." $this->profesor, teniendo en cuenta"
											." que con la misma no se excede el tiempo m??ximo de cinco a??os de que trata el art??culo 115 del Estatuto Profesoral."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("6.	Que el art??culo 111 del Acuerdo Superior 083 de 1996 (modificado por el Acuerdo Superior 353 del 29 de"
											." abril de 2008), establece que el Concejo de la Unidad Acad??mica a la cual pertenece el profesor, informar??"
											." sobre las formas de seguimiento de la comisi??n."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("7.	Que el literal c  del art??culo 1 de la Resoluci??n Rectoral 37544 del 19 de julio de 2013, establece como delegaci??n en la Vicerrectora de Docencia, la autorizaci??n para las "
											."las comisiones de estudio de los profesores, as?? como las situaciones que se derivan de las mismas, tales como pr??rrogas ordinarias, modificaciones, suspensiones, renovaciones e incumplimientos, conforme a los art??culos, 70, 110 y 111 del Acuerdo Superior 083 de 1996 (Estatuto Profesoral)."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText("RESUELVE",null,'title');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ART??CULO 1. Conceder ". $this->diccionario->getSe??or($this->sexoProfesor) ." $this->profesor ". $this->diccionario->getPalIdentificacion($this->sexoProfesor)." con c??dula de ciudadan??a $this->cedula, ". substr($this->generoDocente,2,10)." de tiempo completo, ".$this->diccionario->getAdscrito($this->sexoProfesor)." a la $this->facultad,"
										." pr??rroga de comisi??n de estudios, remunerada con el 100% de su salario b??sico mensual, con una dedicaci??n del $this->dedicasion de su jornada laboral, desde"
										." el $this->fechaInicial hasta el $this->fechaFinal, con el fin de realizar estudios de $this->estudio en ".$this->diccionario->getPalabra(substr($this->universidad,0,strpos($this->universidad,' ')))." $this->universidad. $this->pais."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ART??CULO 2. Al conceptuar sobre la conveniencia de conceder la comisi??n de estudios, el Consejo de la Unidad Acad??mica a la cual pertenece el profesor,"
										." inform?? a la Vicerrectora de Docencia, sobre las formas de seguimiento que se implementar??n para la comisi??n de estudios, las cuales quedar??n consignadas en el respectivo"
										." contrato que el profesor suscribir?? en la Direcci??n de Asesor??a Jur??dica y ser??n de obligatorio cumplimiento."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ART??CULO 3. Para cada solicitud de pr??rroga o modificaci??n de la comisi??n de estudios concedida, al igual que al momento de su finalizaci??n, el Consejo de"
										." la Unidad Acad??mica a la cual pertenece el profesor informar?? a la Vicerrectora de Docencia, sobre el resultado del seguimiento implementado."),null,'justify');
		
		
		$section->addTextBreak(2);
		
		$section->addText("LUZ STELLA ISAZA MESA",null,'firma');
		$section->addText("Vicerrectora de Docencia",null,'firma');
		
		//se guarda el documento
		$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
		$objWriter->save('Resolucion.docx');
		}
	}
?>