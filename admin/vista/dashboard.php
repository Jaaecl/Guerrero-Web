<?php require_once("../model/conexion.php");
$db = new Conectar();
$con = $db->conexion();
      $sql = "SELECT p.Id_producto, p.nombre_producto, SUM(d.cantidad_producto_pedido) AS total_comprado
          FROM detalle_pedido d
          INNER JOIN productos p ON d.Id_producto = p.Id_producto
          GROUP BY p.Id_producto, p.nombre_producto
          ORDER BY total_comprado DESC
          LIMIT 10;";
$stmt = $con->prepare($sql);
$stmt->execute();
$cols = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<link href="assets/plugins/datatables/DataTables/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
<link href="assets/plugins/datatables/Buttons/css/buttons.bootstrap4.min.css" rel="stylesheet"/>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Tablero</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="../index.php">Ir a tienda</a></li>
          <li class="breadcrumb-item active">Tablero (Inicio)</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <!-- Small Box (Stat card) -->

    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-info">
          <?php
          $query = "SELECT COUNT(*) as total FROM pedidos WHERE estado_pedido='En proceso'";

          $stmt = $con->prepare($query);
          $stmt->execute();
          $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
          ?>
          <div class="inner">
            <h3><?php echo $resultado['total']; ?></h3>

            <p>Nuevos Pedidos</p>
          </div>
          <div class="icon">
            <i class="fas fa-shopping-cart"></i>
          </div>
          <a href="vista/pedidos.php" style="cursor:pointer;" class="small-box-footer">
            Ver más <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">

        <!-- small card -->
        <div class="small-box bg-success">
          <?php
          $query = "SELECT COUNT(*) as total FROM productos";

          $stmt = $con->prepare($query);
          $stmt->execute();
          $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
          ?>
          <div class="inner">
            <h3><?php echo $resultado['total']; ?></h3>

            <p>Productos registrados</p>
          </div>
          <div class="icon">
            <i class="fa-solid fa-box-archive"></i>
          </div>
          <a href="vista/inventario.php" style="cursor:pointer;" class="small-box-footer">
            Ver más <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-warning">
          <?php
          $query = "SELECT COUNT(*) as total FROM productos WHERE existencia_actual_producto <= stock_min_producto";

          $stmt = $con->prepare($query);
          $stmt->execute();
          $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
          ?>

          <div class="inner">
            <h3><?php echo $resultado['total']; ?></h3>
            <p>En poco stock</p>
          </div>
          <div class="icon">
            <i class="fa-solid fa-circle-exclamation"></i>
          </div>
          <a href="#pocostock" style="cursor:pointer;" class="small-box-footer">
            Ver más <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-danger">
          <?php
          $query = "SELECT COUNT(*) as total FROM usuarios";

          $stmt = $con->prepare($query);
          $stmt->execute();
          $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
          ?>
          <div class="inner">
            <h3><?php echo $resultado['total']; ?></h3>

            <p>Usuarios registrados</p>
          </div>
          <div class="icon">
            <i class="fa-solid fa-user"></i>
          </div>
          <a href="vista/usuarios.php" style="cursor:pointer;" class="small-box-footer">
            Ver más <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>

      </div>
      <!-- ./col -->
    </div>
    
    <?php
    $sql = "SELECT Id_factura, total_factura, fecha_factura FROM facturas ORDER BY fecha_factura DESC";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
     <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Ventas</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">

                <table id="example" class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Número</th>
                      <th>Ganancia</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($rows as $row): ?>
                    <tr>
                      <td><?php echo $row['Id_factura'] ?></td>
                      <td>$<?php echo $row['total_factura'];?></td>
                      <td><?php echo $row['fecha_factura'];?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    <div class="row">
      <div class="col-lg-6">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">10 Productos más vendidos</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div> <!-- ./ end card-tools -->
          </div> <!-- ./ end card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table display" id="tbl_productos_mas_vendidos">
                <thead>
                  <tr class="text-danger">
                    <th>Id producto</th>
                    <th>Producto</th>
                    <th>Ventas</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($cols as $row) : ?>
                    <tr>
                    <td><?php echo $row['Id_producto']; ?></td>
                    <td><?php echo $row['nombre_producto']; ?></td>
                    <td><?php echo $row['total_comprado']; ?></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div> <!-- ./ end card-body -->
        </div>
      </div>
      <?php
require_once 'controlador/controlador_producto.php';
$productosController = new ProductosController();

$productos = $productosController->lowStock();

?>
      <div class="col-lg-6">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Listado de productos con poco stock</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div> <!-- ./ end card-tools -->
          </div> <!-- ./ end card-header -->
          <div class="card-body" id="pocostock">
            <div class="table-responsive">
              <table class="table display" id="myTable">
                <thead>
                  <tr class="text-danger">
                    <th>Id producto</th>
                    <th>Producto</th>
                    <th>Stock Actual</th>
                    <th>Mín. Stock</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($productos as $low): ?>
                    <tr>
                      <td><?php echo $low->getId(); ?></td>
                      <td><?php echo $low->getNombre(); ?></td>
                      <td><?php echo $low->getExistenciaActual(); ?></td>
                      <td><?php echo $low->getStockMinimo(); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div> <!-- ./ end card-body -->
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<script src="assets/plugins/datatables/JSZip/jszip.min.js"></script>
<script src="assets/plugins/datatables/pdfmake/pdfmake.min.js"></script>
<script src="assets/plugins/datatables/pdfmake/vfs_fonts.js"></script>
<script src="assets/plugins/datatables/DataTables/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/DataTables/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables/Buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/Buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables/Buttons/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables/Buttons/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {    
    $('#example').DataTable({        
        language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
           },
           "sProcessing":"Procesando...",
            },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
      {
        extend:    'excelHtml5',
        text:      '<i class="fas fa-file-excel"></i> ',
        titleAttr: 'Exportar a Excel',
        className: 'btn btn-success'
      },
      {
        extend:    'pdfHtml5',
        text:      '<i class="fas fa-file-pdf"></i> ',
        titleAttr: 'Exportar a PDF',
        className: 'btn btn-danger'
      },
      {
        extend:    'print',
        text:      '<i class="fa fa-print"></i> ',
        titleAttr: 'Imprimir',
        className: 'btn btn-info'
      },
    ]         
    });     
});
</script>

<script type="text/javascript">
$(document).ready(function() {    
    $('#myTable').DataTable({        
        language: {
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
           },
           "sProcessing":"Procesando...",
        },
        responsive: true,
        dom: 'Brtip', // quitar las letras "il"
        buttons:[ 
          {
            extend:    'excelHtml5',
            text:      '<i class="fas fa-file-excel"></i> ',
            titleAttr: 'Exportar a Excel',
            className: 'btn btn-success'
          },
          {
            extend:    'pdfHtml5',
            text:      '<i class="fas fa-file-pdf"></i> ',
            titleAttr: 'Exportar a PDF',
            className: 'btn btn-danger'
          },
          {
            extend:    'print',
            text:      '<i class="fa fa-print"></i> ',
            titleAttr: 'Imprimir',
            className: 'btn btn-info'
          },
        ],
        paging: true,
        lengthChange: false // quitar la opción de mostrar el número de registros por página
    });     
});

</script>
