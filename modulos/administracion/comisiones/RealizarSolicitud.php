<?php
	/*
	* Autor: Luis Fernando Orozco
	* Este script elige que vista mostrar cuando el docente este creando una solicitud en el sistema.
	*/
	require_once('./MsgError.php');
	MsgError::getMsgError("Error","");
	require_once('./RealizarSolicitud_c.php');
	require_once('../../login/Session.php');
	require_once('./FormularioSolicitud.php');
	require_once('../../../configuracion/path.php');
	
	$path=asignarPath(dirname(__FILE__));
	require_once($path['modelo'].'clasesDTO.php');
	$session = Session::getInstance();
	if($session->getVal("usuario_id")=="" || $session->getVal("rol")!="docente") //si no hay ningun usuario registrado muestra la vista general
		echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
	
	$tipoSolicitud;
	$formulario;
	$comision=NULL;
	if(isset($_POST['buscar'])){
		//echo "buscar";	
		$id=$session->getVal("usuario_id");
		$comision=new ComisionDTO();
		$idComision = $_POST["comisiones"];
		//var_dump($idComision);
		//throw new Exception;
		//echo "*******</br>";
		$comision=$comision->find($idComision);
		//echo $_POST['comisiones'];
		//echo $comision->getObjetivo();
	}
	
	if(isset($_GET['tipoSolicitud'])){
		switch($_GET['tipoSolicitud']){
			case 'Nueva';
				$tipoSolicitud = "Nueva";
				$formulario = FormularioSolicitud::makeNueva();
					
				break;
			case 'Prorroga';
				$tipoSolicitud = "Prórroga";
				$formulario = FormularioSolicitud::makeProrroga($session->getVal("usuario_id"),$comision);
				break;
			case 'ProrrogaExcepcional';
				$tipoSolicitud = "Prórroga excepcional";
				
				$formulario = FormularioSolicitud::makeProrrogaExceptional($session->getVal("usuario_id"),$comision,'10');
				break;
			case 'Modificacion';
				$tipoSolicitud = "Modificación";
				$formulario=FormularioSolicitud::makeModificacion($session->getVal("usuario_id"),$comision);
				break;
			case 'Cancelacion';
				$tipoSolicitud = "Cancelación";
				$formulario = FormularioSolicitud::makeProrrogaExceptional($session->getVal("usuario_id"),$comision,'5');
				break;
			case 'Renuncia';
				$tipoSolicitud = "Renuncia";
				$formulario = FormularioSolicitud::makeProrrogaExceptional($session->getVal("usuario_id"),$comision,'6');
				break;
			case 'Suspension';
				$tipoSolicitud = "Suspensión";
				$formulario = FormularioSolicitud::makeProrrogaExceptional($session->getVal("usuario_id"),$comision,'7');
				break;
			case 'ReintegroConGrados';
				$tipoSolicitud = "Reintegro anticipado con grado";
				$formulario = FormularioSolicitud::makeProrrogaExceptional($session->getVal("usuario_id"),$comision,'8');
				break;
			case 'ReintegroSinGrados';
				$tipoSolicitud = "Reintegro sin grado";
				$formulario = FormularioSolicitud::makeProrrogaExceptional($session->getVal("usuario_id"),$comision,'12');
				break;
			case 'ReintegroAnticipadoConGrados';
				$tipoSolicitud = "Reintegro anticipado con grado";
				$formulario = FormularioSolicitud::makeProrrogaExceptional($session->getVal("usuario_id"),$comision,'8');
				break;
			case 'ReintegroAnticipadoSinGrados';
				$tipoSolicitud = "Reintegro anticipado sin grado";
				$formulario = FormularioSolicitud::makeProrrogaExceptional($session->getVal("usuario_id"),$comision,'9');
				break;
			case 'Informe';
				$tipoSolicitud = "Informe";
				$formulario = FormularioSolicitud::makeInforme($session->getVal("usuario_id"),$comision);
				break;
			default;
				$tipoSolicitud = "**";
				break;
		}
	}else{
		echo '<script>location.href="../../login/login-Copia.php";</script>';
	}
	
	$docente = new DocenteDTO();
	$docente->find($session->getVal("usuario_id"));
	
