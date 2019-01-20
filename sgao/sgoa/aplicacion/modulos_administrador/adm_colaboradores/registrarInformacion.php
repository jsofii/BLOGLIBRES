<?php
session_start();
require_once '../../clases_negocio/clase_conexion.php';
require '../../clases_negocio/funciones_oa_profesor.php';
$imagen = filter_input(INPUT_POST, 'perfil');
$path = $_FILES['perfil']['name'];
$target_file = 'imagenes/'.$path;
echo $_FILES["perfil"]["name"];
if (move_uploaded_file($_FILES["perfil"]["tmp_name"],$target_file)) {
    $seGuardo_sto = 1;
    echo "<script>location.href='nuevo.php'</script>";
} else {
    $seGuardo_sto = 0;
}
?>