<?php

include_once('../../model/conexion.php');
$db = new Conectar();
$con = $db->conexion();
$sql = "SELECT acciones_usuarios.*, usuarios.correo_usuario, usuarios.nombre_usuario 
        FROM acciones_usuarios 
        INNER JOIN usuarios ON acciones_usuarios.Id_usuario = usuarios.Id_usuario 
        ORDER BY acciones_usuarios.fecha_hora DESC";

$stmt = $con->prepare($sql);
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Historial</title>
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
                 <h1 class="m-0">Historial</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Historial</li>
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
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Dirección IP</th>
                    <th>Acción</th>
                    <th>Fecha y hora</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($resultados as $resultado): ?>
                  <tr>
        <td><?php echo $resultado['Id_accion'] ?></td>
        <td><?php echo $resultado['nombre_usuario'] ?></td>
        <td><?php echo $resultado['correo_usuario'] ?></td>
        <td><?php echo $resultado['direccion_ip'] ?></td>
        <td><?php echo $resultado['accion_usuario'] ?></td>
        <td><?php echo $resultado['fecha_hora'] ?></td>
                  </tr>
                  <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
     </div><!-- /.container-fluid -->
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