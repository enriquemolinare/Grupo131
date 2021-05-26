<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $query = "SELECT tiendas.id, tiendas.nombre AS nombre_tienda, comunas.comuna FROM tiendas, cobertura_tiendas, comunas WHERE tiendas.id = cobertura_tiendas.tienda_id AND cobertura_tiendas.comuna_cobertura_id = comunas.id ORDER BY tiendas.id ASC;";
  $result = $db -> prepare($query);
  $result -> execute();
  $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
 
  ?>

  <table class="center">
    <tr>
      <th>ID</th>
      <th>Nombre Tienda</th>
      <th>Comuna cobertura</th>
    </tr>
  <?php
  foreach ($dataCollected as $p) {
    echo "<tr> <td>$p[0]</td> <td>$p[1]</td> <td>$p[2]</td> </tr>";
  }
  ?>
  </table>

<?php include('../templates/footer.html'); ?>
