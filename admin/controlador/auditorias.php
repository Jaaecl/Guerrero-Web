<?php

function registrarAccion($id_usuario, $direccion_ip, $tipo_accion, $tabla, $id_registro = null) {
    include_once('C:/xampp/htdocs/market/model/conexion.php');
    $db = new Conectar();
    $con = $db->conexion();
    
    $accion = $tipo_accion . '(' . $tabla . ')';
    
    if (!is_null($id_registro)) {
        $accion .= ' - ID: ' . $id_registro;
    }

    $sql_audit = "INSERT INTO acciones_usuarios (Id_usuario, direccion_ip, accion_usuario) VALUES (:id_usuario, :direccion_ip, :accion)";
    $stmt_audit = $con->prepare($sql_audit);
    $stmt_audit->execute(array(":id_usuario" => $id_usuario, ":direccion_ip" => $direccion_ip, ":accion" => $accion));
}

?>