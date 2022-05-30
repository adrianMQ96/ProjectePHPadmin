<?php 
session_start()
$servidor = "localhost";
$usuari = "projectes_Adrian";
$contrasenya = "projectes_Adrian";
$basedades = "projectes_Adrian";

$connexio = mysqli_connect($servidor, $usuari, $contrasenya, $basedades);

if (!$connexio) {
    die ("Error de connexió: ".mysqli_connect_error ());
}
$id_Prof = $_GET['id'];
$sql1="DELETE FROM `professorat` WHERE idprof = $id_Prof";


if($resultat = mysqli_query($connexio, $sql1)){
    session_destroy();
    $dia = date("Y")."/".date("n")."/".date("j");
    $hora = date("G").":".date("i").":".date("s");
    $fp = fopen("../log/registre.log","a");
    fputs($fp, "$_SESSION['usuari'] - Eliminat Professorat amb id $id_Prof - Dia: $dia - Hora: $hora \n");
    fclose($fp);
    header("Location: ../Admin.php");
}else{
    echo $id_Prof;
}

?>