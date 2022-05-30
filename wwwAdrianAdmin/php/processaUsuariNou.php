<!DOCTYPE html>
<html>
<head>
    <title> Exemple echo </title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css"  href="../css/styles.css?v=<?php echo time(); ?>">
</head>
<body>


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

    $Cognoms = $_POST['cognoms'];
    $Poblacio = $_POST['poblacio'];

    $Email = $_POST['email'];
    $ContrasenyaRegistre = $_POST['contrasenya'];
    $ConfirmarContrasenya = $_POST['confirmarContrasenya'];
    $TipusUsuari = $_POST['tipusUsuari'];
    $Aleatori =rand(1,15);

    if ($ContrasenyaRegistre != $ConfirmarContrasenya){
        header("Location: RegistreUsuari.php?error=contrasenya");
    }

    $Usuaris = strtolower($TipusUsuari);
    //$sql="SELECT * FROM $Usuaris WHERE correu = '".$Email."'";
    $sql="SELECT * FROM $Usuaris";
    $resultat = mysqli_query($connexio, $sql);

    echo '<div id="zonaTitol"><h1 id="titol">Projecte PHP Adrian</h1></div><br>';
    echo '<div id="zonaTitol"><h4 id="titol">Processa Registre Usuari Nou</h4></div>';
    echo '<div id="main">';
    echo "<ul>";
    echo "<li>Nom: $Nom</li>";
    echo "<li>Cognoms: $Cognoms</li>";
    echo "<li>Poblacio: $Poblacio</li>";
    echo "<li>Email: $Email</li>";
    echo "<li>Contrasenya 01: $ContrasenyaRegistre</li>";
    echo "<li>Contrasenya 02: $ConfirmarContrasenya</li>";
    echo "<li>Tipus d&#39;usuari: $TipusUsuari</li>";
    echo "</ul>";

    // Executem la instrucció, comprovant si hi ha hagut algun tipus d'error i si n'ha retornat més de 0
    if (mysqli_num_rows($resultat) > 0) {

        while($row = mysqli_fetch_assoc($resultat)) {
            echo "<p>".$row["email"]."</p>";
            if($row["email"] == $Email){
                mysqli_close($connexio);
                header("Location: RegistreUsuari.php?error=email$TipusUsuari");
            }
        }
        $opcions = [
            'cost' => 11,
        ];
    $ContrasenyaEncriptada= password_hash($ContrasenyaRegistre, PASSWORD_BCRYPT,$opcions)."\n";
    $ContrasenyaEncriptada= trim($ContrasenyaEncriptada);
    $Rol=0;
    $TipusRol="";
    if ($Usuaris == "alumnat"){
        $Rol = 1;
        $TipusRol="ROL_ALUMNAT";
    }else{
        $Rol = 2;
        $TipusRol="ROL_PROFESSORAT";
    }
    $sqlInsert = "INSERT INTO $Usuaris(nom,cognoms,email,poblacio,contrasenya,rol,data)
    
    VALUES ('$Nom','$Cognoms','$Email','$Poblacio','$ContrasenyaEncriptada','$Rol',now())";

        if (mysqli_query($connexio, $sqlInsert)) {

            $dia = date("Y")."/".date("n")."/".date("j");
            $hora = date("G").":".date("i").":".date("s");
            $fp = fopen("../log/registre.log","a");
            fputs($fp, "Usuari Registrat: $Email - $TipusRol - Dia: $dia - Hora: $hora \n");
            fclose($fp);

            $ultim_id = mysqli_insert_id($connexio);
            echo "Nou registre creat amb èxit. Últim id: ".$ultim_id;
        } else {
            echo "Error: ". $sql . "<br/>" . mysqli_error ($connexio);
        }

    } else {
        //no s'ha trobat cap resultat
        echo "0 resultats";
    }
    //Tanquem la connexió abans d'acabar
    mysqli_close($connexio);

    echo "</div>";
    for($i=0; $i<$Aleatori ; $i++) {
        echo "<div id='imatgeRandom'><img src='../img/$TipusUsuari.jpg' height='150px' width='150px'>
                </div>";
    }
    echo '<div id="titol"><a href="../index.php">Torna a l&#39;inici</a></div>';

?>
</body>
</html>