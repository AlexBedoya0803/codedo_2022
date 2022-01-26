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
			
			//para poner año o años
			if($this->duracion>1){
				$this->letrasDuracion = "años";		
			}else{
				$this->letrasDuracion = "año";	
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
		//$table->addCell(4500)->addText(utf8_decode("Resolución Rectoral"));
		$table->addCell(10000)->addImage('../../../imagenes/udea.jpg', array('width'=>100, 'height'=>100, 'align'=>'center'));
		
		//se crea el cuerpo del documento
		$section->addText(utf8_decode("RESOLUCIÓN DE VICERRECTORÍA DE DOCENCIA"),null,'title');
		$section->addTextBreak(1);
		$section->addText(utf8_decode("Por la cual se concede prórroga a una comisión de estudios"),null,'title');
		$section->addText(utf8_decode("LA VICERRECTORA DE DOCENCIA DE LA UNIVERSIDAD DE ANTIOQUIA, en uso de sus facultades legales y estatutarias y en especial la conferida por el literal c,"
										." artículo 1 de la Resolución Rectoral 37544 del 19 de julio de 2013."));
	
		
		$section->addTextBreak(1);
		$section->addText("CONSIDERANDO",null,'title');
		$section->addTextBreak(1);

		$section->addText(utf8_decode("1.	Que mediante la Resolución de Vicerrectoría de Docencia 8296 del 26 de agosto de 2014, se le concedió ". $this->diccionario->getSeñor($this->sexoProfesor)
											." $this->profesor, ". $this->diccionario->getPalIdentificacion($this->sexoProfesor)." con la cédula de ciudadanía $this->cedula, ". substr($this->generoDocente,2,10)." de tiempo completo, "
											.$this->diccionario->getAdscrito($this->sexoProfesor)." a la $this->facultad, comisión de estudios, remunerada con el 100% de su salario básico mensual,"
											." con una dedicación del $this->dedicasion % de su jornada laboral, desde $this->fechaInicial hasta $this->fechaFinal,"
											." con el fin de que realice estudios de $this->estudio, en ".$this->diccionario->getPalabra(substr($this->universidad,0,strpos($this->universidad,' ')))." $this->universidad, $this->pais. El tiempo estimado para la culminación de los estudios es de ".NumeroEnLetras::convertir($this->duracion)." ($this->duracion) $this->letrasDuracion."),null,'justify');
		$section->addTextBreak(1);
		$section->addText(utf8_decode("2.	Que dicha comisión se ha venido prorrogando hasta el $this->fechaProrroga mediante la Resolución"
											." Vicerrectoría de Docencia 9038 del 16 de julio de 2015."),null,'justify');
										
		$section->addTextBreak(1);
		$section->addText(utf8_decode("3.	**, ".$this->diccionario->getGeneroDocente($this->sexoProfesor)." $this->profesor, presentó al Consejo de $this->facultad, solicitud de prórroga de la comisión de estudios con el fin de continuar sus estudios de $this->tipoEsutidio."),null,'justify');
											
		$section->addTextBreak(1);
		$section->addText(utf8_decode("4.	Que en comunicado **, el Consejo de $this->faculta, informa que en su sesión"
											." de $this->fechaReunion, Acta $this->acta1, recomendó la prórroga de la comisión de estudios para el"
											." $this->profesor."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("5.	Que el Comité de Desarrollo del Personal Docente, en el Acta 876 del 8 de agosto de 2012, conceptuó favorablemente"
											." sobre la prórroga de la comisión de estudios para ".$this->generoDocente." $this->profesor, teniendo en cuenta"
											." que con la misma no se excede el tiempo máximo de cinco años de que trata el artículo 115 del Estatuto Profesoral."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("6.	Que el artículo 111 del Acuerdo Superior 083 de 1996 (modificado por el Acuerdo Superior 353 del 29 de"
											." abril de 2008), establece que el Concejo de la Unidad Académica a la cual pertenece el profesor, informará"
											." sobre las formas de seguimiento de la comisión."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("7.	Que el literal c  del artículo 1 de la Resolución Rectoral 37544 del 19 de julio de 2013, establece como delegación en la Vicerrectora de Docencia, la autorización para las "
											."las comisiones de estudio de los profesores, así como las situaciones que se derivan de las mismas, tales como prórrogas ordinarias, modificaciones, suspensiones, renovaciones e incumplimientos, conforme a los artículos, 70, 110 y 111 del Acuerdo Superior 083 de 1996 (Estatuto Profesoral)."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText("RESUELVE",null,'title');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 1. Conceder ". $this->diccionario->getSeñor($this->sexoProfesor) ." $this->profesor ". $this->diccionario->getPalIdentificacion($this->sexoProfesor)." con cédula de ciudadanía $this->cedula, ". substr($this->generoDocente,2,10)." de tiempo completo, ".$this->diccionario->getAdscrito($this->sexoProfesor)." a la $this->facultad,"
										." prórroga de comisión de estudios, remunerada con el 100% de su salario básico mensual, con una dedicación del $this->dedicasion de su jornada laboral, desde"
										." el $this->fechaInicial hasta el $this->fechaFinal, con el fin de realizar estudios de $this->estudio en ".$this->diccionario->getPalabra(substr($this->universidad,0,strpos($this->universidad,' ')))." $this->universidad. $this->pais."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 2. Al conceptuar sobre la conveniencia de conceder la comisión de estudios, el Consejo de la Unidad Académica a la cual pertenece el profesor,"
										." informó a la Vicerrectora de Docencia, sobre las formas de seguimiento que se implementarán para la comisión de estudios, las cuales quedarán consignadas en el respectivo"
										." contrato que el profesor suscribirá en la Dirección de Asesoría Jurídica y serán de obligatorio cumplimiento."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 3. Para cada solicitud de prórroga o modificación de la comisión de estudios concedida, al igual que al momento de su finalización, el Consejo de"
										." la Unidad Académica a la cual pertenece el profesor informará a la Vicerrectora de Docencia, sobre el resultado del seguimiento implementado."),null,'justify');
		
		
		$section->addTextBreak(2);
		
		$section->addText("LUZ STELLA ISAZA MESA",null,'firma');
		$section->addText("Vicerrectora de Docencia",null,'firma');
		
		//se guarda el documento
		$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
		$objWriter->save('Resolucion.docx');
		}
	}
?>