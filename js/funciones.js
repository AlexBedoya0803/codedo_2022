
//OCULTA ELEMTO ID
function Mostrar(id){
	elem = document.getElementById(id);
	elem.style.display='block';
}

//MUESTRA ELEMTO ID
function Ocultar(id)
{
	elem = document.getElementById(id);
	elem.style.display='none';
}

//OBTIENE LA DIFERENCIA DOS FECHAS Y LA MUESTRA EN LOS CAMPOS
function DiferenciaFechas () {  
    
   CadenaFecha1 = document.getElementById("fecha1").value  
   CadenaFecha2 = document.getElementById("fecha2").value 
     
   var fecha1 = new fecha( CadenaFecha1 )     
   var fecha2 = new fecha( CadenaFecha2 )  
     
   var miFecha1 = new Date( fecha1.anio, fecha1.mes, fecha1.dia )  
   var miFecha2 = new Date( fecha2.anio, fecha2.mes, fecha2.dia )  
   
   var diferencia = miFecha2.getTime()- miFecha1.getTime()
   var dias = Math.floor(diferencia / (1000 * 60 * 60 * 24))  
   var meses = dias/30; 
   var years = meses/12; 
   document.getElementById("diferencia_dias").value=dias;
   document.getElementById("diferencia_meses").value=meses;
   document.getElementById("diferencia_years").value=years;
   
}  
  
function fecha( cadena ) {  
  
 
   var separador = "-"  
  

   if ( cadena.indexOf( separador ) != -1 ) {  
        var posi1 = 0  
        var posi2 = cadena.indexOf( separador, posi1 + 1 )  
        var posi3 = cadena.indexOf( separador, posi2 + 1 )  
        this.anio = cadena.substring( posi1, posi2 )  
        this.mes = cadena.substring( posi2 + 1, posi3 )  
        this.dia = cadena.substring( posi3 + 1, cadena.length )  
   } else {  
        this.dia = 0  
        this.mes = 0  
        this.anio = 0     
   }  
}  

//POSICIONA UN COMBO DEACUERDO AL VALOR DE UN CAMPO ORIGEN

function PosicionarCombo(origen,comboId){
	var texto =origen.value;
	var combo=document.getElementById(comboId);
	combo.selectedIndex=0;
	for (var opcombo=0;opcombo < combo.length;opcombo++){ 
	   var valor = combo.options[opcombo].value;
          if(texto==valor)
		  {
		  combo.selectedIndex=opcombo;
		  }  
      }
   }
   
 //ESCRIBE EN UN CAMPO DESTINO EL VALOR DE UN COMBO 
   
 function LeerCombo(combo,destino){
	var opcombo=combo.value;
	document.getElementById(destino).value=opcombo; 
   }
  
  
  
 //VALIDA QUE EXISTA Y LA EXTENSION Y HACE VISIBLE EL ERROR 
  
function validar_extension(fileId,errorId) {
	var archivo=document.getElementById(fileId).value;
   extensiones_permitidas = new Array(".pdf");
   mierror = "";
   if (!archivo) {
       mierror = "Debe anexar la documentación";
   }else{
      extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
      permitida = false;
      for (var i = 0; i < extensiones_permitidas.length; i++) {
         if (extensiones_permitidas[i] == extension) {
         permitida = true;
         break;
         }
      }
      if (!permitida) {
         mierror = "No es la extension. \nSólo se permiten : " + extensiones_permitidas.join();
       }
	   else{
		  document.getElementById(errorId).style.display='none';
         return 1;
		 
       }
   }
   document.getElementById(errorId).style.display='block';
   document.getElementById(fileId).value = "";

   return 0;
} 

//Valida que el

   
 function Validar(campoId1,campoId2){
	  var valor1 = document.getElementById(campoId1).value ;
	  var valor2 = document.getElementById(campoId2).value ;
		if( valor1>valor2)
		 {	 
		 alert("invalido");
		 PosicionarCombo(document.getElementById(campoId1),campoId2)
		 }
}

 
  






