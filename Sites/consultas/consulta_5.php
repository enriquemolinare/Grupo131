<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #$id_nuevo = $_POST["comuna_elegida"];
  print_r($_POST);

  $comuna_elegida = $_POST["comuna_elegida"];

 	#$query = "SELECT * FROM pokemones where pid = $id_nuevo;";
  #$query = "SELECT tiendas.id, tiendas.nombre, AVG(personal.edad) AS promedio_edad_personal FROM tiendas, direcciones_tiendas, direcciones, comunas, personal WHERE tiendas.direccion_id = direcciones.id AND direcciones.comuna_id = comunas.id AND personal.tienda_id = tiendas.id AND comunas.comuna = $comuna_elegida GROUP BY tiendas.id;"
  $query = "SELECT tiendas.id, tiendas.nombre FROM tiendas WHERE tiendas.direccion_id = direcciones.id AND direcciones.comuna_id = comunas.id AND personal.tienda_id = tiendas.id AND comunas.comuna = $comuna_elegida GROUP BY tiendas.id;";
	$result = $db -> prepare($query);
	$result -> execute();
	$tiendas_y_promedios = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID</th>
      <th>Tienda</th>
      <th>Promedio edad personal</th>
    </tr>
  <?php
	foreach ($tiendas_y_promedios as $tupla) {
  		echo "<tr><td>$tupla[0]</td><td>$tupla[1]</td><td>$tupla[2]</td></tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
