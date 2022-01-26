<?php
	class UploadFiles{
		
		public static function saveAnexos($files,$dir){
			if(!empty($files)){
				//throw new Exception;
				//$img_desc = reArrayFiles($files)
				//var_dump($files_desc);
				//$tipo_archivo = $files['type'];	
				if(is_array($files)){ //en caso de que se carguen varios archivos
					$files_desc = UploadFiles::reArrayFiles($files);
					foreach ($files_desc as $file) {
						$nombre= UploadFiles::normaliza($file['name']);	//elimina los caracteres especiales del nombre del archivo	
						if (move_uploaded_file($file['tmp_name'], $dir.DIRECTORY_SEPARATOR.$nombre)) {
								echo "El archivo " . $nombre . " ha sido cargado correctamente.</br>";
							}else{	
								echo "Hubo un error subiendo el archivo " . $nombre. ", por favor inténtalo de nuevo.</br>";
							}
						}
				}else{//si solo se carga un archivo
								$nombre= UploadFiles::normaliza($files['name']);	//elimina los caracteres especiales del nombre del archivo	
								if (move_uploaded_file($files['tmp_name'], $dir.DIRECTORY_SEPARATOR.$nombre)) {
								echo "El archivo " . $nombre . " ha sido cargado correctamente.</br>";
							}else{	
								echo "Hubo un error subiendo el archivo " . $nombre. ", por favor inténtalo de nuevo.</br>";
							}
				}
					
			}
			
		}
		

		static function normaliza($cadena) {
    		$originales = 'ÀÁ?ÂÃÄÅÆÇÈÉÊËÌÍ?ÎÏ?�?ÑÒÓÔÕÖØÙÚÛÜ�?Þ
    						ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ´';              
   			$modificadas = 'AAAAAAAACEEEEIIIIIIIDNOOOOOOUUUUUUY
    						baaaaaaaceeeeiiiidnoooooouuuyybyRrl';
    		$cadena = utf8_decode($cadena);
    		$cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    		$cadena = strtolower($cadena);
    		return utf8_encode($cadena);
		}
		
				
		
		static function reArrayFiles($file){ //organiza el arreglo de archivos que han sido cargados 
			$file_ary = array();
			$file_count = count($file['name']); //obtiene la cantidad de archivos que fueron cargados
			$file_key = array_keys($file); //obtiene cada archivo como una clave
			
			for($i=0;$i<$file_count;$i++)
			{
				foreach($file_key as $val)
				{
					$file_ary[$i][$val] = $file[$val][$i]; 
				}
			}
			
			return $file_ary;
		}
		
		
	}
?>