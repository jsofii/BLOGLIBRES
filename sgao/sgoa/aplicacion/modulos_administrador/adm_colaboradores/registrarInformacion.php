<?php
session_start();
require_once '../../clases_negocio/clase_conexion.php';
require '../../clases_negocio/funciones_oa_profesor.php';
$imagen = filter_input(INPUT_POST, 'perfil');
$path = $_FILES['perfil']['name'];
$target_file = 'imagenes/'.$path;
$id_usuario;
echo $_FILES["perfil"]["name"]."<br>";
if (move_uploaded_file($_FILES["perfil"]["tmp_name"],$target_file)) {
    $seGuardo_sto = 1;
    echo "<script>location.href='nuevo.php'</script>";
    // $lis = obtener_lista_de_usuarios();
    // echo '<br>'.$lis;
    // $listaUsiarios = explode(",",$lis);
    // foreach ($listaUsiarios as &$usu) {
    //     if($usu!='admin')
    //     echo $usu.'<br>';
    // }
    // $lis = obtener_usuario_como_arreglo('Cesar');
    // foreach ($lis as &$tipo) {
    //     echo $tipo."<br>";
    // }
} else {
    $seGuardo_sto = 0;
}
?>