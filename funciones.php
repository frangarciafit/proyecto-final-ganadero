<?php

$con = new mysqli("localhost", "root", "", "ganadero");


$funcion = isset($_POST['funcion']) ? $_POST["funcion"] : "";
if (isset($_POST["subAgregar"])) {
    global $con;

    $caravanaPropia = $_POST['txtCaravanaPropia'];
    $caravanaAjena = $_POST['txtCaravanaAjena'];
    $raza = $_POST['txtRaza'];
    $nacimiento = $_POST['datNacimiento'];
    $peso = $_POST['numPeso'];
    $fecha = $_POST['datFecha'];
    $color = $_POST['txtColor'];
    $lugar = $_POST['txtLugar'];
    $sexo = $_POST['selSexo'];

    $sql = "INSERT INTO t_animal (caravanaPropia, caravanaAjena, raza, nacimiento, color, sexo, eliminada) VALUES ('$caravanaPropia', '$caravanaAjena', '$raza', '$nacimiento', '$color','$sexo', 'FALSE') ";
    $result = mysqli_query($con, $sql);
    $sql = "INSERT INTO t_peso (caravanaPropia, fecha, peso) VALUES ('$caravanaPropia', '$fecha', '$peso') ";
    $result = mysqli_query($con, $sql);
    $sql = "INSERT INTO t_lugar (caravanaPropia, fecha, lugar) VALUES ('$caravanaPropia', '$fecha', '$lugar') ";
    $result = mysqli_query($con, $sql);

    // echo'<script type="text/javascript">
    // alert("Animal agregado");
    // </script>';

    // $stmt = $con->prepare($sql);
    // $stmt->execute();
    if (mysqli_affected_rows($con) == 1) {
        echo '<script type="text/javascript">
        alert("ANIMAL AGREGADO");
        </script>';
        return 1;
    } else {
        echo "<h3>ERROR</h3>";
    }
}
if (isset($_POST["subAgregarTernero"])) {
    global $con;

    $caravanaPropia = $_POST['txtCaravanaPropia'];
    $caravanaMadre = $_POST['txtCaravanaMadre'];
    $raza = $_POST['txtRaza'];
    $nacimiento = $_POST['datNacimiento'];
    $peso = $_POST['numPeso'];
    $color = $_POST['txtColor'];
    $lugar = $_POST['txtLugar'];
    $sexo = $_POST['selSexo'];

    $sql = "SELECT * FROM t_animal WHERE caravanaPropia = '$caravanaMadre'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $sql = "INSERT INTO t_animal (caravanaPropia, caravanaAjena, raza, nacimiento, color, sexo, eliminada) VALUES ('$caravanaPropia', '', '$raza', '$nacimiento', '$color','$sexo', 'FALSE') ";
        $result = mysqli_query($con, $sql);
        $sql = "INSERT INTO t_peso (caravanaPropia, fecha, peso) VALUES ('$caravanaPropia', '$nacimiento', '$peso') ";
        $result = mysqli_query($con, $sql);
        $sql = "INSERT INTO t_lugar (caravanaPropia, fecha, lugar) VALUES ('$caravanaPropia', '$nacimiento', '$lugar') ";
        $result = mysqli_query($con, $sql);
        $sql = "INSERT INTO t_ternero (caravanaTernero, caravanaMadre) VALUES ('$caravanaPropia','$caravanaMadre') ";
        $result = mysqli_query($con, $sql);
        // $stmt = $con->prepare($sql);
        // $stmt->execute();
        // if (mysqli_num_rows($result) == 1) {
        //     echo "<h3>Cargado exitoso</h3>";
        //     return 1;
        // } else {
        //     echo "<h3>ERROR</h3>";
        // }
    } else {
        echo "<h3>ERROR</h3>";
    }
}
if (isset($_POST["subCambio"])) {
    global $con;

    $lugar = $_POST['txtCaravanaPropia'];
    $fecha = $_POST['txtCaravanaAjena'];
}
if ($funcion == "eliminar") {
    $id = isset($_POST['id']) ? $_POST["id"] : "";
    echo "<h3> id $id </h3>";
    $sql = "UPDATE t_animal SET eliminada = 1 WHERE caravanaPropia = $id";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    if ($funcion == "modificar") {
        global $con;
        $id = isset($_POST['id']) ? $_POST["id"] : "";
        $sql = "SELECT * ";
        $sql .= "FROM t_animal a ";
        $sql .= "CROSS JOIN t_peso p , t_lugar l ";
        $sql .= "WHERE '$id' = a.caravanaPropia AND '$id' = p.caravanaPropia AND '$id' = l.caravanaPropia ";

        // $resultado = mysqli_query($con, $sql);
        // if (mysqli_num_rows($resultado) == 0) {
        //     echo "No se encontro ningun dato";
        // }else{
        //     echo "hola";
        // }
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado;
    }
}


