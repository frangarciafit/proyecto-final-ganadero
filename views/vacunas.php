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
    <p>Vacunacion</p>
  </nav>

  <?php $datas = obtenerLugar($id); ?>
  <section class="formulario">
    <form action="" id="forminsert" method="">
      <ul>
      <li>
          <label for="">Vacuna</label>
          <input type="text" name="txtVacuna" id="txtVacuna" required>
        </li>
        <li>
          <label for="">Fecha de vacunacion</label>
          <input type="date" name="datFecha" id="datFecha" required>
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
      <input class="enviar1" onclick="guardar_elemento(<?php echo $id; ?>)" type="submit" name="subVacunas" id="subVacunas">
    </form>

    <div class="tabla tablasLugares">
      <table class="table_lugares">
        <thead>
          <tr>
            <th>Vacuna</th>
            <th>Fecha</th>
            <th>Droga</th>
            <th>Obligatoria</th>
            <th>Descripcion</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0; ?>
          <?php foreach ($datas->vacunas as $v) { ?>
            <tr>
              <td class="vacuna"><?php echo $v->vacuna ?></td>
              <td class="fecha"><?php echo $datas->fechas[$i]->fecha ?></td>
              <td class="droga"><?php echo $datas->drogas[$i]->droga ?></td>
              <td class="obligatoria"><?php echo $datas->obligatorias[$i]->obligatoria ?></td>
              <td class="descripcion"><?php echo $datas->descripciones[$i]->descripcion ?></td>
              <td>
                <a href="javascript:void(0)" onclick="remove_element(this)">Eliminar</a>
              </td>
            </tr>
            <?php $i++; ?>
          <?php } ?>
        </tbody>
      </table>
    </div>


  </section>
</body>
</html>