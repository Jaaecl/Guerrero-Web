<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/market/adminassets/plugins/fontawesome-free/css/all.min.css">
  <script src="https://kit.fontawesome.com/9e0ac2e663.js" crossorigin="anonymous"></script>

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="/market/admin/assets/dist/css/adminlte.min.css">

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="/market/admin/assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/market/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <!-- AdminLTE App -->
  <script src="/market/admin/assets/dist/js/adminlte.min.js"></script>
    
<style>

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



                <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Profesores</h3>
                <div style="float:right;">
                    <a href="#addnewprod" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#xE147;</i><span>Nuevo</span></a>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Edad</th>
                        <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    include_once('../M/connection.php');
                    $db=new Conectar();
                    $con=$db->conexion();
                    try{
                        $sql=('SELECT * FROM profesor');
                        foreach ($con->query($sql) as $row) {
                            ?>
                        <tr>
                            <td><?php echo $row["id_profesor"] ?></td>
                            <td><?php echo $row["nombre_profesor"] ?></td>
                            <td><?php echo $row["apellido_profesor"] ?></td>
                            <td>$<?php echo $row["edad_profesor"] ?></td>
                            <td>
                                <a href="#editp_<?php echo $row['id_profesor']; ?>" class="edit" data-toggle="modal"><i class="material-icons" title="Edit">&#xE254;</i></a>

                                <a href="#delete_<?php echo $row['id_profesor']; ?>" class="delete" data-toggle="modal"><i class="material-icons" title="Delete">&#xE872;</i></a>
                            </td>
                            <?php include('mod.php'); ?>
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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!--modal-->

        <!-- /.row -->

            

     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content -->

</body>
</html>



