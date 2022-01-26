<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../../../estilos/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../../../js/calendar/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="../../../js/calendar/mootools-1.2-core.js"></script>
<script type="text/javascript" src="../../../js/calendar/_class.datePicker.js"></script>
<script type="text/javascript" src="../../../js/calendar/funciones/fecha1.js"></script>
<script type="text/javascript" src="../../../js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,insertdate,inserttime,preview,|,forecolor,backcolor,link,unlink",

		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "css/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<title>Documento sin t&iacute;tulo</title>
</head>
<?php require_once('editar_c.php');?>
<body>
<div align="center">
  <form id="form1" name="form1" method="post" action="">
    <p>
      <textarea  id="anexo" name="anexo" rows="40" cols="100" style="width: 500"><?php echo $formulario['anexo'] ?></textarea>
    </p>
    <p>Cambiar Fecha :
      <input name="fecha" type="text" id="fecha" value="<?php echo $formulario['fecha'] ?>" size="10" readonly="readonly" />
</p>
    <p>
      <input name="editar" type="submit" class="button" id="editar" value="Guardar cambios en el acta  <?php echo $id ?>" />
    </p>
  </form>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
</body>
</html>
