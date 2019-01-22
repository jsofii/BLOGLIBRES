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
$lisAux;
if($_SERVER["QUERY_STRING"]!=""){
    $id = recuperar_id_usuario_por_nombre($_SERVER["QUERY_STRING"]);
    $tipo = obtener_tipo_usuario_con_id($id);
    $conexion = new Conexion();
    $colaborador = obtenerColaboradorPorUsuario ($id);
    echo ' <p id="Fecha" hidden>'.$colaborador['FechaDeNacimiento'].'</p>';
    echo ' <p id="Genero" hidden>'.$colaborador['Género'].'</p>';
    // echo ' <p id="Genero" hidden>'.$colaborador['Género'].'</p>';
    if($tipo=='EST'){
        $statement = 'SELECT * FROM usuario as u,colaborador as c,estudiante as e, telefono as t,Direccion d 
        where c.idUsuario = u.idUsuario and e.id_Usuario=u.idUsuario and c.idtelefono=t.idtelefono and c.idDireccion=d.idDireccion and u.idUsuario="'.$id.'"';
        $consulta = $conexion->prepare($statement);
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute();
    }else{
        $statement = 'SELECT * FROM usuario as u,colaborador as c,profesor as p, telefono as t,Direccion d 
        where c.idUsuario = u.idUsuario and p.id_Usuario=u.idUsuario and c.idtelefono=t.idtelefono and c.idDireccion=d.idDireccion and u.idUsuario="'.$id.'"';
        $consulta = $conexion->prepare($statement);
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute();
    }
    if ($consulta->rowCount() != 0) {
        $fila = $consulta->fetch();
    }
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
<?php include './navbar_adm_colaboradores.php';
?>
    <center>
        <div class="ui segment" style="width:60%;">
            <form class="ui  form" action="actualizarColaborador.php" method="POST" enctype="multipart/form-data">
                <h4 class="ui  dividing header">Actualización de colaborador</h4>
                <div class="field">
                <?php
                         echo '<input type="hidden" name="idColaborador" value='.$colaborador['idColaborador'].'>'
                ?>
                    <label>Cédula</label>
                    <div class="field">
                    <input type="text" name="cedula" placeholder="172396..." style="border: 2px solid #ccc;" <?php if($_SERVER["QUERY_STRING"]!=""){echo "value =".$fila['ci'];}?> readonly>
                    </div>
                    <label>Nombre</label>

                    <div class="two fields">
                        <div class="field">
                            <input type="text" name="nombre" placeholder="Nombre" style="border: 2px solid #ccc;" id="in-nombre" <?php if($_SERVER["QUERY_STRING"]!=""){echo "value =".$fila['nombres'];}?> readonly>
                        </div>
                        <div class="field">
                            <input type="text" name="Apellido" placeholder="Apellido"  style="border: 2px solid #ccc;" id="in-apellido" <?php if($_SERVER["QUERY_STRING"]!=""){echo "value =".$fila['apellidos'];}?> readonly> 
                        </div>
                        
                    </div>
                </div>
                <label>Fecha de nacimiento</label>
                <div class="three fields">
                    <div class="field">
                        <label>Día</label>
                        <select class="ui dropdown" style="border: 2px solid #ccc;" name='dia' id='InDia'>
                            <option value=''>--Seleccione un día--</option>
                            <option value='01'>1</option>
                            <option value='02'>2</option>
                            <option value='03'>3</option>
                            <option value='04'>4</option>
                            <option value='05'>5</option>
                            <option value='06'>6</option>
                            <option value='07'>7</option>
                            <option value='08'>8</option>
                            <option value='09'>9</option>
                            <option value='10'>10</option>
                            <option value='11'>11</option>
                            <option value='12'>12</option>
                            <option value='13'>13</option>
                            <option value='14'>14</option>
                            <option value='15'>15</option>
                            <option value='16'>16</option>
                            <option value='17'>17</option>
                            <option value='18'>18</option>
                            <option value='19'>19</option>
                            <option value='20'>10</option>
                            <option value='21'>21</option>
                            <option value='22'>22</option>
                            <option value='23'>23</option>
                            <option value='24'>24</option>
                            <option value='25'>25</option>
                            <option value='26'>26</option>
                            <option value='27'>27</option>
                            <option value='28'>28</option>
                            <option value='29'>29</option>
                            <option value='30'>30</option>
                            <option value='31'>31</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>Mes</label>
                        <select class="ui dropdown" style="border: 2px solid #ccc;" name="mes" id='InMes'>
                            <option value=''>--Seleccione un mes--</option>
                            <option value='01'>Enero</option>
                            <option value='02'>Febrero</option>
                            <option value='03'>Marzo</option>
                            <option value='04'>Abril</option>
                            <option value='05'>Mayo</option>
                            <option value='06'>Junio</option>
                            <option value='07'>Julio</option>
                            <option value='08'>Agosto</option>
                            <option value='09'>Septiembre</option>
                            <option value='10'>Octubre</option>
                            <option value='11'>Noviembre</option>
                            <option value='12'>Diciembre</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>Año</label>
                        <input type="text" name="anio" placeholder="Año" style="border: 2px solid #ccc;" id='InAño'>
                    </div>
                </div>
                
                <label>Género</label>
                <div class="two fields">
                    <div class="field">
                        <label>Mujer</label><input type="radio" name="example2" value="F" checked="checked">
                    </div>
                    <div class="field">
                        <label>Hombre</label><input type="radio" name="example2" value="M" id="myCheck">
                    </div>
                </div>
                <label>Dirección de domicilio</label>
                <div class="three fields">
                    <div class="field">
                        <label>Calle</label>
                        <input type="text" name="calle" placeholder="Calle" style="border: 2px solid #ccc;" <?php if($_SERVER["QUERY_STRING"]!=""){echo "value =".$fila['Calle'];}?>>
                    </div>
                    <div class="field">
                        <label>Nro</label>
                        <input type="text" name="Nro" placeholder="E14" style="border: 2px solid #ccc;" <?php if($_SERVER["QUERY_STRING"]!=""){echo "value =".$fila['Nro'];}?>>
                    </div>
                    <div class="field">
                        <label>Transversal</label>
                        <input type="text" name="transversal" placeholder="transversal" style="border: 2px solid #ccc;" <?php if($_SERVER["QUERY_STRING"]!=""){echo "value =".$fila['Transversal'];}?>>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Sector</label>
                        <input type="text" name="sector" placeholder="Sector" style="border: 2px solid #ccc;" <?php if($_SERVER["QUERY_STRING"]!=""){echo "value =".$fila['Sector'];}?>>
                    </div>
                    <div class="field">
                        <label>Ciudad</label>
                        <input type="text" name="ciudad" placeholder="Ciudad" style="border: 2px solid #ccc;" <?php if($_SERVER["QUERY_STRING"]!=""){echo "value =".$fila['Ciudad'];}?>>
                    </div>
                </div>
                <label>Número teléfono</label>
                <div class="two fields">
                    <div class="field">
                        <label>Convencional</label>
                        <input type="text" name="convencional" placeholder="convencional" style="border: 2px solid #ccc;" <?php if($_SERVER["QUERY_STRING"]!=""){echo "value =".$fila['Convencional'];}?>>
                    </div>
                    <div class="field">
                        <label>Celular</label>
                        <input type="text" name="celular" placeholder="celular" style="border: 2px solid #ccc;" <?php if($_SERVER["QUERY_STRING"]!=""){echo "value =".$fila['Celular'];}?>>
                    </div>
                </div>
                <label>Correo electrónico</label>
                <div class="field">
                    <input type="text" name="correoElec" placeholder="nombre.apellido@hotmail.com" style="border: 2px solid #ccc;" <?php if($_SERVER["QUERY_STRING"]!=""){echo "value =".$fila['mail'];}?> readonly> 
                </div>
                <script>
                    fecha = document.getElementById("Fecha").innerHTML;
                    var fe = fecha.split("-");
                    document.getElementById("InDia").value = fe[2];
                    document.getElementById("InMes").value = fe[1];
                    document.getElementById("InAño").value = fe[0];
                    if(document.getElementById("Genero").innerHTML == "M")document.getElementById("myCheck").checked = true;
                </script>
            </div>
            <button class="ui button" type="submit">Actualizar</button>
        </form>
        </div>
    </center>
    <br>
</body>

</html>