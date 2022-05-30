<?php

    $servidor = "localhost";
    $usuari = "projectes_Adrian";
    $contrasenya = "projectes_Adrian";
    $basedades = "projectes_Adrian";

    $connexio = mysqli_connect($servidor, $usuari, $contrasenya, $basedades);

    if (!$connexio) {
        die ("Error de connexió: ".mysqli_connect_error ());
    }

    $dia = date('jnY') . date('_His');

    //Fitxer Alumnat
    $sql1 = "SELECT * FROM alumnat";
    $resultat1 = mysqli_query($connexio, $sql1);

    $arxiu1 = fopen("../backup/backupAlumnat_$dia.txt", "w");

    $cadena = "idAlumne::nom::cognom::email::poblacio::contrasenya::rol::data \n";
    $frase = "";

    fwrite($arxiu1, $cadena); 

    while ($mostrar1 = mysqli_fetch_array($resultat1)) { 
  
        $idusuari1 = $mostrar1['idalum'];
        $nom1 = $mostrar1['nom'];
        $cognom1 = $mostrar1['cognoms'];
        $email1 = $mostrar1['email'];
        $poblacio1 = $mostrar1['poblacio'];
        $contrasenya1 = $mostrar1['contrasenya'];
        $rol1 = $mostrar1['rol'];
        $data1 = $mostrar1['data'];
    
       
        $frase = $idusuari1 . "::" . $nom1 . "::" . $cognom1 . "::" . $email1 . "::" . $poblacio1 . "::" . $contrasenya1 . "::" . $rol1 . "::" . $data1 . " \n";
    
        fwrite($arxiu1, $frase);
    }
    fclose($arxiu1);
    

    //Fitxer Professorat
    $sql2 = "SELECT * FROM professorat";
    $resultat2 = mysqli_query($connexio, $sql2);

    $arxiu2 = fopen("../backup/backupProfessorat_$dia.txt", "w");

    $cadena2 = "idProfessor::nom::cognom::email::poblacio::contrasenya::rol::data \n";
    $frase2 = "";

    fwrite($arxiu2, $cadena2);

    while ($mostrar2 = mysqli_fetch_array($resultat2)) { 
  
        $idusuari2 = $mostrar2['idprof'];
        $nom2 = $mostrar2['nom'];
        $cognom2 = $mostrar2['cognoms'];
        $email2 = $mostrar2['email'];
        $poblacio2 = $mostrar2['poblacio'];
        $contrasenya2 = $mostrar2['contrasenya'];
        $rol2 = $mostrar2['rol'];
        $data2 = $mostrar2['data'];
    
       
        $frase = $idusuari2 . "::" . $nom2 . "::" . $cognom2 . "::" . $email2 . "::" . $poblacio2 . "::" . $contrasenya2 . "::" . $rol2 . "::" . $data2 . " \n";
    
        fwrite($arxiu2, $frase2);
    }
    fclose($arxiu2);
    mysqli_close($connexio);

    $dia = date("Y")."/".date("n")."/".date("j");
    $hora = date("G").":".date("i").":".date("s");
    $fp = fopen("../log/registre.log","a");
    $usuariLog = $_SESSION["usuari"];
    fputs($fp, "$usuariLog - Backup realitzat - Dia: $dia - Hora: $hora \n");
    fclose($fp);

    header("Location: ../Admin.php");
    
?>