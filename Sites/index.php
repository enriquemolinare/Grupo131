<?php include('templates/header.html'); ?>

<body>
<h1 align="center">Entrega 2 </h1>
<p style="textalign:center;">Aqui podras encontrar informacion sobre el Proyecto DB</p>

<h3 align="center"> Consulta 1: Muestra tiendas junto a sus comunas de cobertura </h3>
<form align="center" action="consultas/consulta_1.php" method="get">
    <input type="submit" value="Buscar">
  </form>

<br>
<br>

<h3 align="center"> Consulta 3: ¿Quieres saber las tiendas que venden un cierto tipo de producto? </h3>
<form align="center" action="consultas/consulta_3.php" method="post">
    Ingrese tipo producto (no_comestibles, frescos, congelados, conservas):
    <input type="text" name="tipo_elegido">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>

<br>
<br>

<h3 align="center"> Consulta 5: ¿Quieres saber el promedio de edad del personal de cada tienda de una cierta comuna? </h3>
<form align="center" action="consultas/consulta_5.php" method="post">
    Ingrese comuna:
    <input type="text" name="comuna_elegida">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>

</body>
</html>