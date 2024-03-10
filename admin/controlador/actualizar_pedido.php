<?php

include_once('../../model/conexion.php');
$db = new Conectar();
$con = $db->conexion();

$id_pedido = $_GET["Id_pedido"];
$nuevo_estado = "Finalizado";

$sql = "UPDATE pedidos SET estado_pedido = :nuevo_estado WHERE Id_pedido = :id_pedido";
$resultado = $con->prepare($sql);
$resultado->execute(array(":nuevo_estado"=>$nuevo_estado, ":id_pedido"=>$id_pedido));

header("location:../vista/pedidos.php");

?>