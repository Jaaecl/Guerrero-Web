<!-- DELETE PROFESSOR MODAL HTML -->
<div class="modal fade" id="delete_<?php echo $row['id_profesor']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Eliminar Profesor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                 <p>¿Estas seguro que deseas borrar este registro?</p>
                <p class="text-warning"><small>Esta acción no se puede deshacer</small></p>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                <a href="" class="btn btn-danger">Borrar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DELETE STUDENT MODAL HTML -->
<div class="modal fade" id="delete_<?php echo $row['id_estudiante']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Eliminar Estudiante</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                 <p>¿Estas seguro que deseas borrar este registro?</p>
                <p class="text-warning"><small>Esta acción no se puede deshacer</small></p>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                <a href="" class="btn btn-danger">Borrar</a>
                </div>
            </div>
        </div>
    </div>
</div>