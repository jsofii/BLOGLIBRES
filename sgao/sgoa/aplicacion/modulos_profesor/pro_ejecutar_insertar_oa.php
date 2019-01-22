<?php
//clases requeridas
session_start();
require_once '../clases_negocio/clase_conexion.php';
require '../clases_negocio/funciones_oa_profesor.php';
//variables de de objeto de prendizaje
$almacenamiento = '../../storage/';
$archivo = filter_input(INPUT_POST, 'archivo');
$archivo2 = filter_input(INPUT_POST, 'archivo2');
$nombre = filter_input(INPUT_POST, 'nombre');
$descripcion = filter_input(INPUT_POST, 'descripcion');
$institucion = filter_input(INPUT_POST, 'institucion');
$palabras_clave = filter_input(INPUT_POST, 'palabras_claves');
//echo $nombre.'-----------'.$descripcion.'-----------'.$institucion.'---------'.$palabras_clave;
$seGuardo_db = 0;
$seGuardo_sto = 1;
$path = $_FILES['archivo']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);
$target_file = $almacenamiento .urlencode($nombre). '.' . $ext;
$target_file2 = $almacenamiento .urlencode($nombre). '.' . $ext.'.jpg';


 $id_usuario= $_SESSION['id'];
 
 

$conexion = new Conexion();
$statement = 'INSERT INTO objeto_aprendizaje (nombre,descripcion, id_usuario, institucion,palabras_clave,tamanio,ruta,descarga) VALUES (?, ?, ?, ?,?,?,?,?)';
$consulta = $conexion->prepare($statement);
if ($consulta->execute(array($nombre, $descripcion, $id_usuario, $institucion, $palabras_clave, $_FILES["archivo"]["size"], $target_file,0))) {
    $seGuardo_db = 1;
} else {
    $seGuardo_db = 0;
}
$conexion = null;

if ($seGuardo_db == 1) {
    if (file_exists($target_file)) {
        echo "Lo sentimos el archivo ya existe";
        $seGuardo_sto = 0;
    }

    if ($seGuardo_sto == 0) {
        echo "Lo sentimos su archivo no ha sido cargado.";
    } else {
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"],$target_file)) {
            //echo "The file ". $nombre. " has been uploaded. en".$target_file;
            $seGuardo_sto = 1;
        } else {
            //echo "Sorry, there was an error uploading your file.";
            $seGuardo_sto = 0;
        }
    }
} else {

}


//comprvacion de guardado
if ($seGuardo_db == 1 && $seGuardo_sto==1) {
    if(obtenerColaboradorPorUsuario($id_usuario)==NULL){
        ingresar_telefono($id_usuario,$id_usuario);
        $idTelefono=getIDTelefono($id_usuario,$id_usuario);
        ingresar_direccion($id_usuario,$id_usuario,$id_usuario,$id_usuario,$id_usuario);
        $idDireccion=getIDDireccion($id_usuario,$id_usuario,$id_usuario,$id_usuario,$id_usuario);
        ingresar_colaborador($idDireccion, $idTelefono,"",date("Y-m-d"),"M",$id_usuario);
    }
    echo '<script>alert("El objeto de aprendizaje se ha guardo correctamente.")</script> ';
    echo "<script>location.href='pro_importar_catalogar.php'</script>";
} else {
    echo '<script>alert("Error ineperado el objeto de aprendizaje no se ha guardado correctamente.")</script> ';
    echo "<script>location.href='adm_objetos_aprendizaje.php'</script>";
}
?>
