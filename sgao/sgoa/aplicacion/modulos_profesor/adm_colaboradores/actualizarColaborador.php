<?php
session_start();
require_once '../../clases_negocio/clase_conexion.php';
require '../../clases_negocio/funciones_oa_profesor.php';

$idColaborador=filter_input(INPUT_POST, 'idColaborador');
$colaborador=obtenerColaborador($idColaborador);
$idDireccion=$colaborador['idDireccion'];
$idTelefono=$colaborador['idTelefono'];
$nombre = filter_input(INPUT_POST, 'nombre');
$Celular = filter_input(INPUT_POST, 'celular');
$Convencional = filter_input(INPUT_POST, 'convencional');
$Calle = filter_input(INPUT_POST, 'calle');
$Nro = filter_input(INPUT_POST, 'Nro');
$Transversal = filter_input(INPUT_POST, 'transversal');
$Sector = filter_input(INPUT_POST, 'sector');
$Ciudad = filter_input(INPUT_POST, 'ciudad');
$Dia = filter_input(INPUT_POST, 'dia');
$Mes = filter_input(INPUT_POST, 'mes');
$Año = filter_input(INPUT_POST, 'anio');
$fechaDeNacimiento = $Año.'-'.$Mes.'-'.$Dia;
$Genero = filter_input(INPUT_POST, 'example2');
    actualizar_Direccion($idDireccion,$Calle,$Nro,$Transversal,$Sector,$Ciudad);
    actualizar_telefono($idTelefono,$Celular,$Convencional);
    actualizar_soloColaborador($idColaborador,$fechaDeNacimiento,$Genero);
    echo "<script>location.href='edicion.php'</script>";
?>