function _porId(id){
	return document.getElementById(id);
}

var _FJS_AGT = navigator.userAgent.toLowerCase();    	
var _FJS_Nav = "NA";
if (_FJS_AGT.indexOf("opera") != -1) {
	_FJS_Nav = "opera";	    }
else if (_FJS_AGT.indexOf("msie") != -1 && document.all) {
	_FJS_Nav = "msie";
}
else if (_FJS_AGT.indexOf("msie 5") != -1 && document.all) {
	_FJS_Nav = "msie5";
}
else if (_FJS_AGT.indexOf("mac") != -1) {
	_FJS_Nav = "mac";
}
else if (_FJS_AGT.indexOf("gecko") != -1) {
	_FJS_Nav = "gecko";
}
else if (_FJS_AGT.indexOf("safari") != -1) {
	_FJS_Nav = "safari";
}

function recuperarFormCampos() {	    
	return escape(_porId('divFormCamposConculta').innerHTML);
}

function ocultarMostrar (img, div){
	objDiv = _porId(div);
	if (objDiv.style.display == 'none'){
		objDiv.style.display = 'block';
	}
	else {
		objDiv.style.display = 'none';
	}
}

function cargarCampo (){
	objLis = _porId("lisCampos");
	
	sCual= objLis.options[objLis.selectedIndex].value;

	var cualDiv = "divCamposConsulta";
	// Para el control de los campos insertados, de manera que no se borre la informacion previamente ingresada
	if (_FJS_Nav != "msie" && _FJS_Nav != "msie5") {
		var obj = _porId('tableCampos');
		var row = document.createElement('TR');
		var col = document.createElement('TD');
		var div = document.createElement('DIV');
		div.id = 'divContiene';
		col.appendChild(div);
		row.appendChild(col);
		obj.appendChild(row);
		cualDiv = 'divContiene';
	}

	crearControlCampo (sCual, cualDiv);
}

function cargarCal(campo) {
	if (_porId(campo).title == 0) {
		_porId(campo).title = 1;
		Calendar.setup ({inputField:campo,ifFormat:"%d/%m/%Y",button:"imgcalendario_"+campo,align:"Bl",singleClick:true,weekNumbers:false});
	}
}

function crearControlCampo (sCual, sDivDonde) {
	if (_FJS_Datos[sCual].tipo == "TEXTO"){
		_porId(sDivDonde).innerHTML += definirCampoTexto(_FJS_Datos[sCual].etiqueta, sCual);
	}
	else if (_FJS_Datos[sCual].tipo == "LISTA"){
		_porId(sDivDonde).innerHTML += definirCampoLista(_FJS_Datos[sCual].etiqueta, sCual, _FJS_Datos[sCual].valores, _FJS_Datos[sCual].datos);
	}
	else if (_FJS_Datos[sCual].tipo == "NUMERO"){
		_porId(sDivDonde).innerHTML += definirCampoNumero(_FJS_Datos[sCual].etiqueta, sCual);
	}
	else if (_FJS_Datos[sCual].tipo == "FECHA"){
		_porId(sDivDonde).innerHTML += definirCampoFecha(_FJS_Datos[sCual].etiqueta, sCual);
	}

}

function validarCampoNumero(campo){	        
	var expreg = new RegExp ("^\\d+\\.?\\d*$");
	var cadena = campo.value;
	
	if (cadena != "" && !expreg.test(cadena)){
		alert ("-Por favor, ingrese un valor numérico o el campo no será tenido en cuenta en la consulta");
		campo.focus();
	}
}

