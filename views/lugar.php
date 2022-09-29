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
    <p>Cambio de lugar</p>
  </nav>

  <section class="formulario">
    <form action="" id="forminsert" method="">
        <ul>
          <li>
            <label for="">Fecha de cambio</label>
            <input type="date" name="datFecha"  required>
          </li>
          <li>
            <label for="">Lugar</label>
            <input type="text" name="txtLugar" id="txtLugar" required>
          </li>

        </ul>
      <input class="enviar1" type="submit" name="subCambio" id="subCambio">
    </form>
  </section>

</body>

</html>