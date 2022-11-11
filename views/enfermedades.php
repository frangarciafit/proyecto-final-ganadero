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
    <p>Enfermedades/Comportamiento</p>
    <p>Caravana N°: <?php echo $id ?> </p>
  </nav>

  <?php $datas = registroEnfermedad($id); ?>
  <section class="formulario formEnfermedades">
  <h1 class="comportamientoh1">Enfermedades</h1>
    <form action="" id="forminsert" method="post">
      <ul>
        <li>
          <label for="">Fecha de enfermedad</label>
          <input type="date" name="datFecha" id="datFecha" required>
        </li>
        <li>
          <label for="">Descripcion de la enfermedad</label>
          <textarea name="txtArea" id="txtArea" rows="8" cols="25" placeholder="Descripcion" required></textarea>
        </li>
      </ul>
	    <input class="enviar1" onclick="agregarEnfermedad()" name="subCambio" id="subCambio" value="Agregar Enfermedad">
    </form>
    <input class="enviar1 enviar2" onclick="guardarElemento('<?php echo $id ?>')" name="subCambio" id="subCambio" value="Guardar">

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
              <a href="javascript:void(0)" onclick="removeElement(this)"><i class="fa fa-times iconito-eliminar"></i></a>
              </td>
            </tr>
            <?php $i++; ?>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </section>

  <?php $datas = registroComportamiento($id); ?>
  <section class="formulario formEnfermedades">
  <h1 class="comportamientoh1">Comportamientos</h1>
    <form action="" id="forminsert" method="post">
      <ul>
        <li>
          <label for="">Fecha</label>
          <input type="date" name="datFechaComportamiento" id="datFechaComportamiento" required>
        </li>
        <li>
          <label for="">Comportamiento</label>
          <textarea name="txtAreaComportamiento" id="txtAreaComportamiento" rows="8" cols="25" placeholder="Descripcion" required></textarea>
        </li>
      </ul>
	    <input class="enviar1" onclick="agregarComportamiento()" name="subCambio" id="subCambio" value="Agregar Enfermedad">
    </form>
    <input class="enviar1 enviar2" onclick="guardarElementoComportamiento('<?php echo $id ?>')" name="subCambio" id="subCambio" value="Guardar">

    <div class="tabla tablasLugares">
      <table class="table_comportamiento">
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
              <td class="comportamiento"><?php echo $d->descripcion ?></td>
              <td class="fecha2"><?php echo $datas->fechas[$i]->fecha ?></td>
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

    function agregarEnfermedad() {
    	//Obtenemos los valores
    	let fecha = $("#datFecha").val();
    	let descripcion = $("#txtArea").val();
    	//Verificamos los valores
    	if (fecha == "") {
    		alert ("Por favor ingrese una fecha");
    		return false;
    	}
    	if (descripcion == "") {
    		alert ("Por favor ingrese una descripcion");
    		return false;
    	}
      
  
    	let elemento_descripcion = `
    		<tr>
    			<td class="descripcion">${descripcion}</td>
    			<td class="fecha">${fecha}</td>
    			<td>
    				<a href="javascript:void(0)" onclick="remove_element(this)"><i class="fa fa-times iconito-eliminar"></i></a>
    			</td>
    		</tr>
    	`;
    	$(".table_lugares tbody").append(elemento_descripcion);
    }

    function agregarComportamiento() {
    	//Obtenemos los valores
    	let fecha = $("#datFechaComportamiento").val();
    	let descripcion = $("#txtAreaComportamiento").val();
    	//Verificamos los valores
    	if (fecha == "") {
    		alert ("Por favor ingrese una fecha");
    		return false;
    	}
    	if (descripcion == "") {
    		alert ("Por favor ingrese una descripcion");
    		return false;
    	}
      
    	let elemento_descripcion = `
    		<tr>
    			<td class="comportamiento">${descripcion}</td>
    			<td class="fecha2">${fecha}</td>
    			<td>
    				<a href="javascript:void(0)" onclick="remove_element(this)"><i class="fa fa-times iconito-eliminar"></i></a>
    			</td>
    		</tr>
    	`;
    	$(".table_comportamiento tbody").append(elemento_descripcion);
    }

    function guardarElemento(id) {
      var descripciones = new Array();

      $(".table_lugares tbody tr").each(function(i, e) {
        var descripcion = $(e).find(".descripcion").text();
        var fecha = $(e).find(".fecha").text();

        descripciones.push({
          "descripcion": descripcion,
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
        },
        success: function(r) {
          if (r.error == 0) {
            alert("Exitoso");
            location.reload();
          }
        },
      });
    }

    function guardarElementoComportamiento(id) {
      var descripciones = new Array();

      $(".table_comportamiento tbody tr").each(function(i, e) {
        var descripcion = $(e).find(".comportamiento").text();
        var fecha = $(e).find(".fecha2").text();

        descripciones.push({
          "descripcion": descripcion,
          "fecha": fecha,
        });
      });
      

      $.ajax({
        "url": "../funciones.php",
        "type": "post",
        "dataType": "json",
        "data": {
          "id": id,
          "funcion": "registroComportamientos",
          "descripciones": descripciones,
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