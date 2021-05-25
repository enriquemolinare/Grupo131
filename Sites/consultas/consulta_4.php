<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $tipo_descripcion_elegido = $_POST["tipo_elegido"];
  
  $query = "SELECT usuarios.nombre FROM compras, producto_por_compra, usuarios, productos WHERE usuarios.id = compras.comprador_id AND producto_por_compra.compra_id = compras.id AND  producto_por_compra.producto_id = productos.id AND productos.descripción = '$tipo_descripcion_elegido';";
	$result = $db -> prepare($query);
	$result -> execute();
	$dataCollected = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>Usuarios</th>
    </tr>
  <?php
	foreach ($dataCollected as $tupla) {
  		echo "<tr> <td>$tupla[0]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
