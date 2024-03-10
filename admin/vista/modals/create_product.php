<!-- Create Modal HTML -->
<div id="addProduct" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="../controlador/controlador_producto.php" role="form" enctype="multipart/form-data">
				<input type="hidden" name="sesion" value="<?php echo $_SESSION['ID'];?>">
				<div class="modal-header">						
					<h4 class="modal-title">Agregar Producto</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control" name="producto" required autocomplete="off">
					</div>
					<div class="form-group">
    					<label>Proveedor</label>
    					<br>
    					<select class="form-select mb-3" name="proveedor">
        					<option selected disabled>--Seleccionar proveedor--</option>
        						<?php foreach ($proveedores as $proveedor): ?>
            						<option value="<?php echo $proveedor->getId(); ?>"><?php echo $proveedor->getRazonSocial(); ?></option>
        						<?php endforeach; ?>
    					</select>
					</div>
					<div class="form-group">
					    <label>Categoría</label>
					    <br>
					    <select class="form-select mb-3" name="categoria">
					        <option selected disabled>--Seleccionar categoria--</option>
					        <?php foreach ($categorias as $categoria): ?>
					            <option value="<?php echo $categoria->getId(); ?>"><?php echo $categoria->getNombre(); ?></option>
					        <?php endforeach; ?>
					    </select>
					</div>
					<div class="form-group">
						<label>Existencia Inicial</label>
						<input type="text" class="form-control" name="stock_inicial" required autocomplete="off">
					</div>
					<div class="form-group">
						<label>Precio</label>
						<input type="text" class="form-control" name="precio" required autocomplete="off">
					</div>
					<div class="form-group">
						<label>Stock Mínimo</label>
						<input type="text" class="form-control" name="stock_minimo" required autocomplete="off">
					</div>
					<div class="form-group">
						<label>Imágen</label><br>
						<input type="file" name="imagen" required>
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