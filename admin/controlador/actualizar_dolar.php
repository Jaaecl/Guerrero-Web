<?php
$nuevo_valor = $_POST['nuevo_valor'];
file_put_contents('../../dolar.txt', $nuevo_valor);
header("Location: ".$_SERVER['HTTP_REFERER']."");
?>