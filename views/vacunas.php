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
    <p>Vacunacion</p>
  </nav>

  <section class="formulario">
    <form action="" id="forminsert" method="">
      <ul>
        <li>
          <label for="">Fecha de vacunacion</label>
          <input type="date" name="datFecha" required>
        </li>
        <li>
          <label for="">Droga aplicada</label>
          <input type="text" name="txtDroga" id="txtDroga" required>
        </li>
        <li>
          <label for="">Obligatoria</label>
          <select name="selObligatoria" id="selObligatoria" required>
            <option value="si">Si</option>
            <option value="no" selected>No</option>
          </select>
        </li>
        <li>
          <label for="">Veterinario</label>
          <input type="text" name="txtVeterinario" id="txtVeterinario" required>
        </li>
        <li>
          <label for="">Descripcion de la vacunacion</label>
          <textarea name="textArea" rows="10" cols="50" placeholder="Descripcion"></textarea>
        </li>
      </ul>
      <input class="enviar1" type="submit" name="subVacuna" id="subVacuna">
    </form>
  </section>

</body>

</html>