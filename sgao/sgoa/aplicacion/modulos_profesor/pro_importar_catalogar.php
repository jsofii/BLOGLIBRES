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
require '../clases_negocio/funciones_oa_profesor.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
    <head>

        <meta charset="utf-8"></meta>
        <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css"></link>
        <script type="text/javascript" src="../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
        <title>Proyecto SGOA</title>
    </head>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */ 
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {height: 390px}

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        html{
            min-height: 100%;
            position: relative;
        }
        body{
            margin:0;
            margin-bottom: 40px;
        }
        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height:auto;} 
        }
    </style>


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
                        <li class="active"><a href="../modulos_profesor/pro_importar_catalogar.php">Importar y catalogar</a></li>
                        <li><a href="../modulos_profesor/pro_buscar.php">Buscar</a></li>
                        <?php
                        echo '<li><a href="https://localhost:5001/home/'.$id.'/'.$nombre.'/'.$rol.'">Foro</a></li>';
                        ?>
                        <li><a href="../modulos_profesor/pro_herramientas.php">Herramientas</a></li>
                        <?php
                        if(obtenerColaboradorPorUsuario($_SESSION['id'])!=NULL){
                            echo '
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Colaboradores<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                <li><a href="adm_colaboradores/edicion.php">Edicion</a></li>
                                <li><a href="adm_colaboradores/borrar.php">Borrar</a></li>
                                <li><a href="adm_colaboradores/contribuciones.php">Contribuciones</a></li>
                                <li><a href="pro_buscar.php">Salir</a></li>
                            </ul>
                            </li';
                        }
                        ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../../aplicacion/desconectar_sesion.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid text-center">    
            <div class="row content">
                <div class="col-sm-6 col-sm-offset-3"> 
                    <h2>Objeto de aprendizaje</h2>
                    <form onsubmit="return validar_formulario()" action="../modulos_profesor/pro_ejecutar_insertar_oa.php" method="post" enctype="multipart/form-data">
                        <p id="oas_existentes" style="display:none;" ><?php
                            //echo implode(",", scandir('../../storage/')); 
                            
                            echo obtener_lista_de_oas();
                            ?></p>
                        <div class="form-group">
                            <label for="file">Archivo que contine el objeto de aprendizaje:</label>
                            <p id="error1" style="display:none; color:#FF0000;">
                                Formato de archivo ínvalido! Solo se admiten archivos .zip.
                            </p>
                            <p id="error2" style="display:none; color:#FF0000;">
                                El límite máximo de tamaño de archivo es 10MB.
                            </p>
                            <input type="file" class="form-control" id="o_aprendizaje" name="archivo" required>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <p id="oas_duplicados" style="display:none; color:#FF0000;">
                                El nombre de objeto ya ha sido utilizado!
                            </p>
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre de objeto de aprendizaje" name="nombre" required autocomplete="off">
                        </div>


                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion" placeholder="Ingrese la descripción" name="descripcion" required>
                        </div>

                        <div class="form-group">
                            <label for="institucion">Institución:</label>
                            <input type="text"  class="form-control" id="institucion" placeholder="Institución"  name="institucion" required>
                        </div>

                        <div class="form-group">
                            <label for="palabras_claves">Palabras claves:</label>
                            <input type="text"  class="form-control" id="palabras_claves" placeholder="Palabras claves"  name="palabras_claves" required>
                        </div>

                        <button id="registrar" type="submit" class="btn btn-default">Registrar</button></br>
                    </form>

                </div>
            </div>
        </div></br></br></br>

        <footer class="container-fluid text-center">
            <p>Diseño y programación: Elsa Vasco, Edison Tamayo, José Criollo</p>
        </footer>

        <script>
            var a = 0;
            $('#o_aprendizaje').bind('change', function () {
                if (document.getElementById("registrar").disabled == false) {
                    document.getElementById("registrar").disabled = true;
                }
                var ext = $('#o_aprendizaje').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['zip']) == -1) {
                    $('#error1').slideDown("slow");
                    //document.getElementById("texto").value = "error ";
                    $('#error2').slideUp("slow");
                    a = 0;
                } else {
                    var picsize = (this.files[0].size);
                    if (picsize > 10000000) {
                        $('#error2').slideDown("slow");
                        a = 0;
                    } else {
                        a = 1;
                        $('#error2').slideUp("slow");
                    }
                    $('#error1').slideUp("slow");
                    /*if (a == 1) {
                     var name = (this.files[0].name.split('.').shift());
                     //alert("el nombre de archivo es: "+name);
                     //document.getElementById("registrar").disabled = false;
                     document.getElementById("nombre").value = name;
                     }*/
                }
            });
            //funcion validacion objetos
            function comprobar_existencia(arreglo, valor) {
                var flag = false;
                for (i = 0; i < arreglo.length; i++)
                {
                    if (arreglo[i].trim().localeCompare(valor.trim()) === 0)
                        flag = true;
                }
                return flag;
            }
            $(document).ready(function () {
                var isvalue = document.getElementById("oas_existentes").innerHTML;
                isvalue = isvalue.split(',');
                $('#nombre').keyup(function () {
                    let useramount = $(this).val();
                    //alert(useramount+'.zip');
                    //alert(isvalue.includes(String(useramount + '.zip')));
                    if (comprobar_existencia(isvalue, useramount)) {
                        $('#oas_duplicados').slideDown("slow");
                        document.getElementById("registrar").disabled = true;
                    } else {
                        $('#oas_duplicados').slideUp("slow");
                        document.getElementById("registrar").disabled = false;
                    }
                });
            });

            function validar_formulario() {
                var caracteres = /^[0-9a-zA-Z]+$/;
                if (document.getElementById('nombre').value.match(caracteres) && document.getElementById('nombre').value.length<=15)
                {
                    return true;
                } else
                {
                    if(!document.getElementById('nombre').value.match(caracteres)){
                         alert('El nombre solo puede contener letras(no caracteres especiales) y numeros!');
                    }
                    if(document.getElementById('nombre').value.length>15){
                        alert('El nombre solo puede contener 15 caracteres como máximo!');
                    }
                    return false;
                }
            }
        </script>
    </body>

</html>
