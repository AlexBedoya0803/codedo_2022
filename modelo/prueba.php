<?php
require_once('clasesDTO.php');
/*
$articulo=new ArticuloDTO();
$articulo->setContenido("conte30213");
$articulo->setAutor("yo");
$articulo->setFecha("fecha");
$articulo->save();
echo $articulo->getId();
$comentario=new ComentarioDTO();
$comentario->setContenido("quedo bueno si");
$comentario->setAutor("mario");
$comentario->setFecha("hoy");
$comentario->setArticuloId($articulo->getId());
$comentario->save();
*/
require_once('criteria.php');
$criteria=new Criteria("Articulos");
$criteria->operador="OR";
$criteria->addFiltro("contenido","LIKE","333");
$criteria->addFiltro("autor","LIKE","yo");
$criteria->orderBy("fecha","DESC");
$articulos=$criteria->execute();
foreach ($articulos as $articulo)
{
echo $articulo->getAutor();
echo " \n ";
}