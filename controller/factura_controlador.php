<?php

session_start();
$id_usuario = $_SESSION['ID'];
require_once("../model/conexion.php");
$db = new Conectar();
$con = $db->conexion();
$sql = "SELECT * FROM pedidos
INNER JOIN facturas ON pedidos.Id_factura = facturas.Id_factura
INNER JOIN usuarios ON facturas.Id_usuario = usuarios.Id_usuario
INNER JOIN detalle_pedido ON pedidos.Id_pedido = detalle_pedido.Id_pedido
INNER JOIN productos ON detalle_pedido.Id_producto = productos.Id_producto
WHERE usuarios.Id_usuario = ?
ORDER BY facturas.fecha_factura DESC
LIMIT 1";

$query = $con->prepare($sql);
$query->execute(array($id_usuario));

// Obtener los datos de la última factura del usuario
$factura = $query->fetch(PDO::FETCH_ASSOC);

// Obtener los detalles del pedido
$query2 = $con->prepare("SELECT detalle_pedido.*, productos.nombre_producto FROM detalle_pedido 
	INNER JOIN productos ON detalle_pedido.Id_producto = productos.Id_producto
	WHERE Id_pedido = ?");
$query2->bindParam(1, $factura['Id_pedido']);
$query2->execute();
$detalles_pedido = $query2->fetchAll(PDO::FETCH_ASSOC);
?>