<?php


$fp = fopen("log/registre.log", "r");
while (!feof($fp)) {
    $linia = fgets($fp); 
        ?>
        <p style="text-align: center; color: red;"> <?php echo $linia ?> </p>
        <?php
}
fclose($fp);

?>