?>
<DOCTYPE html>
<head>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../../js/funciones.js"></script>
<script src="../../../js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="../../../js/validarFilesDocente.js"></script>
	<style>
		.Estilo8 {color: #FFFFFF}
		.Informacion{
			border-style: solid;
			margin: 5px;
			padding: 5px;
			width: 500px;
			font-family:Arial, Helvetica, sans-serif;
			 font-size: 75%;
		}
	</style>
    
    <script>
		$(document).ready(function(){
			$("#motivos").change(function () {
				val = $("#motivos option:selected").index();
				
				if(val == 1 || val == 2 || val == 3 || val == 4 || val == 6 || val == 10 || val == 11 || val == 12 || val == 13 ||val == 14 || val == 98){  
					$("#dTipo").text(' De Estudio');
					//alert(val);
				}
				else{
					$("#dTipo").text(' De Servicio');
					//alert(val);
				}
			})
			.trigger('change');
		});
			
		</script>

</head>
<body>
	<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
 		<table width="95%" border="0" align="center">
  			<tr>
    			<td>
      				<table width="100%" border="0" align="center">
        				<tr>
          					<td width="116" bgcolor="#0A351C" class="Estilo8"><?php echo $docente->getCedula()?></td>
          					<td width="207" bgcolor="#0A351C" class="Estilo8"><?php echo $docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2();?></td>
          					<td width="288" bgcolor="#0A351C" class="Estilo8"><?php echo $docente->getFacultad()->getNombre();?></td>
        				</tr>
      				</table>
     			</td>
       		</tr>
            <tr><td>
            <fieldset   style="border:#0000FF ridge">
          		<legend ><span class="Estilo10"><?php echo $tipoSolicitud?></span></legend>
                        <table>
                        	<?php if($cantidadSolicitudesRegistradas==0 || !in_array($tipoSolicitud, $tipoSolicitudesRegistradas)){
								echo $formulario;	
								}else{ ?>
                         
                                <p  class="Informacion">Actualmente tiene una solicitud de este tipo en espera de aval.<br> Puede realizar una modificación de esta o eliminarla.</p>
								<p align="center" class="Arial_12_B">Solicitud en espera de aval</p>
                                
                                
                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
                                  <tr>
                                    <td width="70" bgcolor="#0A351C"><div align="left"></div></td>
                                    <td width="63" bgcolor="#0A351C" class="Estilo8">Número</td>
                                    <td width="117" bgcolor="#0A351C" class="Estilo8" align="center"><div align="left"> Objetivo</div></td>
                                    <td width="117" bgcolor="#0A351C" class="Estilo8">Pa&iacute;s</td>
                                    <td width="167"  bgcolor="#0A351C"><div align="left"><span class="Estilo8">Fecha de Inicio </span></div></td>
                                    <td width="133" bgcolor="#0A351C" class="Estilo8"><div align="left">Fecha de Finalizaci&oacute;n </div></td>
                                  </tr>
                                  <tr>
                                    <td colspan="6" bgcolor="#FFFFFF">&nbsp;</td>
                                  </tr>
                                  <?php 
                                 $color="#FFFFFF";
                                  foreach ($solicitudes as $solicitud)
                                 {
                                 if($color=="#FFFFFF")
                                 $color="#DDEDFF";
                                 else
                                 $color="#FFFFFF";
                                 ?>
                                  <tr bgcolor="<?php echo $color ?>">
                                    <td height="18"><div align="left"><span class="Estilo2"><a href="../solicitudes/ver.php?id=<?php echo $solicitud->getId() ?>" title="Ver solicitud"><img src="../../../imagenes/acciones/b_view.png" width="16" height="16" border="0" /></a>
                                    <a href="./editarSolicitud.php?id=<?php echo $solicitud->getId()?>&tipoSolicitud=<?php echo $solicitud->getTipoSolicitudId()?>"  title="Editar solicitud"><img src="../../../imagenes/acciones/b_edit.png" width="16" height="16" border="0" /></a>
                                    <a href="./borrarSolicitud.php?id=<?php echo $solicitud->getId()?>" title="Eliminar solicitud"><img src="../../../imagenes/acciones/b_drop.png" width="16" height="16" border="0" /></a>
                                   
                                    
                                     <div align="left" class="Estilo2"></div></td>
                                    <td height="18"><?php echo $solicitud->getId()?></td>
                                    <td><div align="left"><span class="Estilo2"><?php echo html_entity_decode($solicitud->getObjetivo())?></span></div></td>
                                    <td><span class="Estilo2"><?php echo $solicitud->getPais()->getPais() ?></span></td>
                                    <td><div align="left"><span class="Estilo2"><?php echo $solicitud->getFecha1()?></span></div></td>
                                    <td><div align="left"><span class="Estilo2"><?php echo $solicitud->getFecha2()?></span></div></td>
                                  </tr>
                                  <?php }?>
                                </table>
                                                                    <?php }?>
                                                        
                                                        </table>
                                            </fieldset>
                                            </td></tr>
                                        </table>
    </form>


</body>

</html>