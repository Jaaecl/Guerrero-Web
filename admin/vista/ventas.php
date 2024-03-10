 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Ventas</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Ventas</li>
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
                <h3 class="card-title">Historial de Ventas</h3>
                <div class="card-tools">
                  <div class="form-group">
                    <label>Buscar por fecha:</label>
                    <select class="select2" style="width: 100%;">
                      <option selected>Ascendente</option>
                      <option>Descendente</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Productos</th>
                      <th>Cantidad</th>
                      <th>Total</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    include_once('../../models/conexion.php');
                    $db=new Conectar();
                    $con=$db->conexion();
                    try{
                        $sql=('SELECT * FROM detalle_factura
                        INNER JOIN productos ON detalle_factura.Id_producto = productos.Id_producto
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
                      <td><?php echo $row["Id_detalle_factura"] ?></td>
                      <td><?php echo $row["Id_producto"] ?></td>
                      <td><?php echo $row["cantidad_producto"] ?></td>
                      <td><?php echo $row["precio_venta_detalle_factura"] ?></td>
                      <td><?php echo $row["fecha_detalle_factura"] ?></td>
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
                        