<!-- Delete Modal HTML -->
<div id="deleteProduct_<?php echo $producto->getId(); ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="../controlador/controlador_producto.php">
				<input type="hidden" name="id" value="<?php echo $producto->getId(); ?>">
				<input type="hidden" name="sesion" value="<?php echo $_SESSION['ID'];?>">
				<div class="modal-header">						
					<h4 class="modal-title">Eliminar Producto</h4>
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

<!-- Edit Modal HTML -->
<div id="editProduct_<?php echo $producto->getId(); ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="../controlador/controlador_producto.php" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $producto->getId(); ?>">
				<input type="hidden" name="sesion" value="<?php echo $_SESSION['ID'];?>">
				<div class="modal-header">						
					<h4 class="modal-title">Editar Producto</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control" name="producto" value="<?php echo $producto->getNombre(); ?>" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Precio</label>
						<input type="text" class="form-control" name="precio" value="<?php echo $producto->getPrecioVenta(); ?>" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Stock Mínimo</label>
						<input type="text" class="form-control" name="stock_minimo" value="<?php echo $producto->getStockMinimo(); ?>" autocomplete="off">
					<div class="form-group">
    					<label>Proveedor</label><br>
    					<select class="form-select mb-3" name="proveedor">
        					<option selected disabled>--Seleccionar proveedor--</option>
        						<?php foreach ($proveedores as $proveedor): ?>
            						<option value="<?php echo $proveedor->getId(); ?>"><?php echo $proveedor->getRazonSocial(); ?></option>
        						<?php endforeach; ?>
    					</select>
					</div>
					<div class="form-group">
					    <label>Categoría</label><br>
					    <select class="form-select mb-3" name="categoria">
					        <option selected disabled>--Seleccionar categoria--</option>
					        <?php foreach ($categorias as $categoria): ?>
					            <option value="<?php echo $categoria->getId(); ?>"><?php echo $categoria->getNombre(); ?></option>
					        <?php endforeach; ?>
					    </select>
					</div>
					<div class="form-group">
						<label>Imagen</label><br>
						<input type="file"  name="imagen">
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