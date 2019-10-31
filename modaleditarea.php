<div  class="modal fade" id="edit_area<?php echo $valoresa->id; ?>" role="dialog">
                <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar el área</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="POST" action="update_area.php?id=<?php echo $valoresa->id; ?>">

                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="namearea">Nombre de área</label>
                                   
                                    <div class="col-md-9">
                                        <select class="form-control" id="namearea" name="namearea">
                                            <option value="N/A" <?php if (!(strcmp("N/A", htmlentities($valoresa->namearea, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> >N/A</option>
                                            <option value="ADMINISTRACIÓN" <?php if (!(strcmp("ADMINISTRACIÓN", htmlentities($valoresa->namearea, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> >ADMINISTRACIÓN</option>
                                            <option value="OPERACIONES" <?php if (!(strcmp("OPERACIONES", htmlentities($valoresa->namearea, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> >OPERACIONES</option>
                                            <option value="DIRECCION GENERAL" <?php if (!(strcmp("DIRECCION GENERAL", htmlentities($valoresa->namearea, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> >DIRECCION GENERAL</option>
                                        </select>
                                    </div>
                                <span class="help-block"></span></div>

                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="description">Descripción</label>
                                    <div class="col-md-9">
                           
                                        <textarea name="description" id="description"  class="form-control" rows="4" cols="50"><?php echo $valoresa->description; ?></textarea>
                                    </div>
                                <span class="help-block"></span></div>
                        </div>
                        
                        <div class="modal-footer">

                           <button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
                          <input class="btn btn-primary submitBtn" name="editararea"  type="submit"  value="actualizar" />
                        </div>
                          </form>
                    </div>
                </div>

            </div>

<div class="modal fade" id="deletea<?php echo $valoresa->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Borrar el área</h4></center>
            </div>
            <div class="modal-body">    
                <p class="text-center">¿Esta seguro de Borrar el área?</p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <a href="delete_inductionare.php?id=<?php echo $valoresa->id; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Borrar</a>
            </div>

        </div>
    </div>
</div>