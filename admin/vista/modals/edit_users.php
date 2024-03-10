<!-- Edit Modal HTML -->
<div id="level_<?php echo $usuario->getId(); ?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="../controlador/controlador_usuarios.php">
                <input type="hidden" name="id" value="<?php echo $usuario->getId(); ?>">
                <input type="hidden" name="sesion" value="<?php echo $_SESSION['ID'];?>">
                <div class="modal-header">
                    <h4 class="modal-title">Nivel de Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nivel</label><br>
                        <select class="form-select" name="nivel">
                            <option <?php if($usuario->getNivel() == 'estandar') { echo 'selected'; } ?> value='estandar'>Estandar</option>
                            <option <?php if($usuario->getNivel() == 'administrador') { echo 'selected'; } ?> value='administrador'>Administrador</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="change_level" class="btn btn-info" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="status_<?php echo $usuario->getId(); ?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="../controlador/controlador_usuarios.php">
                <input type="hidden" name="id" value="<?php echo $usuario->getId(); ?>">
                <input type="hidden" name="sesion" value="<?php echo $_SESSION['ID'];?>">
                <div class="modal-header">                      
                    <h4 class="modal-title">
                    <?php echo $usuario->getEstatus() == 'activo' ? 'Dar de baja' : 'Activar'; ?> <!--Operador ternario-->
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="estatus" value="<?php echo $usuario->getEstatus() == 'activo' ? 'inactivo' : 'activo'; ?>">
                    <p>
                        ¿Estás seguro de que quieres 
                        <?php echo $usuario->getEstatus() == 'activo' ? 'dar de baja' : 'activar'; ?> 
                        a este usuario?
                    </p>
                    <p class="text-warning">
                        <small>El usuario no podrá ingresar hasta que vuelva a estar activo</small>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-default" name="change_status" value="Confirmar">
                </div>
            </form>
        </div>
    </div>
</div>