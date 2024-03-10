<?php

require_once "../model/conexion.php";
$db = new Conectar();
$con = $db->conexion();

$filtro = $_GET["filtro"];

switch ($filtro) {
    case "high":
        $sql = "SELECT * FROM productos ORDER BY precio_venta_producto DESC";
        break;
    case "low":
        $sql = "SELECT * FROM productos ORDER BY precio_venta_producto ASC";
        break;
    case "new":
        $sql = "SELECT * FROM productos ORDER BY Id_producto DESC";
}

try {
    foreach ($con->query($sql) as $row) {
?>
    <div class="col-md-3 mb-4">
    <?php if(!isset($_SESSION['usuario'])){?>
                    <form action="/market/view/login.php" method="post">
                    <?php } ?>
                    <form action="../controller/addtocart.php" method="post">
    <div class="card">

      <img class="card-img-top" src="/market/assets/img/productos/<?php echo $row['imagen_producto']; ?>">
      <div class="card-body">
        <p class="card-title"><?php echo $row['nombre_producto']; ?></p>
        <p class="card-text">$<?php echo $row['precio_venta_producto']; ?></p>
        <button type="submit" name="agregar" class="btn btn-success add"> + Agregar</button>
        <div class="product-data">
          <input type="hidden" name="Id_producto" value="<?php echo $row['Id_producto'];?>">
          <input type="hidden" name="imagen_producto" value="<?php echo $row['imagen_producto']; ?>">
          <input type="hidden" name="nombre_producto" value="<?php echo $row['nombre_producto']; ?>">
          <input type="hidden" name="precio_venta_producto" value="<?php echo $row['precio_venta_producto']; ?>">
          <input type="hidden" name="cantidad" value="1" min="1">
        </div>
      </div>
    </div>
  </div>
<?php
    }
} catch (PDOException $e) {
    echo "There is some problem in connection: " . $e->getMessage();
}