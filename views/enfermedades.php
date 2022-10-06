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
    <p>Registro de enfermedades</p>
  </nav>

  <?php $datas = registroEnfermedad($id); ?>
  <section class="formulario formEnfermedades">
    <form action="" id="forminsert" method="post">
      <ul>
        <li>
          <label for="">Fecha de registro</label>
          <input type="date" name="datFecha" id="datFecha" required>
        </li>
        <li>
          <label for="">Descripcion de la enfermedad</label>
          <input type="text" name="txtDescripcion" id="txtDescripcion" required>
        </li>
      </ul>
      <input class="enviar1" onclick="guardar_elemento(<?php echo $id; ?>)" type="submit" name="subCambio" id="subCambio">
    </form>

    <div class="tabla tablasLugares">
      <table class="table_lugares">
        <thead>
          <tr>
            <th class="grandef" >Descripcion</th>
            <th class="grandef" >Fecha</th>
            <th class="chico"></th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0; ?>
          <?php foreach ($datas->descripciones as $d) { ?>
            <tr>
              <td class="descripcion"><?php echo $d->descripcion ?></td>
              <td class="fecha"><?php echo $datas->fechas[$i]->fecha ?></td>
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
      var descripciones = new Array();
      var fechas = new Array();
      let nuevaDescrripcion = $("#txtDescripcion").val();
      let nuevaFecha = $("#datFecha").val();

      $(".table_lugares tbody tr").each(function(i, e) {
        var descripcion = $(e).find(".descripcion").text();
        var fecha = $(e).find(".fecha").date();
        descripciones.push({
          "descripcion": descripcion,
        });
        fechas.push({
          "fecha": fecha,
        });
      });
      $.ajax({
        "url": "../funciones.php",
        "type": "post",
        "dataType": "json",
        "data": {
          "id": id,
          "funcion": "registroEnfermedades",
          "descripciones": descripciones,
          "fechas": fechas,
          "descripcion": nuevaDescripcion,
          "fecha": nuevaFecha,
        },
        success: function(r) {
          if (r.error == 0) {
            console.log("Exitoso")
          }
        },
      });
    }
  </script>
</body>

</html>