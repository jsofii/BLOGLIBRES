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
            <a class="navbar-brand" href="#">Bienvenid@: <strong><?php echo $_SESSION['usuario'] ?></strong></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Objetos de aprendizaje
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="adm_objetos_aprendizaje.php">Importar y catalogar objetos de aprendizaje</a></li>
                        <li><a href="adm_buscar.php">Buscar y administrar objetos de aprendizaje</a></li>
                    </ul>
                </li>
                <li><a href="adm_buscar_profesores.php">Gestionar profesores</a></li>
                <li ><a href="adm_buscar_estudiantes.php">Gestionar Estudiantes</a></li>
                <?php
                echo '<li><a href="https://localhost:5001/home/'.$id.'/'.$nombre.'/'.$rol.'">Foro</a></li>';
                ?>
                <li><a href="adm_herramientas.php">Herramientas</a></li>
                <li class="active"><a href="adm_encuesta.php">Resultados evaluación</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Colaboradores<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="adm_colaboradores/nuevo.php">Nuevo</a></li>
                        <li><a href="adm_colaboradores/edicion.php">Edicion</a></li>
                        <li><a href="adm_colaboradores/borrar.php">Borrar</a></li>
                        <li><a href="adm_colaboradores/contribuciones.php">Contribuciones</a></li>
                        <li><a href="adm_objetos_aprendizaje.php">Salir</a></li>
                    </ul>
                </li>


            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../../aplicacion/desconectar_sesion.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
            </ul>
        </div>
    </div>
</nav>

