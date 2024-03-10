<?php
	session_start();
	include_once('../../models/conexion.php');

	if(isset($_POST['edit'])){
		$db = new Conectar();
		$con = $db->conexion();
		try{
			$id = $_GET['id'];
			$product = $_POST['producto'];
			$category = $_POST['categoria'];
			$cost = $_POST['costo'];
			$prov = $_POST['proveedor_p'];
			$minimo = $_POST['stock_minimo'];
			$price = $_POST['precio'];
			$image=addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
			/*Usuarios*/
			/*$nivel=isset($_POST['level']) ? $_POST['level'] : '1';*/
			/*$status=isset($_POST['status']) ? $_POST['status'] : '1';*/

			$sql = "UPDATE productos SET nombre_producto = '$product', categoria_producto = '$category', precio_costo_producto = '$cost', proveedor = '$prov', stock_min_producto = '$minimo', precio_venta_producto = '$price', img_producto = '$image' WHERE Id_producto = '$id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $con->exec($sql) ) ? 'Member updated successfully' : 'Something went wrong. Cannot update member';

		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$db->close();
	}
	else{
		$_SESSION['message'] = 'Fill up edit form first';
	}

	header("location: ".$_SERVER['HTTP_REFERER']."");

?>