if (isset($_POST["subLogin"])) {
    global $con;
    $usuario = $_POST['txtUsuario'];
    $password = $_POST['pasPassword'];

    $sql = "SELECT * FROM t_login WHERE usuario = '$usuario' and password = '$password'";
    $result = mysqli_query($con, $sql);

    if (empty($usuario)) {
        header("Location: login.php?error=El usuario se encuentra vacio");
        exit();
    } else if (empty($password)) {
        header("Location: login.php?error=La contraseña se encuentra vacia");
        exit();
    } else if (mysqli_num_rows($result) == 1) {
        ob_start();
        header('Location: index.php');
        ob_end_flush();
        return 1;
    } else {
        header("Location: login.php?error=El usuario o contraseña son invalidos");
        exit();
    }
}

if ($funcion == "modificarLugar") {
    global $con;
    $lugares = $_POST["lugares"];
    $fechas = $_POST["fechas"];
    $nuevoLugar = $_POST["lugar"];
    $nuevaFecha = $_POST["fecha"];
    // $hoy = date("Y-m-d");
    $id = $_POST["id"];

    // $sql = "INSERT INTO t_lugar (caravanaPropia, fecha, lugar) VALUES ('$id', '$nuevaFecha', '$nuevoLugar')";
    // $stmt = $con->prepare($sql);
    // $stmt->execute();
    // print_r($sql);

    // $sql = "DELETE FROM t_lugar WHERE caravanaPropia = '$id' ";
    // $stmt = $con->prepare($sql);
    // $stmt->execute();

    foreach ($lugares as $lugar) {

        $lugar = $lugar["lugar"];
        $sql = "INSERT INTO t_lugar (caravanaPropia, fecha, lugar) ";
        $sql .= "VALUES ('$id', '$hoy', '$lugar') ";
        $stmt = $con->prepare($sql);
        $stmt->execute();
    }
}

if ($funcion == "modificar_campo") {
    global $con;
    $lugares = $_POST["lugares"];
    $pesos = $_POST["pesos"];
    $id = $_POST["id"];
    $hoy = date("Y-m-d");
    $raza = $_POST["raza"];

    $sql = "UPDATE t_animal SET raza = '$raza' WHERE caravanaPropia = '$id' ";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    $sql = "DELETE FROM t_lugar WHERE caravanaPropia = '$id' ";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    foreach ($lugares as $lugar) {

        $lugar = $lugar["lugar"];
        $sql = "INSERT INTO t_lugar (caravanaPropia, fecha, lugar) ";
        $sql .= "VALUES ('$id', '$hoy', '$lugar') ";
        $stmt = $con->prepare($sql);
        $stmt->execute();
    }


    $sql = "DELETE FROM t_peso WHERE caravanaPropia = '$id' ";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    foreach ($pesos as $peso) {

        $peso = $peso["peso"];

        $sql = "INSERT INTO t_peso (caravanaPropia, fecha, peso) ";
        $sql .= "VALUES ('$id', '$hoy', '$peso') ";
        $stmt = $con->prepare($sql);
        $stmt->execute();
    }
}

if ($funcion == "cambioPesos") {
    global $con;
    $pesos = $_POST["pesos"];
    $fechas = $_POST["fechas"];
    $nuevoPeso = $_POST["peso"];
    $nuevaFecha = $_POST["fecha"];
    // $hoy = date("Y-m-d");
    $id = $_POST["id"];

    // $sql = "INSERT INTO t_lugar (caravanaPropia, fecha, lugar) VALUES ('$id', '$nuevaFecha', '$nuevoLugar')";
    // $stmt = $con->prepare($sql);
    // $stmt->execute();
    // print_r($sql);

    // $sql = "DELETE FROM t_lugar WHERE caravanaPropia = '$id' ";
    // $stmt = $con->prepare($sql);
    // $stmt->execute();

    foreach ($pesos as $peso) {

        $peso = $peso["peso"];
        $sql = "INSERT INTO t_peso (caravanaPropia, fecha, peso) ";
        $sql .= "VALUES ('$id', '$nuevaFecha', '$nuevoPeso') ";
        $stmt = $con->prepare($sql);
        $stmt->execute();
    }
}

