<?php 

$servidor = "localhost";
$usuari = "projectes_Adrian";
$contrasenya = "projectes_Adrian";
$basedades = "projectes_Adrian";

$connexio = mysqli_connect($servidor, $usuari, $contrasenya, $basedades);

if (!$connexio) {
    die ("Error de connexió: ".mysqli_connect_error ());
}
$id = $_GET['id'];
$rolEdits = $_GET['rolEdits'];
$tipusUsuari = "";
$id_tipus = "";

if($rolEdits == "ROL_ALUMNAT"){
    $tipusUsuari = "alumnat";
    $id_tipus = "idalum";
}else{
    $tipusUsuari = "professorat";
    $id_tipus = "idprof";
}

$sql= "SELECT * FROM $tipusUsuari WHERE $id_tipus LIKE $id";
$resultat= mysqli_query($connexio,$sql);

while ($row = mysqli_fetch_assoc($resultat)){
    
    echo '<div id="main">';
    echo 'Editar dades';
        echo '<div id="mainLogin">';
            echo '<form action="php\processaEditaUsuari.php" method="POST">';
            echo '<div id="formulariLogin">';
                echo '<label for="">Nom:</label>';
                echo '<input type="text" id="nom" name="nom" value='.$row["nom"].' required><br/>';

                echo '<label for="">Cognoms:</label>';
                echo '<input type="text" id="cognoms" name="cognoms" value='.$row["cognoms"].' required><br/>';

                echo '<label for="">Població:</label>';
                echo '<input type="text" id="poblacio" name="poblacio" value='.$row["poblacio"].' required><br/>';

                echo '<label for="">Email:</label>';
                echo '<input type="text" id="email" name="email" value='.$row["email"].' required readonly><br/>';

                echo '<label for="">Contrasenya:</label>';
                echo '<input type="text" id="contrasenya" name="contrasenya" value='.$row["contrasenya"].' required readonly><br/>';

                echo '<label for="">ROL:</label>';
                echo '<input type="text" id="rol" name="rol" value='.$row["rol"].' required readonly><br/>';

                echo '<label for="">Data:</label>';
                echo '<input type="text" id="data" name="data" value='.$row["data"].' required readonly><br/>';
    
                echo '<button type="submit" class="btn btn-primary">Enviar</button>';
            echo '</div>';
  
        echo '</div>';
  
            echo '</form>';
        echo '</div>';
    echo '</div>';
}

?>