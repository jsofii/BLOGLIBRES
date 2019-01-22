<?php
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
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Bienvenid@: <strong>
                    <?php echo $_SESSION['usuario'] ?></strong></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                        <li><a href="../pro_importar_catalogar.php">Importar y catalogar</a></li>
                </li>
                <li><a href="../pro_buscar.php">Buscar</a></li>
                <?php
                echo '<li><a href="https://localhost:5001/home/'.$id.'/'.$nombre.'/'.$rol.'">Foro</a></li>';
                ?>
                <li><a href="../pro_herramientas.php">Herramientas</a></li>
                <li class="dropdown active">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Colaboradores<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="edicion.php">Edicion</a></li>
                        <li><a href="borrar.php">Borrar</a></li>
                        <li><a href="contribuciones.php">Contribuciones</a></li>
                        <li><a href="../pro_buscar.php">Salir</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../../../aplicacion/desconectar_sesion.php"><span class="glyphicon glyphicon-log-out"></span>
                        Salir</a></li>
            </ul>
        </div>
    </div>
</nav>