<!-- Create Modal HTML -->
<div id="addCategory" class="modal fade">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<form method="POST" action="../controlador/controlador_categoria.php" role="form">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Categoría</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control" name="categoria" required autocomplete="off">
						<input type="hidden" name="sesion" value="<?php echo $_SESSION['ID'];?>">
					</div>					
				</div>
				<div class="modal-footer justify-content-between">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" name="add" class="btn btn-success" value="Agregar">
				</div>
			</form>
		</div>
	</div>
</div>