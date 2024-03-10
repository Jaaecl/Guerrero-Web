<?php
session_start();
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard</title>

    <!-- REQUIRED SCRIPTS -->
    
    <!-- jQuery -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- JS Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <script src="https://kit.fontawesome.com/9e0ac2e663.js" crossorigin="anonymous"></script>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!--Google Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!--Bootstrap Dashboard-->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <!-- SweetAlert2 -->
    <script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Bootstrap core CSS -->
    <link href="../assets/dist2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../assets/dashboard.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .card-title{
        margin-top: 10px;
        font-weight: bold;
      }

      .btn i{
        float: left;
        font-size: 21px;
        margin-right: 10px;
        margin-top: 1px;
      }

      table.table td a:hover {
        color: #2196F3;
      }

      table.table td a.edit {
        color: #FFC107;
      }

      table.table td a.delete {
        color: #F44336;
      }

      table.table td i {
        font-size: 19px;
      }
    </style>
  </head>
  <body>

    <?php
    include("partials/navbar.php");
    include("partials/sidebar.php");
    ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Productos</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Compartir</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Exportar</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            Esta semana
          </button>
        </div>
      </div>
      <div class="card card-info">
                     <div class="card-header">
                         <h3 class="card-title">Seleccionar Archivo de Carga (Excel):</h3>
                         <div class="card-tools">
                             <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                 <i class="fas fa-minus"></i>
                             </button>
                         </div> <!-- ./ end card-tools -->
                     </div> <!-- ./ end card-header -->
                     <div class="card-body">
                         <form method="post" enctype="multipart/form-data" id="form_carga_productos">
                             <div class="row">
                                 <div class="col-lg-10">
                                     <input type="file" name="fileProductos" id="fileProductos" class="form-control" accept=".xls, .xlsx">
                                 </div>
                                 <div class="col-lg-2">
                                     <input type="submit" value="Cargar Productos" class="btn btn-primary" id="btnCargar">
                                 </div>
                             </div>
                         </form>

                    </div> <!-- ./ end card-body -->
                 </div>

         <!-- FILA PARA IMAGEN DEL GIF -->
         <div class="row mx-0">
             <div class="col-lg-12 mx-0 text-center">
                <span id="img_carga" style="display:none;">CARGANDO PRODUCTOS...</span>
             </div>
         </div>

 <!-- /.content -->
      <div style="float:right;">
        <a href="#addnewprod" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#xE147;</i><span>Nuevo</span></a>
      </div>
      <h3>Inventario</h3>
      <?php 
      /*session_start();*/
      if(isset($_SESSION['message'])){
      ?>
        <div class="alert alert-info text-center" style="margin-top:20px;">
          <?php echo $_SESSION['message']; ?>
        </div>
        <?php
        unset($_SESSION['message']);
      }
        ?>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Categoría</th>
              <th>Costo</th>
              <th>Proveedor</th>
              <th>Existencia Inicial</th>
              <th>Existencia Actual</th>
              <th>Precio Venta</th>
              <th>Stock Mínimo</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            include_once('../../models/conexion.php');
            $db=new Conectar();
            $con=$db->conexion();
            try{
              $sql=('SELECT * FROM productos
              INNER JOIN categorias ON productos.categoria_producto = categorias.Id_categoria
              INNER JOIN proveedores ON productos.proveedor_producto = proveedores.Id_proveedor
              ORDER BY Id_producto ASC
              ');
              foreach ($con->query($sql) as $row) {
            ?>
            <tr>
              <td><?php echo $row["Id_producto"] ?></td>
              <td><?php echo $row["nombre_producto"] ?></td>
              <td><?php echo $row["nombre_categoria"] ?></td>
              <td>$<?php echo $row["precio_costo_producto"] ?></td>
              <td><?php echo $row["razon_social_proveedor"] ?></td>
              <td><?php echo $row["existencia_inicial_producto"] ?></td>
              <td><?php echo $row["existencia_actual_producto"] ?></td>
              <td>$<?php echo $row["precio_venta_producto"] ?></td>
              <td><?php echo $row["stock_min_producto"] ?></td>
              <td>
                <a href="#editp_<?php echo $row['Id_producto']; ?>" class="edit" data-toggle="modal"><i class="material-icons" title="Edit">&#xE254;</i></a>

                <a href="#delete_<?php echo $row['Id_producto']; ?>" class="delete" data-toggle="modal"><i class="material-icons" title="Delete">&#xE872;</i></a>
              </td>
              <?php include('partials/modal.php'); ?>
            </tr>
            <?php
              }
            }
            catch(PDOException $e){
              echo "There is some problem in connection: " . $e->getMessage();
            }
            //close connection
            $db->close();
            ?>
          </tbody>
        </table>
      </div>
      <?php include('partials/modal.php'); ?>

      <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
          <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
        </ul>
      </div>
      


        

      <form action="enhanced-results.html">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Ordenar por:</label>
                                    <select class="select2" style="width: 100%;">
                                        <option selected>Título</option>
                                        <option>Categoría</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Orden:</label>
                                    <select class="select2" style="width: 100%;">
                                        <option selected>Ascendente</option>
                                        <option>Descendente</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Categorías</label>
                                    <select class="select2" style="width: 100%;">
                                        <option selected>Ascendente</option>
                                        <option>Descendente</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="Palabras claves">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <h3>Inventario</h3>

       <?php 
                /*session_start();*/
                if(isset($_SESSION['message'])){
                    ?>
                    <div class="alert alert-info text-center" style="margin-top:20px;">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php

                    unset($_SESSION['message']);
                }
            ?>

      <div class="table-responsive">

        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            include_once('../../models/conexion.php');
            $db=new Conectar();
            $con=$db->conexion();
            try{

                        $sql=('SELECT * FROM categorias');
                        foreach ($con->query($sql) as $row) {
                            ?>

            <tr>
                      <td><?php echo $row["Id_categoria"] ?></td>
                      <td><?php echo $row["nombre_categoria"] ?></td>
              <td>
                <a href="#editp_<?php echo $row['Id_categoria']; ?>" class="edit" data-toggle="modal"><i class="material-icons" title="Edit">&#xE254;</i></a>

                <a href="#delete_<?php echo $row['Id_categoria']; ?>" class="delete" data-toggle="modal"><i class="material-icons" title="Delete">&#xE872;</i></a>
              </td>
              <?php include('partials/modals.php'); ?>
            </tr>
            <?php
              }
            }
            catch(PDOException $e){
              echo "There is some problem in connection: " . $e->getMessage();
            }
            //close connection
            $db->close();
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


    <script src="../assets/dist2/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../assets/dashboard.js"></script>
  </body>
</html>



 <script>
     $(document).ready(function() {

         $("#form_carga_productos").on('submit', function(e) {

             e.preventDefault();

             /*===================================================================*/
             //VALIDAR QUE SE SELECCIONE UN ARCHIVO
             /*===================================================================*/
             if ($("#fileProductos").get(0).files.length == 0) {
                 Swal.fire({
                     position: 'center',
                     icon: 'warning',
                     title: 'Debe seleccionar un archivo (Excel).',
                     showConfirmButton: false,
                     timer: 2500
                 })
             } else {

                 /*===================================================================*/
                 //VALIDAR QUE EL ARCHIVO SELECCIONADO SEA EN EXTENSION XLS O XLSX
                 /*===================================================================*/
                 var extensiones_permitidas = [".xls", ".xlsx"];
                 var input_file_productos = $("#fileProductos");
                 var exp_reg = new RegExp("([a-zA-Z0-9\s_\\-.\:])+(" + extensiones_permitidas.join('|') + ")$");

                 if (!exp_reg.test(input_file_productos.val().toLowerCase())) {
                     Swal.fire({
                         position: 'center',
                         icon: 'warning',
                         title: 'Debe seleccionar un archivo con extensión .xls o .xlsx.',
                         showConfirmButton: false,
                         timer: 2500
                     })

                     return false;
                 }

                 var datos = new FormData($(form_carga_productos)[0]);

                 $("#btnCargar").prop("disabled", true);
                 $("#img_carga").attr("style", "display:block");
                 $("#img_carga").attr("style", "height:200px");
                 $("#img_carga").attr("style", "width:200px");

                 $.ajax({
                     url: "ajax/productos.ajax.php",
                     type: "POST",
                     data: datos,
                     cache: false,
                     contentType: false,
                     processData: false,
                     dataType: 'json',
                     success: function(respuesta) {

                         // console.log("respuesta",respuesta);

                         if (respuesta['totalCategorias'] > 0 && respuesta['totalProductos'] > 0) {

                             Swal.fire({
                                 position: 'center',
                                 icon: 'success',
                                 title: 'Se registraron ' + respuesta['totalCategorias'] + ' categorías y ' + respuesta['totalProductos'] + 'productos correctamente!',
                                 showConfirmButton: false,
                                 timer: 2500
                             })

                             $("#btnCargar").prop("disabled", false);
                             $("#img_carga").attr("style", "display:none");
                         } else {

                             Swal.fire({
                                 position: 'center',
                                 icon: 'error',
                                 title: 'Se presento un error al momento de realizar el registro de categorías y/o productos!',
                                 showConfirmButton: false,
                                 timer: 2500
                             })

                             $("#btnCargar").prop("disabled", false);
                             $("#img_carga").attr("style", "display:none");

                         }
                     }
                 });

             }
         })

     })
 </script>

