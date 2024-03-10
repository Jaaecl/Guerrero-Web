<?php

$nombre=$_POST["name"];
$apellido=$_POST["lastname"];
$correo=$_POST["email"];
$clave=$_POST["password"];

$encryption=password_hash($clave, PASSWORD_DEFAULT);//,array("cost=>12")

if ($_POST["password"]==$_POST["confirm-password"]){
    include_once('c://xampp/htdocs/market/model/conexion.php');
    $db=new Conectar();
    $con=$db->conexion();

    try{
        
        $sql="INSERT INTO usuarios (nombre_usuario, apellido_usuario, correo_usuario, contraseña_usuario, nivel_usuario) VALUES (:name, :lastname, :email, :password, :nivel)";
        
        $resultado=$con->prepare($sql);     
        
        $resultado->execute(array(":name"=>$nombre, ":lastname"=>$apellido, ":email"=>$correo, ":password"=>$encryption, ":nivel"=>"estandar"));

        // Obtener el ID del usuario recién registrado
        $id_usuario = $con->lastInsertId();

        session_start();

        $_SESSION["usuario"]=$_POST["email"];
        $_SESSION['nombre']=$_POST['name'];
        $_SESSION["ID"] = $id_usuario;
        $_SESSION['nivel'] = 'estandar';

        // Registrar acción de inicio de sesión en la tabla de auditoría
        $direccion_ip = $_SERVER['REMOTE_ADDR'];
        $accion = 'Registro de usuario';
        $sql_audit = "INSERT INTO acciones_usuarios (Id_usuario, direccion_ip, accion_usuario) VALUES (:id_usuario, :direccion_ip, :accion)";
        $stmt_audit = $con->prepare($sql_audit);
        $stmt_audit->execute(array(":id_usuario" => $id_usuario, ":direccion_ip" => $direccion_ip, ":accion" => $accion));

        header("location:../index.php");
        
        $resultado->closeCursor();

    }catch(Exception $e){

        echo "error" . $e->getMessage();            
        
        echo "Línea del error: " . $e->getLine();
        
    }finally{
        
        $base=null;
        
        
    }

}

else{
    header("location:../view/login.php?error=2");
}


    

    //Si quieren saber si el usuario ya existe para no insertar más de una vez, hagan una consulta preparada con PDO y luego de execute($consulta) usen el método rowCount() y establezcan una condición
//if( $filas=$pdoStatement->rowCount() ==0){
    // hacen la inserción
 //} else{
 
    // muestran el error "que ya existen registros con esos datos, por ejemplo"
 //}password: password

?>