<?php
	session_start();
	include_once('../../models/conexion.php');

	if(isset($_GET['id'])){
		$db = new Conectar();
		$con = $db->conexion();
		try{
			$sql = "DELETE FROM productos WHERE Id_producto = '".$_GET['id']."'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $con->exec($sql) ) ? 'Member deleted successfully' : 'Something went wrong. Cannot delete member';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$db->close();

	}
	else{
		$_SESSION['message'] = 'Select member to delete first';
	}

	header("location: ".$_SERVER['HTTP_REFERER']."");

?>

<?php
	session_start();
	include_once('../../models/conexion.php');

	if(isset($_GET['id'])){
		$db = new Conectar();
		$con = $db->conexion();
		try{
			$sql = "DELETE FROM productos WHERE Id_producto = '".$_GET['id']."'";
			//if-else statement in executing our query
			if($con->exec($sql)){
				echo 'Producto eliminado exitosamente';
			} else {
				echo 'Algo salió mal. No se pudo eliminar el producto';
			}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}

		//close connection
		$db->close();

	}
	else{
		echo 'Seleccione un producto para eliminar primero';
	}

	header("location: ".$_SERVER['HTTP_REFERER']."");
?>