function definirCampoTexto(sEtiqueta, sCampo)
{
	var sTiempo = Math.round((Math.random() * 1000000000));
	var sId = sCampo + "_" + sTiempo;
	var sHtml = "<div id='div_con_" + sId + "'><span class='txtSubtitulo'>" + sEtiqueta + ":</span> ";
	sHtml += "<select name='FJS_op_" + sId + "' id='FJS_op_" + sId + "'>";
	sHtml += " <option value='LIKE'>contiene (comodin %)</option>";
	sHtml += " <option value='NOT LIKE'>no contiene</option>";
	sHtml += " <option value='='>igual a</option>";
	sHtml += " <option value='<>'>diferente de</option>";
	sHtml += " <option value='>'>mayor que</option>";
	sHtml += " <option value='>='>mayor o igual que</option>";
	sHtml += " <option value='<'>menor que</option>";
	sHtml += " <option value='<='>menor o igual que</option>";
	sHtml += "</select> ";
	sHtml += "<input type='hidden' id='FJS_txt_" + sId + "' name='FJS_txt_" + sTiempo + "' value='" + sCampo + "' />";
	sHtml += "<input type='text' id='FJS_" + sId + "' name='FJS_" + sId + "' /> ";
	sHtml += "<a href='#' onClick=\"document.getElementById('div_con_" + sId + "').style.display='none'; document.getElementById('div_con_" + sId + "').innerHTML = '';\" class='a_borrar_campo_consulta'>";
	sHtml += "borrar";
	sHtml += "</a> ";
	sHtml += "<NOBR>[<input name='FJS_rb_" + sId + "' type='radio' value='AND' checked='checked' />Y ] - ";
	sHtml += "[<input name='FJS_rb_" + sId + "' type='radio' value='OR' />O ]</NOBR>";
	sHtml += "<hr /></div>";

	return sHtml;
}

function definirCampoNumero(sEtiqueta, sCampo)
{
	var sTiempo = Math.round((Math.random() * 1000000000));
	var sId = sCampo + "_" + sTiempo;
	var sHtml = "<div id='div_con_" + sId + "'><span class='txtSubtitulo'>" + sEtiqueta + ":</span> ";
	sHtml += "<select name='FJS_op_" + sId + "' id='FJS_op_" + sId + "'>";
	sHtml += " <option value='='>igual a</option>";
	sHtml += " <option value='<>'>diferente de</option>";
	sHtml += " <option value='>'>mayor que</option>";
	sHtml += " <option value='>='>mayor o igual que</option>";
	sHtml += " <option value='<'>menor que</option>";
	sHtml += " <option value='<='>menor o igual que</option>";
	sHtml += "</select> ";
	sHtml += "<input type='hidden' id='FJS_txn_" + sId + "' name='FJS_txn_" + sTiempo + "' value='" + sCampo + "' />";
	sHtml += "<input type='text' onchange='validarCampoNumero(this);' id='FJS_" + sId + "' name='FJS_" + sId + "' /> ";
	sHtml += "<a href='#' onClick=\"document.getElementById('div_con_" + sId + "').style.display='none'; document.getElementById('div_con_" + sId + "').innerHTML = '';\" class='a_borrar_campo_consulta'>";
	sHtml += "borrar";
	sHtml += "</a> ";
	sHtml += "<NOBR>[<input name='FJS_rb_" + sId + "' type='radio' value='AND' checked='checked' />Y ] - ";
	sHtml += "[<input name='FJS_rb_" + sId + "' type='radio' value='OR' />O ]</NOBR>";
	sHtml += "<hr /></div>";

	return sHtml;
}
		
