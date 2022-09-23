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
    <p>Agregar animal</p>
    <a href="../index.php">Volver</a>
  </nav>

  <section class="formulario">
    <form action="" id="forminsert" method="post">
      <ul>
        <li>
          <label for="">Caravana propia</label>
          <input type="text" name="txtCaravanaPropia"  min="0" required>
        </li>
        <li>
          <label for="">Caravana ajena</label>
          <input type="text" name="txtCaravanaAjena" min="0" placeholder="Opcional">
        </li>
        <li>
          <label for="">Raza</label>
          <input type="text" name="txtRaza" required>
        </li>
        <li>
          <label for="">Nacimiento</label>
          <input type="date" name="datNacimiento" id="datNacimiento" required>
        </li>
        <li>
          <label for="">Peso</label>
          <input type="number" name="numPeso" id="numPeso" step="0.01" min="0" required>
        </li>
        <li>
          <label for="">Fecha ingreso</label>
          <input type="date" name="datFecha" required>
        </li>
        <li>
          <label for="">Color</label>
          <input type="text" name="txtColor" id="txtColor" required>
        </li>
        <li>
          <label for="">Lugar</label>
          <input type="text" name="txtLugar" id="txtLugar" required>
        </li>
        <li>
          <label for="">Sexo</label>
          <select name="selSexo" id="selSexo" required>
            <option value="macho">Macho</option>
            <option value="hembra" selected>Hembra</option>
          </select>
        </li>
      </ul>
      <input class="enviar1" type="submit" name="subAgregar" id="subAgregar" >
    </form>
  </section>

</body>

</html>