<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
	require_once('../../../configuracion/path.php');
	require_once($path['modelo'].'clasesDTO.php');
	require_once('../../../librerias/PHPWord_0.6.2/PHPWord.php');
	require_once('diccionario.php');
	
	class NuevaCorttaDuracionMenor3M{
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
		private $letrasDuracion;
		
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
		$this->profesor =  mb_strtoupper($this->codificar($solicitud->getDocente()->getNombre()." ".$solicitud->getDocente()->getApellido1()." ".$solicitud->getDocente()->getApellido2() ),'UTF-8');
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
	
		$datetime1 = date_create($this->fechaInicial);
		$datetime2 = date_create($this->fechaFinal);
		$interval = date_diff($datetime1, $datetime2);
		$this->duracion = $interval->format('%a');
		$this->duracion = intval($this->duracion/30);
		
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
		$section->addText(utf8_decode("Por la cual se concede una comisi??n de estudios de corta duraci??n"),null,'title');
		$section->addText(utf8_decode("LA VICERRECTORA DE DOCENCIA DE LA UNIVERSIDAD DE ANTIOQUIA, en uso de sus facultades legales y estatutarias y en especial la conferida por el literal c,"
										." art??culo 1 de la Resoluci??n Rectoral 37544 del 19 de julio de 2013."));
	
		
		
		$section->addTextBreak(1);
		$section->addText("CONSIDERANDO",null,'title');
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode("1.	Que en los art??culos 111 y 112 del Acuerdo Superior 083 de 1996 se estipulan las condiciones para otorgar una comisi??n de estudios."),null,'justify');
		//$section->addTextBreak(1);
		$section->addText(utf8_decode("2.	Que luego de verificar dichos requisitos, y con fundamento en la facultad conferida por el literal m, art??culo 60, del Estatuto General"
										." el Consejo de $this->facultad, reunido el $this->fechaReunion, Acta $this->actaFacultad, recomend?? una comisi??n de estudios para $this->generoDocente $this->profesor ".$this->diccionario->getPalIdentificacion($this->sexoProfesor)
										." con c??dula de ciudadan??a $this->cedula, desde el $this->fechaInicial hasta el $this->fechaFinal, con el fin de realizar $this->estudio en ".$this->diccionario->getPalabra(substr($this->universidad,0,strpos($this->universidad,' ')))." $this->universidad."),null,'justify');
										
		//$section->addTextBreak(1);
		$section->addText(utf8_decode("3.	Que el Comit?? $this->comite, en el uso de la funci??n conferida por los literales d y e, articulo 3, del Acuerdo Superior 33 del 15 de julio de 1983,"
											." recomend?? conceder la comisi??n de estudios para $this->generoDocente $this->profesor seg??n Acta $this->acta2 del $this->fechaActa2."),null,'justify');
		
		//$section->addTextBreak(1);
		$section->addText(utf8_decode("4.	Que toda vez que la comisi??n a conceder, no supera los tres meses de que trata el art??culo 113 del Estatuto Profesoral, no ser?? necesaria la suscripci??n de un contrato,"
											." por lo que hacen parte de la presente resoluci??n, los compromisos adquiridos por $this->generoDocente $this->profesor e virtud de la comisi??n conferida, aprobados por el"
											." Consejo de la Dependencia y avalados por la Vicerrector??a de Docencia"),null,'justify');
		
											
		//$section->addTextBreak(1);
		$section->addText(utf8_decode("5.	Que el art??culo 111 del Acuerdo Superior 083 de 1996 (modificado por el Acuerdo Superior 353 del 29 de abril de 2008), establece que el Consejo"
											." de la dependencia a la cual pertenece el profesor, informar?? sobre las formas de seguimiento de la comisi??n"),null,'justify');
		//$section->addTextBreak(1);
		$section->addText(utf8_decode("6.	Que el literal c  del art??culo 1 de la Resoluci??n Rectoral 37544 del 19 de julio de 2013, establece como delegaci??n en la Vicerrectora de Docencia, la autorizaci??n para las "
											,"las comisiones de estudio de los profesores, as?? como las situaciones que se derivan de las mismas, tales como pr??rrogas ordinarias, modificaciones, suspensiones, renovaciones e incumplimientos, conforme a los art??culos, 70, 110 y 111 del Acuerdo Superior 083 de 1996 (Estatuto Profesoral)."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText("RESUELVE",null,'title');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ART??CULO 1. Conceder a ". $this->diccionario->getSe??or($this->sexoProfesor) ." $this->profesor ". $this->diccionario->getPalIdentificacion($this->sexoProfesor)." con c??dula de ciudadan??a $this->cedula, ". substr($this->generoDocente,2,10)." de tiempo completo, ".$this->diccionario->getAdscrito($this->sexoProfesor)." a la $this->facultad,"
										." comisi??n de estudios de corta duraci??n, remunerada con el 100% de su salario b??sico mensual, con una dedicaci??n de tiempo completo de su jornada laboral, desde el"
										." $this->fechaInicial hasta el $this->fechaFinal, con el prop??sito de realizar $this->estudio en ".$this->diccionario->getPalabra(substr($this->universidad,0,strpos($this->universidad,' ')))." $this->universidad."),null,'justify');
		
		//$section->addTextBreak(1);
		$section->addText(utf8_decode("ART??CULO 2. $this->generoDocente $this->profesor adquiere como compromisos de obligatorio cumplimiento en el marco de esta comisi??n: ***"),null,'justify');
		
		//$section->addTextBreak(1);
		
		//$section->addTextBreak(1);
		$section->addText(utf8_decode("ART??CULO 3. Al conceptuar sobre la conveniencia de conceder la comisi??n de estudios de corta duraci??n, el Consejo de la Unidad Acad??mica a la cual pertenece $this->generoDocente,"
										." inform?? a la Vicerrectora de Docencia, sobre las formas de seguimiento que se implementar??n para la comisi??n de estudios, las cuales quedar??n consignadas en el respectivo"
										." contrato que el profesor suscribir?? en la Direcci??n de Asesor??a Jur??dica y ser??n de obligatorio cumplimiento."),null,'justify');
		
		//$section->addTextBreak(1);
		$section->addText(utf8_decode("ART??CULO 4. Para cada solicitud de pr??rroga o modificaci??n de la comisi??n de estudios concedida, al igual que al momento de su finalizaci??n, el Consejo de"
										." la Unidad Acad??mica a la cual pertenece el profesor informar?? a la Vicerrectora de Docencia, sobre el resultado del seguimiento implementado."),null,'justify');
		
		$section->addTextBreak(1);
		
		$section->addText("LUZ STELLA ISAZA MESA");
		$section->addText("Vicerrectora de Docencia");
		
		//se guarda el documento
		$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
		$objWriter->save('Resolucion.docx');
		}
	}
?>