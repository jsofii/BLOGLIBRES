
<?php
session_start();
if($_SESSION['usuario']){
        session_unset();
	session_destroy();
	header("location:../aplicacion/encuesta/index.php");
}
else{
	header("location:../aplicacion/encuesta/index.php");
}
?>