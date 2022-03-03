<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php require_once('informacion2_c.php');?>
<link rel="stylesheet" href="../../../js/calendar/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="../../../js/funciones.js"></script>
<script type="text/javascript" src="../../../librerias/bootstrap-3.3.7-dist/jquery/jquery-3.1.0.min.js"></script>
<link src="../../../librerias/bootstrap-3.3.7-dist/css/bootstrap.min.css"></link>
<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<script type="text/javascript" src="../../../librerias/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../../js/calendar/mootools-1.2-core.js"></script>
<script type="text/javascript" src="../../../js/calendar/_class.datePicker.js"></script>


<script language="javascript">

$(function() {$( "#fecha" ).datepicker();});
</script>

<script type="text/javascript">
    function activar(elemento){
      desactivar();
      document.getElementById(elemento).style="display:inline";

    }

    function desactivar(){
      var elementos =['group1','group2','group3','group4','group5','group6'];
      for(i=0;i<elementos.length;i++){
		  var elemento = document.getElementById(elementos[i]);
		  if(elemento != null){
			 elemento.style="display:none";	  
		  }
        
      }
    }

  </script>



<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo10 {color: #00007F; font-size: 16px; font-weight: bold; }
.Estilo8 {color: #FFFFFF}
-->
</style>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />

<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #527497;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;
    background-color: #FFF;
    color: white;
}
.button {
    display: block;
    width: 98%;
    height: 100%;
    background: #527497;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
}
.button2 {
    display: block;
    width: 100%;
    height: 100%;
    background: #D6E0EB;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: #000;
    font-weight: bold;
}
.titleSolicitudes{
	display: block;
    width: 98%;
    height: 100%;
    
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: #000;
    font-weight: bold;
	font-size: 16px
}
</style>
  <!--<meta charset="utf-8">-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<fieldset style="border:#0000FF ridge">
<legend><span class="Estilo10">Informaci&oacute;n del docente</span></legend>
<form id="form1" name="form1" method="post" action="">
  <legend><span class="Estilo10"></span></legend>
  <table width="100%" border="0" align="center">
    <tr>
      <td width="167" bgcolor="#0A351C"><span class="Estilo8">Cedula </span></td>
      <td colspan="5" bgcolor="#ADC0B7"><label><?php if($docente->getCedula()) echo $docente->getCedula(); ?></label></td>
    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo8">Nombre </span></td>
      <td colspan="5" bgcolor="#ADC0B7"><label><?php if($docente->getNombre()) echo $docente->getNombre()." ".$docente->getApellido1()." ".$docente->getApellido2();  ?></label></td>


    <tr>
      <td bgcolor="#0A351C"><span class="Estilo8">Email</span></td>
      <td colspan="5" bgcolor="#ADC0B7"><label><?php if($docente->getCorreo()) echo $docente->getCorreo() ?></label></td>
    </tr>



    </tr>
    <tr>
      <td bgcolor="#0A351C"><span class="Estilo8">Facultad</span></td>
      <td colspan="5" bgcolor="#ADC0B7"><label><?php if($facultad->getNombre()) echo $facultad->getNombre() ?></label></td>
    </tr>
    
    <tr>
      <td bgcolor="#0A351C" class="Estilo8">Historial</td>
      <td colspan="5" bgcolor="#FFFFFF">
	  <?php if($existe)
echo'<a href="historial.php?id='.$docente->getId().'"><img src="../../../imagenes/iconos/historial.jpg" width="16" height="16" border="0" /></a>';?></td>
    </tr>
    
    
    <tr>
      <td class="Estilo8">&nbsp;</td>
    </tr>
    <!--
    <tr>
      <td bgcolor="#527497" class="Estilo8">Solicitud</td>
      <td bgcolor="#527497"> <?php /* echo $nueva; */?></td>
      <td bgcolor="#527497"> <?php /* echo $prorroga; */?></td>
      <td bgcolor="#527497"> <?php /* echo $modificacion; */?></td>
      <td bgcolor="#527497"> <?php /* echo $otras; */?></td>
      <td bgcolor="#527497"> <?php /* echo $informe; */?></td>
    </tr>
    -->
    
    
    
    <tr>
      <td class="Estilo8">&nbsp;</td>
    </tr>
    
    <!-- Grupo Nueva -->
    <tr>
    	<td colspan="6">
        	<label class="titleSolicitudes"> Solicitudes</label>
        </td>
    </tr>
    
    <?php 
	
	
	if($docente->getNumeroComisionesProxima()<1){
		echo '
	<tr>
    	<td colspan="6">
        	<a style="background-color:#0A351C" href="#" class="button" onclick="activar(\'group1\')">Comisi�n nueva</a>
       <div id="group1" style="display: none;">
       	<table cellpadding="10">
        	<tr><td><a href="../comisiones/RealizarSolicitud.php?tipoSolicitud=Nueva" class="button2" style="color:#000">Realizar Solicitud Nueva</a></td></tr>
      	</table>
      </div>
     </td>
    </tr>
	
	';
	}
	?>
    
  
    <?php 
	if($docente->getNumeroComisiones()>0){
		echo '
    <!-- Grupo Prorroga -->
    <tr>
    	<td colspan="6">
            <a style="background-color:#0A351C" href="#" class="button" onclick="activar(\'group2\')">Pr&oacute;rroga</a>
           <div id="group2" style="display: none;">
                <table cellpadding="10">
                <tr>
                	<td><a href="../comisiones/RealizarSolicitud.php?tipoSolicitud=Prorroga" class="button2" style="color:#000">Pr&oacute;rroga Larga y Corta Duraci&oacute;n</a></td>
                    <td>&nbsp;&nbsp;</td>
                    <td><a href="../comisiones/RealizarSolicitud.php?tipoSolicitud=ProrrogaExcepcional" class="button2" style="color:#000">Pr&oacute;rroga Excepcional</a></td>
                
                </tr>
                
            </table>
           </div>
        </td>
    </tr>
    
    <!-- Grupo Modificaci�n -->
    <tr>
    	<td colspan="6">
            <a style="background-color:#0A351C" href="#" class="button" onclick="activar(\'group3\')">Modificaci&oacute;n</a>
           <div id="group3" style="display: none;">
                <table cellpadding="10">
                <tr>
                	<td><a href="../comisiones/RealizarSolicitud.php?tipoSolicitud=Modificacion" class="button2" style="color:#000">Modificaci&oacute;n</a></td> 
                 </tr> 
            </table>
           </div>
        </td>
    </tr>
    
    <!-- Grupo Terminaci�n -->
    <tr>
    	<td colspan="6">
            <a style="background-color:#0A351C" href="#" class="button" onclick="activar(\'group4\')">Cancelaci&oacute;n/Renuncia/Suspensi&oacute;n</a>
           <div id="group4" style="display: none;">
                <table cellpadding="20">
                <tr>
                	<td><a href="../comisiones/RealizarSolicitud.php?tipoSolicitud=Cancelacion" class="button2" style="color:#000">Cancelaci&oacute;n</a></td>
                    <td><a href="../comisiones/RealizarSolicitud.php?tipoSolicitud=Renuncia" class="button2" style="color:#000">Renuncia</a></td>
                    <td><a href="../comisiones/RealizarSolicitud.php?tipoSolicitud=Suspension" class="button2" style="color:#000">Suspensi&oacute;n</a></td>
                    
                
                </tr>
                
            </table>
           </div>
        </td>
    </tr>
    
    
    <!-- Grupo Reintegro -->
    <tr>
    	<td colspan="6">
            <a style="background-color:#0A351C" href="#" class="button" onclick="activar(\'group5\')">Reintegro</a>
           <div id="group5" style="display: none;">
                <table cellpadding="20">
                <tr>
                	<td><a href="../comisiones/RealizarSolicitud.php?tipoSolicitud=ReintegroConGrados" class="button2" style="color:#000">Reintegro Con Grados</a></td>
                    <td><a href="../comisiones/RealizarSolicitud.php?tipoSolicitud=ReintegroSinGrados" class="button2" style="color:#000">Reintegro Sin Grados</a></td>
                	<td><a href="../comisiones/RealizarSolicitud.php?tipoSolicitud=ReintegroAnticipadoConGrados" class="button2" style="color:#000">Reintegro Anticipado Con Grados</a></td>
                    <td><a href="../comisiones/RealizarSolicitud.php?tipoSolicitud=ReintegroAnticipadoSinGrados" class="button2" style="color:#000">Reintegro Anticipado Sin Grados</a></td>      
                </tr>
                
            </table>
           </div>
        </td>
    </tr>
    
     <!-- Grupo de Informe -->
    <tr>
    	<td colspan="6">
            <a style="background-color:#0A351C" href="#" class="button" onclick="activar(\'group6\')">Informe</a>
           <div id="group6" style="display: none;">
                <table cellpadding="20">
                <tr>
                	<td><a href="../comisiones/RealizarSolicitud.php?tipoSolicitud=Informe" class="button2" style="color:#000">Realizar Informe</a></td>
                            
                </tr>
                
            </table>
           </div>
        </td>
    </tr>
	';
	}
	?>
    
   
  </table>

</form>

<p>&nbsp;</p>
</fieldset>
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <!--<span class="close">x</span>-->
      <h2>Por favor ingrese la siguiente informaci&oacute;n para poder continuar</h2>
    </div>
    <div class="modal-body">
      <form id="addSexo" method="post" name="addSexo" action="AddSexo.php">
      
      <table width="100%">
      <tr>
      	<td>Cedula:</td>
        <td><input type="text" id="bcedula" name="bcedula" value="<?php echo $session->getVal("usuario_id");?>" disabled/>
      </tr>
      <tr>
      	<td>Sexo:</td>
      	<td>
      <select name="sex">
      	<option value="F">F</option>
        <option value="M">M</option>
      </select>
      	</td>
      </tr>
      <tr>
      	<td>Categor�a:</td>
      	<td>
      <select name="categoria">
      	<option value="1">Auxiliar</option>
        <option value="2">Asistente</option>
        <option value="3">Asociado</option>
        <option value="4">Titular</option>
        <option value="5">Experto 1</option>
        <option value="6">Experto 2</option>
        <option value="7">Experto 3</option>
      </select>
      	</td>
      </tr>
       <tr>
      	<td>Dedicaci�n:</td>
      	<td>
      <select name="dedicacion">
      	<option value="1">Medio tiempo</option>
        <option value="2">Tiempo completo</option>
      </select>
      	</td>
      </tr>
 	  <tr>
        <td>Fecha de vinculaci�n:</td>
        <td bgcolor="#FFFFFF"><input type="date" name="fecha" id="fecha" required="required"/></td>
       </tr>
      <tr>
      <td><br/></td>
      </tr>
      <tr>
      <td colspan="2" align="center">
      
      <input name="aceptar" type="submit" id="aceptar" value="Aceptar"/>
    	
       <td>
      </tr>
      </table>
      </form>
    </div>
    <div class="modal-footer">
    
    </div>
  </div>

</div>

<?php
	if($sexo=='' && $verificar){
		echo '<script>
			document.getElementById("myModal").style.display="block";
		</script>';	
	}
	
?>
<script>
// Get the modal
var modal = document.getElementById('myModal');
// When the user clicks the button, open the modal

function cerrar(){
	modal.style.display="none";
}

</script>
</body>
</html>
