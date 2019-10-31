<div  class="modal fade" id="edit_activity<?php echo $nuevosvalores->id; ?>" role="dialog">
                <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar la indución al puesto</h4>
                        </div>
                     <div class="modal-body">
                            <form class="form-horizontal" method="POST" action="update_inductionact.php?id=<?php echo $nuevosvalores->id; ?>">

                                <div class="form-group" style="padding-bottom: 15px;">
                                    <label class="col-xs-3 control-label" for="nameactivity">Nombre de la actividad</label>
                                    
                                    <div class="col-md-9">
                                        <select class="form-control" id="nameactivity" name="nameactivity">
                                            <option value="CÓDIGO DE VESTIMENTA" <?php if (!(strcmp("CÓDIGO DE VESTIMENTA", htmlentities($nuevosvalores->nameactivity, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> >CÓDIGO DE VESTIMENTA</option>
                                            <option value="ESTRUCTURA TRIPLEI VS MI PUESTO" <?php if (!(strcmp("ESTRUCTURA TRIPLEI VS MI PUESTO", htmlentities($nuevosvalores->nameactivity, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> >ESTRUCTURA TRIPLEI VS MI PUESTO</option>
                                            <option value="HORARIOS" <?php if (!(strcmp("HORARIOS", htmlentities($nuevosvalores->nameactivity, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> >HORARIOS</option>
                                            <option value="POLÍTICAS DE ASISTENCIA" <?php if (!(strcmp("POLÍTICAS DE ASISTENCIA", htmlentities($nuevosvalores->nameactivity, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> >POLÍTICAS DE ASISTENCIA</option>
                                            <option value="REGLAMENTO INTERNO" <?php if (!(strcmp("REGLAMENTO INTERNO", htmlentities($nuevosvalores->nameactivity, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> >REGLAMENTO INTERNO</option>
                                        </select>
                                    </div>
                                <span class="help-block"></span></div>
                                <div class="form-group" id="updatestatus" style="padding-bottom: 15px;">
                                    <label class="control-label col-md-3" for="status">Estatus</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="status" name="status">
                                            
                                            <option value="FINALIZADO" <?php if (!(strcmp("FINALIZADO", htmlentities($nuevosvalores->status, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> >FINALIZADO</option>
                                            <option value="NO FINALIZADO" <?php if (!(strcmp("NO FINALIZADO", htmlentities($nuevosvalores->status, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> >NO FINALIZADO</option>
                                            
                                            
                                            
                                        </select>
                                    </div>
                                <span class="help-block"></span></div>
                               

                                <div class="form-group" style="padding-bottom: 15px;">
                                    <label class="col-xs-3 control-label" for="date">Fecha</label>
                                    <div class="col-xs-9">
                                        <input type="date" id="date" name="date"  class="form-control" value="<?php echo $nuevosvalores->fecha ?>" >
                                    </div>
                                <span class="help-block"></span></div>

 
                        </div>
                        
                        <div class="modal-footer">

                           <button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
                          <input class="btn btn-primary submitBtn btn-personalizado" name="editarproceso"  type="submit"  value="actualizar" />
                        </div>
                          </form>
                    </div>
                </div>

            </div>

<div class="modal fade" id="delete<?php echo $nuevosvalores->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Borrar indución al puesto</h4></center>
            </div>
            <div class="modal-body">    
                <p class="text-center">¿Esta seguro de Borrar la indución al puesto?</p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <a href="delete_inductionact.php?id=<?php echo $nuevosvalores->id; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Borrar</a>
            </div>

        </div>
    </div>
</div>

<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
