<!DOCTYPE html>
<html>
<head>
    <title>Projecte</title>
    <meta charset = "utf-8"/>
    <link rel="stylesheet" type="text/css"  href="../css/registreStyles.css?v=<?php echo time(); ?>">
</head>
<body>
<?php
$pagina="";

$parametre="";
if(isset($_GET['error'])){
    $parametre = $_GET['error'];
}
$ErrorContrasenya="";
$ErrorEmail="";

switch ($parametre){
    case "contrasenya":
        $ErrorContrasenya="Les contrasenyes han de coincidir";
        break;
    case "emailalumnat":
        $ErrorEmail="El alumne ja existeix";
    case "emailprofessorat":
        $ErrorEmail="El professor ja existeix";
}
include "./partials/cap.partial.php";
echo '<div id="main">';

echo '<div id="mainRegistre">';

echo '<div id="formulariLogin">';

    echo '<form action="processaUsuariNou.php" method="post">';

        echo '<label for="">Nom:</label>';
        echo '<input type="text" id="nom" name="nom" required><br/>';

        echo '<label for="">Cognoms:</label>';
        echo '<input type="text" id="cognoms" name="cognoms" required><br/>';

        echo '<label for="">Poblacio:</label>';
        echo '<input type="text" id="poblacio" name="poblacio" required><br/>';

        echo '<label for="">Email:</label>';
        echo '<input type="text" id="email" name="email" required><br/>';
        echo '<span class="errors">'.$ErrorEmail.'</span><br>';

        echo '<label for="">Contrasenya:</label>';
        echo '<input type="password" id="contrasenya" name="contrasenya" minlength="6" required><br/>';
        echo '<span class="errors">'.$ErrorContrasenya.'</span><br>';

        echo '<label for="">Confirmar Contrasenya:</label>';
        echo '<input type="password" id="confirmarContrasenya" name="confirmarContrasenya" minlength="6" required><br/>';

        echo '<label for="">Tipus d&#39;usuari:</label>';
        echo '<select name="tipusUsuari">
                <option value="alumnat">ALUMNAT</option>
                <option value="professorat">PROFESSORAT</option>
            </select><br/>';

        echo '<input type="submit" value="Envia"><br>';
        
    echo '</form>';

echo '</div>';

echo '</div>';

echo '</div>';
echo '<div id="titol"><a href="../index.php">Torna a l&#39;inici</a></div>';
?>
</body>