<?php

require_once("../../model/conexion.php");
$db = new Conectar();
$con = $db->conexion();
$sql = "SELECT usuarios.nombre_usuario, usuarios.apellido_usuario, usuarios.correo_usuario, usuarios.telefono_usuario, facturas.subtotal_factura, facturas.factor_iva_factura, facturas.total_factura, 
       pedidos.Id_pedido, pedidos.entrega, pedidos.metodo_pago, pedidos.comprobante_pago, pedidos.estado_pedido, 
       detalle_pedido.cantidad_producto_pedido AS cantidad_productos, detalle_pedido.precio_producto_pedido 
FROM pedidos
INNER JOIN facturas ON pedidos.Id_factura = facturas.Id_factura
INNER JOIN usuarios ON facturas.Id_usuario = usuarios.Id_usuario
INNER JOIN detalle_pedido ON pedidos.Id_pedido = detalle_pedido.Id_pedido
GROUP BY pedidos.Id_pedido
ORDER BY facturas.fecha_factura DESC";


$query = $con->prepare($sql);
$query->execute();

// Obtener los datos de los pedidos y sus detalles
$pedidos = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pedidos</title>
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
  <link rel="stylesheet" href="../assets/Magnific-Popup-master/dist/magnific-popup.css">
  <script src="../assets/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
  <script src="../assets/Magnific-Popup-master/dist/jquery.magnific-popup.js"></script>

  <script>
    $(document).ready(function() {
      $('.popup-image-button').magnificPopup({
        type: 'image',
        gallery: {
          enabled: true
        }
      });
    });
  </script>
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
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Pedidos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Pedidos</li>
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
                <!-- ./card-header -->
                <div class="card-body">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Usuario</th>
                        <th>Entrega por</th>
                        <th>Forma de Pago</th>
                        <th>Comprobante</th>
                        <th>Estado</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($pedidos as $pedido) { ?>
                        <tr data-widget="expandable-table" aria-expanded="false">
                          <td><?php echo $pedido['Id_pedido']; ?></td>
                          <td><?php echo $pedido['nombre_usuario'] . ' ' . $pedido['apellido_usuario']; ?></td>
                          <td><?php echo $pedido['entrega']; ?></td>
                          <td><?php echo $pedido['metodo_pago']; ?></td>
                          <td><button class="btn btn-sm btn-default popup-image-button" data-mfp-src="../../assets/img/pagos/<?php echo $pedido['comprobante_pago']; ?>"><i class="fa-solid fa-image"></i> Revisar</button></td>
                          <td><?php echo $pedido['estado_pedido']; ?>
                            <?php if ($pedido['estado_pedido'] != 'Finalizado') { ?>
                              <a href="../controlador/actualizar_pedido.php?Id_pedido=<?php echo $pedido['Id_pedido']; ?>">
                                <button class="btn btn-sm btn-default">Finalizar</button>
                              </a>
                            <?php } ?>
                          </td>

                        </tr>
                        <tr class="expandable-body">
                          <td colspan="6">
                            <?php
                            // Obtener los detalles del pedido
                            $query2 = $con->prepare("SELECT detalle_pedido.*, productos.nombre_producto 
                              FROM detalle_pedido 
                              INNER JOIN productos ON detalle_pedido.Id_producto = productos.Id_producto 
                              WHERE detalle_pedido.Id_pedido = ?");
                            $query2->execute([$pedido['Id_pedido']]);
                            $detalles_pedido = $query2->fetchAll(PDO::FETCH_ASSOC);
                            ?>

                            <table class="table table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>Producto</th>
                                  <th>Cantidad</th>
                                  <th>Precio</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($detalles_pedido as $detalle) { ?>
                                  <tr>
                                    <td><?php echo $detalle['nombre_producto']; ?></td>
                                    <td><?php echo $detalle['cantidad_producto_pedido']; ?></td>
                                    <td>$<?php echo $detalle['precio_producto_pedido']; ?></td>
                                  </tr>
                                <?php } ?>
                                <tr>
                                  <td></td>
                                  <td><strong>Subtotal:</strong></td>
                                  <td>$<?php echo $pedido['subtotal_factura']; ?></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td><strong>IVA:</strong></td>
                                  <td><?php echo $pedido['factor_iva_factura']; ?></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td><strong>Total:</strong></td>
                                  <td>$<?php echo $pedido['total_factura']; ?></td>
                                </tr>
                                <tr>
                                  <td>Correo: <?php echo $pedido['correo_usuario']; ?></td>
                                  <td>Teléfono: <?php echo $pedido['telefono_usuario']; ?></td>
                                  <td></td>
                                </tr>
                              </tbody>
                            </table>


                          </td>
                        </tr>
                      <?php } ?>

                    </tbody>
                  </table>
                  <?php include('modals/editar_pedido.php'); ?>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul>
                </div>
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
    <?php include('capas/footer.php'); ?>
  </div>
  <!-- ./wrapper -->
</body>

</html>