if ($funcion == "cambioVacunas") {
    global $con;
    $vacunas = $_POST["vacunas"];
    $fechas = $_POST["fechas"];
    $drogas = $_POST["drogas"];
    $obligatorias = $_POST["obligatorias"];
    $descripciones = $_POST["descripciones"];
    $nuevaVacuna = $_POST["vacuna"];
    $nuevaFecha = $_POST["fecha"];
    $nuevaDroga = $_POST["droga"];
    $nuevoObligatoria = $_POST["obligatoria"];
    $nuevaDescripcion = $_POST["descripcion"];
    $id = $_POST["id"];

    // $sql = "INSERT INTO t_lugar (caravanaPropia, fecha, lugar) VALUES ('$id', '$nuevaFecha', '$nuevoLugar')";
    // $stmt = $con->prepare($sql);
    // $stmt->execute();
    // print_r($sql);

    // $sql = "DELETE FROM t_lugar WHERE caravanaPropia = '$id' ";
    // $stmt = $con->prepare($sql);
    // $stmt->execute();

    foreach ($vacunas as $vacuna) {

        $vacuna = $vacuna["peso"];
        $sql = "INSERT INTO t_vacuna (caravanaPropia, vacuna ,fecha, droga, obligatoria, veterinario, descripcion) ";
        $sql .= "VALUES ('$id', '$nuevaVacuna', '$nuevaFecha', '$nuevaDroga', '$nuevoObligatoria', '$nuevoVeterinario', '$nuevaDescripcion') ";
        $stmt = $con->prepare($sql);
        $stmt->execute();
    }
}

if ($funcion == "registroEnfermedades") {
    global $con;
    $descripciones = $_POST["descripciones"];
    $fechas = $_POST["fechas"];
    $nuevaDescripcion = $_POST["descripcion"];
    $nuevaFecha = $_POST["fecha"];
    $id = $_POST["id"];

    // $sql = "INSERT INTO t_lugar (caravanaPropia, fecha, lugar) VALUES ('$id', '$nuevaFecha', '$nuevoLugar')";
    // $stmt = $con->prepare($sql);
    // $stmt->execute();
    // print_r($sql);

    // $sql = "DELETE FROM t_lugar WHERE caravanaPropia = '$id' ";
    // $stmt = $con->prepare($sql);
    // $stmt->execute();

    foreach ($descripciones as $descripcion) {

        $descripcion = $descripcion["descripcion"];
        $sql = "INSERT INTO t_enfermedades (caravanaPropia, fecha, descripcion) ";
        // $sql .= "VALUES ('$id', '$hoy', '$lugar') ";
        $stmt = $con->prepare($sql);
        $stmt->execute();
    }
}

function cargarTodo($conf = array())
{
    global $con;
    $caravanaPropia = isset($conf["caravanaPropia"]) ? $conf["caravanaPropia"] : "";
    $caravanaAjena = isset($conf["caravanaAjena"]) ? $conf["caravanaAjena"] : "";
    $sexo = isset($conf["sexo"]) ? $conf["sexo"] : "";
    $color = isset($conf['color']) ? $conf["color"] : "";
    $raza = isset($conf['raza']) ? $conf["raza"] : "";
    $peso = isset($conf['peso']) ? $conf["peso"] : "";
    $nacimiento = isset($conf['nacimiento']) ? $conf["nacimiento"] : "";
    $lugar = isset($conf['lugar']) ? $conf["lugar"] : "";

    $sql = " SELECT * FROM t_animal a CROSS JOIN t_peso p , t_lugar l WHERE a.caravanaPropia = p.caravanaPropia AND a.caravanaPropia = l.caravanaPropia ";

    if ($caravanaPropia != "") $sql .= "AND a.caravanaPropia LIKE '%$caravanaPropia%' ";
    if ($caravanaAjena != "") $sql .= "AND caravanaAjena LIKE '%$caravanaAjena%' ";
    if ($sexo != "") $sql .= "AND sexo LIKE '%$sexo%' ";
    if ($color != "") $sql .= "AND color LIKE '%$color%' ";
    if ($raza != "") $sql .= "AND raza LIKE '%$raza%' ";
    if ($peso != "") $sql .= "AND peso LIKE '%$peso%' ";
    if ($nacimiento != "") $sql .= "AND nacimiento LIKE '%$nacimiento%' ";
    if ($lugar != "") $sql .= "AND lugar LIKE '%$lugar%' ";

    $stmt = $con->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado;

    #$stmt->bind_param("sss", $firstname, $lastname, $email);
    // $resultado = mysqli_query($con, $sql);
    // if (mysqli_num_rows($resultado) == 0) {
    //     echo "No se encontro ningun dato";
    // }
    // mysqli_free_result($resultado);
}

