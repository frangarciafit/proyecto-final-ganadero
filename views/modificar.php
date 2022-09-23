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
    <p>Modificando datos</p>
  </nav>

  <section class="formulario">
    <form action="" id="forminsert" method="post">
      <?php $datos = cargarVaca() ?>
      <?php while ($data = $datos->fetch_object()) { ?>
        <ul>
          <li>
            <label for="">Caravana propia</label>
            <input type="text" name="txtCaravanaPropia" value="<?php echo $data->$caravanaPropia; ?>" min="0" required>
          </li>
          <li>
            <label for="">Caravana ajena</label>
            <input type="text" name="txtCaravanaAjena" value="<?php echo $data->$caravanaAjena; ?>" min="0" placeholder="Opcional">
          </li>
          <li>
            <label for="">Raza</label>
            <input type="text" name="txtRaza" value="<?php echo $data->$raza; ?>" required>
          </li>
          <li>
            <label for="">Nacimiento</label>
            <input type="date" name="datNacimiento" value="<?php echo $data->$nacimiento ?>" id="datNacimiento" required>
          </li>
          <li>
            <label for="">Peso</label>
            <input type="number" name="numPeso" value="<?php echo $data->$peso ?>" id="numPeso" step="0.01" min="0" required>
          </li>
          <li>
            <label for="">Fecha ingreso</label>
            <input type="date" name="datFecha" value="<?php echo $data->$fecha ?>" required>
          </li>
          <li>
            <label for="">Color</label>
            <input type="text" name="txtColor" value="<?php echo $data->$color ?>" id="txtColor" required>
          </li>
          <li>
            <label for="">Lugar</label>
            <input type="text" name="txtLugar" value="<?php echo $data->$lugar ?>" id="txtLugar" required>
          </li>
          <li>
            <label for="">Sexo</label>
            <select name="selSexo" id="selSexo" required>
              <option <?php echo ($sexo == "macho") ? 'selected' : '' ?> value="macho">Macho</option>
              <option <?php echo ($sexo == "hembra") ? 'selected' : '' ?> value="hembra" selected>Hembra</option>
            </select>
          </li>
        </ul>
      <?php } ?>
      <input class="enviar1" type="submit" name="subModificar" id="subModificar">
    </form>
  </section>

</body>

</html>