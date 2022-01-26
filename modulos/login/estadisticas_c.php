<?php
require_once('../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
require_once($path['modelo'].'clasesDTO.php');
require_once($path['librerias'].'/libchart/libchart/classes/libchart.php');
$valores = array();
$nombres = array();
$hoy=date("Y-m-d");
$total=0;
	$chart = new PieChart(600,300);
	$dataSet = new XYDataSet();
    for($i = 1; $i <= 11; $i += 1)
	{
	$consulta = new Criteria("comisiones");
	$consulta->addFiltro("motivo_id","=",$i);
	$consulta->addFiltro("fechaf",">",$hoy);
	$consulta->generarQuery();
    $valores[$i]=$consulta->_count();
	$motivo = new MotivoDTO();
	$motivo=$motivo->find($i);
	$nombres[$i]=$motivo->getMotivo();
	$dataSet->addPoint(new Point($nombres[$i]."(".$valores[$i].")",$valores[$i]));
	$total=$total+$valores[$i];
	}
	$chart->setDataSet($dataSet);
	$chart->setTitle(" Resultado de solicitudes ");
    $chart->render($path['imagenes'].'estadisticas/grafico.png');
?>

