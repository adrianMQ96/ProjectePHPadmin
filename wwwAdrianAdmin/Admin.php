<!DOCTYPE html>
<html>
<head>
    <title>Projecte</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/styles.css?v=<?php echo time(); ?>">
</head>
<body>
<?php
session_start();
include "php\partials\cap.partial.php";
include "php\partials\benvinguda.partial.php";

$MostrarErrors = "";
if(isset($_GET['error'])){
    if($_GET['error'] == "usuari"){
        $MostrarErrors = "L'usuari no és vàlid";
    }elseif($_GET['error'] == "contrasenya"){
        $MostrarErrors = "La contrasenya no és correcta";
    }
}

$login = null;
if(isset($_SESSION['rol'])){
     
    $login = $_SESSION['rol'];

    if($login != 'ROL_ADMIN'){
        $login = null;
        session_destroy();
    }
}

echo '<h3 id="titol">Admin</h3>';
echo '<div id="main">';
echo '<h3 id="titol">'.$MostrarErrors.'</h3>';

if($login == null){
    include "php\partials\login.partial.php";
}else{

    if(isset($_GET['projectes'])){
        include "php\partials\projectes.partial.php";
    }elseif(isset($_GET['gestio'])){
        include "php\partials\usuaris.partial.php";
    }elseif(isset($_GET['rolEdits'])){
        include "php/partials/editaUsuari.partial.php";
    }elseif(isset($_GET['afegeix'])){
        include "php/partials/afegeixUsuari.partial.php";
    }else{
        echo '<div id="usuari"> <img src="img/construccio.png" width="100%" height="100%">';
        echo '<a href="php\desconnecta.php">Logout</a>';
    }

    

echo '</div>';
}


echo '</div>';



if (isset($_SESSION["usuari"])) {
    //include "./../php/partials/benvinguda.partial.php";
    
}


include "./php/partials/peu.partial.php";
if(isset($_GET['visual'])){
    include "php/partials/visualitzaLog.partial.php";
}

?>
</body>
</html>