<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
	require_once('../../../configuracion/path.php');
	require_once($path['modelo'].'clasesDTO.php');
	require_once('../../../librerias/PHPWord_0.6.2/PHPWord.php');
	require_once('diccionario.php');
	require_once('NumeroEnLetras.php');
	require_once('FormatoFecha.php');
	
	class Modificacion{
		private $facultad="null";
		private $fechaReunion="null";
		private $actaFacultad="null";
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
		private $sexoProfesor;
		
		private $diccionario; //este objeto es para corregir algunas palabras que varian de acuerdo al genero
		private $generoDocente="**";
		private $letrasDuracio;
		
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
		$this->actaFacultad = $solicitud->getNumeroActaCF();
		$this->acta2 = $solicitud->getActa()->getId();
		$this->fechaActa2 = $solicitud->getActa()->getFecha();
		$this->profesor =  mb_strtoupper($this->codificar($solicitud->getDocente()->getNombre()." ".$solicitud->getDocente()->getApellido1()." ".$solicitud->getDocente()->getApellido2() ),'UTF-8');
		$this->cedula = $solicitud->getDocenteId();
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
	}
	
	//Se crea el documento .doc y se guarda
	function crear(){

		$PHPWord = new PHPWord();
		$PHPWord->addParagraphStyle('title', array('align'=>'center', 'spaceAfter'=>100));
		$PHPWord->addParagraphStyle('right', array('align'=>'right', 'spaceAfter'=>100));
		$PHPWord->addParagraphStyle('left', array('align'=>'left', 'spaceAfter'=>100));
		$PHPWord->addParagraphStyle('justify', array('align'=>'both', 'spaceAfter'=>100));
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
		$section->addText(utf8_decode("Por la cual se modifica la Resoluci??n de Vicerrector??a de Docencia"),null,'title');
		$section->addText(utf8_decode("LA VICERRECTORA DE DOCENCIA DE LA UNIVERSIDAD DE ANTIOQUIA, en uso de sus facultades legales y estatutarias y en especial la conferida por el literal c,"
										." art??culo 1 de la Resoluci??n Rectoral 37544 del 19 de julio de 2013."));
	
		
		$section->addTextBreak(1);
		$section->addText("CONSIDERANDO",null,'title');
		$section->addTextBreak(1);
		
		//$section->addText($this->estudio);
		$section->addText(utf8_decode("1.	Que mediante la Resoluci??n de Vicerrector??a de Docencia **, se le concedi?? ".$this->diccionario->getSe??or($this->sexoProfesor)." $this->profesor ".$this->diccionario->getPalIdentificacion($this->sexoProfesor)." con"
											." c??dula de ciudadan??a $this->cedula, profesor de tiempo completo, ".$this->diccionario->getAdscrito($this->sexoProfesor)." a la facultad de $this->facultad, comisi??n de estudios remunerada con el 100% de su salario b??sico"
											." mensual, con dedicaci??n del 100% de su jornada laboral, desde el $this->fechaInicial hasta el $this->fechaFinal, con el objetivo de $this->estudio en ".$this->diccionario->getPalabra(substr($this->universidad,0,strpos($this->universidad,' ')))." $this->universidad."),null,'justify');
		$section->addTextBreak(1);
		$section->addText(utf8_decode("2.	Que en comunicado **, $this->generoDocente $this->profesor, solicita modificar la fecha de inicio de la comisi??n de estudios **"),null,'justify');
										
		$section->addTextBreak(1);
		$section->addText(utf8_decode("3.	Que en comunicado **, el Concejo de Facultad de $this->facultad, informa que en su sesi??n del $this->fechaReunion, Acta $this->actaFacultad, recomend?? favorablemente la modificaci??n de la fecha de inicio de la comisi??n de estudios concedida ".$this->diccionario->getDel($this->sexoProfesor)." $this->profesor, desde el $this->fechaInicial."),null,'justify');
											
		$section->addTextBreak(1);
		$section->addText(utf8_decode("4.	Que el comit?? de Desarrollo del Personal Docente, en el Acta 958 del 12 de abril de 2016, una vez verificada la solicitud de $this->generoDocente $this->profesor, recomend?? la modificaci??n de la Resoluci??n de Vicerrector??a de Docencia ** por cambio de la fecha de inicio de la comisi??n de estudios"),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("5.	Que el art??culo 111 del Acuerdo Superior 083 de 1996 (modificado por el Acuerdo Superior 353 del 29 de abril de 2008), establece que el Concejo de la Unidad Acad??mica a la cual pertenece $this->generoDocente, informar?? sobre las formas de seguimiento de la comisi??n."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("6.	Que el literal c  del art??culo 1 de la Resoluci??n Rectoral 37544 del 19 de julio de 2013, establece como delegaci??n en la Vicerrectora de Docencia, la autorizaci??n para las "
											."las comisiones de estudio de los profesores, as?? como las situaciones que se derivan de las mismas, tales como pr??rrogas ordinarias, modificaciones, suspensiones, renovaciones e incumplimientos, conforme a los art??culos, 70, 110 y 111 del Acuerdo Superior 083 de 1996 (Estatuto Profesoral)."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText("RESUELVE",null,'title');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ART??CULO UNICO. Modificar el art??culo 1 de la Resoluci??n de Vicerrector??a de Docencia ****, el cual quedar?? as??:"));
		
		$section->addText(utf8_decode("Art??culo 1. Conceder a ".$this->diccionario->getSe??or($this->sexoProfesor)." $this->profesor, ".$this->diccionario->getPalIdentificacion($this->sexoProfesor)." con la c??dula de ciudadan??a $this->cedula"
										." ".$this->diccionario->getProfesor($this->sexoProfesor)." de tiempo completo, ".$this->diccionario->getAdscrito($this->sexoProfesor)." a la Facultad de $this->facultad, comisi??n de estudios, remunerada con el 100% de su salario b??sico mensual, con dedicaci??n del 100% de su jornada laboral, desde el $this->fechaInicial hasta el $this->fechaFinal, con el fin de que realice estudios de $this->estudio en"
										." ".$this->diccionario->getPalabra(substr($this->universidad,0,strpos($this->universidad,' ')))." $this->universidad, $this->pais."),null,'justify');
		
		$section->addTextBreak(2);
		
		$section->addText("LUZ STELLA ISAZA MESA");
		$section->addText("Vicerrectora de Docencia");
		
		//se guarda el documento
		$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
		$objWriter->save('Resolucion.docx');
		}
	}
?>