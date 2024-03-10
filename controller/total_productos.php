<?php
  // Consulta SQL para obtener el total de productos
  $sql_total = "SELECT COUNT(*) as total FROM productos";

  // Si se seleccionó una categoría, agregar la condición a la consulta SQL
  if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
    $sql_total .= " WHERE categoria_producto = '$categoria'";
  }

  // Si se seleccionó un proveedor, agregar la condición a la consulta SQL
  if (isset($_GET['marca'])) {
    $marca = $_GET['marca'];
    if (strpos($sql_total, 'WHERE') !== false) {
      $sql_total .= " AND proveedor_producto = '$marca'";
    } else {
      $sql_total .= " WHERE proveedor_producto = '$marca'";
    }
  }

  if (isset($_GET['search'])) {
    $search = $_GET['search'];
    if (strpos($sql_total, 'WHERE') !== false) {
      $sql_total .= " AND nombre_producto LIKE '%$search%'";
    } else {
      $sql_total .= " WHERE nombre_producto LIKE '%$search%'";
    }
  }
  
  // Ejecutar la consulta SQL para obtener el total de productos
  $stmt_total = $con->prepare($sql_total);
  $stmt_total->execute();
  $result_total = $stmt_total->fetch(PDO::FETCH_ASSOC);
  $total_productos = $result_total['total'];
?>