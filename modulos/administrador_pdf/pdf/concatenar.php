<?php
require('fpdi.php');

class concat_pdf extends FPDI

{

var $files = array();

function setFiles($files)
{
$this->files = $files;
}

function concat()
{
foreach($this->files AS $file)
{
$pagecount = $this->setSourceFile($file);
for ($i = 1; $i <= $pagecount; $i++)
{
$tplidx = $this->ImportPage($i);
$s = $this->getTemplatesize($tplidx);
$this->AddPage($s['h'] > $s['w'] ? 'P' : 'L');
$this->useTemplate($tplidx);
}
}
}
}
/*
$pdf =& new concat_pdf();
$pdf->setFiles(array('1.pdf','2.pdf','3.pdf','4.pdf'));
$pdf->concat();
$pdf->Output('pdf/paginas.pdf', 'F');
*/

?>
