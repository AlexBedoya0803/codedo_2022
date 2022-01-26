<?php
	class MsgError{
		static function getMsgError($name,$msg){
			echo'
				<style>
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
				
				<div style="display:none">
					<label id="recargar">false</label>
					<label id="url"></label>
				</div>
				<div id="myModal" class="modal">
  					<div class="modal-content">
    					<div class="modal-header">
      						<span class="close" onClick="cerrar()">x</span>
      						<h2 id="name">'.$name.'</h2>
    					</div>
    					<div class="modal-body">
      						<form id="addSexo" method="post" name="addSexo" action="AddSexo.php">
      							<tr>
      								<td><div id="msg">'.$msg.'</div></td>
      							</tr>
      							<tr>
									<center>
								  		<input name="aceptar" type="button" id="aceptar" value="Continuar" onClick="cerrar()" />
									</center>
      							</tr>
      						</form>
    					</div>
    					<div class="modal-footer">
    
   				 		</div>
  					</div>
				</div>
				
				
				
				
				<script>
				// Get the modal
				var modal = document.getElementById("myModal");
				
				function cerrar(){
					modal.style.display="none";
					var recargar = document.getElementById("recargar").innerHTML;
					var url = document.getElementById("url").innerHTML;
					//alert(recargar);
					
					if(recargar=="true"){
						//alert("entro");
						document.getElementById("recargar").innerHTML=false;
						location.href = url;
					}
				}
				
				</script>
			'
			
			
			
			;			
		}
	}
?>