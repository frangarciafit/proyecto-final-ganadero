<?php

if (!isset($_COOKIE["usuarioLogeado"]) || empty($_COOKIE["usuarioLogeado"])) {
    header("Location: ../login.php");
    exit;
}


define("DB_NAME", "ganadero");
define("DB_USER", "root");
define("DB_PASS", "");

class Conexion
{
    public $cnx;
    public function conectar()
    {
        try {
            $opciones = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            $this->cnx = new PDO(
                "mysql:host=localhost;
            dbname=" . DB_NAME,
                DB_USER,
                DB_PASS,
                $opciones
            );
            return $this->cnx;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function desconectar()
    {
        $this->cnx = null;
    }
}


class Consulta
{

    private $_db;
    public $listAnimal;
    public $listPeso;
    public $listLugar;
    public $listVacunas;
    public $listEnfermedad;
    public $listComportamiento;
    public $listHijo;
    public $listPadre;

    public function __construct()
    {
        $this->_db = new Conexion();
    }

    public function Animal($id)
    {
        $this->_db->conectar();

        $stmt = $this->_db->cnx->prepare("SELECT * FROM t_animal where caravanaPropia = '$id'");
        $stmt->execute();
        $stmt_animal = $stmt->fetch(PDO::FETCH_OBJ);


        $this->_db->desconectar();
        return $stmt_animal;
    }

    public function Pesos($id)
    {
        $this->_db->conectar();
        $sql = "SELECT peso, fecha FROM t_peso WHERE caravanaPropia = '$id'";
        $stmt_peso = $this->_db->cnx->prepare($sql);
        $stmt_peso->execute();

        while ($peso = $stmt_peso->fetch(PDO::FETCH_OBJ)) {
            $this->listPeso[] = $peso;
        }

        $this->_db->desconectar();
        return $this->listPeso;
    }

    public function Lugares($id)
    {
        $this->_db->conectar();
        $sql = "SELECT lugar, fecha FROM t_lugar WHERE caravanaPropia = '$id' ";
        $stmt_lugar = $this->_db->cnx->prepare($sql);
        $stmt_lugar->execute();

        while ($lugar = $stmt_lugar->fetch(PDO::FETCH_OBJ)) {
            $this->listLugar[] = $lugar;
        }

        $this->_db->desconectar();
        return $this->listLugar;
    }

    public function Vacunas($id)
    {
        $this->_db->conectar();
        $sql = "SELECT vacuna, fecha, droga, obligatoria, veterinario, descripcion FROM t_vacuna WHERE caravanaPropia = '$id' ";
        $stmt_vacuna = $this->_db->cnx->prepare($sql);
        $stmt_vacuna->execute();

        while ($vacuna = $stmt_vacuna->fetch(PDO::FETCH_OBJ)) {
            $this->listVacunas[] = $vacuna;
        }

        $this->_db->desconectar();
        return $this->listVacunas;
    }

    public function Enfermedades($id)
    {
        $this->_db->conectar();
        $sql = "SELECT descripcion, fecha FROM t_enfermedades WHERE caravanaPropia = '$id' ";
        $stmt_enfermedad = $this->_db->cnx->prepare($sql);
        $stmt_enfermedad->execute();

        while ($enfermedad = $stmt_enfermedad->fetch(PDO::FETCH_OBJ)) {
            $this->listEnfermedad[] = $enfermedad;
        }

        $this->_db->desconectar();
        return $this->listEnfermedad;
    }

    public function Comportamientos($id)
    {
        $this->_db->conectar();
        $sql = "SELECT descripcion, fecha FROM t_comportamiento WHERE caravanaPropia = '$id' ";
        $stmt_comportamiento = $this->_db->cnx->prepare($sql);
        $stmt_comportamiento->execute();

        while ($comportamiento = $stmt_comportamiento->fetch(PDO::FETCH_OBJ)) {
            $this->listComportamiento[] = $comportamiento;
        }

        $this->_db->desconectar();
        return $this->listComportamiento;
    }

    public function Hijas($id)
    {
        $this->_db->conectar();
        $sql = "SELECT caravanaMadre, razaPadre FROM t_ternero WHERE caravanaTernero = '$id' ";
        $stmt_hija = $this->_db->cnx->prepare($sql);
        $stmt_hija->execute();

        $hija = $stmt_hija->fetch(PDO::FETCH_OBJ);

        if ($hija) {
            $sql = "SELECT raza FROM t_animal WHERE caravanaPropia = '$hija->caravanaMadre' ";
            $stmt_hijas = $this->_db->cnx->prepare($sql);
            $stmt_hijas->execute();

            $madre = $stmt_hijas->fetch(PDO::FETCH_OBJ);

            $hija->razaMadre = $madre->raza;
        }
        $this->_db->desconectar();
        return $hija;
    }

    public function Madres($id)
    {
        $this->_db->conectar();
        $sql = "SELECT caravanaTernero FROM t_ternero WHERE caravanaMadre = '$id' ";
        $stmt_madre = $this->_db->cnx->prepare($sql);
        $stmt_madre->execute();

        while ($madre = $stmt_madre->fetch(PDO::FETCH_OBJ)) {
            $this->listPadre[] = $madre;
        }

        $this->_db->desconectar();
        return $this->listPadre;
    }
    
}

$id = isset($_GET["id"]) ? $_GET["id"] : 0;

$consulta = new Consulta();
$animales = $consulta->Animal($id);
$pesos = $consulta->Pesos($id);
$lugares = $consulta->Lugares($id);
$vacunas = $consulta->Vacunas($id);
$enfermedades = $consulta->Enfermedades($id);
$comportamientos = $consulta->Comportamientos($id);
$hijas = $consulta->Hijas($id);
$madres = $consulta->Madres($id);

$salida = "";
$salida .= "<table>";
$salida .= "<thead> <th>Caravana</th> <th>Caravana Ajena</th><th>Raza</th><th>Nacimiento</th><th>Color</th><th>Sexo</th></thead>";

$salida .= "<tr> <td>" . $animales->caravanaPropia . "</td><td>" . $animales->caravanaAjena . "</td> <td>" . $animales->raza . "</td><td>" . $animales->nacimiento . "</td><td>" . $animales->color . "</td><td>" . $animales->sexo . "</td></tr>";
$salida .= "</table>";

$salida .= "<tr>---------------------------------------</tr>";
$salida .= "<table>";
$salida .= "<thead> <th>Peso</th> <th>Fecha</th></thead>";
if ($pesos) {
    foreach ($pesos as $p) {
        $salida .= "<tr> <td>" . $p->peso . "</td> <td>" . $p->fecha . "</td></tr>";
    }
}
$salida .= "</table>";

$salida .= "<tr>---------------------------------------</tr>";
$salida .= "<table>";
$salida .= "<thead> <th>Lugar</th> <th>Fecha</th></thead>";
if ($lugares) {
    foreach ($lugares as $l) {
        $salida .= "<tr> <td>" . $l->lugar . "</td> <td>" . $l->fecha . "</td></tr>";
    }
}
$salida .= "</table>";

$salida .= "<tr>-------------------------------------------------------------</tr>";
$salida .= "<table>";
$salida .= "<thead> <th>Vacuna</th> <th>Fecha</th> <th>Droga</th> <th>Obligatoria</th> <th>Veterinario</th> <th>Descripcion</th></thead>";
if ($vacunas) {
    foreach ($vacunas as $v) {
        $salida .= "<tr> <td>" . $v->vacuna . "</td> <td>" . $v->fecha . "</td> <td>" . $v->droga . "</td> <td>" . $v->obligatoria . "</td> <td>" . $v->veterinario . "</td> <td>" . $v->descripcion . "</td></tr>";
    }
}
$salida .= "</table>";

$salida .= "<tr>---------------------------------------</tr>";
$salida .= "<table>";
$salida .= "<thead> <th>Enfermedad</th> <th>Fecha</th></thead>";
if ($enfermedades) {
    foreach ($enfermedades as $e) {
        $salida .= "<tr> <td>" . $e->descripcion . "</td> <td>" . $l->fecha . "</td></tr>";
    }
}
$salida .= "</table>";

$salida .= "<tr>---------------------------------------</tr>";
$salida .= "<table>";
$salida .= "<thead> <th>Comportamiento</th> <th>Fecha</th></thead>";
if ($comportamientos) {
    foreach ($comportamientos as $c) {
        $salida .= "<tr> <td>" . $c->descripcion . "</td> <td>" . $c->fecha . "</td></tr>";
    }
}
$salida .= "</table>";

$salida .= "<tr>---------------------------------------</tr>";
$salida .= "<table>";
$salida .= "<thead> <th>Caravana Madre</th> <th>Raza Madre</th> <th>Raza Padre</th></thead>";
if ($hijas) {
    $salida .= "<tr> <td>" . $hijas->caravanaMadre . "</td> <td>" . $hijas->razaMadre . "</td> <td>" . $hijas->razaPadre . "</td></tr>";
}
$salida .= "</table>";

$salida .= "<tr>---------------------------------------</tr>";
$salida .= "<table>";
$salida .= "<thead> <th>Caravana Hijo</th></thead>";
if ($madres) {
    foreach ($madres as $m) {
        $salida .= "<tr> <td>" . $m->caravanaTernero . "</td></tr>";
    }
}
$salida .= "</table>";


header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=animales.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $salida;
