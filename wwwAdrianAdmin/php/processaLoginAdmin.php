<?php
$servidor = "localhost";
$usuari = "projectes_Adrian";
$contrasenya = "projectes_Adrian";
$basedades = "projectes_Adrian";

$connexio = mysqli_connect($servidor, $usuari, $contrasenya, $basedades);

if (!$connexio) {
    die ("Error de connexió: ".mysqli_connect_error ());
}

$Nom = $_POST['nom'];
$ContrasenyaLogin = $_POST['contrasenya'];

$sql1="SELECT * FROM `professorat` WHERE nom LIKE '$Nom'";
$resultat = mysqli_query($connexio, $sql1);

if (mysqli_num_rows($resultat) > 0){
    $contrasenyaEncriptada='';
    session_start();
    
    /*session is started if you don't write this line can't use $_Session  global variable*/

    $esAdmin = false;
    while($row = mysqli_fetch_assoc($resultat)){
        $contrasenyaEncriptada= $row["contrasenya"];
        $_SESSION["usuari"]=$row["nom"];
        $_SESSION["rol"]=$row["rol"];
        if($row["rol"] == "ROL_ADMIN"){
            $esAdmin = true;
        }
    }

    if(!$esAdmin){
        mysqli_close($connexio);
        header("Location: Admin.php?error=usuari");
    }

    $contrasenyaDes =password_verify($ContrasenyaLogin,$contrasenyaEncriptada);
    if ($contrasenyaDes){

        $dia = date("Y")."/".date("n")."/".date("j");
        $hora = date("G").":".date("i").":".date("s");
        $fp = fopen("../log/registre.log","a");
        $usuariLog = $_SESSION["usuari"];
        fputs($fp, "$usuariLog - Login - Dia: $dia - Hora: $hora \n");
        fclose($fp);

        mysqli_close($connexio);
        header("Location: ../Admin.php");
    }else{
        Session_destroy();
        mysqli_close($connexio);
        header("Location: ../Admin.php?error=contrasenya");
    }
}else{
    mysqli_close($connexio);
    header("Location: ../Admin.php?error=usuari");
}
?>