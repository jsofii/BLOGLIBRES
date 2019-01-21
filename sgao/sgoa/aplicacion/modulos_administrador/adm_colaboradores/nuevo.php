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
    $lis = obtener_usuario_como_arreglo($_SERVER["QUERY_STRING"]);
    $cont=0;
    foreach ($lis as &$tipo) {
        $lisAux[$cont]=$tipo;
        $cont++;
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
            <form class="ui  form" action="registrarInformacion.php" method="POST" enctype="multipart/form-data">
                <h4 class="ui  dividing header">Nuevo colaborador</h4>
                <div class="field">
                    <label>Usuario</label>
                    <div class="field">

                    <select class="ui dropdown" style="border: 2px solid #ccc;" id="opc">
                        <option value=''>--Seleccione un usuario--</option>
                        <?php
                            $cont=0;
                            $lis = obtener_lista_de_usuarios();
                            $listaUsiarios = explode(",",$lis);
                            foreach ($listaUsiarios as &$usu) {
                                if($usu!='admin')
                                echo '<option value="'.$usu.'">'.$usu.'</option>';
                            }
                        ?>
                    </select>

                    </div>
                    
                    <script>
                        const opcion = document.getElementById("opc");
                        var contOp; 
                        opcion.addEventListener("change", function(){
                                contOp = opcion.value;
                                var x = "nuevo.php";
                                location.href=x+"?"+contOp; 
                        });
                        // document.getelementbyid('opc').value=window.location.search;
                        opcion.value=window.location.search.substring(1);
                        console.log(window.location.search.substring(1));
                    </script>
                    
                    <label>Cédula</label>
                    <div class="field">
                        <input type="text" name="cedula" placeholder="172396..." style="border: 2px solid #ccc;" <?php if($_SERVER["QUERY_STRING"]!=""){echo "value =".$lisAux[1];}?> readonly>
                    </div>
                    <label>Nombre</label>

                    <div class="two fields">
                        <div class="field">
                            <input type="text" name="nombre" placeholder="Nombre" style="border: 2px solid #ccc;" id="in-nombre" <?php if($_SERVER["QUERY_STRING"]!=""){echo "value =".$lisAux[2];}?> readonly>
                        </div>
                        <div class="field">
                            <input type="text" name="Apellido" placeholder="Apellido"  style="border: 2px solid #ccc;" id="in-apellido" <?php if($_SERVER["QUERY_STRING"]!=""){echo "value =".$lisAux[3];}?> readonly> 
                        </div>
                    </div>
                </div>
                <label>Fecha de nacimiento</label>
                <div class="three fields">
                    <div class="field">
                        <label>Día</label>
                        <select class="ui dropdown" style="border: 2px solid #ccc;" name='dia'>
                            <option value=''>--Seleccione un día--</option>
                            <option selected value='1'>1</option>
                            <option value='2'>2</option>
                            <option value='3'>3</option>
                            <option value='4'>4</option>
                            <option value='5'>5</option>
                            <option value='6'>6</option>
                            <option value='7'>7</option>
                            <option value='8'>8</option>
                            <option value='9'>9</option>
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
                        <select class="ui dropdown" style="border: 2px solid #ccc;" name="mes">
                            <option value=''>--Seleccione un mes--</option>
                            <option selected value='1'>Enero</option>
                            <option value='2'>Febrero</option>
                            <option value='3'>Marzo</option>
                            <option value='4'>Abril</option>
                            <option value='5'>Mayo</option>
                            <option value='6'>Junio</option>
                            <option value='7'>Julio</option>
                            <option value='8'>Agosto</option>
                            <option value='9'>Septiembre</option>
                            <option value='10'>Octubre</option>
                            <option value='11'>Noviembre</option>
                            <option value='12'>Diciembre</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>Año</label>
                        <input type="text" name="anio" placeholder="Año" style="border: 2px solid #ccc;">
                    </div>
                </div>
                <label>Género</label>
                <div class="two fields">
                    <div class="field">
                        <label>Mujer</label><input type="radio" name="example2" value="F" checked="checked">
                    </div>
                    <div class="field">
                        <label>Hombre</label><input type="radio" name="example2" value="M">
                    </div>
                </div>
                <label>Dirección de domicilio</label>
                <div class="three fields">
                    <div class="field">
                        <label>Calle</label>
                        <input type="text" name="calle" placeholder="Calle" style="border: 2px solid #ccc;">
                    </div>
                    <div class="field">
                        <label>Nro</label>
                        <input type="text" name="Nro" placeholder="E14" style="border: 2px solid #ccc;">
                    </div>
                    <div class="field">
                        <label>Transversal</label>
                        <input type="text" name="transversal" placeholder="transversal" style="border: 2px solid #ccc;">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Sector</label>
                        <input type="text" name="sector" placeholder="Sector" style="border: 2px solid #ccc;">
                    </div>
                    <div class="field">
                        <label>Ciudad</label>
                        <input type="text" name="ciudad" placeholder="Ciudad" style="border: 2px solid #ccc;">
                    </div>
                </div>
                <label>Número teléfono</label>
                <div class="two fields">
                    <div class="field">
                        <label>Convencional</label>
                        <input type="text" name="convencional" placeholder="convencional" style="border: 2px solid #ccc;">
                    </div>
                    <div class="field">
                        <label>Celular</label>
                        <input type="text" name="celular" placeholder="celular" style="border: 2px solid #ccc;">
                    </div>
                </div>
                <label>Correo electrónico</label>
                <div class="field">
                    <input type="text" name="correoElec" placeholder="nombre.apellido@hotmail.com" style="border: 2px solid #ccc;" <?php if($_SERVER["QUERY_STRING"]!=""){echo "value =".$lisAux[6];}?> readonly> 
                </div>
                
                
                <label>Foto</label>
                <div class="field">
                    <input type="file" id="imagen" name="perfil" required>
                </div>
    
            </div>
            <button class="ui button" type="submit">Crear</button>
        </form>
        </div>
    </center>
    <br>
</body>

</html>