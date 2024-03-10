<?php

include_once('../model/conexion.php');
$db = new Conectar();
$con = $db->conexion();
?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="assets/img/favicon-16x16.png" rel="icon">
  <link href="../assets/css/4.1.1.bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/catalog.css" rel="stylesheet">
  <!--Bootstrap JS-->
  <script src="../assets/js/4.1.1.bootstrap.min.js"></script>
  <script src="../assets/js/3.2.1.jquery.min.js"></script>
  <script src="../assets/js/jquery-ui.js" integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
  <script src="../assets/js/4.0.0.bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="../assets/js/(ajax)jquery.min.js"></script>
  <script src="../assets/js/catalog.js"></script>
  <title>Supermercado El Bosque</title>

</head>

<body id="page-top">
  <?php
  include('layouts/header.php');
  ?>

  <main id="main">

    <div class="breadcrumbs">
      <nav>
        <div class="container">
          <ol>
            <li><a href="../index.php">Inicio</a></li>
            <li>Tienda</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->


    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">
          <div class="col-lg-3">

            <div class="sidebar">

              <div class="sidebar-item search-form">
                <h3 class="sidebar-title">Buscar</h3>
                <form class="mt-3" method="GET">
                  <input type="text" name="search" placeholder="Buscar...">
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

              <div class="sidebar-item categories">
                <h3 class="sidebar-title">Categorias</h3>
                <ul class="mt-3">
                  <li><a href="tienda.php">Todos</a></li>
                  <?php
                  $query = "SELECT * FROM categorias ORDER BY nombre_categoria ASC";
                  $stmt = $con->prepare($query);
                  $stmt->execute();
                  $result = $stmt->fetchAll();
                  foreach ($result as $row_categoria) {
                    $categoria = $row_categoria['Id_categoria'];
                  ?>
                    <li><a href="?categoria=<?php echo $categoria; ?>"><?php echo $row_categoria['nombre_categoria']; ?></a></li>
                    <?php } ?>
                </ul>
              </div><!-- End sidebar categories-->

              <div class="sidebar-item categories">
                <h3 class="sidebar-title">Marcas</h3>
                <ul class="mt-3">
                  <?php
                  $query = "SELECT * FROM proveedores ORDER BY Id_proveedor DESC";
                  $stmt = $con->prepare($query);
                  $stmt->execute();
                  $result = $stmt->fetchAll();
                  foreach ($result as $row_proveedor) {
                    $proveedor = $row_proveedor['Id_proveedor'];
                  ?>
                    <li><a href="?marca=<?php echo $proveedor; ?>"><?php echo $row_proveedor['razon_social_proveedor']; ?></a></li>
                  <?php } ?>
                </ul>
              </div><!-- End sidebar categories-->
            </div><!-- End Sidebar -->
          </div><!-- col-lg-3 -->
          <div class="col-lg-8">
            <?php include_once('../controller/total_productos.php'); ?>

            <article class="blog-details">
              <header class="border-bottom mb-4 pb-3">
                <div class="form-inline">
                  <span class="mr-md-auto"><?php echo "Cantidad de productos: " . $total_productos ?></span>
                  <select class="mr-2 form-control" id="filtro" style="width: 180px;">
                    <option value="new" selected>Nuevos</option>
                    <option value="high">Mayor precio</option>
                    <option value="low">Menor precio</option>
                  </select>
                </div>
              </header>

              <div class="row" id="resultado">
                <?php
                try {
                  $sql = "SELECT * FROM productos
                  INNER JOIN categorias ON productos.categoria_producto = categorias.Id_categoria
                  INNER JOIN proveedores ON productos.proveedor_producto = proveedores.Id_proveedor";

                  if (isset($_GET['categoria'])) {
                    $categoria = $_GET['categoria'];
                    $sql .= " WHERE categoria_producto = '$categoria'";
                  }

                  if (isset($_GET['marca'])) {
                    $marca = $_GET['marca'];
                    if (strpos($sql, 'WHERE') !== false) {
                      $sql .= " AND proveedor_producto = '$marca'";
                    } else {
                      $sql .= " WHERE proveedor_producto = '$marca'";
                    }
                  }

                  if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    if (strpos($sql, 'WHERE') !== false) {
                      $sql .= " AND nombre_producto LIKE '%$search%'";
                    } else {
                      $sql .= " WHERE nombre_producto LIKE '%$search%'";
                    }
                  }
                  foreach ($con->query($sql) as $row) { ?>

                    <div class="col-md-3 mb-4 text-center">
                      <?php if (!isset($_SESSION['usuario'])) { ?>
                        <form action="/market/vista/login.php" method="post">
                        <?php } ?>
                        <form action="../controller/addtocart.php" method="post">
                          <div class="product-data">
                            <input type="hidden" name="Id_producto" value="<?php echo $row['Id_producto']; ?>">
                            <input type="hidden" name="imagen_producto" value="<?php echo $row['imagen_producto']; ?>">
                            <input type="hidden" name="nombre_producto" value="<?php echo $row['nombre_producto']; ?>">
                            <input type="hidden" name="precio_venta_producto" value="<?php echo $row['precio_venta_producto']; ?>">
                            <input type="hidden" name="cantidad" value="1" min="1">
                          </div>
                          <div class="card product-card" onmouseover="showFullText(this)" onmouseout="hideFullText(this)">
                            <img class="card-img-top" src="/market/assets/img/productos/<?php echo $row['imagen_producto']; ?>">
                            <div class="card-body">
                              <p class="card-title short-text"><?php echo $row['nombre_producto']; ?></p>
                              <p class="card-text">$<?php echo $row['precio_venta_producto']; ?></p>
                              <button type="submit" name="agregar" class="btn btn-success add"> + Agregar</button>
                            </div>
                          </div>
                        </form>
                    </div>
                <?php
                  }
                } catch (PDOException $e) {
                  echo "Se presentó un problema con la conexión: " . $e->getMessage();
                }
                ?>
              </div>
              <nav class="mt-4" aria-label="Page navigation sample">
                <ul class="pagination">
                  <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                </ul>
              </nav>
              <script src="../assets/js/filters.js"></script>
            </article>
          </div>
        </div>
      </div>
    </section>

    <?php include('layouts/footer.php'); ?>
</body>

</html>