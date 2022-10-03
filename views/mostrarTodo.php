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
        <p>Historicos</p>
    </nav>

    <h1 class="mostradoTotal">Tabla Peso</h1>
    <?php $datas = cambioPeso($id); ?>
    <div class="tabla tablasLugares">
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
                        <td class="peso"><?php echo $l->lugar ?></td>
                        <td class="fecha"><?php echo $datas->fechas[$i]->fecha ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div id="tabla" class="tabla">
        <h1>Tabla Vacunas</h1>
        <table class="table">
            <thead>
                <tr>
                    <th class="normal">Fecha</th>
                    <th class="grande">Droga</th>
                    <th class="chico">Obligatoriedad</th>
                    <th class="chico">Veterinario</th>
                    <th class="grande">Descripcion</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $datos = mostrarVacunas()
                ?>
                <?php while ($data = $datos->fetch_object()) { ?>
                    <tr>
                        <td class="grande"><?php echo $data->fecha; ?></td>
                        <td class="normal"><?php echo $data->droga; ?></td>
                        <td class="normal"><?php echo $data->obligatoria; ?></td>
                        <td class="normal"><?php echo $data->veterinario; ?></td>
                        <td class="normal"><?php echo $data->descripcion; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div id="tabla" class="tabla">
        <h1>Tabla Enfermedades</h1>
        <table class="table">
            <thead>
                <tr>
                    <th class="normal"> Fecha</th>
                    <th class="grande"> Detalles</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $datos = mostrarEnfermedad()
                ?>
                <?php while ($data = $datos->fetch_object()) { ?>
                    <tr>
                        <td class="grande"><?php echo $data->fecha; ?></td>
                        <td class="normal"><?php echo $data->descripcion; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>