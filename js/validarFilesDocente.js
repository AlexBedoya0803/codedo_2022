
function extension(id){
	 var x = document.getElementById(id);
	 var file = x.files[0];
	 var name;
     if ('name' in file) {
        name = "name: " + file.name;
	 }
	 var ext= (name.substring(name.lastIndexOf("."))).toLowerCase();
	 if(ext !== ".pdf"){
		 alert("El archivo debe tener formato .pdf \nPor favor ingresarlo de nuevo.");
		 x.value = "";
		 }
	}

function enviar(files){
	///alert(files);
	//console.log("test");
	var MAX_SIZE_FILE = 30;
	var suma=0;
	//alert(files);
	var temp = files.split(',');
	
	for(var i=0;i<temp.length;i++){
		var input=document.getElementById(temp[i]);
		if(input.files && input.files.length>0){
			
			suma+=input.files[0].size;	
		}
		//alert(document.getElementById(temp[i]).files[0].size);
	}
	
	suma=suma/(1024*1024);
	//alert(suma);
	if(suma>MAX_SIZE_FILE){
		document.getElementById("recargar").innerHTML = false;	
		document.getElementById("name").innerHTML = "Error";
		document.getElementById("msg").innerHTML = "La solicitud no se puede enviar debido a que el tamaño de los archivos sobrepasa el permitido";
		document.getElementById("myModal").style.display="block";
				
	}else{
			
		document.getElementById("guardar").click();
	}
	
}



