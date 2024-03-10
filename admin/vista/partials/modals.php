<!-- EDIT PRODUCT MODAL HTML -->
<div class="modal fade" id="editp_<?php echo $row['Id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Editar Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="controlador/update.php?id=<?php echo $row['Id_producto']; ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="producto" value="<?php echo $row['nombre_producto']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Costo</label>
                        <input type="text" class="form-control" name="costo" value="<?php echo $row['precio_costo_producto']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Precio de Venta</label>
                        <input type="text" class="form-control" name="precio" value="<?php echo $row['precio_venta_producto']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Stock Mínimo</label>
                        <input type="text" class="form-control" name="stock_minimo" value="<?php echo $row['stock_min_producto']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Imágen</label>
                        <input type="file" class="form-control" name="imagen">
                    </div>
                    <div class="form-group">
                        <label>Proveedor</label>
                        <select class="form-select mb-3" name="proveedor_p">
                            <option selected disabled>--Seleccionar proveedor--</option>
                            <?php
                            $sql="SELECT * FROM proveedores";
                            foreach ($con->query($sql) as $row) {
                                echo "<option name='proveedor_p' value'".$row['Id_proveedor'] . "'>" . $row['razon_social_proveedor'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Categoría</label>
                        <select class="form-select mb-3" name="categoria">
                            <option selected disabled>--Seleccionar proveedor--</option>
                            <?php
                            $sql="SELECT * FROM categorias";
                            foreach ($con->query($sql) as $row) {
                                echo "<option name='categoria' value'".$row['Id_categoria'] . "'>" . $row['nombre_categoria'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                        <input type="submit" name="edit" class="btn btn-info" value="Guardar"/>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>

<!-- DELETE PRODUCT MODAL HTML -->
<div class="modal fade" id="delete_<?php echo $row['Id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Eliminar Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                 <p>¿Estas seguro que deseas borrar este registro?</p>
                <p class="text-warning"><small>Esta acción no se puede deshacer</small></p>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                <a href="controlador/delete.php?id=<?php echo $row['Id_producto']; ?>" class="btn btn-danger">Borrar</a>
                </div>
            </div>
        </div>
    </div>
</div>