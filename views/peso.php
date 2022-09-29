<!DOCTYPE html>
<html>
<?php include("../funciones.php") ?>

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../css/index.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@200&family=Splash&family=Trispace:wght@200&display=swap" rel="stylesheet">

  <title>Ganadero</title>

</head>

<body id="blur">

  <nav>
    <p>Pesado del animal</p>
  </nav>

  <section class="formulario">
    <form action="" id="forminsert" method="">
        <ul>
          <li>
            <label for="">Fecha de pesado</label>
            <input type="date" name="datFecha"  required>
          </li>
          <li>
          <label for="">Peso</label>
          <input type="number" name="numPeso" id="numPeso" step="0.01" min="100" max="9999" required>
        </li>
        </ul>
      <input class="enviar1" type="submit" name="subPeso" id="subPeso">
    </form>
  </section>

</body>
</html>