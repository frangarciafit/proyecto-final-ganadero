<!DOCTYPE html>
<html>
<?php include("../funciones.php") ?>
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../css/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Ganadero</title>


  <?php

  $caravanapropia = isset($_POST["caravanapropia"]) ? $_POST["caravanapropia"] : "";
  $caravanaajena = isset($_POST["caravanaajena"]) ? $_POST["caravanaajena"] : "";
  $sexo = isset($_POST["sexo"]) ? $_POST["sexo"] : "";

  ?>
</head>

<body>


  <nav>
    <p>Consulta datos</p>
    <a href="../index.php">Volver</a>
  </nav>

  <form action="" method="post">
    <div class="buscador">
      <label for="">Caravana propia</label>
      <input type="number" value="<?php echo $caravanapropia ?>" name="caravanapropia" id="caravanapropia" min="0">

      <label for="">Caravana ajena</label>
      <input type="number" value="<?php echo $caravanaajena ?>" name="caravanaajena" id="caravanaajena" min="0">

      <label for="">Raza</label>
      <input type="text" id="raza">

      <label for="">Nacimiento</label>
      <input type="date" id="nacimiento">
      <br>
      <label for="">Peso</label>
      <input type="number" id="peso" step="0.01" min="0">

      <label for="">Color</label>
      <input type="text" id="color">

      <label for="">Lugar</label>
      <input type="text" id="lugar">

      <label for="">Sexo</label>
      <select name="sexo" id="sexo">
        <option <?php echo ($sexo == "macho") ? 'selected' : '' ?> value="macho">Macho</option>
        <option <?php echo ($sexo == "hembra") ? 'selected' : '' ?> value="hembra">Hembra</option>
        <option <?php echo ($sexo == "") ? 'selected' : '' ?> value="" >Ambos</option>
      </select>
      <button type="submit" class="enviar" id="insertar2" onclick="agregar_animal2()">Buscar</button>
    </div>
  </form>

  <div class="tabla">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Caravana Propia</th>
          <th scope="col">Caravana Ajena</th>
          <th scope="col">Raza</th>
          <th scope="col">Nacimiento</th>
          <th scope="col">Peso</th>
          <th scope="col">Color</th>
          <th scope="col">Lugar</th>
          <th scope="col">Sexo</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>


        <?php 
        $datos = cargartodo(array(
          "caravanapropia"=>$caravanapropia,
          "caravanaajena"=>$caravanaajena,
          "sexo"=>$sexo,
        )); 
        ?>
        <?php while ($data = $datos->fetch_object()) { ?>
          <tr>
            <td><?php echo $data->caravanapropia; ?></td>
            <td><?php echo $data->caravanaajena; ?></td>
            <td><?php echo $data->raza; ?></td>
            <td><?php echo $data->nacimiento; ?></td>
            <td><?php echo $data->peso; ?></td>
            <td><?php echo $data->color; ?></td>
            <td><?php echo $data->lugar; ?></td>
            <td><?php echo $data->sexo; ?></td>
            <td><i class="fa fa-pencil" aria-hidden="true"></i></td>
            <td><button data-id="<?php echo $data->caravanapropia; ?>" class="btn_eliminar espacio_right" onclick="eliminar_animal(this)"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
          </tr>
        <?php } ?>

      </tbody>
    </table>
  </div>


</body>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

<script>
  function eliminar_animal(e) {
    if(confirm("Desea eliminar el animal?")){
        let id = $(e).attr("data-id");
        console.log(id);
        eliminar_campo(id);
        $(e).parent().parent().remove();
    }
  }


  function eliminar_campo(id) {
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
          console.log("Exitoso")
        }
      },
    });

  }
</script>

</html>