<?php
include_once('C:/xampp/htdocs/market/model/conexion.php');
$db = new Conectar();
$con = $db->conexion();

class Carrito {
  private $con;

  public function __construct($con) {
    $this->con = $con;
  }

  public function getCantidadTotal($usuario) {
    $sql = "SELECT SUM(cantidad) AS cantidad_total FROM carrito WHERE usuario = :usuario";
    $stmt = $this->con->prepare($sql);
    $stmt->execute(array(':usuario' => $usuario));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return ($row['cantidad_total']) ? $row['cantidad_total'] : 0;
  }
}

?>