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
    public $listaAnimales;

    public function __construct()
    {
        $this->_db = new Conexion();
    }

    public function buscar($estado)
    {

        $this->_db->conectar();

        if ($estado == 0) {
            $stmt = $this->_db->cnx->prepare("SELECT * FROM t_animal where eliminada = 0");
            $stmt->execute();

        } else {
            $stmt = $this->_db->cnx->prepare("SELECT * FROM t_animal where eliminada = 1");
            $stmt->execute();
        }
        while ($res = $stmt->fetch(PDO::FETCH_OBJ)) {

            $sql = "SELECT * FROM t_peso WHERE caravanaPropia = '$res->caravanaPropia' ORDER BY fecha DESC LIMIT 0,1";
            $stmt_peso = $this->_db->cnx->prepare($sql);
            $stmt_peso->execute();
            $peso = $stmt_peso->fetch(PDO::FETCH_OBJ);
            $res->peso = $peso->peso;

            $sql = "SELECT * FROM t_lugar WHERE caravanaPropia = '$res->caravanaPropia' ORDER BY fecha DESC LIMIT 0,1";
            $stmt_lugar = $this->_db->cnx->prepare($sql);
            $stmt_lugar->execute();
            $lugar = $stmt_lugar->fetch(PDO::FETCH_OBJ);
            $res->lugar = $lugar->lugar;

            $this->listaAnimales[] = $res;
        }
        $this->_db->desconectar();
        return $this->listaAnimales;
    }
}


$estado = isset($_GET["estado"]) ? $_GET["estado"] : 0;

$consulta = new Consulta();
$animales = $consulta->buscar($estado);

$salida = "";
$salida .= "<table>";
$salida .= "<thead> <th>Caravana</th> <th>Caravana Ajena</th><th>Raza</th><th>Peso</th><th>Nacimiento</th><th>Color</th><th>Lugar</th><th>Sexo</th></thead>";
foreach ($animales as $r) {
    $salida .= "<tr> <td>" . $r->caravanaPropia . "</td> <td>" . $r->caravanaAjena . "</td><td>" . $r->raza . "</td><td>" . $r->peso . "</td><td>" . $r->nacimiento . "</td><td>" . $r->color . "</td><td>" . $r->lugar . "</td><td>" . $r->sexo . "</td></tr>";
}
$salida .= "</table>";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=animales.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $salida;


?>