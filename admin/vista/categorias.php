<?php

require_once '../controlador/controlador_categoria.php';
$categoriaController = new CategoriasController();

$categorias = $categoriaController->index();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Categorias</title>
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
                <h1 class="m-0">Categorias</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Categorias</li>
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
                    <div class="input-group input-group-sm" style="width: 100px">
                        <a href="#addCategory" class="btn btn-primary" data-toggle="modal"><i class="fa-solid fa-plus"></i><span> Nuevo</span></a>
                    </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-striped table-valign-middle" id="example">
            <thead>
              <tr>
                <th>#</th>
                <th>Descripción</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($categorias as $categoria) : ?>
                <tr>
                  <td><?php echo $categoria->getId(); ?></td>
                  <td><?php echo $categoria->getNombre(); ?></td>
                  <td>
                    <a href="#editCategory_<?php echo $categoria->getId(); ?>" class="edit" data-toggle="modal"><i class="fa-solid fa-pen-to-square" data-toggle="tooltip" title="Edit" style="color: #2a28a9;"></i></a>
                    <a href="#deleteCategory_<?php echo $categoria->getId(); ?>" class="delete" data-toggle="modal"><i class="fa-sharp fa-solid fa-trash-can" data-toggle="tooltip" title="Delete" style="color: #9a2828;"></i></a>
                  </td>
                  <?php include('modals/edit_category.php'); ?>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php include('modals/create_category.php'); ?>
      </div>
      <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Main Footer -->
<?php include('capas/footer.php');?>
</div>
<?php include('../assets/plugins/datatables/datatable-function.php')?>
</script>
</body>
</html>