<?php
	/*
	* Autor Luis Fernando Orozco
	* Esta contiene metodos estaticos para eliminar los anexos de una solicitud
	*/
	
	class DeleteAnexos{
		static function delete($path){
			foreach(glob($path . "/*") as $file){
				if(is_dir($file)){
					DeleteAnexos::delete($file);	
				}else{
					unlink($file);	
				}
			}
			rmdir($path);
		}
		
	}
?>