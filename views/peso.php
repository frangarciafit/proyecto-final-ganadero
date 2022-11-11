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
    <p>Nuevas pesadas</p>
    <p>Caravana N°: <?php echo $id ?> </p>
  </nav>

  <?php $datas = cambioPeso($id); ?>
  <section class="formulario">
  	<form>
	    <ul>
      <li>
	        <label for="">Peso</label>
	        <input type="number" name="numPeso" id="numPeso">
	      </li>
	      <li>
	        <label for="">Fecha</label>
	        <input type="date" name="datFecha" id="datFecha">
	      </li>
	    </ul>
	    <!-- En vez de guardar de una, lo que hacemos es agregar un nuevo peso -->
	    <input class="enviar1" onclick="agregarNuevoPeso()" name="subCambio" id="subCambio" value="Agregar nuevo peso">
    </form>
    <input class="enviar1 enviar2" onclick="guardarElemento('<?php echo $id ?>')" name="subCambio" id="subCambio" value="Guardar Pesos">

    <div class="tabla tablasPesos">
      <table class="table_pesos">
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
                <a href="javascript:void(0)" onclick="removeElement(this)"><i class="fa fa-times iconito-eliminar"></i></a>
              </td>
            </tr>
            <?php $i++; ?>
          <?php } ?>
        </tbody>
      </table>
    </div>

  </section>
  <div class="vacio">

</div>
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    function removeElement(e) {
    	if (confirm("Estas seguro que desea eliminar el elemento?")){
      	$(e).parent().parent().remove();
        console.log(e);
    	}
    }

    function agregarNuevoPeso() {
    	//Obtenemos los valores
    	let fecha = $("#datFecha").val();
    	let peso = $("#numPeso").val();
    	//Verificamos los valores
      if (peso == "") {
    		alert ("Por favor ingrese un peso");
    		return false;
    	}
    	if (fecha == "") {
    		alert ("Por favor ingrese una fecha");
    		return false;
    	}

    	//Agregamos el nuevo peso a la tabla
    	let elemento_peso = `
    		<tr>
    			<td class="peso">${peso}</td>
    			<td class="fecha">${fecha}</td>
    			<td>
    				<a href="javascript:void(0)" onclick="remove_element(this)"><i class="fa fa-times iconito-eliminar"></i></a>
    			</td>
    		</tr>
    	`;
    	$(".table_pesos tbody").append(elemento_peso);
    }

    function guardarElemento(id) {
      var pesos = new Array();

      $(".table_pesos tbody tr").each(function(i, e) {
        var peso = $(e).find(".peso").text();
        var fecha = $(e).find(".fecha").text();
        pesos.push({
          "peso": peso,
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