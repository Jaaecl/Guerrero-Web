<?php
// Obtener los datos del formulario
$correo = $_POST['email'];
$nuevaClave = $_POST['new-password'];

// Encriptar la nueva contraseña
$encryption = password_hash($nuevaClave, PASSWORD_DEFAULT);

// Realizar la consulta UPDATE en la base de datos
try {
    include_once('c://xampp/htdocs/market/model/conexion.php');
    $db = new Conectar();
    $con = $db->conexion();

    $sql = "UPDATE usuarios SET contraseña_usuario = :nuevaClave WHERE correo_usuario = :correo";

    $stmt = $con->prepare($sql);

    $stmt->bindParam(':nuevaClave', $encryption, PDO::PARAM_STR);
    $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);

    $stmt->execute();

    // Verificar si se actualizó algún registro en la base de datos
    if ($stmt->rowCount() > 0) {
        // Obtener el ID del usuario recién registrado
        $sql_select = "SELECT Id_usuario FROM usuarios WHERE correo_usuario = :correo";
        $stmt_select = $con->prepare($sql_select);
        $stmt_select->execute(array(":correo" => $correo));
        $registro = $stmt_select->fetch(PDO::FETCH_ASSOC);

        // Registrar acción de cambio de contraseña en la tabla de auditoría
        $direccion_ip = $_SERVER['REMOTE_ADDR'];
        $accion = 'Cambio de contraseña';
        $sql_audit = "INSERT INTO acciones_usuarios (Id_usuario, direccion_ip, accion_usuario) VALUES (:id_usuario, :direccion_ip, :accion)";
        $stmt_audit = $con->prepare($sql_audit);
        $stmt_audit->execute(array(":id_usuario" => $registro["Id_usuario"], ":direccion_ip" => $direccion_ip, ":accion" => $accion));

        echo "La contraseña se actualizó correctamente";
        header("refresh:3;url=../index.php");
    } else {
        echo "No se encontró ningún usuario con el correo proporcionado";
        header("refresh:3;url=../view/login.php");
    }


} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión a la base de datos
$con = null;
?>