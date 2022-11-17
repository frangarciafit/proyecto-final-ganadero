<!DOCTYPE html>
<html>

<?php include("../funciones.php") ?>

<head>
  <?php
  if (!isset($_COOKIE["usuarioLogeado"]) || empty($_COOKIE["usuarioLogeado"])) {
    header("Location: ../login.php");
    exit;
  }
  ?>

  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@200&family=Splash&family=Trispace:wght@200&display=swap" rel="stylesheet">
  <title>Ganadero</title>


  <?php
  $caravanaPropia = isset($_POST["txtCaravanaPropia"]) ? $_POST["txtCaravanaPropia"] : "";
  $caravanaAjena = isset($_POST["txtCaravanaAjena"]) ? $_POST["txtCaravanaAjena"] : "";
  $sexo = isset($_POST["selSexo"]) ? $_POST["selSexo"] : "";
  $color = isset($_POST['txtColor']) ? $_POST["txtColor"] : "";
  $raza = isset($_POST['txtRaza']) ? $_POST["txtRaza"] : "";
  $peso = isset($_POST['selPeso']) ? $_POST["selPeso"] : "";
  $nacimiento = isset($_POST['datNacimiento']) ? $_POST["datNacimiento"] : "";
  $lugar = isset($_POST['txtLugar']) ? $_POST["txtLugar"] : "";
  $estado = isset($_POST["selEstado"]) ? $_POST["selEstado"] : "";
  ?>

</head>

