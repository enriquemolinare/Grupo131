<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $tipo_producto_elegido = $_POST["tipo_elegido"];
  if $tipo_producto_elegido == no_comestible{
  $query = "SELECT todas_tiendas.producto_id, productos.nombre, todas_tiendas.tienda_id, tiendas.nombre FROM productos, tiendas, ( SELECT tiendas_1.tienda_id AS tiendas_no_maximas, tiendas_1.producto_id AS producto_id FROM (SELECT tiendas.id AS tienda_id, productos.id AS producto_id, SUM(producto_por_compra.cantidad) AS Cantidad_Ventas FROM no_comestibles, producto_por_compra, compras, tiendas, productos WHERE no_comestibles.producto_id = producto_por_compra.producto_id AND compras.id = producto_por_compra.compra_id AND compras.tienda_id = tiendas.id AND no_comestibles.producto_id = productos.id  GROUP BY productos.id, tiendas.id ORDER BY productos.id) AS tiendas_1, (SELECT tiendas.id AS tienda_id, productos.id AS producto_id, SUM(producto_por_compra.cantidad) AS Cantidad_Ventas FROM no_comestibles, producto_por_compra, compras, tiendas, productos WHERE no_comestibles.producto_id = producto_por_compra.producto_id AND compras.id = producto_por_compra.compra_id AND compras.tienda_id = tiendas.id AND no_comestibles.producto_id = productos.id GROUP BY productos.id, tiendas.id ORDER BY productos.id)  AS tiendas_2 WHERE  tiendas_1.cantidad_ventas  <  tiendas_2.cantidad_ventas  AND tiendas_1.producto_id = tiendas_2.producto_id) AS tiendas_menores, (SELECT tiendas.id AS tienda_id, productos.id AS producto_id, SUM(producto_por_compra.cantidad) AS Cantidad_Ventas FROM no_comestibles, producto_por_compra, compras, tiendas, productos WHERE no_comestibles.producto_id = producto_por_compra.producto_id AND compras.id = producto_por_compra.compra_id AND compras.tienda_id = tiendas.id AND no_comestibles.producto_id = productos.id GROUP BY productos.id, tiendas.id ORDER BY productos.id) AS todas_tiendas,(SELECT tiendas.producto_id AS producto_id, MAX(tiendas.cantidad_ventas) AS cantidad_maxima FROM (SELECT tiendas.id AS tienda_id, productos.id AS producto_id, SUM(producto_por_compra.cantidad) AS Cantidad_Ventas FROM no_comestibles, producto_por_compra, compras, tiendas, productos WHERE no_comestibles.producto_id = producto_por_compra.producto_id AND compras.id = producto_por_compra.compra_id AND compras.tienda_id = tiendas.id AND no_comestibles.producto_id = productos.id GROUP BY productos.id, tiendas.id ORDER BY productos.id) AS tiendas GROUP BY tiendas.producto_id) AS cantidades_maximas WHERE tiendas_menores.producto_id = todas_tiendas.producto_id AND cantidades_maximas.cantidad_maxima = todas_tiendas.cantidad_Ventas AND cantidades_maximas.producto_id = todas_tiendas.producto_id  AND productos.id = cantidades_maximas.producto_id AND tiendas.id = todas_tiendas.tienda_id GROUP BY todas_tiendas.producto_id, productos.nombre, todas_tiendas.tienda_id, tiendas.nombre ;";
	$result = $db -> prepare($query);
	$result -> execute();
	$dataCollected = $result -> fetchAll();
  }elseif $tipo_producto_elegido == 'comestible'{

  }
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
