<!-- Edit Modal HTML -->
<div id="editarPedido_<?php echo $pedido['Id_pedido']; ?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="../controlador/controlador_usuarios.php">
                <input type="hidden" name="id" value="<?php echo $usuario->getId(); ?>">
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nivel</label><br>
                        <select class="form-select" name="pedido">
                            <option <?php if($pedido['estado_pedido'] == 'Procesando') { echo 'selected'; } ?> value='Procesando'>Procesando</option>
                            <option <?php if($pedido['estado_pedido'] == 'Finalizado') { echo 'selected'; } ?> value='Finalizado'>Finalizado</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="update" class="btn btn-info" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>