<body>


  <nav>
    <p>Consulta animal</p>
    <a href="../index.php">Volver</a>
  </nav>

  <div class="formularioconsulta">
    <form action="" method="post">
      <div class="buscador">
        <div class="alinear">
          <label for="">Caravana propia</label>
          <input type="text" value="<?php echo $caravanaPropia ?>" name="txtCaravanaPropia" id="txtCaravanaPropia" min="0">

          <label for="">Caravana ajena</label>
          <input type="text" value="<?php echo $caravanaAjena ?>" name="txtCaravanaAjena" id="txtCaravanaAjena" min="0">

          <label for="">Raza</label>
          <input type="text" value="<?php echo $raza ?>" name="txtRaza" id="txtRaza">

          <label for="">Nacimiento</label>
          <input type="date" value="<?php echo $nacimiento ?>" name="datNacimiento" id="datNacimiento">
        </div>
        <div class="alinear">
          <label for="">Peso</label>
          <select name="selPeso" id="selPeso">
            <option <?php echo ($peso == "<200") ? 'selected' : '' ?> value="<200">200 o menos</option>
            <option <?php echo ($peso == "200-300") ? 'selected' : '' ?> value="200-300">200-300</option>
            <option <?php echo ($peso == "300-400") ? 'selected' : '' ?> value="300-400">300-400</option>
            <option <?php echo ($peso == "400-500") ? 'selected' : '' ?> value="400-500">400-500</option>
            <option <?php echo ($peso == "500-600") ? 'selected' : '' ?> value="500-600">500-600</option>
            <option <?php echo ($peso == ">600") ? 'selected' : '' ?> value=">600">600 o más</option>
            <option <?php echo ($peso == "") ? 'selected' : '' ?> value="">Todos</option>
          </select>

          <label for="">Color</label>
          <input type="text" value="<?php echo $color ?>" name="txtColor" id="txtColor">

          <label for="">Lugar</label>
          <input type="text" value="<?php echo $lugar ?>" name="txtLugar" id="txtLugar">

          <label for="">Sexo</label>
          <select name="selSexo" id="selSexo">
            <option <?php echo ($sexo == "macho") ? 'selected' : '' ?> value="macho">Macho</option>
            <option <?php echo ($sexo == "hembra") ? 'selected' : '' ?> value="hembra">Hembra</option>
            <option <?php echo ($sexo == "") ? 'selected' : '' ?> value="">Ambos</option>
          </select>
        </div>

        <div class="alinear alinearestado">
          <label for="">Estado</label>
          <select name="selEstado" id="selEstado">
            <option <?php echo ($estado == "") ? 'selected' : '' ?> value="">Activo</option>
            <option <?php echo ($estado == "eliminada") ? 'selected' : '' ?> value="eliminada">Eliminada</option>
          </select>

          <button type="submit" class="enviar" id="insertar" onclick="cargarTodo()">Filtrar</button>
        </div>
      </div>
    </form>

    <div class="exportar" id="menu">
      <ul>
        <li><a href="">Exportar</a>
          <ul>
            <li><a target="_blank" href="/exportar.php?estado=0"> Activos</a></li>
            <li><a target="_blank" href="/exportar.php?estado=1"> Inactivos</a></li>
          </ul>
        </li>
      </ul>
    </div>

    <div id="tabla" class="tabla">
      <table class="table">
        <thead>
          <tr>
            <th class="normal">Caravana Propia</th>
            <!-- <th class="normal">Caravana Ajena</th>
            <th class="normal">Nacimiento</th> -->
            <th class="grande">Raza</th>
            <th class="normal">Peso</th>
            <th class="normal">Color</th>
            <th class="grande">Lugar</th>
            <th class="normal">Sexo</th>
            <th class="chico"></th>
            <th class="chico"></th>
            <th class="chico"></th>
            <th class="chico"></th>
            <th class="chico"></th>
            <th class="chico"></th>
            <th class="chico"></th>
          </tr>
        </thead>
        <tbody>

          <?php
          $datos = cargarTodo(array(
            "caravanaPropia" => $caravanaPropia,
            "caravanaAjena" => $caravanaAjena,
            "sexo" => $sexo,
            "color" => $color,
            "raza" => $raza,
            "peso" => $peso,
            "nacimiento" => $nacimiento,
            "lugar" => $lugar,
          ));
          ?>
          <?php foreach ($datos as $data) { ?>
            <?php if ($estado == '') { ?>
              <?php if ($data->eliminada == 0) { ?>
                <tr>
                  <td class="grande"><?php echo $data->caravanaPropia; ?></td>
                  <td class="normal"><?php echo $data->raza; ?></td>
                  <td class="normal"><?php echo $data->peso; ?></td>
                  <td class="normal"><?php echo $data->color; ?></td>
                  <td class="normal"><?php echo $data->lugar; ?></td>
                  <td class="normal"><?php echo $data->sexo; ?></td>
                  <td class="chico"><a href="./mostrarTodo.php?id=<?php echo $data->caravanaPropia ?> " target="_blank"><i class="fa fa-plus icons" aria-hidden="true"></i></a></td>
                  <td class="chico"><a href="./peso.php?id=<?php echo $data->caravanaPropia ?> " target="_blank"><i class="fa fa-balance-scale icons" aria-hidden="true"></i></a></td>
                  <td class="chico"><a href="./vacunas.php?id=<?php echo $data->caravanaPropia ?> " target="_blank"><i class="fa fa-eyedropper icons" aria-hidden="true"></i></a></td>
                  <td class="chico"><a href="./enfermedades.php?id=<?php echo $data->caravanaPropia ?> " target="_blank"><i class="fa fa-user-md icons" aria-hidden="true"></i></a></td>
                  <td class="chico"><a href="./lugar.php?id=<?php echo $data->caravanaPropia ?> " target="_blank"><i class="fa fa-home icons" aria-hidden="true"></i></a></td>
                  <td class="chico"><a href="./modificar.php?id=<?php echo $data->caravanaPropia ?> " target="_blank"><i class="fa fa-pencil-square-o icons" aria-hidden="true"></i></a></td>
                  <td class="chico"><button data-id="'<?php echo $data->caravanaPropia; ?>'" onclick="eliminarAnimal(this)"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                </tr>
              <?php } ?>
            <?php } else { ?>
              <?php if ($data->eliminada == 1) { ?>
                <tr>
                  <td class="grande"><?php echo $data->caravanaPropia; ?></td>
                  <td class="grande"><?php echo $data->raza; ?></td>
                  <td class="normal"><?php echo $data->peso; ?></td>
                  <td class="grande"><?php echo $data->color; ?></td>
                  <td class="grande"><?php echo $data->lugar; ?></td>
                  <td class="grande"><?php echo $data->sexo; ?></td>
                  <td class="normal"><a href="./mostrarTodo.php?id=<?php echo $data->caravanaPropia ?> " target="_blank"><i class="fa fa-plus icons" aria-hidden="true"></i></a></td>
                  <td class="normal"><button data-id="'<?php echo $data->caravanaPropia; ?>'" onclick="eliminarDefinitivo(this)"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                </tr>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
  <script>
    function eliminarAnimal(e) {
      if (confirm("DESEA ELIMINAR AL ANIMAL?")) {
        let id = $(e).attr("data-id");
        console.log(id);
        eliminarCampo(id);
        $(e).parent().parent().remove();
      }
    }

    function eliminarDefinitivo(e) {
      if (confirm("DESEA ELIMINAR AL ANIMAL?")) {
        let id = $(e).attr("data-id");
        console.log(id);
        eliminarCampoDefinitivo(id);
        $(e).parent().parent().remove();
      }
    }

    function eliminarCampo(id) {
      $.ajax({
        "url": "../funciones.php",
        "type": "post",
        "dataType": "json",
        "data": {
          "id": id,
          "funcion": "eliminar",
        },
        success: function(r) {
          if (r.error == 0) {}
        },
      });
    }

    function eliminarCampoDefinitivo(id) {
      $.ajax({
        "url": "../funciones.php",
        "type": "post",
        "dataType": "json",
        "data": {
          "id": id,
          "funcion": "eliminarDefinitivo",
        },
        success: function(r) {
          if (r.error == 0) {
            alert("Borrado exitoso");
          }
        },
      });
    }

    function modificarDatos() {
      let id = $(e).attr("data-id");
      $.ajax({
        "url": "../funciones.php",
        "type": "post",
        "dataType": "json",
        "data": {
          "id": id,
          "funcion": "modificar",
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