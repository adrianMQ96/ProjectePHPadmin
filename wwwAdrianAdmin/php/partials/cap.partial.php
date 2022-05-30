
<div id="zonaTitol"><h1 id="titol">Projecte PHP Adrià Admin</h1></div>


<table id="navMenu">
  <tr>
    <th><a id="navItem" href="\wwwAdrianadmin\Admin.php">Inici Administració</a></th>
    <th><a id="navItem" href="..\wwwAdrian\Index.php">Inici Projecte</a></th>
    <?php
      if(isset($_SESSION['usuari'])){
        echo '<th><a id="navItem" href="\wwwAdrianadmin\Admin.php?gestio">Gestió d&#39;usuari</a></th>';
        echo '<th><a id="navItem" href="\wwwAdrianadmin\Admin.php?projectes">Gestió de projectes</a></th>';
      }
    ?>
</table>