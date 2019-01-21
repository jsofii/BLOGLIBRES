<?php
session_start();
require_once '../../clases_negocio/clase_conexion.php';
require '../../clases_negocio/funciones_oa_profesor.php';
$id=$_SESSION['id'];
$imagen = filter_input(INPUT_POST, 'perfil');
$path = $_FILES['perfil']['name'];
$target_file = 'imagenes/'.$path;
$id_usuario;
// echo $_FILES["perfil"]["name"]."<br>";
$idDireccion;
$idTelefono;
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
$NumMes = 0;
switch($Mes){
    case 'Enero':
        $NumMes=1;
        break;
    case 'Febrero':
        $NumMes=2;
        break;
    case 'Marzo':
        $NumMes=3;
        break;
    case 'Abril':
        $NumMes=4;
        break;
    case 'Mayo':
        $NumMes=5;
        break;
    case 'Junio':
        $NumMes=6;
        break;
    case 'Julio':
        $NumMes=7;
        break;
    case 'Agosto':
        $NumMes=8;
        break;
    case 'Septiembre':
        $NumMes=9;
        break;
    case 'Octubre':
        $NumMes=10;
        break;
    case 'Noviembre':
        $NumMes=11;
        break;
    case 'Diciembre':
        $NumMes=12;
        break;
}
$fechaDeNacimiento = $Año.'-'.$NumMes.'-'.$Dia;
$Genero = filter_input(INPUT_POST, 'example2');
if($Genero=='on'){
    $Genero='F';
}else{
    $Genero='M';
}

if (move_uploaded_file($_FILES["perfil"]["tmp_name"],$target_file)) {
    $seGuardo_sto = 1;
    ingresar_telefono($Convencional,$Celular);
    $idTelefono=getIDTelefono($Convencional,$Celular);
    ingresar_direccion($Calle,$Nro,$Transversal,$Sector,$Ciudad);
    $idDireccion=getIDDireccion($Calle,$Nro,$Transversal,$Sector,$Ciudad);
    ingresar_colaborador($idDireccion, $idTelefono, $DireccionImagen,$fechaDeNacimiento,$Genero,$id);
    echo "<script>location.href='nuevo.php'</script>";
} else {
    $seGuardo_sto = 0;
}
?>