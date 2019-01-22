<?php
session_start();
require_once '../../clases_negocio/clase_conexion.php';
require '../../clases_negocio/funciones_oa_profesor.php';

$idColaborador=$_SERVER["QUERY_STRING"];
$colaborador=obtenerColaborador($idColaborador);
$idDireccion=$colaborador['idDireccion'];
$idTelefono=$colaborador['idTelefono'];
    eliminacionDeRegistro("Colaborador","idColaborador=".$idColaborador);
    eliminacionDeRegistro("Telefono","idTelefono=".$idTelefono);
    eliminacionDeRegistro("Direccion","idDireccion=".$idDireccion);
    echo "<script>location.href='borrar.php'</script>";
?>