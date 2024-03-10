<!-- Edit Modal HTML -->
<div id="editProvider_<?php echo $proveedor->getId(); ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="../controlador/controlador_proveedores.php">
				<input type="hidden" name="id" value="<?php echo $proveedor->getId(); ?>">
				<input type="hidden" name="sesion" value="<?php echo $_SESSION['ID'];?>">
				<div class="modal-header">						
					<h4 class="modal-title">Editar Proveedor</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>RIF</label>
						<input type="text" class="form-control" name="rif" value="<?php echo $proveedor->getRif(); ?>">
					</div>
					<div class="form-group">
						<label>Razon Social</label>
						<input type="text" class="form-control" name="asunto" value="<?php echo $proveedor->getRazonSocial(); ?>">
					</div>
					<div class="form-group">
						<label>Direccion</label>
						<input type="text" class="form-control" name="direccionP" value="<?php echo $proveedor->getDireccionP(); ?>">
					</div>
					<div class="form-group">
						<label>Teléfono</label>
						<input type="text" class="form-control" name="telefonoP" value="<?php echo $proveedor->getTelefonoP(); ?>">
					</div>
					<div class="form-group">
						<label>Correo</label>
						<input type="text" class="form-control" name="correoP" value="<?php echo $proveedor->getCorreoP(); ?>">
					</div>	
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" name="update" class="btn btn-info" value="Guardar">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Delete Modal HTML -->
<div id="deleteProvider_<?php echo $proveedor->getId(); ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="../controlador/controlador_proveedores.php">
				<input type="hidden" name="id" value="<?php echo $proveedor->getId(); ?>">
				<input type="hidden" name="sesion" value="<?php echo $_SESSION['ID'];?>">
				<div class="modal-header">						
					<h4 class="modal-title">Eliminar Proveedor</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Estas seguro que deseas eliminar este registro?</p>
					<p class="text-warning"><small>Esta acción no se puede deshacer</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" name="delete" class="btn btn-danger" value="Borrar">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- 4	J-00019582-0	Industrias Iberia	Cj Prevenca, Zona Industrial Las Vegas, Cagua	02443958801	industriaiberia@gmail.com-->