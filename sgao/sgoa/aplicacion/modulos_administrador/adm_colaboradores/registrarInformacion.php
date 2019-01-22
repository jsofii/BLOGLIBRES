<?php
session_start();
require_once '../../clases_negocio/clase_conexion.php';
require '../../clases_negocio/funciones_oa_profesor.php';
$id=$_SESSION['id'];
$imagen = filter_input(INPUT_POST, 'perfil');
$path = $_FILES['perfil']['name'];
$target_file = 'imagenes/'.$path;
// echo $_FILES["perfil"]["name"]."<br>";
$idDireccion;
$idTelefono;
$nombre = filter_input(INPUT_POST, 'nombre');
$Celular = filter_input(INPUT_POST, 'celular');
$Convencional = filter_input(INPUT_POST, 'convencional');
$Calle = filter_input(INPUT_POST, 'calle');
$Nro = filter_input(INPUT_POST, 'Nro');
$Transversal = filter_input(INPUT_POST, 'transversal');
$Sector = filter_input(INPUT_POST, 'sector');
$Ciudad = filter_input(INPUT_POST, 'ciudad');
$DireccionImagen = 'imagenes/'.$_FILES["perfil"]["name"];
$Dia = filter_input(INPUT_POST, 'dia');
$Mes = filter_input(INPUT_POST, 'mes');
$Año = filter_input(INPUT_POST, 'anio');
$fechaDeNacimiento = $Año.'-'.$Mes.'-'.$Dia;
$Genero = filter_input(INPUT_POST, 'example2');


if (move_uploaded_file($_FILES["perfil"]["tmp_name"],$target_file)) {
    $seGuardo_sto = 1;
    ingresar_telefono($Convencional,$Celular);
    $idTelefono=getIDTelefono($Convencional,$Celular);
    ingresar_direccion($Calle,$Nro,$Transversal,$Sector,$Ciudad);
    $idDireccion=getIDDireccion($Calle,$Nro,$Transversal,$Sector,$Ciudad);
    $idUsu=recuperar_id_usuario_por_nombre($nombre);
    echo $nombre.' '.$idUsu.'aa';
    ingresar_colaborador($idDireccion, $idTelefono, $DireccionImagen,$fechaDeNacimiento,$Genero,$idUsu);
    echo "<script>location.href='nuevo.php'</script>";
    // echo $NumMes."<br>".$Mes;
} else {
    $seGuardo_sto = 0;
}
?>