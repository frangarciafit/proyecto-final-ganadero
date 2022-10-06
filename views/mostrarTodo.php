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

<body>

    <nav>
        <p>Historicos</p>
    </nav>


    <?php $datas = cambioPeso($id); ?>
    <h1 class="mostradoTotal">Tabla Peso</h1>
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
    <h1 class="mostradoTotal">Tabla Lugar</h1>
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
    <h1 class="mostradoTotal">Tabla Enfermedades</h1>
    <div class="tabla tablasLugares tablasEnfermedades">
        <table class="table_lugares">
            <thead>
                <tr>
                    <th class="grandef">Fecha</th>
                    <th class="grandeplus">Descripcion</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 0; ?>
                <?php foreach ($datas->fechas as $f) { ?>
                    <tr>
                        <td class="fecha"><?php echo $f->fecha ?></td>
                        <td class="descripcion"><?php echo $datas->descripciones[$i]->descripcion ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php $datas = cambioVacunas2($id); ?>
    <h1 class="mostradoTotal">Tabla Vacunas</h1>
    <div class="tabla tablasLugares tablasVacunas">
        <table class="table_lugares">
            <thead>
                <tr>
                    <th class="normal">Vacuna</th>
                    <th class="grande">Fecha</th>
                    <th class="grande">Droga</th>
                    <th class="chico">Obligatoria</th>
                    <th class="chico">Veterinario</th>
                    <th class="grandeplus">Descripcion</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 0; ?>
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
            </tbody>
        </table>
    </div>
    <div class="vacio">

    </div>

</body>

</html>