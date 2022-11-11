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
    <p>Vacunacion</p>
    <p>Caravana N°: <?php echo $id ?> </p>
  </nav>

  <?php $datas = cambioVacunas2($id); ?>
  <section class="formulario formvacunas">
    <form action="" id="forminsert" method="">
      <ul>
      <li>
          <label for="">Vacuna</label>
          <input type="text" name="txtVacuna" id="txtVacuna" required>
        </li>
        <li>
          <label for="">Fecha de vacunacion</label>
          <input type="date" name="datFecha" id="datFecha" required>
        </li>
        <li>
          <label for="">Droga aplicada</label>
          <input type="text" name="txtDroga" id="txtDroga" required>
        </li>
        <li>
          <label for="">Obligatoria</label>
          <select name="selObligatoria" id="selObligatoria" required>
            <option value="si">SI</option>
            <option value="no" selected>NO</option>
          </select>
        </li>
        <li>
          <label for="">Veterinario</label>
          <input type="text" name="txtVeterinario" id="txtVeterinario" required>
        </li>
        <li>
          <label for="">Descripcion</label>
          <input name="text" id="txtDescripcion" placeholder="Descripcion"></input>
        </li>
      </ul>
	    <input class="enviar1" onclick="agregarNuevaVacuna()" name="subCambio" id="subCambio" value="Agregar Vacuna">
    </form>
    <input class="enviar1 enviar2" onclick="guardarElemento('<?php echo $id; ?>')" name="subVacunas" id="subVacunas" value="Guardar">

    <div class="tabla tablasLugares">
      <table class="table_lugares">
        <thead>
          <tr>
            <th class="grande">Vacuna</th>
            <th class="grande">Fecha</th>
            <th>Droga</th>
            <th>Obligatoria</th>
            <th>Veterinario</th>
            <th>Descripcion</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0; ?>
          <?php foreach ($datas->vacunas as $v) { ?>
            <tr>
              <td class="vacuna"><?php echo $v->vacuna ?></td>
              <td class="fecha"><?php echo $datas->fechas[$i]->fecha ?></td>
              <td class="droga"><?php echo $datas->drogas[$i]->droga ?></td>
              <td class="obligatoria"><?php echo $datas->obligatorias[$i]->obligatoria ?></td>
              <td class="veterinario"><?php echo $datas->veterinarios[$i]->veterinario ?></td>
              <td class="descripcion"><?php echo $datas->descripciones[$i]->descripcion ?></td>
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

    function agregarNuevaVacuna() {
 
    	let vacuna = $("#txtVacuna").val();
      let fecha = $("#datFecha").val();
    	let droga = $("#txtDroga").val();
    	let obligatoria = $("#selObligatoria").val();
    	let veterinario = $("#txtVeterinario").val();
      let descripcion = $("#txtDescripcion").val();

      if (vacuna == "") {
    		alert ("Por favor ingrese una vacuna");
    		return false;
    	}
    	if (fecha == "") {
    		alert ("Por favor ingrese una fecha");
    		return false;
    	}
      if (droga == "") {
    		alert ("Por favor ingrese una droga");
    		return false;
    	}
      if (veterinario == "") {
    		alert ("Por favor ingrese un veterinario");
    		return false;
    	}

    	let elemento_vacuna = `
    		<tr>
    			<td class="vacuna">${vacuna}</td>
    			<td class="fecha">${fecha}</td>
          <td class="droga">${droga}</td>
    			<td class="obligatoria">${obligatoria}</td>
          <td class="veterinario">${veterinario}</td>
    			<td class="descripcion">${descripcion}</td>
    			<td>
    				<a href="javascript:void(0)" onclick="remove_element(this)"><i class="fa fa-times iconito-eliminar"></i></a>
    			</td>
    		</tr>
    	`;
    	$(".table_lugares tbody").append(elemento_vacuna);
    }

    function guardarElemento(id) {
      var vacunas = new Array();

      $(".table_lugares tbody tr").each(function(i, e) {
        var vacuna = $(e).find(".vacuna").text();
        var fecha = $(e).find(".fecha").text();
        var droga = $(e).find(".droga").text();
        var obligatoria = $(e).find(".obligatoria").text();
        var veterinario = $(e).find(".veterinario").text();
        var descripcion = $(e).find(".descripcion").text();
        vacunas.push({
          "vacuna": vacuna,
          "fecha": fecha,
          "droga": droga,
          "obligatoria": obligatoria,
          "veterinario": veterinario,
          "descripcion": descripcion,
        });
      });

      $.ajax({
        "url": "../funciones.php",
        "type": "post",
        "dataType": "json",
        "data": {
          "id": id,
          "funcion": "cambioVacunas",
          "vacunas": vacunas,
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