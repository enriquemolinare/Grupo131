<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $tipo_producto_elegido = $_POST["tipo_elegido"];
  
  $query = "SELECT tiendas.id, tiendas.nombre AS nombre_tienda FROM tiendas, productos_tienda, $tipo_producto_elegido WHERE tiendas.id = productos_tienda.tienda_id AND productos_tienda.producto_id = $tipo_producto_elegido.producto_id GROUP BY tiendas.id ORDER BY tiendas.id ASC;";
	$result = $db -> prepare($query);
	$result -> execute();
	$dataCollected = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID</th>
      <th>Tienda</th>
    </tr>
  <?php
	foreach ($dataCollected as $tupla) {
  		echo "<tr> <td>$tupla[0]</td> <td>$tupla[1]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
