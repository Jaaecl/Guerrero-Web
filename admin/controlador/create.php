<?php
	session_start();
	require_once("../../models/conexion.php");
 
	if(isset($_POST['add'])){
		$db=new Conectar();
		$con=$db->conexion();
		try{
			//make use of prepared statement to prevent sql injection
			$stmt = $con->prepare("INSERT INTO productos (nombre_producto, categoria_producto, precio_costo_producto, proveedor_producto, existencia_inicial_producto, stock_min_producto, precio_venta_producto) VALUES (:producto, :categoria, :costo, :proveedor_p, :stock_inicial, :stock_minimo, :precio)");
			//if-else statement in executing our prepared statement
			$_SESSION['message'] = ( $stmt->execute(array(':producto' => $_POST['producto'] , ':categoria' => $_POST['categoria'] ,':costo' => $_POST['costo'] , ':proveedor_p' => $_POST['proveedor_p'], ':stock_inicial' => $_POST['stock_inicial'], ':stock_minimo' => $_POST['stock_minimo'], ':precio' => $_POST['precio'])) ) ? 'Registro agregado' : 'Algo salio mal, no se pudo agregar registro';	
 
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}
 
		//close connection
		$db->close();
	}
 
	else{
		$_SESSION['message'] = 'Complete los campos primero';
	}
 
	header("location: ".$_SERVER['HTTP_REFERER']."");
 
?>