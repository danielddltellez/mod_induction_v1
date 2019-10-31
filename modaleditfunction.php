        <div  class="modal fade" id="edit_function<?php echo $valoresf->id; ?>" role="dialog">
                <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar la indución al puesto</h4>
                        </div>
                     <div class="modal-body">
                            <form class="form-horizontal" method="POST" action="update_function.php?id=<?php echo $valoresf->id; ?>">
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="namefunction">Nombre de la función</label>
                                    <div class="col-xs-9">
                           
                                        <textarea name="namefunction" id="namefunction"  class="form-control col-xs-12" rows="7" cols="50"><?php echo $valoresf->namefunction; ?></textarea>
                                    </div>
                                <span class="help-block"></span></div>
                                <div class="form-group" id="updatestatus">
                                    <label class="control-label col-md-3" for="estatus">Estatus</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="estatus" name="estatus">
                                            <option value="NO FINALIZADO" <?php if (!(strcmp("NO FINALIZADO", htmlentities($valoresf->estatus, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> >NO FINALIZADO</option>
                                            <option value="FINALIZADO" <?php if (!(strcmp("FINALIZADO", htmlentities($valoresf->estatus, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> >FINALIZADO</option>
                                        </select>
                                    </div>
                                <span class="help-block"></span></div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="date">Fecha</label>
                                    <div class="col-xs-9">
                                        <input type="date" id="date" name="date"  class="form-control" value="<?php echo $valoresf->fechafunc ?>" >
                                    </div>
                                <span class="help-block"></span></div>
                              </div>
                    <div class="modal-footer">
                          <button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
                          <input class="btn btn-primary submitBtn" name="editarproceso"  type="submit"  value="actualizar" />
                        </div>
                </form>
                </div>
            </div>
        </div>

<div class="modal fade" id="deletef<?php echo $valoresf->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Borrar la función</h4></center>
            </div>
            <div class="modal-body">    
                <p class="text-center">¿Esta seguro de Borrar la función?</p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <a href="delete_inductionfuc.php?id=<?php echo $valoresf->id; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Borrar</a>
            </div>

        </div>
    </div>
</div>
