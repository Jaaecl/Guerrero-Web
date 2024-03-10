<?php
session_start();
require_once("../model/conexion.php");
$db = new Conectar();
$con = $db->conexion();

$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$id_usuario = $_SESSION['ID'];

// Actualizar la dirección y el teléfono del usuario en la base de datos
$sql_usuario = "UPDATE usuarios SET direccion_usuario = :direccion, telefono_usuario = :telefono WHERE Id_usuario = :id_usuario";
$stmt_usuario = $con->prepare($sql_usuario);
$stmt_usuario->execute(array(':direccion' => $direccion, ':telefono' => $telefono, ':id_usuario' => $id_usuario));

/*FACTURA*/
$usuario = $_POST['id_usuario'];
$num = "0001";

// Obtener el número de factura para el usuario actual
$sql_factura = "SELECT nro_factura FROM facturas WHERE id_usuario = :id_usuario ORDER BY Id_factura DESC LIMIT 1";
$stmt_factura = $con->prepare($sql_factura);
$stmt_factura->execute(array(':id_usuario' => $usuario));
$row_factura = $stmt_factura->fetch(PDO::FETCH_ASSOC);
if ($row_factura) {
  // Si ya hay una factura previa del usuario, extraer el número de factura
  $last_num = intval(substr($row_factura['nro_factura'], 2));
  
  // Incrementar el número de factura en 1
  $new_num = $last_num + 1;

  // Formatear el número de factura para que tenga el formato "1-XXXX"
  $num = $usuario . '-' . str_pad($new_num, 4, '0', STR_PAD_LEFT);
} else {
  // Si no hay una factura previa del usuario, asignar el número de factura con el formato "1-0001"
  $num = $usuario . '-' . $num;
}

// Obtener los valores de la factura
$iva = $_POST['iva'];
$subtotal = $_POST['subtotal'];
$delivery = $_POST['precio_delivery'];
$total = $_POST['total'];
$numero_factura = $num;

// Insertar la factura en la base de datos
$sql_insert_factura = "INSERT INTO facturas (nro_factura, Id_usuario, factor_iva_factura, subtotal_factura, precio_delivery, total_factura) VALUES (:nro_factura, :id_usuario, :iva, :subtotal, :precio_delivery, :total)";
$stmt_insert_factura = $con->prepare($sql_insert_factura);
$stmt_insert_factura->execute(array(':nro_factura' => $numero_factura, ':id_usuario' => $usuario, ':iva' => $iva, ':subtotal' => $subtotal, ':precio_delivery' => $delivery, ':total' => $total));

/*PEDIDOS*/

$id_factura = $con->lastInsertId();
$method = $_POST['metodoPago'];
$entrega = $_POST['entrega'];
$sql_pedidos = "SELECT * FROM carrito WHERE usuario = :usuario";
$query = $con->prepare($sql_pedidos);
$query->execute(array(':usuario' => $_SESSION['usuario']));
$img_name = $_FILES['imagen']['name'];
$img_type = $_FILES['imagen']['type'];
$img_size = $_FILES['imagen']['size'];

if($img_size<=1000000){
  if($img_type=="image/png"){
    //Ruta de carpeta destino en servidor
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/market/assets/img/pagos/';
    //Mover imagen de directorio temporal al directorio escogido
    move_uploaded_file($_FILES['imagen']['tmp_name'], $folder.$img_name);

    $sql_pedidos = "INSERT INTO pedidos (Id_factura, metodo_pago, comprobante_pago, entrega) VALUES (:id_factura, :metodo_pago, :comprobante_pago, :entrega)";
    $query_pedidos = $con->prepare($sql_pedidos);
    $query_pedidos->execute(array(':id_factura' => $id_factura, ':metodo_pago' => $method, ':comprobante_pago' => $img_name, ':entrega' => $entrega));

    $id_pedido = $con->lastInsertId();
    // Iterar sobre los resultados de la consulta del carrito
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $product_id = $row['id_producto'];
      $product_qty = $row['cantidad'];
      $product_price = $row['precio_producto'];

      // Actualizar existencia del producto
      $sql_actualizar_existencia = "UPDATE productos SET existencia_actual_producto = existencia_actual_producto - :cantidad WHERE Id_producto = :id_producto";
      $query_actualizar_existencia = $con->prepare($sql_actualizar_existencia);
      $query_actualizar_existencia->execute(array(':id_producto' => $product_id, ':cantidad' => $product_qty));

      $sql_detalle_pedido = "INSERT INTO detalle_pedido (Id_pedido, Id_producto, cantidad_producto_pedido, precio_producto_pedido) VALUES (:id_pedido, :id_producto, :cantidad, :precio)";
      $query_detalle_pedido = $con->prepare($sql_detalle_pedido);
      $query_detalle_pedido->execute(array(':id_pedido' => $id_pedido, ':id_producto' => $product_id, ':cantidad' => $product_qty, ':precio' => $product_price));
    }

  }else{
    'Formato no válido';
  }
}else{
  echo "El tamaño excede los límites";
}

// Vaciar el carrito
$usuario = $_SESSION['usuario'];
$sql_carrito = "DELETE FROM carrito WHERE usuario = :usuario";
$stmt_carrito = $con->prepare($sql_carrito);
$stmt_carrito->execute(array(':usuario' => $usuario));

header("Location:../view/factura.php");
?>