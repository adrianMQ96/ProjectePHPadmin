<?php 

$servidor = "localhost";
$usuari = "projectes_Adrian";
$contrasenya = "projectes_Adrian";
$basedades = "projectes_Adrian";

$connexio = mysqli_connect($servidor, $usuari, $contrasenya, $basedades);

if (!$connexio) {
    die ("Error de connexió: ".mysqli_connect_error ());
}


$sql1="SELECT * FROM `professorat`";
$resultat = mysqli_query($connexio, $sql1);

$sql2="SELECT * FROM `alumnat`";
$resultat2=mysqli_query($connexio, $sql2);

if (mysqli_num_rows($resultat) > 0){

    $esAdmin = false;
    echo "<div class='container'><table class='table m-5'>
        <thead class='thead-dark'>
            <tr class='taulaCap'>
                <th>ID</th>
                <th>Nom</th>
                <th>Cognoms</th>
                <th>Correu Electronic</th>
                <th>Població</th>
                <th>Rol</th>
                <th>Data Creació</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>";

    while($row = mysqli_fetch_assoc($resultat)){
        
        echo " <tr class='profe'><td>".$row["idprof"]."</td>";
        echo " <td>".$row["nom"]."</td>";
        echo " <td>".$row["cognoms"]."</td>";
        echo " <td>".$row["email"]."</td>";
        echo " <td>".$row["poblacio"]."</td>";
        echo " <td>".$row["rol"]."</td>";
        echo " <td>".$row["data"]."</td>";
        if($row["rol"] == "ROL_PROFESSORAT"){
            echo " <td><a href=/wwwAdrianadmin/php/eliminaProfessorat.php?id='".$row["idprof"]."'>Borrar</a>
                    <a href=/wwwAdrianadmin/Admin.php?id=".$row["idprof"]."&rolEdits=".$row["rol"].">Modificar</a></td>";
        }else{
            echo "<td></td>";
        }
        
    }

    while($row = mysqli_fetch_assoc($resultat2)){
        
        echo " <tr class='alum'><td>".$row["idalum"]."</td>";
        echo " <td>".$row["nom"]."</td>";
        echo " <td>".$row["cognoms"]."</td>";
        echo " <td>".$row["email"]."</td>";
        echo " <td>".$row["poblacio"]."</td>";
        echo " <td>".$row["rol"]."</td>";
        echo " <td>".$row["data"]."</td>";
        echo " <td><a href=/wwwAdrianadmin/php/processaBaixaUsuari.php?id=".$row['idalum'].">Borrar</a>
        <a href=/wwwAdrianadmin/Admin.php?id=".$row["idalum"]."&rolEdits=".$row["rol"].">Modificar</a></td>";
    }

    echo "</tbody></table></div>";
    echo "<p><a href='/wwwAdrianadmin/Admin.php?afegeix'>Afegeix Usuari Nou</a>&nbsp;&nbsp;<a href='/wwwAdrianadmin/php/processaBackup.php'>Fes un backup dels usuaris</a>&nbsp;&nbsp;<a href='/wwwAdrianadmin/Admin.php?visual'>Visualitza Log</a></p>";
    echo "<p></p>";
}
        
?>