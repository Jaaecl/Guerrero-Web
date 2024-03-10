<?php 

session_start();

require_once('../model/conexion.php');
$db = new Conectar();
$con = $db->conexion();

$id = $_POST['Id_producto'];
$nombre = $_POST['nombre_producto'];
$precio = $_POST['precio_venta_producto'];
$imagen = '/market/assets/img/productos/' .$_POST['imagen_producto'];
$cantidad = $_POST['cantidad'];

// Verificar si el producto ya existe en la tabla para ese usuario
$sql = "SELECT * FROM carrito WHERE id_producto = :id AND usuario = :usuario";
$stmt = $con->prepare($sql);
$stmt->execute(array(':id' => $id, ':usuario' => $_SESSION['usuario']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    // Si el producto ya existe, actualizar la cantidad
    $cantidad = $cantidad + $row['cantidad'];
    $sql = "UPDATE carrito SET cantidad = :cantidad WHERE id_producto = :id AND usuario = :usuario";
    $stmt = $con->prepare($sql);
    $stmt->execute(array(':cantidad' => $cantidad, ':id' => $id, ':usuario' => $_SESSION['usuario']));
} else {
    // Si el producto no existe, insertar un nuevo registro en la tabla
    $sql = "INSERT INTO carrito (id_producto, titulo_producto, precio_producto, cantidad, foto_producto, usuario) VALUES (:id, :nombre, :precio, :cantidad, :imagen, :usuario)";
    $stmt = $con->prepare($sql);
    $stmt->execute(array(':id' => $id, ':nombre' => $nombre, ':precio' => $precio, ':cantidad' => $cantidad, ':imagen' => $imagen, ':usuario' => $_SESSION['usuario']));
}

header("Location: ".$_SERVER['HTTP_REFERER']."");
exit();

$con = null;

?>