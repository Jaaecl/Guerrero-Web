<?php
session_start();
require_once("../../model/conexion.php");
$db = new Conectar();
$con = $db->conexion();
$sql = "SELECT usuarios.nombre_usuario, facturas.subtotal_factura, facturas.factor_iva_factura, facturas.total_factura, 
       pedidos.Id_pedido, pedidos.entrega, pedidos.metodo_pago, pedidos.comprobante_pago, pedidos.estado_pedido, 
       detalle_pedido.cantidad_producto_pedido AS cantidad_productos, detalle_pedido.precio_producto_pedido 
FROM pedidos
INNER JOIN facturas ON pedidos.Id_factura = facturas.Id_factura
INNER JOIN usuarios ON facturas.Id_usuario = usuarios.Id_usuario
INNER JOIN detalle_pedido ON pedidos.Id_pedido = detalle_pedido.Id_pedido
GROUP BY pedidos.Id_pedido
ORDER BY facturas.fecha_factura DESC";


$query = $con->prepare($sql);
$query->execute();

// Obtener los datos de los pedidos y sus detalles
$pedidos = $query->fetchAll(PDO::FETCH_ASSOC);

?>