function definirCampoLista(sEtiqueta, sCampo, aValores, aDatos)
{
	var sTiempo = Math.round((Math.random() * 1000000000));
	var sId = sCampo + "_" + sTiempo;
	var sHtml = "<div id='div_con_" + sId + "'><span class='txtSubtitulo'>" + sEtiqueta + ":</span> ";
	sHtml += "<input type='hidden' id='FJS_sel_" + sId + "' name='FJS_sel_" + sTiempo + "' value='" + sCampo + "' />";
	
	sHtml += "<select name='FJS_" + sId + "' id='FJS_" + sId + "'>";
	for (var i = 0; i < aValores.length; i++)
	{
		sHtml += " <option value='" + aValores[i] + "'>" + aDatos[i] + "</option>";
	}
	sHtml += "</select> ";

	sHtml += "<a href='#' onClick=\"document.getElementById('div_con_" + sId + "').style.display='none'; document.getElementById('div_con_" + sId + "').innerHTML = '';\" class='a_borrar_campo_consulta'>";
	sHtml += "borrar";
	sHtml += "</a> ";
	sHtml += "<NOBR>[<input name='FJS_rb_" + sId + "' type='radio' value='AND' checked='checked' />Y ] - ";
	sHtml += "[<input name='FJS_rb_" + sId + "' type='radio' value='OR' />O ]</NOBR>";
	sHtml += "<hr /></div>";

	return sHtml;
}

function definirCampoFecha(sEtiqueta, sCampo)
{
	var sTiempo = Math.round((Math.random() * 1000000000));
	var sId = sCampo + "_" + sTiempo;
	var sHtml = "<div id='div_con_" + sId + "'><span class='txtSubtitulo'>" + sEtiqueta + ":</span> ";
	sHtml += "<select name='FJS_op_" + sId + "' id='FJS_op_" + sId + "'>";
	sHtml += " <option value='='>igual a</option>";
	sHtml += " <option value='<>'>diferente de</option>";
	sHtml += " <option value='>'>mayor que</option>";
	sHtml += " <option value='>='>mayor o igual que</option>";
	sHtml += " <option value='<'>menor que</option>";
	sHtml += " <option value='<='>menor o igual que</option>";
	sHtml += "</select> ";
	sHtml += "<input type='hidden' id='FJS_fec_" + sId + "' name='FJS_fec_" + sTiempo + "' value='" + sCampo + "' />";
	sHtml += "<input type='text' id='FJS_" + sId + "' name='FJS_" + sId + "' size='10' maxlenght='10' title='0' /> ";
	sHtml += "<a href='#' onClick=\"document.getElementById('div_con_" + sId + "').style.display='none'; document.getElementById('div_con_" + sId + "').innerHTML = '';\" class='a_borrar_campo_consulta'>";
	sHtml += "borrar";
	sHtml += "</a> ";
	sHtml += "<NOBR>[<input name='FJS_rb_" + sId + "' type='radio' value='AND' checked='checked' />Y ] - ";
	sHtml += "[<input name='FJS_rb_" + sId + "' type='radio' value='OR' />O ]</NOBR>";
	sHtml += "<hr /></div>";

	return sHtml;
}

function cargarCamposLista(){
	var sel = _porId("lisCampos");
	
	var opt;

	for (var k in _FJS_Datos){
		if (_FJS_Datos[k].etiqueta != "undefined" && _FJS_Datos[k].etiqueta != null){
			opt = new Option(_FJS_Datos[k].etiqueta, k);
			sel.options[sel.options.length] = opt;
		}
	}
}

var _FJS_Datos = Array();

//esta debe ser la estructura de salida retornada en litDatosJS
/*_FJS_Datos["id"] = {
	etiqueta: "Id",
	tipo: "TEXTO"
}

_FJS_Datos["nombre"] = {
	etiqueta: "Nombre",
	tipo: "TEXTO"
}

_FJS_Datos["tipos"] = {
	etiqueta: "Algunos tipos",
	tipo: "LISTA",
	valores : [
		"1",
		"2",
		"3"
	],
	datos : [
		"primero",
		"segundo",
		"tercero"
	]
}*/

//se incluye en el script que utiliza el JS ya que IE no permite el manejo del onload desde un script externo
/*if (_FJS_Nav != "msie" && _FJS_Nav != "msie5") {
// para Mozilla browsers
  document.addEventListener("DOMContentLoaded", cargarCamposLista, false);
}
else {
// para IE browsers
}*/