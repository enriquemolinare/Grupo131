<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $comuna_elegida = strtolower($_POST["comuna_elegida"]);
  $query = "SELECT tiendas.id, tiendas.nombre, CONCAT(direcciones.dirección, ', ', comunas.comuna) AS direccion, AVG(personal.edad) AS promedio_edad_personal FROM tiendas, direcciones_tiendas, direcciones, comunas, personal WHERE tiendas.direccion_id = direcciones.id AND direcciones.comuna_id = comunas.id AND personal.tienda_id = tiendas.id AND comunas.comuna = '$comuna_elegida' GROUP BY tiendas.id, direcciones.dirección, comunas.comuna ORDER BY tiendas.id ASC;";
	$result = $db -> prepare($query);
	$result -> execute();
	$dataCollected = $result -> fetchAll();
  ?>

	<table class="center">
    <tr>
      <th>ID</th>
      <th>Tienda</th>
      <th>Dirección</th>
      <th>Promedio edad personal</th>
    </tr>
  <?php
	foreach ($dataCollected as $tupla) {
  		echo "<tr> <td>$tupla[0]</td> <td>$tupla[1]</td> <td>$tupla[2]</td> <td>$tupla[3]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
