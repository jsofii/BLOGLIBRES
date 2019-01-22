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
// require_once '../../clases_negocio/clase_conexion.php';
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
<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-12 text-center">
            <h1 class="ui header">Objetos de Aprendizaje</h1>
            <form action="../../modulos_administrador/adm_ejecutar_buscar.php" method="post" enctype="multipart/form-data">
                <div class="col-md-3">
                </div>
                <div class="col-md-3 text-left ">
                    <select class= "form-control" name="tipo_criterio" dir="ltr" required>
                        <option value="">Filtrar por:</option>
                        <option value="autor">Autor</option>
                        <option value="nombre">Nombre</option>
                        <option value="descripcion">Descripción</option>
                        <option value="institucion">Institución</option>
                        <option value="palabras_clave">Palabra Clave</option>
                    </select></br>
                </div>
                <div class="col-md-3 text-center">
                    <input type="text" class="form-control" id="criterio_busqueda" placeholder="Buscar:" name="criterio_busqueda" required></br>
                </div>
                <div class="col-md-3 text-left">
                    <button id="registrar" type="submit" class="btn btn-success">Buscar</button>
                    </br></br>
                </div>
            </form>
            <div class="container" >
                <table class="ui celled table" id="tabla">
                    <thead>
                    <tr class="warning">
                        <td>Nombre</td>
                        <td>Descripción</td>
                        <td>Institución</td>
                        <td>Fecha Creación</td>
                        <td>Palabras Clave</td>
                        <td>Tamaño</td>
                        <td>Autor</td>
                        <td>Comentarios</td>
                        <td>Descargas</td>
                    </tr>
                    </thead>
            </div>

            <?php
            
            $statement = ("select * from objeto_aprendizaje");
            $conexion = new Conexion();
            $consulta = $conexion->prepare($statement);
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            $consulta->execute();
            $id_usuario = $_SESSION['id'];

            if ($consulta->rowCount() != 0) {
                while ($row = $consulta->fetch()) {
                    echo '<tr class="success">';
                    echo '<td>' . $row['nombre'] . '</td>';
                    echo '<td>' . $row['descripcion'] . '</td>';
                    echo '<td>' . $row['institucion'] . '</td>';
                    echo '<td>' . $row['fechaCreacion'] . '</td>';
                    echo '<td>' . $row['palabras_clave'] . '</td>';
                    echo '<td>' . number_format($row['tamanio'] / 1e6, 2, '.', '') . ' MB' . '</td>';
                    if (obtener_tipo_usuario_con_id($row['id_usuario']) == 'ADM') {
                        echo '<td>ADMINISTRADOR</td>';
                    } else if(obtener_tipo_usuario_con_id($row['id_usuario']) == 'PRO') {
                        $profesor = obtener_profesor_como_arreglo(obtener_id_profesor_con_id_usuario($row['id_usuario']));
                        echo '<td>' . $profesor['nombres'] . ' ' . $profesor['apellidos'] . '</td>';
                    }else{
                        $profesor = obtener_estudiante_como_arreglo(obtener_id_estudiante_con_id_usuario($row['id_usuario']));
                        echo '<td>' . $profesor['nombres'] . ' ' . $profesor['apellidos'] . '</td>';
                    }
                    echo '<td><a href="adm_comentarios.php?id=' . $row['idobjeto_aprendizaje'] . '">' . obtener_nro_comentarios_oa($row['idobjeto_aprendizaje']) . '</a></td>';
                    echo '<td>' . $row['descarga'] . '</td>';
                    echo '<td><a href="adm_actualizar_oa.php?id=' . $row['idobjeto_aprendizaje'] . '"><span class="glyphicon glyphicon-refresh"></a></td>';
                    echo "<td><a id='borrar'onClick=\"eliminar('".$row['idobjeto_aprendizaje']."');\" href='adm_buscar.php?id=" . $row['idobjeto_aprendizaje'] . "&idborrar=2'><span class='glyphicon glyphicon-trash'></a></td>";
                    echo "<td><a href=" . $row['ruta'] . "  onclick= \"myFunction('" . $row['idobjeto_aprendizaje'] . "');\" >Descargar</a></td>";
                    echo "<td><a href=../../storage/" . $row['ruta'] . ".jpg target=".'_blank'."><span class='glyphicon glyphicon-eye-open'></a></td>";
                    echo '</tr>';
                }
            }
            echo '</table>';
            extract($_GET);
            if (@$idborrar == 2) {
                eliminar_objeto_aprendizaje($id);
                echo '<script>alert("OA Eliminado Satisfactoriamente")</script> ';
                echo "<script>location.href='adm_buscar.php'</script>";
            }
            $conexion = null;
            ?>
            <script type = "text/javascript">
                (function(){
                    location.reload();
                }, 10000);

                function myFunction(id_objeto)
                {

                    $.ajax({

                        url: '../modulos_profesor/pro_ejecutar_actualizar_descarga.php',
                        type: 'POST',
                        data: 'objeto_id='+id_objeto,
                        async : false,
                    });

                }
            </script>
            <script>
                function hacer_hover($x)
                {
                    myPopup = window.open('../modulos_administrador/previsualizar.php?vs='+$x,'popupWindow','width=640,height=480');
                    myPopup.opener = self;
                }

                var dataTable = $('#tabla').DataTable({
                    "processing":true,
                    "serverSide":true,
                    "order":[],
                    "ajax":{
                        url:"fetch.php",
                        type:"POST"
                    },
                    "columnDefs":[
                        {
                            "targets":[0, 3, 4],
                            "orderable":false,
                        },
                    ],

                });

            </script>

        </div>
    </div>
</div></br></br></br>
<!-- <footer class="label-default container-fluid text-center">
    <p class="copyright small">Copyright &copy; Sofia Guerrero, Cesar Balcazar, Diego Portero</p>
</footer> -->
</body>

</body>

</html>