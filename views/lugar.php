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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Ganadero</title>

  <?php $id = isset($_GET["id"]) ? $_GET["id"] : 0; ?>

</head>

<body>

  <nav>
    <p>Cambio de lugar</p>
    <p>Caravana N°: <?php echo $id ?> </p>
  </nav>

  <?php $datas = obtenerLugar($id); ?>
  <section class="formulario">
    <form>
      <ul>
      <li>
          <label for="">Lugar</label>
          <input type="text" name="txtLugar" id="txtLugar" required>
        </li>
        <li>
          <label for="">Fecha de cambio</label>
          <input type="date" name="datFecha" id="datFecha" required>
        </li>
      </ul>
      <input class="enviar1" onclick="agregarlugar()" name="subCambio" id="subCambio" value="Agregar lugar">
      
    </form>

    <input class="enviar1 enviar2" onclick="guardarElemento('<?php echo $id ?>')" name="subCambio" id="subCambio" value="Guardar">

    <div class="tabla tablasLugares">
      <table class="table_lugares">
        <thead>
          <tr>
            <th>Lugar</th>
            <th>Fecha</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0; ?>
          <?php foreach ($datas->lugares as $l) { ?>
            <tr>
              <td class="lugar"><?php echo $l->lugar ?></td>
              <td class="fecha"><?php echo $datas->fechas[$i]->fecha ?></td>
              <td>
              <a href="javascript:void(0)" onclick="removeElement(this)"><i class="fa fa-times iconito-eliminar"></i></a>
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
    function removeElement(e) {
    	if (confirm("Estas seguro que desea eliminar el elemento?")){
      	$(e).parent().parent().remove();
        console.log(e);
    	}
    }

    function agregarlugar() {
    	//Obtenemos los valores
    	let fecha = $("#datFecha").val();
    	let lugar = $("#txtLugar").val();
    	//Verificamos los valores
      if (lugar == "") {
    		alert ("Por favor ingrese un lugar");
    		return false;
    	}
    	if (fecha == "") {
    		alert ("Por favor ingrese una fecha");
    		return false;
    	}

    	let elemento_lugar = `
    		<tr>
    			<td class="lugar">${lugar}</td>
    			<td class="fecha">${fecha}</td>
    			<td>
    				<a href="javascript:void(0)" onclick="remove_element(this)"><i class="fa fa-times iconito-eliminar"></i></a>
    			</td>
    		</tr>
    	`;
    	$(".table_lugares tbody").append(elemento_lugar);
    }

    function guardarElemento(id) {
      var lugares = new Array();

      $(".table_lugares tbody tr").each(function(i, e) {
        var lugar = $(e).find(".lugar").text();
        var fecha = $(e).find(".fecha").text();
        lugares.push({
          "lugar": lugar,
          "fecha": fecha,
        });
      });

      $.ajax({
        "url": "../funciones.php",
        "type": "post",
        "dataType": "json",
        "data": {
          "id": id,
          "funcion": "modificarLugar",
          "lugares": lugares,
        },
        success: function(r) {
          if (r.error == 0) {
            alert("Exitoso");
            location.reload();
          }
        },
      });
    }
  </script>
</body>

</html>