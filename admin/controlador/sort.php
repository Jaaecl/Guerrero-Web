<?php

include_once('../../models/conexion.php');
$db=new Conectar();
$con=$db->conexion();


if(isset($_POST['request'])){

   $request=$_POST['request'];

   $query = "SELECT * FROM usuarios WHERE nivel_usuario = '$request'";

   $resultado = $con->prepare($query);

   /*$resultado->execute();*/

   $count = $resultado->fetchColumn();
}

?>

<table class="table table-hover text-nowrap">
   <?php

   if($count){

   ?>
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
         <th>Acción</th>
      </tr>
      <?php
   }else{
      echo "No se encontraron registros";
      ?>
   }
   </thead>
</table>

   <tbody>
      <?php
      while($row=$resultado->fetchAll(PDO::FETCH_ASSOC)) {
                            ?>

                        <tr>
                            <td><?php echo $row["Id_usuario"] ?></td>
                            <td><?php echo $row["nombre_usuario"] ?></td>
                            <td><?php echo $row["apellido_usuario"] ?> </td>
                            <td><?php echo $row["direccion_usuario"] ?></td>
                            <td><?php echo $row["telefono_usuario"] ?></td>
                            <td><?php echo $row["correo_usuario"] ?></td>
                            <td><?php echo $row["fecha_creacion_usuario"] ?></td>
                            <td><?php echo $row["nivel_usuario"] ?></td>
                            <td><?php 
                            if(!isset($_SESSION['usuario'])){
                                $row['estatus_usuario']='desconectado';
                            }else{
                                $row['estatus_usuario']='activo';
                            }
                            if($row['estatus_usuario']=='activo'){echo '<span class="status text-success">&bull;</span> '.$row["estatus_usuario"];}


                            if($row['estatus_usuario']=='inactivo'){echo '<span class="status text-danger">&bull;</span> '.$row["estatus_usuario"];}

                            if($row['estatus_usuario']=='desconectado'){echo '<span class="status text-warning">&bull;</span> '.$row["estatus_usuario"];}?>
                                
                            </td>
                            <td>
                                <a href="#edit_<?php echo $row['Id_usuario']; ?>" class="edit" data-toggle="modal"><i class="material-icons" title="Edit">&#xE254;</i></a>

                                <a href="#delete_<?php echo $row['Id_usuario']; ?>" class="delete" data-toggle="modal"><i class="material-icons" title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>
                        <?php
                        }
 
                        //close connection
                        $db->close();
                        ?>
                    
                </tbody>
            </table>
            <?php
         }
         <?