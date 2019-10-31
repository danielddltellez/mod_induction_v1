<div class="modal fade" id="delete<?php echo $value->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Borrar inducion al puesto</h4></center>
            </div>
            <div class="modal-body">    
                <p class="text-center">¿Esta seguro de Borrar la indución induccion al puesto?</p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <a href="delete_induction.php?id=<?php echo $value->id; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Borrar</a>
            </div>

        </div>
    </div>
</div>