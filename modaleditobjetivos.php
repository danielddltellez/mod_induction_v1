<div  class="modal fade" id="edit_objetivo<?php echo $valoresobj->id; ?>" role="dialog">
                <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar el objetivo</h4>
                        </div>
                     <div class="modal-body">
                            <form class="form-horizontal" method="POST" action="update_objetivos.php?id=<?php echo $valoresobj->id; ?>">
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="nameobjetivo">Nombre del objetivo</label>
                                    <div class="col-xs-9">
                                        <input type="text" name="nameobjetivo" id="nameobjetivo" class="form-control" value="<?php echo $valoresobj->nameobjetivo; ?>" >
                                    </div>
                                <span class="help-block"></span></div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="valorobjetivo">Valor del objetivo sobre 100</label>
                                    <div class="col-xs-9">
                                        <input type="text" name="valorobjetivo" id="valorobjetivo" class="form-control" value="<?php echo $valoresobj->valorobjetivo; ?>" >
                                    </div>
                                <span class="help-block"></span></div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="avanceobjetivo">Avance</label>
                                    <div class="col-xs-9">
                                        <input type="text" name="avanceobjetivo" id="avanceobjetivo" class="form-control" value="<?php echo $valoresobj->avanceobjetivo; ?>" >
                                    </div>
                                <span class="help-block"></span></div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="finalobjetivo">Final</label>
                                    <div class="col-xs-9">
                                        <input type="text" name="finalobjetivo" id="finalobjetivo" class="form-control" value="<?php echo $valoresobj->finalobjetivo; ?>" >
                                    </div>
                                <span class="help-block"></span></div>
                                
                              </div>
                    <div class="modal-footer">
                          <button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
                          <input class="btn btn-primary submitBtn" name="editarfiles"  type="submit"  value="actualizar"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<div class="modal fade" id="deleteobj<?php echo $valoresobj->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Borrar el objetivo</h4></center>
            </div>
            <div class="modal-body">    
                <p class="text-center">¿Esta seguro de Borrar el objetivo</p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <a href="delete_objetivos.php?id=<?php echo $valoresobj->id; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Borrar</a>
            </div>

        </div>
    </div>
</div>
