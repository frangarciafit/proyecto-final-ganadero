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
    <p>Modificando datos</p>
  </nav>

  <section class="formulario">
    <form action="" id="forminsert" method="">
      <?php $datas = obtenerAnimal($id); ?>
<<<<<<< HEAD
=======

>>>>>>> 7c4329527a3dc727de5befc7106eee7b09ccaeaf
      <ul>
        <li>
          <label for="">Caravana propia</label>
          <input type="text" id="caravanaPropia" name="txtCaravanaPropia" value="<?php echo $datas->caravanaPropia; ?>" min="0" required>
        </li>
        <li>
          <label for="">Caravana ajena</label>
          <input type="text" name="txtCaravanaAjena" value="<?php echo $datas->caravanaAjena; ?>" min="0" placeholder="Opcional">
        </li>
        <li>
          <label for="">Raza</label>
          <input type="text" id="txtRaza" name="txtRaza" value="<?php echo $datas->raza; ?>" required>
        </li>
        <li>
          <label for="">Nacimiento</label>
          <input type="date" name="datNacimiento" value="<?php echo $datas->nacimiento ?>" id="datNacimiento" required>
        </li>
        <li>
          <label for="">Fecha ingreso</label>
          <input type="date" name="datFecha" value="<?php echo $datas->fecha ?>" required>
        </li>
        <li>
          <label for="">Color</label>
          <input type="text" name="txtColor" value="<?php echo $datas->color ?>" id="txtColor" required>
        </li>
        <li>
          <label for="">Sexo</label>
          <select name="selSexo" id="selSexo" required>
            <option <?php echo ($datas->sexo == "macho") ? 'selected' : '' ?> value="macho">Macho</option>
            <option <?php echo ($datas->sexo == "hembra") ? 'selected' : '' ?> value="hembra" selected>Hembra</option>
          </select>
        </li>
      </ul>


      <table class="table_pesos">
        <thead>
          <tr>
            <th>Peso</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($datas->pesos as $p) { ?>
            <tr>
              <td class="peso"><?php echo $p->peso ?></td>
              <td>
                
                <a href="javascript:void(0)" onclick="remove_element(this)">Eliminar</a>

              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
<<<<<<< HEAD
     
      <input class="enviar1" onclick="guardar_elemento(<?php echo $id; ?>)" type="submit" name="subModificar" id="subModificar">

=======

      <table class="table_lugares">
        <thead>
          <tr>
            <th>Lugar</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($datas->lugares as $l) { ?>
            <tr>
              <td class="lugar"><?php echo $l->lugar ?></td>
              <td>
                
                <a href="javascript:void(0)" onclick="remove_element(this)">Eliminar</a>

              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

      <input class="enviar1" onclick="guardar_elemento(<?php echo $id; ?>)" type="submit" name="subModificar" id="subModificar">
>>>>>>> 7c4329527a3dc727de5befc7106eee7b09ccaeaf
    </form>
  </section>
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script type="text/javascript">
  function remove_element(e){
    $(e).parent().parent().remove();
  }

  function guardar_elemento(id) {
    var lugares = new Array();
    var pesos = new Array();
    var raza = $("#txtRaza").val();

    $(".table_lugares tbody tr").each(function(i, e){
      var lugar = $(e).find(".lugar").text();
      lugares.push({
        "lugar": lugar,
      });
    });

    $(".table_pesos tbody tr").each(function(i, e){
      var peso = $(e).find(".peso").text();
      pesos.push({
        "peso": peso,
      });
    });

    $.ajax({
      "url": "../funciones.php",
      "type": "post",
      "dataType": "json",
      "data": {
        "id": id,
        "funcion": "modificar_campo",
        "lugares": lugares,
        "pesos": pesos,
        "raza": raza,
      },
      success: function(r) {
        if (r.error == 0) {
          console.log("Exitoso")
        }
      },
    });
  }

</script>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script type="text/javascript">

  function remove_element(e){
    $(e).parent().parent().remove();
  }

  function guardar_elemento(id) {
    var lugares = new Array();
    var pesos = new Array();
    var raza = $("#txtRaza").val();

    $(".table_lugares tbody tr").each(function(i, e){
      var lugar = $(e).find(".lugar").text();
      lugares.push({
        "lugar": lugar,
      });
    });

    $(".table_pesos tbody tr").each(function(i, e){
      var peso = $(e).find(".peso").text();
      pesos.push({
        "peso": peso,
      });
    });

    $.ajax({
      "url": "../funciones.php",
      "type": "post",
      "dataType": "json",
      "data": {
        "id": id,
        "funcion": "modificar_campo",
        "lugares": lugares,
        "pesos": pesos,
        "raza": raza,
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