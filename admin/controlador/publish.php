<?php

session_start();
require_once("../../models/conexion.php");

if(isset($_POST['add'])){
	$db=new Conectar();
	$con=$db->conexion();

	$product = $_POST['producto'];
	$category = $_POST['categoria'];
	$cost = $_POST['costo'];
	$provider = $_POST['proveedor_p'];
	$initial=$_POST['stock_inicial'];
	$minimum = $_POST['stock_minimo'];
	$price = $_POST['precio'];
	//Datos de imagen
	$img_name = $_FILES['imagen']['name'];
	$img_type = $_FILES['imagen']['type'];
	$img_size = $_FILES['imagen']['size'];

	if($img_size<=1000000){
		if($img_type=="image/jpeg" || $img_type=="image/jpg" || $img_type=="image/png"){

	//Ruta de carpeta destino en servidor

	$folder = $_SERVER['DOCUMENT_ROOT'] . '/market/assets/img/productos/';

	//Mover imagen de directorio temporal al directorio escogido

	move_uploaded_file($_FILES['imagen']['tmp_name'], $folder.$img_name);

	require_once('c://xampp/htdocs/market/models/conexion.php');
	$db=new Conectar();
	$con=$db->conexion();

	$sql = "INSERT INTO productos (nombre_producto, categoria_producto, precio_costo_producto, proveedor_producto, existencia_inicial_producto, existencia_actual_producto, stock_min_producto, precio_venta_producto, imagen_producto) VALUES ('$product', '$category', '$cost', '$provider', '$initial', '$initial', '$minimum', '$price', '$img_name')";

	$resultado = $con->query($sql);

	if($resultado){
			header("location: ".$_SERVER['HTTP_REFERER']."");
		}else{
			'error';
		}

		}else{
		echo "Formato no válido";
		}

	}else{
	echo "El tamaño excede los límites";
	}


		
}
?>