<?php
session_start();
include_once('../model/conexion.php');
$db = new Conectar();
$con = $db->conexion();

$product_id = $_GET['id'];

// Obtener el contenido actual del carrito de compras del usuario
$usuario = $_SESSION['usuario'];
$sql = "SELECT * FROM carrito WHERE usuario = :usuario AND id_producto = :id_producto";
$stmt = $con->prepare($sql);
$stmt->execute(array(':usuario' => $usuario, ':id_producto' => $product_id));

// Verificar si el producto existe en el carrito
if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $product_qty = $row['cantidad'];
    
    // Obtener el precio del producto
    $sql = "SELECT precio_venta_producto FROM productos WHERE Id_producto = :id_producto";
    $stmt = $con->prepare($sql);
    $stmt->execute(array(':id_producto' => $product_id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $product_price = $row['precio_venta_producto'];

    // Incrementar la cantidad del producto en 1
    $new_qty = $product_qty + 1;
    
    // Actualizar la cantidad y el precio total del producto en la base de datos
    $new_total = $new_qty * $product_price;
    $sql = "UPDATE carrito SET cantidad = :cantidad, precio_producto = :precio_total WHERE usuario = :usuario AND id_producto = :id_producto";
    $stmt = $con->prepare($sql);
    $stmt->execute(array(':cantidad' => $new_qty, ':precio_total' => $new_total, ':usuario' => $usuario, ':id_producto' => $product_id));
}

header("Location: ".$_SERVER['HTTP_REFERER']."");
exit();

?>