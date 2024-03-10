<!-- Create Modal HTML -->
<div id="addProvider" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="../controlador/controlador_proveedores.php" role="form">
				<input type="hidden" name="sesion" value="<?php echo $_SESSION['ID'];?>">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Producto</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
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
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" name="add" class="btn btn-success" value="Agregar">
				</div>
			</form>
		</div>
	</div>
</div>