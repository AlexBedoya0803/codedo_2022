<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
	require_once('../../../configuracion/path.php');
	require_once($path['modelo'].'clasesDTO.php');
	require_once('../../../librerias/PHPWord_0.6.2/PHPWord.php');
	require_once('diccionario.php');
	
	class NuevaSolicitud{
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
		
	//Este metodo permite organizar las cadenas de texto con la codificacion correcta para que se vea bien en el documento
	function codificar($cadena){
		if(mb_detect_encoding($cadena)=="UTF-8" && mb_detect_encoding($cadena)=="ASCII"){
			//echo $cadena." /";
			return $cadena;	
			
		}else{
			//echo " :::: ".utf8_encode($cadena)." /"; 
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
		$this->profesor = strtoupper($this->codificar($solicitud->getDocente()->getNombre()));
		$this->cedula = $solicitud->getDocenteId();
		$this->estudio = $solicitud->getObjetivo();
		$this->tipoEsutidio = $this->codificar($solicitud->getMotivo()->getMotivo());
		$this->duracion= $solicitud->getDuracion();
		$this->universidad = $this->codificar(str_replace('.','',$solicitud->getLugar()));
		$this->pais =  $this->codificar($solicitud->getPais()->getPais());
		$this->comite = "Desarrollo Personal Docente";
		$this->fechaInicial = $solicitud->getFecha1();
		$this->fechaFinal = $solicitud->getFecha2();
		$this->sexoProfesor = ($solicitud->getDocente()->getSexo());
		$this->generoDocente = $this->diccionario->getGeneroDocente($this->sexoProfesor);
	}
	
	//Se crea el documento .doc y se guarda
	function crear(){

		$PHPWord = new PHPWord();
		$PHPWord->addParagraphStyle('title', array('align'=>'center', 'spaceAfter'=>100));
		$PHPWord->addParagraphStyle('right', array('align'=>'right', 'spaceAfter'=>100));
		$PHPWord->addParagraphStyle('left', array('align'=>'left', 'spaceAfter'=>100));
		$section = $PHPWord->createSection();
		
		//se crae un encabezado
		$header = $section->createHeader();
		$table = $header->addTable();
		$table->addRow();
		$table->addCell(4500)->addText(utf8_decode("Resolución Rectoral"));
		$table->addCell(4500)->addImage('../../../imagenes/udea.jpg', array('width'=>100, 'height'=>100, 'align'=>'right'));
		
		//se crea el cuerpo del documento
		$section->addText(utf8_decode("RESOLUCIÓN RECTORAL"),null,'title');
		$section->addTextBreak(1);
		$section->addText(utf8_decode("Por la cual se modifica y se concede prórroga a una comisión de estudios"),null,'title');
		$section->addText(utf8_decode("EL RECTOR DE LA UNIVERSIDAD DE ANTIOQUIA, en uso de sus facultades legales y estatuarias"
										." y en especial las conferidas por el literal r, articulo 42 del Acuerdo Superior 1 de 1994"
										." y articulo 110 del Acuerdo Superior 083 de 1996"));
	
		
		$section->addTextBreak(1);
		$section->addText("CONSIDERANDO",null,'title');
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode("1.	Que mediante la Resolución Rectoral 32308 del 19 de mayo de 2011, se le concedió a $this->generoDocente $this->profesor, ".$this->diccionario->getPalIdentificacion($this->sexoProfesor)." con"
											." la cédula de ciudadania $this->cedula, ".$this->diccionario->getAdscrito($this->sexoProfesor)." a la $this->facultad,"
											." comisión de estudios de corta duración, remunerada con el 100% de su salario básico mensual, con una dedicación de tiempo completo de su jornada laboral, desde"
											." el $this->fechaInicial hasta el $this->fechaFinal, con el fin de realizar estudios de $this->estudio en ".$this->diccionario->getPalabra(substr($this->universidad,0,strpos($this->universidad,' ')))." $this->universidad"));
		$section->addTextBreak(1);
		$section->addText(utf8_decode("2.	Que dicha comisión fue prorrogada hasta el $this->fechaFinal mediante la Resolución Rectoral *****; sinembargo la fecha correcta de finalizacion de dicha prórroga debe ser el ******"));
										
		$section->addTextBreak(1);
		$section->addText(utf8_decode("3.	Que en comunicado ****, $this->generoDocente $this->profesor, presentó al Consejo de $this->facultad, solicitud de prórroga de la comisión de estudios de corta duración, con el fin de continuar"
											." sus estudios de $this->estudio"));
											
		$section->addTextBreak(1);
		$section->addText(utf8_decode("4.	Que en comunicado DECANATO ofic.107 del *****, el Consejo de $this->facultad nforma que, en el Acta 08 del ****, recomendó"
											." la prórroga de la comisión de estudios de corta duración para $this->generoDocente $this->profesor."));
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("5.	Que el Comité de Desarrollo del Personal Docente, en el Acta $this->acta2 del $this->fechaActa2, conceptuó favorablemente sobre la prórroga de la comisión de estudios de corta duración para $this->generoDocente"
											." $this->profesor, teniendo en ceunta que la misma no excede el tiempo máximo de un año de que trata el artículo 115 del Acuerdo Superior 083 del 22 de julio de 1996, modificado por el Acuerdo Superior 353 del 29 de abril de 2008."));
		
		$section->addTextBreak(1);
		$section->addText("RESUELVE",null,'title');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 1. Modificar la Resolución Rectoral *****, para que la prórroga de la comisión de estudios de corta duración concedida a $this->generoDocente"));
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 2. Conceder a ". $this->diccionario->getSeñor($this->sexoProfesor) ." $this->profesor ". $this->diccionario->getPalIdentificacion($this->sexoProfesor)." con cédula de ciudadania $this->cedula, ". substr($this->generoDocente,2,10)." de tiempo completo, ".$this->diccionario->getAdscrito($this->sexoProfesor)." a la $this->facultad,"
										." prórroga de la comisión de estudios de corta duración, remunerada con el 100% de su salario básico mensual, con una dedicación de tiempo completo de su jornada laboral, desde el"
										." el $this->fechaInicial hasta el $this->fechaFinal, con el fin de realizar estudios de $this->estudio en ".$this->diccionario->getPalabra(substr($this->universidad,0,strpos($this->universidad,' ')))." $this->universidad, $this->pais. El".$this->diccionario->getPalabra($this->tipoEsutidio)." $this->tipoEsutidio tiene una duración"
										." aproximana de $this->duracion."));
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 3. Al conceptuar sobre la conveniencia de conceder la comisión de estudios, el Consejo de la Unidad Académica a la cual pertenece el profesor,"
										." informará al Rector, sobre las formas de seguimiento que se implementarán para la comisión de estudios, las cuales quedarán consignadas en el respectivo"
										." contrato que el profesor suscribirá en la Dirección de Asesoría Jurídica y serán de obligatorio cumplimento."));
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 4. Para cada solicitud de prórroga o modificación de la comisión de estudios concedida, al igual que al momento de su finalización, el Consejo de"
										." la Unidad Académica a la cual pertenece el profesor informará al Rector, sobre el resultado del seguimiento implementado."));
		
		$section->addTextBreak(2);
		$table2 = $section->addTable();
		$table2->addRow();
		$table2->addCell(4500)->addText("ALBERTO URIBE CORREA NEIRA");
		$table2->addCell(4500)->addText("LUQUEGI GIL",null,'right');
		
		$table2->addRow();
		$table2->addCell(4500)->addText("Rector General");
		$table2->addCell(4500)->addText("Secretario",null,'right');
		
		$section->addTextBreak(2);
		
		$section->addText("OSCAR SIERRA RODRIGUEZ");
		$section->addText("Vicerrector de Docencia");
		
		//se guarda el documento
		$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
		$objWriter->save('Resolucion.docx');
		}
	}
?>