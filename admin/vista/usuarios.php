<?php

require_once '../controlador/controlador_usuarios.php';
$usuarioController = new UsuarioController();

$usuarios = $usuarioController->index();

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Usuarios</title>
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
              <h1 class="m-0">Usuarios</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../home.php">Inicio</a></li>
                <li class="breadcrumb-item active">Usuarios</li>
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
                    <div class="input-group input-group-sm" style="width: 150px;">
                    </div>
                  </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered table-striped" id="example">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Fecha de Registro</th>
                        <th>Nivel</th>
                        <th>Estatus</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($usuarios as $usuario) : ?>
                        <?php if ($usuario->getId() != $user_id) : ?>
                          <tr>
                            <td><?php echo $usuario->getId(); ?></td>
                            <td><?php echo $usuario->getNombreU(); ?></td>
                            <td><?php echo $usuario->getApellidoU(); ?></td>
                            <td><?php echo $usuario->getDireccionU(); ?></td>
                            <td><?php echo $usuario->getTelefonoU(); ?></td>
                            <td><?php echo $usuario->getCorreoU(); ?></td>
                            <td><?php echo $usuario->getFechaU(); ?></td>
                            <td><?php echo $usuario->getNivel(); ?></td>
                            <td><?php echo $usuario->getEstatus(); ?></td>
                            <td>
                              <a href="#level_<?php echo $usuario->getId(); ?>" class="edit" data-toggle="modal"><i class="fa-solid fa-key" data-toggle="tooltip" title="Edit" style="color: #1a1a19;"></i></a>
                              <?php if ($usuario->getEstatus() != 'inactivo') { ?>
                                <a href="#status_<?php echo $usuario->getId(); ?>" class="edit" data-toggle="modal"><i class="fa-solid fa-user-slash" data-toggle="tooltip" title="Edit" style="color: #cc0f0f;"></i></a>
                              <?php } else { ?>
                                <a href="#status_<?php echo $usuario->getId(); ?>" class="edit" data-toggle="modal"><i class="fa-solid fa-user-check" data-toggle="tooltip" title="Edit" style="color: #15c121;"></i></a>
                              <?php } ?>
                            </td>
                            <?php include('modals/edit_users.php'); ?>
                          </tr>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <hr>
              <?php
          include_once('../../model/conexion.php');
          $db = new Conectar();
          $con = $db->conexion();

          $sql = "SELECT * FROM usuarios WHERE Id_usuario = :user_id";
          $stmt = $con->prepare($sql);
          $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
          $stmt->execute();
          $usuario_actual = $stmt->fetch(PDO::FETCH_ASSOC);

          // Mostrar los detalles del usuario en una sección de la página
          echo "<h2>Tu cuenta</h2>";
          echo "<p><strong>Nombre: </strong>" . $usuario_actual['nombre_usuario'] . "</p>";
          echo "<p><strong>Apellido: </strong>" . $usuario_actual['apellido_usuario'] . "</p>";
          echo "<p><strong>Correo electrónico: </strong>" . $usuario_actual['correo_usuario'] . "</p>";
          echo "<p><strong>Teléfono: </strong>" . $usuario_actual['telefono_usuario'] . "</p>";
          echo "<p><strong>Dirección: </strong>" . $usuario_actual['direccion_usuario'] . "</p>";
          echo "<p><strong>Nivel: </strong>" . $usuario_actual['nivel_usuario'] . "</p>";
          echo "<p><strong>Fecha de registro: </strong>" . $usuario_actual['fecha_creacion_usuario'] . "</p>";
          ?>
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <?php include('capas/footer.php'); ?>
  </div>
  <!-- ./wrapper -->