<?php
// En versiones de PHP anteriores a la 4.1.0, debería utilizarse $HTTP_POST_FILES en lugar
// de $_FILES.

$dir_subida = '/backup/admondoc/dedo/anexos/5806/';
$fichero_subido = $dir_subida . basename($_FILES['C:\Users\AuxProg\Downloads']['Informecomisiondeestudios2016-2017']);

echo '<pre>';
if (move_uploaded_file($_FILES['C:\Users\AuxProg\Downloads']['tmp_Informecomisiondeestudios2016-2017'], $fichero_subido)) {
    echo "El fichero es válido y se subió con éxito.\n";
} else {
    echo "¡Posible ataque de subida de ficheros!\n";
}

echo 'Más información de depuración:';
print_r($_FILES);

echo "</pre>";

?>
