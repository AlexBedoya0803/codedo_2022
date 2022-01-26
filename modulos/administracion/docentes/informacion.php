<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php require_once('informacion_c.php');?>
<script type="text/javascript" src="../../../js/funciones.js"></script>
<script type="text/javascript" src="../../../js/jquery-1.5.1.min.js"></script>
<script language="javascript">
$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
    $('#addSexo').submit(function() {
		var parametros = {
                "sexo" : document.getElementById('sex').value,
                "cedula" : document.getElementById('bcedula').value
        };
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: parametros,
			success: function(data) {
                $('#resultado').html(data);
				cerrar();
            }
			
        })
        
        return false;
    }); 
})  
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
</style>

</head>

<body>
<fieldset style="border:#0000FF ridge">
<legend><span class="Estilo10">Informaci&oacute;n del docente</span></legend>
<form id="form1" name="form1" method="post" action="">
  <legend><span class="Estilo10"></span></legend>
  <table width="100%" border="0" align="center">
    <tr>
      <td width="167" style="background-color:#0A351C"><span class="Estilo8">Buscar por cedula </span></td>
      <td colspan="5" bgcolor="#ADC0B7"><label>
        <input name="bcedula" type="text" class=":integer :required" id="bcedula" onkeyup="PosicionarCombo(this,'bnombres')" value="<?php if(isset( $formulario['bcedula']))echo $formulario['bcedula'] ?>"/>
        <input name="buscar" type="submit" class="botonbuscar" id="buscar" value="_" />
      <?php  if(isset($error)) echo $error ?> </label></td>
    </tr>
    <tr>
      <td style="background-color:#0A351C"><span class="Estilo8">Buscar por nombre </span></td>
      <td colspan="5" bgcolor="#ADC0B7"><select name="bnombres" id="bnombres" onchange="LeerCombo(this,'bcedula')">
          <option value="0" selected="selected">No esta guardado</option>
          <?php foreach($docentes as $doc) {
			  $value=$doc->getCedula();
			  $nombre=$doc->getApellido1()." ".$doc->getApellido2()." ".$doc->getNombre();
			   ?>
          <option value="<?php echo $value;  
			   if($formulario['bnombres']==$value) 
			   echo'"selected="selected"';?>"><?php echo $nombre ?> </option>
          <?php } ?>
      </select></td>


    <tr>
      <td style="background-color:#0A351C"><span class="Estilo8">Email</span></td>
      <td colspan="5" bgcolor="#FFFFFF"><input name="correo" type="text" id="correo" value="<?php  if(isset( $formulario['correo']))echo $formulario['correo']?>" size="40" readonly="readonly"/></td>
    </tr>



    </tr>
    <tr>
      <td style="background-color:#0A351C"><span class="Estilo8">Facultad</span></td>
      <td colspan="5" bgcolor="#FFFFFF"><input name="facultad" type="text" id="facultad" value="<?php  if(isset( $formulario['facultad']))echo $formulario['facultad']?>" size="40" readonly="readonly"/></td>
    </tr>
    
    <tr>
      <td style="background-color:#0A351C"><span class="Estilo8">Centro de costo </span></td>
      <td colspan="5" bgcolor="#FFFFFF"><input name="costo" type="text" id="costo" value="<?php  if(isset( $formulario['costo']))echo $formulario['costo']?> " size="40" readonly="readonly"/></td>
    </tr>
    
    <tr>
      <td style="background-color:#0A351C" class="Estilo8">Hoja de vida </td>
      <td colspan="5" bgcolor="#FFFFFF"><?php if(isset($resume))echo $resume?></td>
          </tr>
    

    <tr>
      <td style="background-color:#0A351C" class="Estilo8">Historial</td>
      <td colspan="5" bgcolor="#FFFFFF">
	  <?php if($existe)
echo'<a href="historial.php?id='.$docente->getId().'"><img src="../../../imagenes/iconos/historial.jpg" width="16" height="16" border="0" /></a>';?></td>
    </tr>
    <tr>
      <td style="background-color:#0A351C" class="Estilo8">Comisiones otorgadas </td>
      <td colspan="5" bgcolor="#FFFFFF"><?php if($existe)echo $docente->getNumeroComisiones()?></td>
    </tr>
   
    <tr>
      <td class="Estilo8">&nbsp;</td>
    </tr>
    <tr>
      <td style="background-color:#0A351C" class="Estilo8">Solicitud</td>
      <td style="background-color:#0A351C"> <?php if(isset( $nueva))echo $nueva;?></td>
      <td style="background-color:#0A351C"> <?php if(isset( $prorroga))echo $prorroga;?></td>
      <td style="background-color:#0A351C"> <?php if(isset( $modificacion))echo $modificacion;?></td>
      <td style="background-color:#0A351C"> <?php if(isset( $otras))echo $otras;?></td>
      <td style="background-color:#0A351C"> <?php if(isset( $informe))echo $informe;?></td>
    </tr>
  </table>

</form>

<p>&nbsp;</p>
</fieldset>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <!--<span class="close">x</span>-->
      <h2>Seleccione el sexo del profesor</h2>
    </div>
    <div class="modal-body">
      <form id="addSexo" method="post" name="addSexo" action="AddSexo.php">
      <tr>
      	<td>Sexo</td>
      	<td>
      <select id="sex">
      	<option value="F">F</option>
        <option value="M">M</option>
      </select>
      	</td>
        
      </tr>
      <tr>
      <center>
      <input name="aceptar" type="submit" id="aceptar" value="Aceptar"/>
    	</center>
      </tr>
      </form>
    </div>
    <div class="modal-footer">
    
    </div>
  </div>

</div>

<?php
	if( isset($sexo) && $sexo=='' && $verificar){
		echo '<script>
			document.getElementById("myModal").style.display="block";
		</script>';	
	}
	
?>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
//var span = document.getElementsByClassName("close")[0];
var btnAceptar = document.getElementById('aceptar');
// When the user clicks the button, open the modal

function cerrar(){
	modal.style.display="none";	
}

</script>
</body>
</html>
