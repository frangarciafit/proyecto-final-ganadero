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


</head>

<body id="blur">

    <nav>
        <p>Historicos</p>
    </nav>

    <div id="tabla" class="tabla">
        <h1>Tabla Peso</h1>
        <table class="table">
            <thead>
                <tr>
                    <th class="normal">Fecha</th>
                    <th class="normal">Peso</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $datos = mostrarPeso()
                ?>
                <?php while ($data = $datos->fetch_object()) { ?>
                    <tr>
                        <td class="normal"><?php echo $data->peso; ?></td>
                        <td class="normal"><?php echo $data->fecha; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div id="tabla" class="tabla">
        <h1>Tabla Lugar</h1>
        <table class="table">
            <thead>
                <tr>
                    <th class="normal">Fecha</th>
                    <th class="grande">Lugar</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $datos = mostrarLugar()
                ?>
                <?php while ($data = $datos->fetch_object()) { ?>
                    <tr>
                        <td class="normal"><?php echo $data->fecha; ?></td>
                        <td class="normal"><?php echo $data->lugar; ?></td>
                    </tr>
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