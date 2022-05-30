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
    $ContrasenyaRegistre = $_POST['contrasenya'];
    $ConfirmarContrasenya = $_POST['confirmarContrasenya'];
    $Rol = $_POST['rol'];

    if ($ContrasenyaRegistre != $ConfirmarContrasenya){
        header("Location: ../Admin.php?afegeix&error=contrasenya");
    }

    $tipusUsuari="";
    if($Rol == "ROL_ALUMNAT"){
        $tipusUsuari = "alumnat";
    }else{
        $tipusUsuari = "professorat";
    }

    $sql="SELECT * FROM $tipusUsuari";
    $resultat = mysqli_query($connexio, $sql);

    if (mysqli_num_rows($resultat) > 0) {

        while($row = mysqli_fetch_assoc($resultat)) {
            echo "<p>".$row["email"]."</p>";
            if($row["email"] == $Email){
                mysqli_close($connexio);
                header("Location: ../Admin.php?afegeix&error=email");
            }
        }
        $opcions = [
            'cost' => 11,
        ];

        $ContrasenyaEncriptada= password_hash($ContrasenyaRegistre, PASSWORD_BCRYPT,$opcions)."\n";
        $ContrasenyaEncriptada= trim($ContrasenyaEncriptada);

        $sqlInsert = "INSERT INTO $tipusUsuari(nom,cognoms,email,poblacio,contrasenya,rol,data)
    
        VALUES ('$Nom','$Cognoms','$Email','$Poblacio','$ContrasenyaEncriptada','$Rol',now())";

        if (mysqli_query($connexio, $sqlInsert)) {
            $dia = date("Y")."/".date("n")."/".date("j");
            $hora = date("G").":".date("i").":".date("s");
            $fp = fopen("../log/registre.log","a");
            $usuariLog = $_SESSION["usuari"];
            fputs($fp, "$usuariLog Usuari creat - Dia: $dia - Hora: $hora \n");
            fclose($fp);

            $ultim_id = mysqli_insert_id($connexio);
            echo "Nou registre creat amb èxit. Últim id: ".$ultim_id;
            header("Location: ../Admin.php");
    } else {
        echo "Error: ". $sql . "<br/>" . mysqli_error ($connexio);
    }
    }
?>