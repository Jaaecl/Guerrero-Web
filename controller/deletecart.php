<?php
session_start();
include_once('../model/conexion.php');
$db = new Conectar();
$con = $db->conexion();

$product_id = $_GET['id'];

// Obtener el contenido actual del carrito de compras del usuario
$usuario = $_SESSION['usuario'];
$sql = "DELETE FROM carrito WHERE usuario = :usuario AND id_producto = :id_producto";
$stmt = $con->prepare($sql);
$stmt->execute(array(':usuario' => $usuario, ':id_producto' => $product_id));

header("Location: ".$_SERVER['HTTP_REFERER']."");
exit();
?>