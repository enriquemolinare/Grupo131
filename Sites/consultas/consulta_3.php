<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $tipo_producto_elegido = strtolower($_POST["tipo_elegido"]);
  if ($tipo_producto_elegido == "no comestibles"){
    $tipo_producto_elegido = "no_comestibles";
    $query = "SELECT tiendas.id, tiendas.nombre, CONCAT(direcciones.dirección, ', ', comunas.comuna) AS direccion FROM tiendas, productos_tienda, $tipo_producto_elegido, direcciones, comunas WHERE tiendas.id = productos_tienda.tienda_id AND productos_tienda.producto_id = $tipo_producto_elegido.producto_id AND tiendas.direccion_id = direcciones.id AND direcciones.comuna_id = comunas.id GROUP BY tiendas.id, direcciones.dirección, comunas.comuna ORDER BY tiendas.id ASC;";
	  $result = $db -> prepare($query);
	  $result -> execute();
	  $dataCollected = $result -> fetchAll();
  }
  elseif ($tipo_producto_elegido == "comestibles"){
    $query = "SELECT tiendas.id, tiendas.nombre, CONCAT(direcciones.dirección, ', ', comunas.comuna) AS direccion FROM (SELECT productos.id AS producto_id, productos.nombre FROM productos, frescos, congelados, conservas WHERE productos.id = frescos.producto_id OR productos.id = congelados.producto_id OR productos.id = conservas.producto_id GROUP BY productos.id ORDER BY productos.id ASC) AS comestibles, tiendas, productos_tienda, direcciones, comunas WHERE tiendas.id = productos_tienda.producto_id AND productos_tienda.producto_id = comestibles.producto_id AND tiendas.direccion_id = direcciones.id AND direcciones.comuna_id = comunas.id GROUP BY tiendas.id, direcciones.dirección, comunas.comuna ORDER BY tiendas.id ASC;";
	  $result = $db -> prepare($query);
	  $result -> execute();
	  $dataCollected = $result -> fetchAll();
  }

  elseif ($tipo_producto_elegido == "comestibles frescos"){
    $tipo_producto_elegido = "frescos";
    $query = "SELECT tiendas.id, tiendas.nombre, CONCAT(direcciones.dirección, ', ', comunas.comuna) AS direccion FROM tiendas, productos_tienda, $tipo_producto_elegido, direcciones, comunas WHERE tiendas.id = productos_tienda.tienda_id AND productos_tienda.producto_id = $tipo_producto_elegido.producto_id AND tiendas.direccion_id = direcciones.id AND direcciones.comuna_id = comunas.id GROUP BY tiendas.id, direcciones.dirección, comunas.comuna ORDER BY tiendas.id ASC;";
	  $result = $db -> prepare($query);
	  $result -> execute();
	  $dataCollected = $result -> fetchAll();
  }

  elseif ($tipo_producto_elegido == "comestibles congelados"){
    $tipo_producto_elegido = "congelados";
    $query = "SELECT tiendas.id, tiendas.nombre, CONCAT(direcciones.dirección, ', ', comunas.comuna) AS direccion FROM tiendas, productos_tienda, $tipo_producto_elegido, direcciones, comunas WHERE tiendas.id = productos_tienda.tienda_id AND productos_tienda.producto_id = $tipo_producto_elegido.producto_id AND tiendas.direccion_id = direcciones.id AND direcciones.comuna_id = comunas.id GROUP BY tiendas.id, direcciones.dirección, comunas.comuna ORDER BY tiendas.id ASC;";
	  $result = $db -> prepare($query);
	  $result -> execute();
	  $dataCollected = $result -> fetchAll();
  }

  elseif ($tipo_producto_elegido == "comestibles en conserva"){
    $tipo_producto_elegido = "conservas";
    $query = "SELECT tiendas.id, tiendas.nombre, CONCAT(direcciones.dirección, ', ', comunas.comuna) AS direccion FROM tiendas, productos_tienda, $tipo_producto_elegido, direcciones, comunas WHERE tiendas.id = productos_tienda.tienda_id AND productos_tienda.producto_id = $tipo_producto_elegido.producto_id AND tiendas.direccion_id = direcciones.id AND direcciones.comuna_id = comunas.id GROUP BY tiendas.id, direcciones.dirección, comunas.comuna ORDER BY tiendas.id ASC;";
	  $result = $db -> prepare($query);
	  $result -> execute();
	  $dataCollected = $result -> fetchAll();
  }
  
  ?>

	<table class="center">
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
