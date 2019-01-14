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
<meta charset="utf-8"></meta>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0"></meta>
        <link rel="stylesheet" href="../../../plugins/bootstrap/css/bootstrap.min.css"></link>
        <script type="text/javascript" src="../../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../../../plugins/bootstrap/js/bootstrap.min.js"></script>
        <title>Colaboradores</title>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="#">Bienvenid@: <strong><?php echo $_SESSION['usuario'] ?></strong></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Objetos de aprendizaje
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../adm_objetos_aprendizaje.php">Importar y catalogar objetos de aprendizaje</a></li>
                        <li><a href="../adm_buscar.php">Buscar y administrar objetos de aprendizaje</a></li>
                    </ul>
                </li>
                <li><a href="../adm_buscar_profesores.php">Gestionar profesores</a></li>
                <li><a href="../adm_buscar_estudiantes.php">Gestionar Estudiantes</a></li>
                <?php
                echo '<li><a href="https://localhost:5001/home/'.$id.'/'.$nombre.'/'.$rol.'">Blog</a></li>';
                ?>
                <li><a href="../adm_herramientas.php">Herramientas</a></li>
                <li ><a href="../adm_encuesta.php">Resultados evaluación</a></li>
                <li class="dropdown active">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Colaboradores<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="nuevo.php">Nuevo</a></li>
                        <li><a href="edicion.php">Edicion</a></li>
                        <li><a href="borrar.php">Borrar</a></li>
                        <li><a href="contribuciones.php">Contribuciones</a></li>
                        <li><a href="../adm_objetos_aprendizaje.php">Salir</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../../aplicacion/desconectar_sesion.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
            </ul>
        </div>
    </div>
</nav>

<form action="../../aplicacion/validar.php" method="post">
            <h2 style="color: #0000FF; ">Inicio de sesión</h2>
            <select class= "form-control" name="tipo_usuario" dir="ltr" required>
                <option value="">Seleccione tipo de usuario</option>
                <option value="ADM">Administrador</option>
                <option value="PRO">Profesor</option>
                <option value="EST">Estudiante</option>
            </select></br>
            <input class="form-control" type="text" placeholder="&#128104 Usuario" required name="user"></input></br>
            <label></label>
            <input class="form-control" type="password" placeholder="&#128273; Contraseña" required name="pass"></input>
            <label>&nbsp;</label></br>
            <input class="btn btn-primary" type="submit"  value="Aceptar"></br>
                <label></label>
                <label></label>
                <td width="50%"> <a href="aplicacion/formularios_registro/RegistrarProfesor.php"> Registrar Profesor</a></td></br>
                <label></label>
                <td width="50%" align="right" valign="middle"><a href="aplicacion/formularios_registro/RegistrarEstudiante.php"> Registrar Estudiante</a></td>
        </form>
</body>
</html>