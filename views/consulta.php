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

  $caravanapropia = isset($_POST["caravanapropia"]) ? $_POST["caravanapropia"] : "";
  $caravanaajena = isset($_POST["caravanaajena"]) ? $_POST["caravanaajena"] : "";
  $sexo = isset($_POST["sexo"]) ? $_POST["sexo"] : "";

  ?>
</head>

<body>


  <nav >
    <p>Consulta animal</p>
    <a href="../index.php">Volver</a>
  </nav>

    <div class="formularioconsulta">
  <form action="" method="post">
    <div class="buscador">
      <div class="alinear">
        <label for="">Caravana propia</label>
        <input type="number" value="<?php echo $caravanapropia ?>" name="caravanapropia" id="caravanapropia" min="0">
  
        <label for="">Caravana ajena</label>
        <input type="number" value="<?php echo $caravanaajena ?>" name="caravanaajena" id="caravanaajena" min="0">
  
        <label for="">Raza</label>
        <input type="text" id="raza">
  
        <label for="">Nacimiento</label>
        <input type="date" id="nacimiento">
      </div>
      <div class="alinear">
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
    </div>
  </form>


  <div class="tabla">
    <table class="table">
      <thead>
        <tr>
          <th class="normal">Caravana Propia</th>
          <th class="normal">Caravana Ajena</th>
          <th class="grande">Raza</th>
          <th class="normal">Nacimiento</th>
          <th class="normal">Peso</th>
          <th class="normal">Color</th>
          <th class="grande">Lugar</th>
          <th class="normal">Sexo</th>
          <th class="chico"></th>
          <th class="chico"></th>
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
            <td class="grande"><?php echo $data->caravanapropia; ?></td>
            <td class="grande"><?php echo $data->caravanaajena; ?></td>
            <td class="normal"><?php echo $data->raza; ?></td>
            <td class="grande"><?php echo $data->nacimiento; ?></td>
            <td class="normal"><?php echo $data->peso; ?></td>
            <td class="normal"><?php echo $data->color; ?></td>
            <td class="normal"><?php echo $data->lugar; ?></td>
            <td class="normal"><?php echo $data->sexo; ?></td>
            <td class="chico"><button><i class="fa fa-pencil" aria-hidden="true"></i></button></td>
            <td class="chico"><button data-id="<?php echo $data->caravanapropia; ?>" class="btn_eliminar espacio_right" onclick="eliminar_animal(this)"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
          </tr>
        <?php } ?>

      </tbody>
    </table>
  </div>
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