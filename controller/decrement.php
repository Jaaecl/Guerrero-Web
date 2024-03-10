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
    $product_price = $row['precio_producto'];
    if ($product_qty > 1){
        // Disminuir la cantidad del producto en 1
    $new_qty = $product_qty - 1;
    
    // Calcular el nuevo precio del producto
    $new_price = $product_price / $product_qty * $new_qty;
    
    // Actualizar la cantidad y el precio del producto en la base de datos
    $sql = "UPDATE carrito SET cantidad = :cantidad, precio_producto = :precio WHERE usuario = :usuario AND id_producto = :id_producto";
    $stmt = $con->prepare($sql);
    $stmt->execute(array(':cantidad' => $new_qty, ':precio' => $new_price, ':usuario' => $usuario, ':id_producto' => $product_id));  
    }else {
        // Si hay solo un producto, eliminarlo completamente del carrito
        $sql = "DELETE FROM carrito WHERE usuario = :usuario AND id_producto = :id_producto";
        $stmt = $con->prepare($sql);
        $stmt->execute(array(':usuario' => $usuario, ':id_producto' => $product_id));
    }
    

}

header("Location: ".$_SERVER['HTTP_REFERER']."");
exit();

?>