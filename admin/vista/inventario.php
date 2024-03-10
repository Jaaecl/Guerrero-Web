<?php

require_once '../controlador/controlador_producto.php';
$productosController = new ProductosController();

$productos = $productosController->index();

require_once '../controlador/controlador_proveedores.php';
$proveedoresController = new ProveedoresController();

$proveedores = $proveedoresController->index();

require_once '../controlador/controlador_categoria.php';
$categoriaController = new CategoriasController();

$categorias = $categoriaController->index();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inventario</title>
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/market/admin/assets/plugins/fontawesome-free/css/all.min.css">
  <link href="/market/assets/icons/fontawesome-free-6.4.0-web/css/all.min.css" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <!-- REQUIRED SCRIPTS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <!-- jQuery -->
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

  <?php 
  include('capas/navbar.php');
  include('capas/sidebar.php'); 
  ?>
      <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Inventario</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Inventario</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">

        <div class="container-fluid">

        <!-- /.row -->
          <div class="row">

            <div class="col-12">

              <div class="card">
                <div class="card-header">
                                    <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 100px;">
                        <a href="#addProduct" class="btn btn-primary" data-toggle="modal"><i class="fa-solid fa-plus"></i><span> Nuevo</span></a>
                    </div>
                  </div>
                </div>

              <!-- /.card-header -->
              <div class="card-body">

                <table id="example" class="table table-bordered table-striped">


                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Categoría</th>
                      <th>Proveedor</th>
                      <th>Existencia Inicial</th>
                      <th>Existencia Actual</th>
                      <th>Precio Venta</th>
                      <th>Stock Mínimo</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($productos as $producto): ?>
                    <tr>
                      <td><?php echo $producto->getId(); ?></td>
                      <td><?php echo $producto->getNombre(); ?></td>
                      <td><?php echo $producto->getCategoria(); ?></td>
                      <td><?php echo $producto->getProveedor(); ?></td>
                      <td><?php echo $producto->getExistenciaInicial(); ?></td>
                      <td><?php echo $producto->getExistenciaActual(); ?></td>
                      <td>$<?php echo $producto->getPrecioVenta(); ?></td>
                      <td><?php echo $producto->getStockMinimo(); ?></td>    
                      <td>
                        <a href="#editProduct_<?php echo $producto->getId(); ?>" class="edit" data-toggle="modal"><i class="fa-solid fa-pen-to-square" data-toggle="tooltip" title="Edit" style="color: #2a28a9;"></i></a>
                        <a href="#deleteProduct_<?php echo $producto->getId(); ?>" class="delete" data-toggle="modal"><i class="fa-sharp fa-solid fa-trash-can" data-toggle="tooltip" title="Delete" style="color: #9a2828;"></i></a>
                      </td>
                      <?php include('modals/edit_product.php'); ?>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <?php include('modals/create_product.php'); ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
</div>
 <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
<?php include('capas/footer.php');?>
  </div>
  <!-- ./wrapper -->
<?php include('../assets/plugins/datatables/datatable-function.php')?>
</body>
</html>