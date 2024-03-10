<?php 
    include_once('../model/conexion.php');
    $db=new Conectar();
    $con=$db->conexion();
    
try{

    $email=htmlentities(addslashes($_POST["email"]));

    $password=htmlentities(addslashes($_POST["password"]));
        
    $sql="SELECT Id_usuario, correo_usuario, nombre_usuario, contraseña_usuario, nivel_usuario, estatus_usuario FROM usuarios where correo_usuario= :login";
    
    $resultado=$con->prepare($sql);     
        
    $resultado->execute(array(":login"=>$email));

    $registro=$resultado->fetch(PDO::FETCH_ASSOC);

    if($registro) {
        if(password_verify($password, $registro["contraseña_usuario"])) {
            session_start();
    
            $_SESSION["usuario"] = $_POST["email"];
            $_SESSION["nombre"] = $registro["nombre_usuario"];
            $_SESSION["ID"] = $registro["Id_usuario"];
            $_SESSION['status'] = $registro["estatus_usuario"];
    
            if($_SESSION['status'] == 'activo') {
                if($registro['nivel_usuario'] == 'estandar') {
                    $_SESSION["nivel"] = $registro["nivel_usuario"];
                    header("location:../index.php");
                } else if($registro['nivel_usuario'] == 'administrador') {
                    $_SESSION["nivel"] = $registro["nivel_usuario"];
                    header("location:../admin/home.php");
                }
                // Registrar acción de inicio de sesión en la tabla de auditoría
                $direccion_ip = $_SERVER['REMOTE_ADDR'];
                $accion = 'Inicio de sesión';
                $sql_audit = "INSERT INTO acciones_usuarios (Id_usuario, direccion_ip, accion_usuario) VALUES (:id_usuario, :direccion_ip, :accion)";
                $stmt_audit = $con->prepare($sql_audit);
                $stmt_audit->execute(array(":id_usuario" => $registro["Id_usuario"], ":direccion_ip" => $direccion_ip, ":accion" => $accion));
            } else {
                header("location:../view/login.php?error=3");
            }   
        } else {
            header("location:../view/login.php?error=1");
        }
        $resultado->closeCursor();
    }
    


}catch(Exception $e){            
            
    echo "Línea del error: " . $e->getLine();
    
}finally{
    
    $base=null;
    
    
}

?>