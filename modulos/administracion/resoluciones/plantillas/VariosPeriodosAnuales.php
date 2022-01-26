
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
	require_once('../../../configuracion/path.php');
	require_once($path['modelo'].'clasesDTO.php');
	require_once('../../../librerias/PHPWord_0.6.2/PHPWord.php');
	require_once('diccionario.php');
	
	class VariosPeriodosAnuales{
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
		$this->universidad = $solicitud->getLugar(); //UTF8
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
		$section->addText(utf8_decode("Por la cual se concede una comisión de estudios"),null,'title');
		$section->addText(utf8_decode("EL RECTOR DE LA UNIVERSIDAD DE ANTIOQUIA, en uso de sus facultades legales y estatuarias"
										." y en especial las conferidas por el literal r, articulo 42 del Acuerdo Superior 1 de 1994"
										." y articulo 110 del Acuerdo Superior 083 de 1996"));
	
		
		$section->addTextBreak(1);
		$section->addText("CONSIDERANDO",null,'title');
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode("1.	Que mediante la Resolución Rectoral 21303 del 22 de agosto de 2005, se le concedió a $this->generoDocente $this->profesor, una"
											." comisión de estudios, del $this->fechaInicial hasta el $this->fechaFinal, con el 100% de su salario básico mensual, equivalente"
											." a tiempo completo de su dedicación laboral, para realizar estudios de $this->estudio, en ".$this->diccionario->getPalabra(substr($this->universidad,0,strpos($this->universidad,' ')))." $this->universidad"));
		$section->addTextBreak(1);
		$section->addText(utf8_decode("2.	Que dicha comisión se ha venido prorrogando hasta el $this->fechaFinal mediante la Resolución Rectoral 24937 del 27 de septiembre de 2007."));
										
		$section->addTextBreak(1);
		$section->addText(utf8_decode("3.	"));
											
		$section->addTextBreak(1);
		$section->addText(utf8_decode("4.	"));
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("5.	"));
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("6.	Que el Comité de Desarrollo del Personal Docente en el Acta 824 del 17 de junio de 2010, conceptuó la necesidad de legalizar las prórrogas de comisión"
											." de estudios para $this->generoDocente $this->profesor, teniendo en cuenta los retrasos en el trámite de las mismas y que de esta forma no se excede el tiempo"
											." máximo de cinco años de que trata el artículo 115 del Estatuto Profesoral."));
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("7.	Que el artículo 111 del Acuerdo Superior 083 de 1996 (modificado por el Acuerdo Superior 353 del 29 de abril de 2008), establece que el Concejo de Facultad"
											." de la Unidad Académica a la cual pertenece la docente, informará sobre las formas de seguimiento de la comisión."));
		
		$section->addTextBreak(1);
		$section->addText("RESUELVE",null,'title');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 1. Legalizar la prórroga de la comisión de estudios remunerada concedida a ".$this->diccionario->getSeñor($this->sexoProfesor)." $this->profesor, ".$this->diccionario->getPalIdentificacion($this->sexoProfesor)." con la"
										." la cédula de ciudadania $this->cedula, Docente de tiempo completo, adscrita a la $this->facultad, por el período comprendido entre el $this->fechaInicial hasta el $this->fechaFinal, y autorizar prórroga desde el $this->fechaInicial,"
										." con el 100% de su salario básico mensual, con una dedicación de tiempo completo de su jornada laboral; con el fin de que continúe realizando estudios de $this->estudio, en ".$this->diccionario->getPalabra(substr($this->universidad,0,strpos($this->universidad,' ')))." $this->universidad."));
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 2. Al conceptuar sobre la conveniencia de conceder la comisión de estudios, el Consejo de la Unidad Académica a la cual pertenece el profesor,"
										." informará al Rector, sobre las formas de seguimiento que se implementarán para la comisión de estudios, las cuales quedarán consignadas en el respectivo"
										." contrato que el profesor suscribirá en la Dirección de Asesoría Jurídica y serán de obligatorio cumplimento."));
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 3. Para cada solicitud de prórroga o modificación de la comisión de estudios concedida, al igual que al momento de su finalización, el Consejo de"
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