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
<!-- consulta 2 -->
<h3 align="center"> Consulta 2: ¿Quieres saber los jefes de una determinada comuna? </h3>
<form align="center" action="consultas/consulta_2.php" method="post">
    Ingrese la comuna:
    <input type="text" name="tipo_elegido">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>


<br>
<br>
<!-- consulta 3 --> 

<h3 align="center"> Consulta 3: ¿Quieres saber las tiendas que venden un cierto tipo de producto? </h3>
<form align="center" action="consultas/consulta_3.php" method="post">
    Ingrese tipo producto (no comestibles, frescos, congelados, conservas):
    <input type="text" name="tipo_elegido">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>

<br>
<br>

 <!-- consulta 4 -->
 <h3 align="center"> Consulta 4: ¿Quieres saber los usuarios que compraron al menos un producto de una determinada descripción? </h3>
<form align="center" action="consultas/consulta_4.php" method="post">
    Ingrese la descripcion:
    <input type="text" name="tipo_elegido">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>



<br>
<br>

<!-- consulta 5 -->

<h3 align="center"> Consulta 5: ¿Quieres saber el promedio de edad del personal de cada tienda de una cierta comuna? </h3>
<form align="center" action="consultas/consulta_5.php" method="post">
    Ingrese comuna:
    <select>
      <option value='santiago'>Santiago</option>
      <option value='la ligua'>La Ligua</option>
      <option value='coquimbo'>Coquimbo</option>
      <option value='punta arenas'>Punta Arenas</option>
      <option value='arica'>Arica</option>
      <option value='providencia'>Providencia</option>
      <option value='la serena'>La Serena</option>
      <option value='san joaquin'>San Joaquin</option>
      <option value='buin'>Buin</option>
      <option value='valparaiso'>Valparaiso</option>
    </select>
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>

<br>
<br>

<!-- consulta 6 -->

<h3 align="center"> Consulta 6: ¿Quieres saber las tiendas que han registrado la mayor cantidad de ventas de productos de un determinado tipo ? </h3>
<form align="center" action="consultas/consulta_6.php" method="post">
    Ingrese tipo de producto:
    <input type="text" name="tipo_elegido">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>

</body>
</html>

<!--<h3 align="center"> Consulta 5: ¿Quieres saber el promedio de edad del personal de cada tienda de una cierta comuna? </h3>
<form align="center" action="consultas/consulta_5.php" method="post">
    Ingrese comuna:
    <input type="text" name="comuna_elegida">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form> -->