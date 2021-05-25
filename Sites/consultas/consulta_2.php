<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $tipo_comuna_elegido = $_POST["tipo_elegido"];
  
  $query = "SELECT personal.nombre, comunas.comuna, tiendas.id FROM jefe_tiendas, tiendas, direcciones_tiendas, personal, direcciones, comunas WHERE jefe_tiendas.tienda_id = tiendas.id AND jefe_tiendas.personal_id = personal.id AND direcciones_tiendas.direccion_id = direcciones.id AND direcciones.comuna_id = comunas.id AND direcciones_tiendas.tienda_id = tiendas.id AND comunas.comuna = $tipo_comuna_elegido;";
	$result = $db -> prepare($query);
	$result -> execute();
	$dataCollected = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID</th>
      <th>Tienda</th>
      <th>Direccion</th>
    </tr>
  <?php
	foreach ($dataCollected as $tupla) {
  		echo "<tr> <td>$tupla[0]</td> <td>$tupla[1]</td> <td>$tupla[2]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
