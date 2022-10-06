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

  <?php $datas = cambioVacunas2($id); ?>
  <section class="formulario formvacunas">
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
            <option value="si">SI</option>
            <option value="no" selected>NO</option>
          </select>
        </li>
        <li>
          <label for="">Veterinario</label>
          <input type="text" name="txtVeterinario" id="txtVeterinario" required>
        </li>
        <li>
          <label for="">Descripcion</label>
          <textarea name="textArea" rows="10" cols="30" placeholder="Descripcion"></textarea>
        </li>
      </ul>
      <input class="enviar1" onclick="guardar_elemento(<?php echo $id; ?>)" type="submit" name="subVacunas" id="subVacunas">
    </form>
    
    <div class="tabla tablasLugares">
      <table class="table_lugares">
        <thead>
          <tr>
            <th class="grande">Vacuna</th>
            <th class="grande">Fecha</th>
            <th>Droga</th>
            <th>Obligatoria</th>
            <th>Veterinario</th>
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
              <td class="veterinario"><?php echo $datas->veterinarios[$i]->veterinario ?></td>
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

  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    function remove_element(e) {
      $(e).parent().parent().remove();
    }

    function guardar_elemento(id) {
      var vacunas = new Array();
      var fechas = new Array();
      var drogas = new Array();
      var obligatorias = new Array();
      var veterinarios = new Array();
      var descripciones = new Array();
      let nuevaVacuna = $("#txtVacuna").val();
      let nuevaFecha = $("#datFecha").val();
      let nuevaDroga = $("#txtDroga").val();
      let nuevoObligatoria = $("#txtObligatoria").val();
      let nuevoVeterinario = $("#txtVeterinario").val();
      let nuevaDescripcion = $("#txtDescripcion").val();

      $(".table_lugares tbody tr").each(function(i, e) {
        var vacuna = $(e).find(".vacuna").text();
        var fecha = $(e).find(".fecha").date();
        var droga = $(e).find(".droga").text();
        var obligatoria = $(e).find(".obligatoria").text();
        var veterinario = $(e).find(".veterinario").text();
        var descripcion = $(e).find(".descripcion").text();
        vacunas.push({
          "vacuna": vacuna,
        });
        fechas.push({
          "fecha": fecha,
        });
        drogas.push({
          "droga": droga,
        });
        obligatorias.push({
          "obligatoria": obligatoria,
        });
        veterinarios.push({
          "veterinario": veterinario,
        });
        descripciones.push({
          "descripcion": descripcion,
        });
      });
      $.ajax({
        "url": "../funciones.php",
        "type": "post",
        "dataType": "json",
        "data": {
          "id": id,
          "funcion": "cambioVacunas",
          "vacunas": vacunas,
          "fechas": fechas,
          "drogas": drogas,
          "obligatorias": obligatorias,
          "veterinarios": veterinarios,
          "descripciones": descripciones,
          "vacuna": nuevaVacuna,
          "fecha": nuevaFecha,
          "droga": nuevaDroga,
          "obligatoria": nuevoObligatoria,
          "veterinario": nuevoVeterinario,
          "descripcion": nuevaDescripcion,
        },
        success: function(r) {
          if (r.error == 0) {
            console.log("Exitoso")
          }
        },
      });
    }
  </script>
  <div class="vacio">

</div>
</body>
</html>