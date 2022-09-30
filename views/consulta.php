<!DOCTYPE html>
<html>
<?php include("../funciones.php") ?>

<head>
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
  $peso = isset($_POST['numPeso']) ? $_POST["numPeso"] : "";
  $nacimiento = isset($_POST['datNacimiento']) ? $_POST["datNacimiento"] : "";
  $lugar = isset($_POST['txtLugar']) ? $_POST["txtLugar"] : "";
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
          <input type="number" value="<?php echo $peso ?>" name="numPeso" id="numPeso" step="0.01" min="0">

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
          <button type="submit" class="enviar" id="insertar" onclick="cargarTodo()">Buscar</button>
        </div>
      </div>
    </form>


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
          <?php while ($data = $datos->fetch_object()) { ?>
            <?php if ($data->eliminada == 0) { ?>
              <tr>
                <td class="grande"><?php echo $data->caravanaPropia; ?></td>
                <td class="normal"><?php echo $data->raza; ?></td>
                <td class="normal"><?php echo $data->peso; ?></td>
                <td class="normal"><?php echo $data->color; ?></td>
                <td class="normal"><?php echo $data->lugar; ?></td>
                <td class="normal"><?php echo $data->sexo; ?></td>
<<<<<<< HEAD
                <td class="chico"><a href="./mostrarTodo.php?id=<?php echo $data->caravanaPropia ?> " target="_blank"><i class="fa fa-plus icons" aria-hidden="true"></i></a></td>
                <td class="chico"><a href="./peso.php?id=<?php echo $data->caravanaPropia ?> " target="_blank"><i class="fa fa-balance-scale icons" aria-hidden="true"></i></a></td>
                <td class="chico"><a href="./vacunas.php?id=<?php echo $data->caravanaPropia ?> " target="_blank"><i class="fa fa-eyedropper icons" aria-hidden="true"></i></a></td>
                <td class="chico"><a href="./enfermedades.php?id=<?php echo $data->caravanaPropia ?> " target="_blank"><i class="fa fa-user-md icons" aria-hidden="true"></i></a></td>
                <td class="chico"><a href="./lugar.php?id=<?php echo $data->caravanaPropia ?> " target="_blank"><i class="fa fa-home icons" aria-hidden="true"></i></a></td>
                <td class="chico"><a href="./modificar.php?id=<?php echo $data->caravanaPropia ?> " target="_blank"><i class="fa fa-pencil-square-o icons" aria-hidden="true"></i></a></td>
=======
                <td class="chico"><a href="./mostrarTodo.php" target="_blank"><button data-id="<?php echo $data->caravanaPropia; ?>" onclick="mostrarTodo(this)"><button><i class="fa fa-plus icons" aria-hidden="true"></i></button></a></td>
                <td class="chico"><a href="./peso.php" target="_blank"><button data-id="<?php echo $data->caravanaPropia; ?>" onclick="agregarPeso(this)"><button><i class="fa fa-balance-scale icons" aria-hidden="true"></i></button></a></td>
                <td class="chico"><a href="./vacunas.php" target="_blank"><button data-id="<?php echo $data->caravanaPropia; ?>" onclick="agregarVacuna(this)"><button><i class="fa fa-eyedropper icons" aria-hidden="true"></i></button></a></td>
                <td class="chico"><a href="./enfermedades.php" target="_blank"><button data-id="<?php echo $data->caravanaPropia; ?>" onclick="agregarEnfermedad(this)"><button><i class="fa fa-user-md icons" aria-hidden="true"></i></button></a></td>
                <td class="chico"><a href="./lugar.php" target="_blank"><button data-id="<?php echo $data->caravanaPropia; ?>" onclick="cambioLugar(this)"><i class="fa fa-home icons" aria-hidden="true"></i></button></a></td>
                <td class="chico"><a href="./modificar.php?id=<?php echo $data->caravanaPropia ?> " target="_blank"><button data-id="<?php echo $data->caravanaPropia; ?>" onclick="modificarDatos(this)"><i class="fa fa-pencil-square-o icons" aria-hidden="true"></i></button></a></td>
>>>>>>> 7c4329527a3dc727de5befc7106eee7b09ccaeaf
                <td class="chico"><button data-id="<?php echo $data->caravanaPropia; ?>" onclick="eliminarAnimal(this)"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
              </tr>
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
          if (r.error == 0) {
            $("#tabla").html(r.total);
            html = `hola`;
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