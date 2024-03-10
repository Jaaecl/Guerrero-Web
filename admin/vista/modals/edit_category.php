<!-- Edit Modal HTML -->
<div id="editCategory_<?php echo $categoria->getId(); ?>" class="modal fade">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<form method="POST" action="../controlador/controlador_categoria.php">
				<input type="hidden" name="id" value="<?php echo $categoria->getId(); ?>">
				<input type="hidden" name="sesion" value="<?php echo $_SESSION['ID'];?>">
				<div class="modal-header">						
					<h4 class="modal-title">Editar Categoría</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control" name="categoria" value="<?php echo $categoria->getNombre(); ?>">
					</div>	
				</div>
				<div class="modal-footer justify-content-between">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" name="update" class="btn btn-info" value="Guardar">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Delete Modal HTML -->
<div id="deleteCategory_<?php echo $categoria->getId(); ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="../controlador/controlador_categoria.php">
				<input type="hidden" name="id" value="<?php echo $categoria->getId(); ?>">
				<input type="hidden" name="sesion" value="<?php echo $_SESSION['ID'];?>">
				<div class="modal-header">						
					<h4 class="modal-title">Eliminar Categoría</h4>
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
<!--controlador/delete.php?id=php echo $row['Id_categoria']; >"-->