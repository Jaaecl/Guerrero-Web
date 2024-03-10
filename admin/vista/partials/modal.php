<!-- CREATE PRODUCT MODAL HTML -->
<div class="modal fade" id="addnewprod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">						
				<h4 class="modal-title" id="myModalLabel">Agregar Producto</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">	
				<form method="POST" action="../controlador/publish.php" role="form" enctype="multipart/form-data">				
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control" name="producto" required autocomplete="off">
					</div>
					<div class="form-group">
						<label>Categoria</label>
						<select class="form-select mb-3" name="categoria">
							<option selected disabled>--Seleccionar categoria--</option>
							<?php
							$sql='SELECT * FROM categorias';
							foreach ($con->query($sql) as $row) {
								echo "<option name='categoria' value='". $row['Id_categoria']."'>".$row['nombre_categoria']. "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Costo</label>
						<input type="text" class="form-control" name="costo" required autocomplete="off">
					</div>
					<div class="form-group">
						<label>Proveedor</label>
						<select class="form-select mb-3" name="proveedor_p">
							<option selected disabled>--Seleccionar proveedor--</option>
							<?php
							$sql='SELECT * FROM proveedores';
							foreach ($con->query($sql) as $row) {
								echo "<option name='proveedor_p' value='". $row['Id_proveedor']."'>".$row['razon_social_proveedor']. "</option>";
							}
							?>
						</select>	
					</div>
					<div class="form-group">
						<label>Existencia Inicial</label>
						<input type="text" class="form-control" name="stock_inicial" required autocomplete="off">
					</div>
					<div class="form-group">
						<label>Precio de Venta</label>
						<input type="text" class="form-control" name="precio" required autocomplete="off">
					</div>
					<div class="form-group">
						<label>Stock Mínimo</label>
						<input type="text" class="form-control" name="stock_minimo" required autocomplete="off">
					</div>
					<div class="form-group">
						<label>Imágen</label>
						<input type="file" class="form-control" name="imagen">
					</div>											
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" name="add" class="btn btn-success" value="Agregar">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- CREATE PROVIDER MODAL HTML -->
<div class="modal fade" id="addnewprov" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">						
				<h4 class="modal-title" id="myModalLabel">Agregar Proveedor</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">	
				<form method="POST" action="modelo/create.php">				
					<div class="form-group">
						<label>RIF</label>
						<input type="text" class="form-control" name="rif" required autocomplete="off">
					</div>
					<div class="form-group">
						<label>Razón Social</label>
						<input type="text" class="form-control" name="asunto" required autocomplete="off">
					</div>
					<div class="form-group">
						<label>Dirección</label>
						<input type="text" class="form-control" name="direccion" required autocomplete="off">
					</div>
					<div class="form-group">
						<label>Teléfono</label>
						<input type="text" class="form-control" name="telefono" required autocomplete="off">
					</div>
					<div class="form-group">
						<label>Correo</label>
						<input type="text" class="form-control" name="correo" required autocomplete="off">
					</div>										
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" name="add" class="btn btn-success" value="Agregar">
					</div>
				</form>
			</div>	
		</div>
	</div>
</div>

<!-- CREATE CATEGORY MODAL HTML-->
<div class="modal fade" id="addnewcat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">						
				<h4 class="modal-title" id="myModalLabel">Agregar Categoría</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">	
				<form method="POST" action="controlador/create.php">				
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control" name="categoria" required autocomplete="off">
					</div>									
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" name="add" class="btn btn-success" value="Agregar">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- EDIT USER MODAL HTML -->
<div class="modal fade" id="edit_<?php echo $row['Id_usuario']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">						
				<h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
				<div class="modal-body">
					<form method="post" action="modelo/update.php?id=<?php echo $row['Id_usuario']; ?>">							
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" class="form-control" name="usuario" value="<?php echo $row['nombre_usuario'].$row['apellido_usuario']; ?>">
						</div>
						<div class="form-group">
							<label>Dirección</label>
							<input type="text" class="form-control" name="direccion" value="<?php echo $row['direccion_usuario']; ?>">
						</div>
						<div class="form-group">
							<label>Teléfono</label>
							<input type="text" class="form-control" name="telefono" value="<?php echo $row['telefono_usuario']; ?>">
						</div>
						<div class="form-group">
							<label>Correo</label>
							<input type="text" class="form-control" name="correo" value="<?php echo $row['correo_usuario']; ?>">
						</div>

						<div class="form-group">
							<label>Nivel</label>
							<div class="form-check">
  								<input class="form-check-input" type="radio" name="level" id="standar" value="1" checked>
  								<?php
  								if($row['nivel_usuario']==1){echo 'checked';}
  								?>
  								<label class="form-check-label" for="exampleRadios1">Estándar</label>
							</div>
							<div class="form-check">
						  		<input class="form-check-input" type="radio" name="level" id="admin" value="2">
						  		 <?php
  								if($row['nivel_usuario']==2){echo 'checked';}
  								?>
						  		<label class="form-check-label" for="exampleRadios2">Administrador</label>
							</div>
							<div class="form-check">
						  		<input class="form-check-input" type="radio" name="level" id="superuser" value="3">
						  		<?php
  								if($row['nivel_usuario']==3){echo 'checked';}
  								?>
						  		<label class="form-check-label" for="exampleRadios3">Superusuario</label>
							</div>
						</div>
						<div class="form-group">
							<label>Estatus</label>
							<div class="form-check">
  								<input class="form-check-input" type="radio" name="status" id="active" value="1" checked>
  								<?php
  								if($row['estatus_usuario']==1){echo 'checked';}
  								?>
  								<label class="form-check-label" for="exampleRadios1">Activo</label>
							</div>
							<div class="form-check">
						  		<input class="form-check-input" type="radio" name="status" id="inactive" value="2">
  								<?php
  								if($row['estatus_usuario']==2){echo 'checked';}
  								?>
						  		<label class="form-check-label" for="exampleRadios2">Inactivo</label>
							</div>

						</div>											
						<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
							<input type="submit" name="edit" class="btn btn-info" value="Guardar">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- DELETE USER MODAL HTML -->
<div class="modal fade" id="delete_<?php echo $row['Id_usuario']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">						
				<h4 class="modal-title" id="myModalLabel">Eliminar Usuario</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">				
				<p>¿Estas seguro que deseas borrar este registro?</p>
				<p class="text-warning"><small>Esta acción no se puede deshacer</small></p>
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
				<a href="modelo/delete.php?id=<?php echo $row['Id_usuario']; ?>" class="btn btn-danger">Borrar</a>
			</div>
		</div>
	</div>
</div>

<!-- DELETE PROVIDER MODAL HTML -->
<div class="modal fade" id="delete_<?php echo $row['Id_proveedor']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">						
					<h4 class="modal-title" id="myModalLabel">Eliminar Proveedor</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">				
					<p>¿Estas seguro que deseas borrar este registro?</p>
					<p class="text-warning"><small>Esta acción no se puede deshacer</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<a href="modelo/delete.php?id=<?php echo $row['Id_proveedor']; ?>" class="btn btn-danger">Borrar</a>
				</div>
		</div>
	</div>
</div>

<!-- EDIT PROVIDER MODAL HTML -->
<div class="modal fade" id="edit_<?php echo $row['Id_proveedor']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">						
				<h4 class="modal-title" id="myModalLabel">Editar Proveedor</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="controlador/update.php?id=<?php echo $row['Id_proveedor']; ?>" role="form">		<div class="form-group">
						<label>RIF</label>
						<input type="text" class="form-control" name="rif" value="<?php echo $row['RIF_proveedor']; ?>">
					</div>
					<div class="form-group">
						<label>Razon Social</label>
						<input type="text" class="form-control" name="asunto" value="<?php echo $row['razon_social_proveedor']; ?>">
					</div>
					<div class="form-group">
						<label>Direccion</label>
						<input type="text" class="form-control" name="costo" value="<?php echo $row['direccion_proveedor']; ?>">
					</div>
					<div class="form-group">
						<label>Teléfono</label>
						<input type="text" class="form-control" name="proveedor_p" value="<?php echo $row['telefono_proveedor']; ?>">
					</div>
					<div class="form-group">
						<label>Correo</label>
						<input type="text" class="form-control" name="precio" value="<?php echo $row['correo_proveedor']; ?>">
					</div>										
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" name="edit" class="btn btn-info" value="Guardar">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- EDIT CATEGORY MODAL HTML -->
<div class="modal fade" id="edit_<?php echo $row['Id_categoria']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">						
				<h4 class="modal-title" id="myModalLabel">Editar Categoría</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
				<div class="modal-body">
					<form method="post" action="modelo/update.php?id=<?php echo $row['Id_categoria']; ?>">							
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" class="form-control" name="categoria" value="<?php echo $row['nombre_categoria']; ?>">
						</div>
						<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
							<input type="submit" name="edit" class="btn btn-info" value="Guardar">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- DELETE CATEGORY MODAL HTML -->
<div class="modal fade" id="delete_<?php echo $row['Id_categoria']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">						
					<h4 class="modal-title" id="myModalLabel">Eliminar Categoría</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">				
					<p>¿Estas seguro que deseas borrar este registro?</p>
					<p class="text-warning"><small>Esta acción no se puede deshacer</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<a href="modelo/delete.php?id=<?php echo $row['Id_categoria']; ?>" class="btn btn-danger">Borrar</a>
				</div>
		</div>
	</div>
</div>