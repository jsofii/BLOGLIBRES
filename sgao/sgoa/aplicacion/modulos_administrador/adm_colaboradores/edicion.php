<?php
session_start();
$id;
$nombre;
$rol;
if ($_SESSION['usuario']=='admin') {
    $id='1';
    $nombre='sofi';
    $rol='admin';   
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
    $id=$_SESSION['id'];
    $nombre=$_SESSION['usuario'];
    $rol='estudiante';
} elseif ($_SESSION['tipo_usuario'] == 'PRO') {
    $id=$_SESSION['id'];
    $nombre=$_SESSION['usuario'];
    $rol='profesor';
}
require '../../clases_negocio/funciones_oa_profesor.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">

<head>
  <meta charset="utf-8">
  </meta>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
  </meta>
  <link rel="stylesheet" href="../../../plugins/bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="../../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
  <script type="text/javascript" src="../../../plugins/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../../../estilos/semantic.css">
  <title>Colaboradores</title>
</head>

<body>
  <?php include './navbar_adm_colaboradores.php';?>

  <table class="ui celled table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Age</th>
        <th>Job</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td data-label="Name">James</td>
        <td data-label="Age">24</td>
        <td data-label="Job">Engineer</td>
      </tr>
      <tr>
        <td data-label="Name">Jill</td>
        <td data-label="Age">26</td>
        <td data-label="Job">Engineer</td>
      </tr>
      <tr>
        <td data-label="Name">Elyse</td>
        <td data-label="Age">24</td>
        <td data-label="Job">Designer</td>
      </tr>
    </tbody>
  </table>
</body>

</html>