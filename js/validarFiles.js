function enviar(){
		//validar_extension( 'file','errorFile');
				var MAX_SIZE_FILE = 8388608;
				var input = document.getElementById("anexos");
				if(input.files && input.files.length>0){
					var filesZise = 0;
					for(i=0;i<input.files.length;i++){
						filesZise+=input.files[i].size;
					}
          //alert(filesZise);
					if(filesZise>MAX_SIZE_FILE){
						alert("No se puede enviar por que la cantidad de archivos sobrepasa el permitido");
						
					}else{
						//alert("enviar formulario");
						document.getElementById("guardar").click();
						//document.form1.submit();
						//enviar=true;
					}
				}else{
					document.getElementById("guardar").click();
					//document.form1.submit();
					//enviar=true;
				}
			}