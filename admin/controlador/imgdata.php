<?php

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

	}else{
		echo "Formato no válido";
	}

}else{
	echo "El tamaño excede los límites";
}

require_once('c://xampp/htdocs/market/models/conexion.php');
$db=new Conectar();
$con=$db->conexion();

$sql = "INSERT INTO test (foto) VALUES ('$img_name')";

$resultado = $con->query($sql);

?>