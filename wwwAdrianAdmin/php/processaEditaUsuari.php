<?php 

$servidor = "localhost";
$usuari = "projectes_Adrian";
$contrasenya = "projectes_Adrian";
$basedades = "projectes_Adrian";

$connexio = mysqli_connect($servidor, $usuari, $contrasenya, $basedades);

if (!$connexio) {
    die ("Error de connexió: ".mysqli_connect_error ());
}
session_start();
$Nom = $_POST['nom'];

$Cognoms = $_POST['cognoms'];
$Poblacio = $_POST['poblacio'];
$Email = $_POST['email'];

$Rol = $_POST['rol'];

$tipusUsuari="";
$tipusId="";

if($Rol == "ROL_ALUMNAT"){
    $tipusUsuari="alumnat";
}else{
    $tipusUsuari="professorat";
}

$sql= "UPDATE $tipusUsuari SET nom='$Nom', cognoms='$Cognoms', poblacio='$Poblacio'  WHERE email LIKE '$Email'";
$resultat= mysqli_query($connexio,$sql);

    if (mysqli_query($connexio, $sql)) {

        $dia = date("Y")."/".date("n")."/".date("j");
        $hora = date("G").":".date("i").":".date("s");
        $fp = fopen("../log/registre.log","a");
        $usuariLog = $_SESSION["usuari"];
        fputs($fp, "$usuariLog - Usuari modificat - Dia: $dia - Hora: $hora \n");
        fclose($fp);

        mysqli_close($connexio);
        header("Location: ../Admin.php");
    } else {
        mysqli_close($connexio);
        echo "Error: ". $sql . "<br/>" . mysqli_error ($connexio);
        header("Location: ../Admin.php");
    }

?>