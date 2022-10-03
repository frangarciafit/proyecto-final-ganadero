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
    <p>Nuevas pesadas</p>
  </nav>

  <?php $datas = cambioPeso($id); ?>
  <section class="formulario">
    <form action="" id="forminsert" method="">
      <ul>
        <li>
          <label for="">Fecha</label>
          <input type="date" name="datFecha" id="datFecha" required>
        </li>
        <li>
          <label for="">Peso</label>
          <input type="number" name="numPeso" id="numPeso" required>
        </li>
      </ul>
      <input class="enviar1" onclick="guardar_elemento(<?php echo $id; ?>)" type="submit" name="subPesada" id="subPesada">
    </form>

    <div class="tabla tablasLugares">
      <table class="table_lugares">
        <thead>
          <tr>
            <th>Peso</th>
            <th>Fecha</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0; ?>
          <?php foreach ($datas->pesos as $p) { ?>
            <tr>
              <td class="peso"><?php echo $p->peso ?></td>
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
      var pesos = new Array();
      var fechas = new Array();
      let nuevoPeso = $("#numPeso").val();
      let nuevaFecha = $("#datFecha").val();

      $(".table_lugares tbody tr").each(function(i, e) {
        var peso = $(e).find(".peso").text();
        var fecha = $(e).find(".fecha").date();
        pesos.push({
          "peso": peso,
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
          "funcion": "cambioPesos",
          "pesos": pesos,
          "fechas": fechas,
          "peso": nuevoPeso,
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