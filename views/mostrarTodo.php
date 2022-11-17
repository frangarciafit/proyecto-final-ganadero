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

<body>

    <nav>
        <p>Historico</p>
        <a href="../exportarAnimal.php?id=<?php echo $id ?>">Exportar a excel</a>
        <p>Caravana N°: <?php echo $id ?> </p>
    </nav>


    <?php $datas = cambioPeso($id); ?>
    <h1 class="mostradoTotal">Historico de Peso</h1>
    <div class="tabla tablasLugares tablasTodo">
        <table class="table_lugares">

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
                    </tr>
                    <?php $i++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php $datas = obtenerLugar($id); ?>
    <h1 class="mostradoTotal">Historico de Lugar</h1>
    <div class="tabla tablasLugares tablasTodo">
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
                        <td class="peso"><?php echo $l->lugar ?></td>
                        <td class="fecha"><?php echo $datas->fechas[$i]->fecha ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php $datas = registroEnfermedad($id); ?>
    <h1 class="mostradoTotal">Historico de Enfermedades</h1>
    <div class="tabla tablasLugares tablasEnfermedades">
        <table class="table_lugares">

            <?php $i = 0; ?>
            <?php if ($datas->opcion[0] == 0) {
                echo "
                            <thead>
                                <tr>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                    <td> No tiene Enfermedades registradas</td>";
            } else {
                echo '<thead>
                    <tr>
                        <th class="grandef">Fecha</th>
                        <th class="grandeplus">Descripcion</th>
                    </tr>
                </thead>
                <tbody>'; ?>
                <?php foreach ($datas->fechas as $f) { ?>
                    <tr>
                        <td class="fecha"><?php echo $f->fecha ?></td>
                        <td class="descripcion"><?php echo $datas->descripciones[$i]->descripcion ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <?php $datas = registroComportamiento($id); ?>
    <h1 class="mostradoTotal">Historico de Comportamientos</h1>
    <div class="tabla tablasLugares tablasEnfermedades">
        <table class="table_lugares">

            <?php $i = 0; ?>
            <?php if ($datas->opcion[0] == 0) {
                echo "
                            <thead>
                                <tr>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                    <td> No tiene un comportamiento registrado</td>";
            } else {
                echo '<thead>
                    <tr>
                        <th class="grandef">Fecha</th>
                        <th class="grandeplus">Descripcion</th>
                    </tr>
                </thead>
                <tbody>'; ?>
                <?php foreach ($datas->fechas as $f) { ?>
                    <tr>
                        <td class="fecha"><?php echo $f->fecha ?></td>
                        <td class="descripcion"><?php echo $datas->descripciones[$i]->descripcion ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <?php $datas = cambioVacunas2($id); ?>
    <h1 class="mostradoTotal">Historico de Vacunas</h1>
    <div class="tabla tablasLugares tablasVacunas">
        <table class="table_lugares">
            <?php $i = 0; ?>
            <?php if ($datas->opcion[0] == 0) {
                echo "
                                <thead>
                                         <tr>
                                             <th></th>
                                         </tr>
                                </thead>
                                     <tbody>
                    <td> No tiene Vacunas registradas </td>";
            } else {
                echo '
                    <thead>
                    <tr>
                        <th class="normal">Vacuna</th>
                        <th class="grande">Fecha</th>
                        <th class="grande">Droga</th>
                        <th class="chico">Obligatoria</th>
                        <th class="grande">Veterinario</th>
                        <th class="grandeplus">Descripcion</th>
                    </tr>
                </thead>
                <tbody>'; ?>
                <?php foreach ($datas->vacunas as $v) { ?>
                    <tr>
                        <td class="vacuna"><?php echo $v->vacuna ?></td>
                        <td class="fecha"><?php echo $datas->fechas[$i]->fecha ?></td>
                        <td class="droga"><?php echo $datas->drogas[$i]->droga ?></td>
                        <td class="obligatorio"><?php echo $datas->obligatorias[$i]->obligatoria ?></td>
                        <td class="veterinario"><?php echo $datas->veterinarios[$i]->veterinario ?></td>
                        <td class="descripcion"><?php echo $datas->descripciones[$i]->descripcion ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>



    <?php $datas = esHija($id); ?>
    <?php $datasSexo = sexo($id); ?>
    <?php $data = $datasSexo->fetch_object() ?>
    <?php $datos = $datas->fetch_object() ?>
    <h1 class="mostradoTotal">Es <?php if ($data->sexo == 'macho') {
                                        echo "Hijo ";
                                    } else {
                                        echo "Hija ";
                                    } ?> de</h1>
    <div class="tabla tablasLugares tablasTodo">
        <table class="table_lugares">



            <?php if (mysqli_num_rows($datas) == 1) { ?>
                <thead>
                    <tr>
                        <th>Caravana Madre</th>
                        <th>Raza Madre</th>
                        <th>Raza Padre</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $razas = recuperarRaza($id); ?>
                    <?php $raza = $razas->fetch_object() ?>
                    <tr>
                        <td class="caravanaMadre"><?php echo $datos->caravanaMadre ?></td>
                        <td class="raza"><?php echo $raza->raza ?></td>
                        <td class="raza"><?php echo $datos->razaPadre ?></td>
                    </tr>
                <?php } else { ?>
                    <thead>
                    <tr>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <td>No tiene madre registrada</td>
                <?php } ?>
                </tbody>
        </table>
    </div>

    <?php $datas = esMadre($id); ?>
    <?php if ($data->sexo == 'hembra') { ?>;
    <h1 class="mostradoTotal">Es Madre de</h1>
    <div class="tabla tablasLugares tablasTodo">
        <table class="table_lugares">

            <thead>
                <tr>
                    <th>Caravana</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($datas) > 0) { ?>
                    <?php while ($datos = $datas->fetch_object()) { ?>
                        <tr>
                            <td class="caravanaTernero"><?php echo $datos->caravanaTernero ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <td>No tiene terneros registrados</td>
                <?php } ?>
            </tbody>
        </table>
    </div>

<?php } ?>






<div class="vacio">

</div>

</body>

</html>