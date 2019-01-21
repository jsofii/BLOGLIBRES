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
  <center>
        <div class="ui segment" style="width:90%;">
        <table class="ui celled table">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Cédula</th>
      <th>Teléfono</th>
      <th>Dirección</th>
      <th>Fecha de nacimiento</th>
      <th>Género</th>
      <th></th>
    </tr></thead>
  <tbody>
    <?php
    require '../../clases_negocio/funciones_oa_profesor.php';
    $statement = 'SELECT * FROM usuario as u,colaborador as c,profesor as p, telefono as t,Direccion d 
    where c.idUsuario = u.idUsuario and p.id_Usuario=u.idUsuario and c.idtelefono=t.idtelefono and c.idDireccion=d.idDireccion';
    $conexion = new Conexion();
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute();
    if ($consulta->rowCount() != 0) {
      while ($row = $consulta->fetch()) {
          echo '
          <tr>
            <td><a href=modificacion.php?'.$row['nombres'].'>'.$row['nombres'].' '.$row['apellidos'].'</a></td>
            <td>'.$row['ci'].'</td>
            <td><b>Celular: </b>'.$row['Celular'].'<br><b>Convencional: </b>'.$row['Convencional'].'</td>
            <td><b>Calle: </b>'.$row['Calle'].'<br><b>Nro: </b>'.$row['Nro'].'<b><br>Transversal: </b>'.$row['Transversal'].'<br><b>Sector: </b>'.$row['Sector'].'<br><b>Ciudad: </b>'.$row['Ciudad'].'</td>
            <td>'.$row['FechaDeNacimiento'].'</td>
            <td>'.$row['Género'].'</td>
            <td><img src='.$row['DireccionImagen'].' width="80"></td>         
          </tr>';
      }
    }
    $statement = 'SELECT * FROM usuario as u,colaborador as c,estudiante as e, telefono as t,Direccion d 
    where c.idUsuario = u.idUsuario and e.id_Usuario=u.idUsuario and c.idtelefono=t.idtelefono and c.idDireccion=d.idDireccion';
    $conexion = new Conexion();
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute();
    if ($consulta->rowCount() != 0) {
      while ($row = $consulta->fetch()) {
          echo '
          <tr>
          <td><a href=modificacion.php?'.$row['nombres'].'>'.$row['nombres'].' '.$row['apellidos'].'</a></td>
            <td>'.$row['ci'].'</td>
            <td><b>Celular: </b>'.$row['Celular'].'<br><b>Convencional: </b>'.$row['Convencional'].'</td>
            <td><b>Calle: </b>'.$row['Calle'].'<br><b>Nro: </b>'.$row['Nro'].'<b><br>Transversal: </b>'.$row['Transversal'].'<br><b>Sector: </b>'.$row['Sector'].'<br><b>Ciudad: </b>'.$row['Ciudad'].'</td>
            <td>'.$row['FechaDeNacimiento'].'</td>
            <td>'.$row['Género'].'</td>
            <td><img src='.$row['DireccionImagen'].' width="80"></td>
          </tr>';
      }
    }
    ?>

  </tbody>
</table>
        </div>
  </center>

  
</body>

</html>