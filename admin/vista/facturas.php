 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Facturas</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Facturas</li>
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
                <h3 class="card-title">Facturas Generadas</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nro factura</th>
                      <th>Usuario</th>
                      <th>% IVA</th>
                      <th>Monto IVA</th>
                      <th>Subtotal</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    include_once('../../models/conexion.php');
                    $db=new Conectar();
                    $con=$db->conexion();
                    try{
                        $sql=('SELECT * FROM facturas
                        INNER JOIN usuarios ON facturas.Id_usuario = usuarios.Id_usuario
                    ');
                        foreach ($con->query($sql) as $row) {
                            ?>
                    <tr>
                      <td>183</td>
                      <td>John Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-success">Approved</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td><?php echo $row["Id_factura"] ?></td>
                      <td><?php echo $row["nro_factura"] ?></td>
                      <td><?php echo $row["Id_usuario"] ?></td>
                      <td><?php echo $row["factor_iva_factura"] ?></td>
                      <td><?php echo $row["monto_iva_factura"] ?></td>
                    <td><?php echo $row["subtotal_factura"] ?></td>
                      <td><?php echo $row["total_factura"] ?></td>
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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
     

     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content -->
                        