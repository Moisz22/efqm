<div class="modal fade" id="modal-default-recurso-proceso">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div id="leyendaAgregarRecursoProceso">
               <h4 class="modal-title" id="myModalLabel">Agregar recurso</h4>
            </div>
            <div id="leyendaEditarRecursoProceso" style="display: none;">
               <h4 class="modal-title" id="myModalLabel">Editar recurso</h4>
            </div>
         </div>
         <div class="modal-body" id="modal_add_body">
            <div id="alta_tarjetaCredito" class="form-medium">
               <div class="form-group">
                  <input type="hidden" id="id_recurso_proceso_update">
                  <label>Actividad asociada:</label>
                  <select  id="id_actividad_recurso_proceso" class="form-control cbx_actividad" title="Actividad asociada">
                     <option value="">Seleccione...</option>
                  </select>
                     <br>
                  <label>Recurso:</label>
                  <select  id="id_recurso" class="form-control" title="Recurso">
                  <option value="">Seleccione...</option>
                  <?php foreach($comboRecurso as $rowRe): ?>
                              <option value="<?php echo $rowRe->id_recurso; ?>"><?php echo $rowRe->descripcion_recurso; ?></option>
                            <?php endforeach; ?>
                  </select>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <div id="buttonGuardarRecursoProceso">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Guardar" onclick="agregarRecursoProceso()" name="B1">
            </div>
            <div id="buttonActualizarRecursoProceso" style="display: none;">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Actualizar" onclick="actualizarRecursoProceso()" name="B1">
            </div>
            
         </div>
      </div>
   </div>
</div>