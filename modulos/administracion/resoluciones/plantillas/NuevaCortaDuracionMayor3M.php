<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
	require_once('../../../configuracion/path.php');
	require_once($path['modelo'].'clasesDTO.php');
	require_once('../../../librerias/PHPWord_0.6.2/PHPWord.php');
	require_once('diccionario.php');
	require_once('FormatoFecha.php');
	require_once('NumeroEnLetras.php');
	
	class NuevaCortaDuraccionMayor3M{
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
		private $dedicasion;
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
		$table->addCell(10000)->addImage('../../../imagenes/udea.jpg', array('width'=>100, 'height'=>100, 'align'=>'center'));
		
		//se crea el cuerpo del documento
		$section->addText(utf8_decode("RESOLUCIÓN DE VICERRECTORÍA DE DOCENCIA"),null,'title');
		$section->addTextBreak(1);
		$section->addText(utf8_decode("Por la cual se concede una comisión de estudios de corta duración"),null,'title');
		$section->addText(utf8_decode("LA VICERRECTORA DE DOCENCIA DE LA UNIVERSIDAD DE ANTIOQUIA, en uso de sus facultades legales y estatutarias y en especial la conferida por el literal c,"
										." artículo 1 de la Resolución Rectoral 37544 del 19 de julio de 2013."));
	
		
		$section->addTextBreak(1);
		$section->addText("CONSIDERANDO",null,'title');
		$section->addTextBreak(1);
		
		$section->addText(utf8_decode("1.	Que en los artículos 111 y 112 del Acuerdo Superior 083 de 1996 se estipulan las condiciones para otorgar una comisión de estudios."),null,'justify');
		$section->addTextBreak(1);
		$section->addText(utf8_decode("2.	Que luego de verificar dichos requisitos, y con fundamento en la facultad conferida por el literal m, artículo 60, del Estatuto General"
										." el Consejo de $this->facultad, en su sesión del $this->fechaReunion, Acta $this->actaFacultad, recomendó una comisión de estudios para $this->generoDocente $this->profesor con el"
										." fin de que realice $this->estudio en ".$this->diccionario->getPalabra(substr($this->universidad,0,strpos($this->universidad,' ')))." $this->universidad"),null,'justify');
										
		$section->addTextBreak(1);
		$section->addText(utf8_decode("3.	Que el Comité $this->comite, en el uso de la función conferida por los literales d y e, articulo 3, del Acuerdo Superior 33 del 15 de julio de 1983,"
											." recomendó conceder la comisión de estudios para $this->generoDocente $this->profesor según Acta $this->acta2 del $this->fechaActa2."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("4.	Que toda vez que la comisión supera los tres meses, será necesaria la suscripción de un contrato en el cual se incluyan los compromisos adquiridos por ".$this->generoDocente.""
											." $this->profesor con la unidad académica a la cual está adscrito o con la Universidad, según el artículo 113 del Acuerdo Superior 083 de 1996."),null,'justify');
		
		$section->addTextBreak(1);									
		$section->addText(utf8_decode("5.	Que el artículo 111 del Acuerdo Superior 083 de 1996 (modificado por el Acuerdo Superior 353 del 29 de abril de 2008), establece que el Consejo"
											." de la dependencia a la cual pertenece el profesor, informará sobre las formas de seguimiento de la comisión"),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("6.	Que el literal c del artículo 1 de la Resolución Rectoral 37544 del 19 de julio de 2013, establece como delegación en la Vicerrectora de Docencia, la autorización para las comisiones de estudio de los profesores"
											." los profesores, así como las situaciones que se derivan de las mismas, tales como prórrogas ordinarias, modificaciones, suspensiones, renovaciones e incumplimientos, conforme a los artículos, 70, 110 y 111 del Acuerdo Superior 083 de 1996(Estatuto Profesoral."),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText("RESUELVE",null,'title');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 1. Conceder ". $this->diccionario->getSeñor($this->sexoProfesor) ." $this->profesor ". $this->diccionario->getPalIdentificacion($this->sexoProfesor)." con cédula de ciudadanía $this->cedula, ". substr($this->generoDocente,2,10)." de tiempo completo, ".$this->diccionario->getAdscrito($this->sexoProfesor)." a la $this->facultad,"
										." comisión de estudios de corta duración, remunerada con el 100% de su salario básico mensual, con una dedicación del $this->dedicasion% de su jornada laboral, desde "
										." el $this->fechaInicial hasta el $this->fechaFinal, con el fin de realizar $this->estudio en ".$this->diccionario->getPalabra(substr($this->universidad,0,strpos($this->universidad,' ')))." $this->universidad, $this->pais. "),null, 'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("PARÁGRAFO. La duración total de la actividad será de aproximadamente ".NumeroEnLetras::convertir($this->duracion)."($this->duracion) $this->letrasDuracion, por lo cual, $this->generoDocente deberá solicitar oportunamente la prórroga de la comisión para completar dicha duración."),null.'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 2. $this->generoDocente $this->profesor adquiere como compromisos de obligatorio cumplimiento en el marco de esta comisión: ***"),null,'justify');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 3. El Consejo de la Unidad Académica a la cual pertenece $this->generoDocente, informó al la Vicerrectora de Docencia sobre los compromisos que ".$this->diccionario->getEste($this->sexoProfesor)." adquiere y sobre las formas de seguimiento a la"
										." comisión que se implementarán, información que quedará consignada en el respectivo contrato que $this->generoDocente suscribirá en la Dirección de Asesoría Jurídica y serán de obligatorio cumplimiento."),null,'justify');
		
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 4. Para cada solicitud de prórroga o modificación de la comisión de estudios concedida, al igual que al momento de su finalización, el Consejo de la Unidad Académica informará a la Vicerrectora de Docencia sobre los resultados del seguimiento implementado."
										.""),null,'justify');
								
		$section->addTextBreak(1);
		
		$section->addText("LUZ STELLA ISAZA MESA",null,'firma');
		$section->addText("Vicerrectora de Docencia",null,'firma');
		
		//se guarda el documento
		$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
		$objWriter->save('Resolucion.docx');
		}
	}
?>