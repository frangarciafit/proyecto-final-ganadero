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

  <?php $id = isset($_GET["id"]) ? $_GET["id"] : 0; ?>
  
</head>

<body id="blur">

  <nav>
    <p>Enfermedades del animal</p>
  </nav>

  <section class="formulario">
    <form action="" id="forminsert" method="">
        <ul>
          <li>
            <label for="">Fecha </label>
            <input type="date" name="datFecha"  required>
          </li>
          <li>
            <label for="">Descripcion de la enfermedad</label>
            <textarea name="textArea" rows="10" cols="50" placeholder="Descripcion"></textarea>
          </li>
        </ul>
      <input class="enviar1" type="submit" name="subEnfermedades" id="subEnfermedades">
    </form>
  </section>

</body>
</html>