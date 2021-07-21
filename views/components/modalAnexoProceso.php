<div class="modal fade" id="modal-default-anexo-proceso">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title" id="myModalLabel">Editar datos de anexo</h4>
         </div>
         <div class="modal-body" id="modal_add_body">
            <div id="alta_tarjetaCredito" class="form-medium">
               <div class="form-group">
               <input type="hidden" id="id_anexo_proceso_update">
                  <label>Tipo de documento:</label>
                  <select class="form-control" id="tipo_documento_anexo_update" name="tipo_documento_anexo_update" required title="Tipo de documento">
                            <option value="">Seleccione...</option>
                            <?php foreach($comboTipoDocumento as $rowd): ?>
                              <option value="<?php echo $rowd->id_tipo_documento; ?>"><?php echo $rowd->descripcion_tipo_documento; ?></option>
                            <?php endforeach; ?>
                          </select>
                  <br>
                  <label>Actividad asociada:</label>
                  <select  id="id_actividad_anexo_update" class="form-control cbx_actividad" title="Actividad asociada">
                     <option value="">Seleccione...</option>
                  </select>
                     <br>
                  <label>Descripción de documento:</label>
                  <textarea maxlength="255" name="descripcion_anexo_proceso_update" id="descripcion_anexo_proceso_update" class="form-control" required title="Descripción de documento"></textarea>
               </div>
            </div>
         </div>
         <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Actualizar" onclick="actualizarAnexoProceso()" name="B1">            
         </div>
      </div>
   </div>
</div>