function obtenerAnimal($id)
{

    global $con;
    $id = intval($id);

    $sql = "SELECT TA.* FROM t_animal TA WHERE TA.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $row = $resultado->fetch_object();

    // $row->pesos = array();
    // $sql = "SELECT TP.* FROM t_peso TP WHERE TP.caravanaPropia = ? ";
    // $stmt = $con->prepare($sql);
    // $stmt->bind_param("i", $id);
    // $stmt->execute();
    // $resultado = $stmt->get_result(); 
    // while ($data = $resultado->fetch_object()) {
    //     $row->pesos[] = $data;
    // }


    $row->lugares = array();
    $sql = "SELECT TL.* FROM t_lugar TL WHERE TL.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    while ($data = $resultado->fetch_object()) {
        $row->lugares[] = $data;
    }

    return $row;
}

function obtenerLugar($id)
{

    global $con;
    $id = intval($id);

    $sql = "SELECT TA.* FROM t_animal TA WHERE TA.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $row = $resultado->fetch_object();


    $row->lugares = array();
    $row->fechas = array();
    $sql = "SELECT TL.* FROM t_lugar TL WHERE TL.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    while ($data = $resultado->fetch_object()) {
        $row->lugares[] = $data;
        $row->fechas[] = $data;
    }

    return $row;
}

function cambioPeso($id)
{
    global $con;
    $id = intval($id);

    $sql = "SELECT TA.* FROM t_animal TA WHERE TA.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $row = $resultado->fetch_object();

    $row->pesos = array();
    $row->fechas = array();
    $sql = "SELECT TP.* FROM t_peso TP WHERE TP.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    while ($data = $resultado->fetch_object()) {
        $row->pesos[] = $data;
        $row->fechas[] = $data;
    }

    return $row;
}

function cambioVacunas2($id)
{
    global $con;
    $id = intval($id);

    $sql = "SELECT TA.* FROM t_animal TA WHERE TA.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $row = $resultado->fetch_object();

    $row->vacunas = array();
    $row->fechas = array();
    $row->drogas = array();
    $row->obligatorias = array();
    $row->veterinarios = array();
    $row->descripciones = array();
    $sql = "SELECT TV.* FROM t_vacuna TV WHERE TV.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    while ($data = $resultado->fetch_object()) {
        $row->vacunas[] = $data;
        $row->fechas[] = $data;
        $row->drogas[] = $data;
        $row->obligatorias[] = $data;
        $row->veterinarios[] = $data;
        $row->descripciones[] = $data;
    }

    return $row;
}

function registroEnfermedad($id)
{
    global $con;
    $id = intval($id);

    $sql = "SELECT TA.* FROM t_animal TA WHERE TA.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $row = $resultado->fetch_object();


    $row->descripciones = array();
    $row->fechas = array();
    $sql = "SELECT TE.* FROM t_enfermedades TE WHERE TE.caravanaPropia = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    while ($data = $resultado->fetch_object()) {
        $row->descripciones[] = $data;
        $row->fechas[] = $data;
    }

    return $row;
}
//  function modificarVaca()
//  {
// }

function mostrarPeso()
{
}
function mostrarLugar()
{
}
function mostrarVacunas()
{
}
function mostrarEnfermedad()
{
}
