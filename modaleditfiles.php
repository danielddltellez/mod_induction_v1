        <div  class="modal fade" id="edit_files<?php echo $valoresfi->id; ?>" role="dialog">
                <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar la ubicación de los archivos</h4>
                        </div>
                     <div class="modal-body">
                            <form class="form-horizontal" method="POST" action="update_files.php?id=<?php echo $valoresfi->id; ?>">
                                <div class="form-group">
                                    <label class="col-xs-3 control-label" for="filename">Nombre del archivo</label>
                                    <div class="col-xs-9">
                                        <input type="text" name="filename" id="filename" class="form-control" value="<?php echo $valoresfi->filename; ?>" >
                                    </div>
                                <span class="help-block"></span></div>
                                <div class="form-group" id="updatefilename">
                                    <label class="control-label col-md-3" for="ubicacion">Ubicación</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="ubicacion" name="ubicacion">
                                            <option value="QDoc" <?php if (!(strcmp("QDoc", htmlentities($valoresfi->ubicacion, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> >QDoc</option>
                                            <option value="Qprocess" <?php if (!(strcmp("Qprocess", htmlentities($valoresfi->ubicacion, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> >Qprocess</option>
                                            <option value="Plataforma E-Learning" <?php if (!(strcmp("Plataforma E-Learning", htmlentities($valoresfi->ubicacion, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> >Plataforma E-Learning</option>
                                        </select>
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

<div class="modal fade" id="deletefi<?php echo $valoresfi->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Borrar la ubicación del archivo</h4></center>
            </div>
            <div class="modal-body">    
                <p class="text-center">¿Esta seguro de Borrar la ubicación del archivo?</p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <a href="delete_files.php?id=<?php echo $valoresfi->id; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Borrar</a>
            </div>

        </div>
    </div>
</div>
