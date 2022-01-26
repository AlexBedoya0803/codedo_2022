<?php require_once('./MsgError.php');
	MsgError::getMsgError("Error","");
	require_once('./editarSolicitud_c.php');
	require_once('../../login/Session.php');
	require_once('./FormularioSolicitud.php');
	require_once('./formularioEditarSolicitud.php');
	require_once('../../../configuracion/path.php');
	
	$path=asignarPath(dirname(__FILE__));
	require_once($path['modelo'].'criteria.php');
	require_once($path['modelo'].'clasesDTO.php');
	$session = Session::getInstance();
	if($session->getVal("usuario_id")=="" || $session->getVal("rol")!="docente") //si no hay ningun usuario registrado muestra la vista general
		echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
	
	
	$formulario;
	$comision=NULL;
	
	if(isset($_POST['buscar'])){	
		$id=$session->getVal("usuario_id");
		$comision=new ComisionDTO();
		$idComision = $_POST["comisiones"];
		$comision=$comision->find($idComision);
	}
	$tipoSolicitud= $_GET["tipoSolicitud"];
	$idSolicitud= $_GET["id"];
	if(isset($tipoSolicitud)){
		switch($tipoSolicitud){
			case "1";
				$tipoSolicitud = "Nueva";
				$formulario = formularioEditarSolicitud::editNueva($idSolicitud);	
				break;
			case "2";
				$tipoSolicitud = "Modificación";
				$formulario=formularioEditarSolicitud::makeModificacion($idSolicitud);
				break;
			case "3";
				$tipoSolicitud = "Prórroga";
				$formulario = formularioEditarSolicitud::editProrroga($idSolicitud);
				break;
			case "4";
				$tipoSolicitud = "Infome de Actividades";
				$formulario = formularioEditarSolicitud::makeInforme($idSolicitud);
				break;
			case "5";
				$tipoSolicitud = "Cancelación";
				$formulario = formularioEditarSolicitud::editOtros($idSolicitud);
				break;
			case "6";
				$tipoSolicitud = "Renuncia";
				$formulario = formularioEditarSolicitud::editOtros($idSolicitud);
				break;
			case "7";
				$tipoSolicitud = "Suspensión";
				$formulario = formularioEditarSolicitud::editOtros($idSolicitud);
				break;
			case "8";
				$tipoSolicitud = "Reintegro Anticipado Con Grados";
				$formulario =formularioEditarSolicitud::editOtros($idSolicitud);
				break;
			case "9";
				$tipoSolicitud = "Reintegro Anticipado Sin Grados";
				$formulario = formularioEditarSolicitud::editOtros($idSolicitud);
				break;
			case "10";
				$tipoSolicitud = "Prórroga Excepcional";
				$formulario = formularioEditarSolicitud::editOtros($idSolicitud);
				break;	
			case "12";
				$tipoSolicitud = "Reintegro Sin Grados";
				$formulario = formularioEditarSolicitud::editOtros($idSolicitud);
				break;
			case "8";
				$tipoSolicitud = "Reintegro Con Grados";
				$formulario = formularioEditarSolicitud::editOtros($idSolicitud);
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
				}
				else{
					$("#dTipo").text(' De Servicio');
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
          		<legend ><span class="Estilo10"><?php echo "Editar ".utf8_decode($tipoSolicitud)?></span></legend>
                        <table>
                        	<?php 
								echo $formulario;	
							?>
                          </table>
            </fieldset>
            </td></tr>
         </table>
    </form>
</body>
        
	