<?php

require_once "controlador/template_control.php";

$plantilla = new PlantillaControlador();
$plantilla -> CargarPlantilla();

?>

 <!--if($nivel_usuario=="Administrador"){?>
 	contenido 
 	<php }?>

 	historial usuarios

 	$id=SESSION['id'];

 	$nivel_usuario=$_SESSION['nivel_usuario']

 	if($tipo_usuario==1);

 		$where="";
 	else if (tipo_usuario==2);
 	$where="id=$id";

 	$sql select * from usuarios $where;
 	$result=mysqli->query($sql);