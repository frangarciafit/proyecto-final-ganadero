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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@200&family=Splash&family=Trispace:wght@200&display=swap" rel="stylesheet">

  <title>Ganadero</title>

  <?php $id = isset($_GET["id"]) ? $_GET["id"] : 0; ?>

</head>

<body id="blur">

  <nav>
    <p>Modificando datos</p>
    <p>Caravana N°: <?php echo $id ?> </p>
  </nav>

  <section class="formulario">
    
    <?php $datas = obtenerAnimal($id); ?>
    <form>
      <ul>
        <li>
          <label for="">Caravana propia</label>
          <input type="text" id="caravanaPropia" disabled name="txtCaravanaPropia" value="<?php echo $datas->caravanaPropia; ?>" min="0" required>
        </li>
        <li>
          <label for="">Caravana ajena</label>
          <input type="text" name="txtCaravanaAjena" id="caravanaAjena" value="<?php echo $datas->caravanaAjena; ?>" min="0" placeholder="Opcional">
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
    </form>
   
    <input class="enviar1 enviar2" onclick="guardarElemento('<?php echo $id; ?>')" type="submit" name="subModificar" id="subModificar">

  </section>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script type="text/javascript">


  function guardarElemento(id) {

    var raza = $("#txtRaza").val();
    var caravanaPropia = $("#caravanaPropia").val();
    var caravanaAjena = $("#caravanaAjena").val();
    var nacimiento = $("#datNacimiento").val();
    var color = $("#txtColor").val();
    var sexo = $("#selSexo").val();

    $.ajax({
      "url": "../funciones.php",
      "type": "post",
      "dataType": "json",
      "data": {
        "id": id,
        "funcion": "modificarCampo",
        "raza": raza,
        "caravanaPropia": caravanaPropia,
        "caravanaAjena": caravanaAjena,
        "nacimiento": nacimiento,
        "color": color,
        "sexo": sexo,
      },
      success: function(r) {
        if (r.error == 0) {
          location.reload();
          alert("Actualizado con exito.");
        }
      },
    });

    return false;
  }

</script>
</body>
</html>