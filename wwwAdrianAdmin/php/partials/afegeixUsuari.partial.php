<?php

$ErrorEmail="";
$ErrorContrasenya="";
if(isset($_GET['error'])){

    if($_GET['error'] == "contrasenya"){
        $ErrorContrasenya = "La contrasenya no coincideix";
    }

    if($_GET['error'] == "email"){
        $ErrorContrasenya = "L'alumnat ja existeix";
    }
}

echo '<div id="main">';
    echo 'Usuari Nou';
        echo '<div id="mainLogin">';
            echo '<form action="php\processaAfegeixUsuari.php" method="POST">';
            echo '<div id="formulariLogin">';
                echo '<label for="">Nom:</label>';
                echo '<input type="text" id="nom" name="nom" required><br/>';

                echo '<label for="">Cognoms:</label>';
                echo '<input type="text" id="cognoms" name="cognoms" required><br/>';

                echo '<label for="">Població:</label>';
                echo '<input type="text" id="poblacio" name="poblacio" required><br/>';

                echo '<label for="">Email:</label>';
                echo '<input type="text" id="email" name="email" required ><br/>';
                echo '<span class="errors">'.$ErrorEmail.'</span><br>';

                echo '<label for="">Contrasenya:</label>';
                echo '<input type="password" id="contrasenya" name="contrasenya" required ><br/>';
                echo '<span class="errors">'.$ErrorContrasenya.'</span><br>';

                echo '<label for="">Confirmar Contrasenya:</label>';
                echo '<input type="password" id="confirmarContrasenya" name="confirmarContrasenya" required ><br/>';

                echo '<label for="">Tipus d&#39;usuari:</label>';
                echo '<select name="rol">
                        <option value="ROL_ALUMNAT">ALUMNAT</option>
                        <option value="ROL_PROFESSORAT">PROFESSORAT</option>
                    </select><br/>';
    
                echo '<button type="submit" class="btn btn-primary">Enviar</button>';
            echo '</div>';
  
        echo '</div>';
  
            echo '</form>';
        echo '</div>';
    echo '</div>';

?>