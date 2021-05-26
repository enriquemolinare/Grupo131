<?php include('../templates/header.html');   ?>

<body>

  <?php
  #SELECT todas_tiendas.producto_id, productos.nombre, todas_tiendas.tienda_id, tiendas.nombre FROM productos, tiendas, ( SELECT tiendas_1.tienda_id AS tiendas_no_maximas, tiendas_1.producto_id AS producto_id FROM (SELECT tiendas.id AS tienda_id, productos.id AS producto_id, SUM(producto_por_compra.cantidad) AS Cantidad_Ventas FROM (SELECT productos.id AS producto_id, productos.nombre FROM productos, frescos, congelados, conservas WHERE productos.id = frescos.producto_id OR productos.id = congelados.producto_id OR productos.id = conservas.producto_id GROUP BY productos.id ORDER BY productos.id ASC) AS comestibles, producto_por_compra, compras, tiendas, productos WHERE comestibles.producto_id = producto_por_compra.producto_id AND compras.id = producto_por_compra.compra_id AND compras.tienda_id = tiendas.id AND comestibles.producto_id = productos.id  GROUP BY productos.id, tiendas.id ORDER BY productos.id) AS tiendas_1, (SELECT tiendas.id AS tienda_id, productos.id AS producto_id, SUM(producto_por_compra.cantidad) AS Cantidad_Ventas FROM (SELECT productos.id AS producto_id, productos.nombre FROM productos, frescos, congelados, conservas WHERE productos.id = frescos.producto_id OR productos.id = congelados.producto_id OR productos.id = conservas.producto_id GROUP BY productos.id ORDER BY productos.id ASC) AS comestibles, producto_por_compra, compras, tiendas, productos WHERE comestibles.producto_id = producto_por_compra.producto_id AND compras.id = producto_por_compra.compra_id AND compras.tienda_id = tiendas.id AND comestibles.producto_id = productos.id GROUP BY productos.id, tiendas.id ORDER BY productos.id)  AS tiendas_2 WHERE  tiendas_1.cantidad_ventas  <  tiendas_2.cantidad_ventas  AND tiendas_1.producto_id = tiendas_2.producto_id) AS tiendas_menores, (SELECT tiendas.id AS tienda_id, productos.id AS producto_id, SUM(producto_por_compra.cantidad) AS Cantidad_Ventas FROM (SELECT productos.id AS producto_id, productos.nombre FROM productos, frescos, congelados, conservas WHERE productos.id = frescos.producto_id OR productos.id = congelados.producto_id OR productos.id = conservas.producto_id GROUP BY productos.id ORDER BY productos.id ASC) AS comestibles, producto_por_compra, compras, tiendas, productos WHERE comestibles.producto_id = producto_por_compra.producto_id AND compras.id = producto_por_compra.compra_id AND compras.tienda_id = tiendas.id AND comestibles.producto_id = productos.id GROUP BY productos.id, tiendas.id ORDER BY productos.id) AS todas_tiendas,(SELECT tiendas.producto_id AS producto_id, MAX(tiendas.cantidad_ventas) AS cantidad_maxima FROM (SELECT tiendas.id AS tienda_id, productos.id AS producto_id, SUM(producto_por_compra.cantidad) AS Cantidad_Ventas FROM (SELECT productos.id AS producto_id, productos.nombre FROM productos, frescos, congelados, conservas WHERE productos.id = frescos.producto_id OR productos.id = congelados.producto_id OR productos.id = conservas.producto_id GROUP BY productos.id ORDER BY productos.id ASC) AS comestibles, producto_por_compra, compras, tiendas, productos WHERE comestibles.producto_id = producto_por_compra.producto_id AND compras.id = producto_por_compra.compra_id AND compras.tienda_id = tiendas.id AND comestibles.producto_id = productos.id GROUP BY productos.id, tiendas.id ORDER BY productos.id) AS tiendas GROUP BY tiendas.producto_id) AS cantidades_maximas WHERE tiendas_menores.producto_id = todas_tiendas.producto_id AND cantidades_maximas.cantidad_maxima = todas_tiendas.cantidad_Ventas AND cantidades_maximas.producto_id = todas_tiendas.producto_id  AND productos.id = cantidades_maximas.producto_id AND tiendas.id = todas_tiendas.tienda_id GROUP BY todas_tiendas.producto_id, productos.nombre, todas_tiendas.tienda_id, tiendas.nombre;

  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $tipo_producto_elegido = strtolower($_POST["tipo_elegido"]);
  if ($tipo_producto_elegido == "no comestible") {
    $query = "SELECT tiendas.id AS id , tiendas.nombre, SUM(producto_por_compra.cantidad) AS Cantidad_Ventas FROM no_comestibles, producto_por_compra, compras, tiendas, productos WHERE no_comestibles.producto_id = producto_por_compra.producto_id AND compras.id = producto_por_compra.compra_id AND compras.tienda_id = tiendas.id AND no_comestibles.producto_id = productos.id GROUP BY tiendas.id ORDER BY cantidad_ventas desc LIMIT 5;";
	  $result = $db -> prepare($query);
	  $result -> execute();
	  $dataCollected = $result -> fetchAll();
  } 
  elseif ($tipo_producto_elegido == 'comestible') {
    $query = "SELECT tiendas.id AS id , tiendas.nombre, SUM(producto_por_compra.cantidad) AS Cantidad_Ventas FROM  producto_por_compra, compras, tiendas, productos, (SELECT productos.id AS producto_id, productos.nombre FROM productos, frescos, congelados, conservas WHERE productos.id = frescos.producto_id OR productos.id = congelados.producto_id OR productos.id = conservas.producto_id GROUP BY productos.id ORDER BY productos.id ASC) AS comestibles WHERE comestibles.producto_id = producto_por_compra.producto_id AND compras.id = producto_por_compra.compra_id AND compras.tienda_id = tiendas.id AND comestibles.producto_id = productos.id  GROUP BY tiendas.id ORDER BY cantidad_ventas desc LIMIT 5;";
	  $result = $db -> prepare($query);
	  $result -> execute();
	  $dataCollected = $result -> fetchAll();
  }
  elseif ($tipo_producto_elegido == "comestibles frescos"){
    $tipo_producto_elegido = "frescos";
    $query = "SELECT tiendas.id AS id , tiendas.nombre, SUM(producto_por_compra.cantidad) AS Cantidad_Ventas FROM frescos, producto_por_compra, compras, tiendas, productos WHERE frescos.producto_id = producto_por_compra.producto_id AND compras.id = producto_por_compra.compra_id AND compras.tienda_id = tiendas.id AND frescos.producto_id = productos.id GROUP BY tiendas.id ORDER BY cantidad_ventas desc LIMIT 5;";
	  $result = $db -> prepare($query);
	  $result -> execute();
	  $dataCollected = $result -> fetchAll();
  }

  elseif ($tipo_producto_elegido == "comestibles congelados"){
    $tipo_producto_elegido = "congelados";
    $query = "SELECT tiendas.id AS id , tiendas.nombre, SUM(producto_por_compra.cantidad) AS Cantidad_Ventas FROM congelados, producto_por_compra, compras, tiendas, productos WHERE congelados.producto_id = producto_por_compra.producto_id AND compras.id = producto_por_compra.compra_id AND compras.tienda_id = tiendas.id AND congelados.producto_id = productos.id GROUP BY tiendas.id ORDER BY cantidad_ventas desc LIMIT 5;";
	  $result = $db -> prepare($query);
	  $result -> execute();
	  $dataCollected = $result -> fetchAll();
  }

  elseif ($tipo_producto_elegido == "comestibles en conserva"){
    $tipo_producto_elegido = "conservas";
    $query = "SELECT tiendas.id AS id , tiendas.nombre, SUM(producto_por_compra.cantidad) AS Cantidad_Ventas FROM conservas, producto_por_compra, compras, tiendas, productos WHERE conservas.producto_id = producto_por_compra.producto_id AND compras.id = producto_por_compra.compra_id AND compras.tienda_id = tiendas.id AND conservas.producto_id = productos.id GROUP BY tiendas.id ORDER BY cantidad_ventas desc LIMIT 5;";
	  $result = $db -> prepare($query);
	  $result -> execute();
	  $dataCollected = $result -> fetchAll();
  }
  ?>

	<table>
    <tr>
      <th>Tienda_id</th>
      <th>Tienda_nombre</th>
      <th>Cantidad Vendida</th>
    </tr>
  <?php
	foreach ($dataCollected as $tupla) {
  		echo "<tr> <td>$tupla[0]</td> <td>$tupla[1]</td> <td>$tupla[2]</td> </tr>";
	}
  ?>
	</table>


<?php include('../templates/footer.html'); ?>
