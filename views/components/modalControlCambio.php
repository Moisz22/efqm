<div class="modal fade" id="modal-default-control-cambio">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div id="leyendaAgregarControlCambio">
               <h4 class="modal-title" id="myModalLabel">Agregar control de cambios</h4>
            </div>
            <div id="leyendaEditarControlCambio" style="display: none;">
               <h4 class="modal-title" id="myModalLabel">Editar control de cambios</h4>
            </div>
         </div>
         <div class="modal-body" id="modal_add_body">
            <div id="alta_tarjetaCredito" class="form-medium">
               <div class="form-group">
                  <input type="hidden" id="id_control_cambio_update">
                  <label>Version</label>
                  <select  id="id_control_cambio_version" class="form-control" title="Versión">
                  <option value="">Seleccione...</option>
                  <?php foreach($comboVersion as $rowvCC): ?>
                              <option value="<?php echo $rowvCC->id_version; ?>"><?php echo $rowvCC->descripcion_version; ?></option>
                            <?php endforeach; ?>
                          </select>
                  <br>
                  <label>Descripción del control de cambios:</label>
                  <textarea maxlength="255" name="de_control_cambio" id="de_control_cambio" class="form-control" required  title="Descripción del control de cambios"></textarea>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <div id="buttonGuardarControlCambio">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Guardar" onclick="agregarControlCambio()" name="B1">
            </div>
            <div id="buttonActualizarControlCambio" style="display: none;">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Actualizar" onclick="actualizarControlCambio()" name="B1">
            </div>
            
         </div>
      </div>
   </div>
</div>