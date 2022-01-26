<?php
	//información del documento
	require_once('../../../configuracion/path.php');
	require_once('../../../modelo/clasesDTO.php');
	require_once('../../../librerias/PHPWord_0.6.2/PHPWord.php');
	
	$numero = count($_GET);
	$solicitud;
if($numero)
{
	$solicitud = $_GET['sol'];
}
	
		 $facultad="null";
		 $fechaReunion="null";
		 $acta1="null";
		 $acta2="null";
		 $fechaActa2="null";
		 //$profesor="null";
		 $profesor = $solicitud->getDocente()->getNombre();
		 $cedula="null";
		 $estudio="null";
		 $tipoEsutidio="null";
		 $duracion="null";
		 $universidad="null";
		 $pais="null";
		 $comite="null";
		 $fechaInicial="null";
		 $fechaFinal="null";
	/*
	$facultad = "Ciencias Humanas";
	$fechaReunion = "30 de junio de 2012";
	$acta1 = "580";
	$acta2 = "877";
	$fechaActa2 = "21 de agosto de 2012";
	$profesor = "MAURICIO HENAO HERNANDEZ BEDOYA HERNÁNDEZ";
	$cedula = "15.508.572";
	$estudio = "Doctorado en Ciencias Sociales";
	$tipoEsutidio = "Doctorado";
	$duracion = "cinco (5) años";
	$universidad = "Universidad de Antioquia";
	$pais = "Colombia";
	$comite = "Desarrollo del Personal Docente";
	$fechaInicial="10 de agosto de 2012";
	$fechaFinal = "9 de agosto de 2013";
	*/
	
	//Se crea un documento nuevo
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
		
		$section->addText(utf8_decode("1.	Que en los articulos 111 y 112 del Acuerdo Superior 083 de 1996 se estipulan las condiciones para otorgar una comisión de estudios."));
		$section->addTextBreak(1);
		$section->addText(utf8_decode("2.	Que luego de verificar dichos requisitos, y con fundamento en la facultad conferida por el literal m, artículo 60, del Estatuto General"
										." el Consejo de Facultad de $facultad, reunido el $fechaReunion, Acta $acta1, recomendó una comisión de estudios para el profesor $profesor con el"
										." el fin de que realice estudios de $estudio en la $universidad, $pais."));
										
		$section->addTextBreak(1);
		$section->addText(utf8_decode("3.	Que el Comité $comite, en el uso de la función conferida por los literales d y e, articulo 3, del Acuerdo Superior 33 del 15 de julio de 1983,"
											." recomendó conceder la comisión de estudios para el profesor $profesor según Acta $acta2 del $fechaActa2."));
											
		$section->addTextBreak(1);
		$section->addText(utf8_decode("4.	Que el articulo 111 del Acuerdo Superior 083 de 1996 (modificado por el Acuerdo Superior 353 del 29 de abril de 2008), establece que el Consejo"
											." de la dependdencia a la cual pertenece el profesor, informará sobre las formas de seguimiento de la comisión"));
		
		$section->addTextBreak(1);
		$section->addText("RESUELVE",null,'title');
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 1. Conceder al señor $profesor identificado con cédula de ciudadania $cedula, profesor de tiempo completo, adscrito a la facultad de $facultad,"
										." comisión de estudios, remunerada con el 100% de su salario básico mensual, con una dedicación de tiempo completo de su jornada laboral, desde el"
										." el $fechaInicial hasta el $fechaFinal, con el fin de realizar estudios de $estudio en la $universidad, $pais. El $tipoEsutidio tiene una duración"
										." aproximana de $duracion."));
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 2. Al conceptuar sobre la conveniencia de conceder la comisión de estudios, el Consejo de la Unidad Académica a la cual pertenece el profesor,"
										." informará al Rector, sobre las formas de seguimiento que se implementarán para la comisión de estudios, las cuales quedarán consignadas en el respectivo"
										." contrato que el profesor suscribirá en la Dirección de Asesoría Jurídica y serán de obligatorio cumplimento."));
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 3. Para cada solicitud de prórroga o modificación de la comisión de estudios concedida, al igual que al momento de su finalización, el Consejo de"
										." la Unidad Académica a la cual pertenece el profesor informará al Rector, sobre el resultado del seguimiento implementado."));
		
		
		$section->addTextBreak(1);
		$section->addText(utf8_decode("ARTÍCULO 4. Para hacer efectivo el beneficio de la comisión, el profesor deberá cumplir previo a su disfrute, con los requisitos establecidos por la universidad,"
										." los cuales se adelantarán en la Oficina de Asesoría Jurídica."));
								
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
		
		//se permite la descarga del documento
		header('Content-Description: File Transfer');
		header('Content-type: application/force-download');
		header('Content-Disposition: attachment; filename='.basename('Resolucion.docx'));
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.filesize('Resolucion.docx'));
		readfile('Resolucion.docx');
		unlink('Resolucion.docx');
?>