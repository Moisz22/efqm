<div class="modal fade" id="modal-default-subactividad">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div id="leyendaAgregarSubactividad">
               <h4 class="modal-title" id="myModalLabel">Agregar subactividad</h4>
            </div>
            <div id="leyendaEditarSubactividad" style="display: none;">
               <h4 class="modal-title" id="myModalLabel">Editar subactividad</h4>
            </div>
         </div>
         <div class="modal-body" id="modal_add_body">
            <div id="alta_tarjetaCredito" class="form-medium">
               <div class="form-group">
               <input type="hidden" id="id_subactividad_update">
                  <label>Actividad asociada:</label>
                  <select  id="id_actividad_subactividad" class="form-control cbx_actividad" title="Actividad asociada">
                     <option value="">Seleccione...</option>
                  </select>
                  <br>
                  <label>Orden subactividad:</label>
                  <input type="number"  id="orden_subactividad" class="form-control" title="Orden subactividad">
                  <br>
                  <label>Responsable:</label>
                  <select  id="id_responsable_subactividad" class="form-control" title="Responsable">
                     <option value="">Seleccione...</option>
                     <?php foreach($comboResponsableSubactividad as $rowRS): ?>
                        <option value="<?php echo $rowRS->id_cargo; ?>"><?php echo $rowRS->descripcion_cargo; ?></option>
                        <?php endforeach; ?>
                  </select>
                     <br>
                  <label>Descripción subactividad:</label>
                  <textarea maxlength="255" name="descripcion_subactividad" id="descripcion_subactividad" class="form-control" required title="Descripción subactividad"></textarea>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <div id="buttonGuardarSubactividad">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Guardar" onclick="agregarSubactividad()" name="B1">
            </div>
            <div id="buttonActualizarSubactividad" style="display: none;">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Actualizar" onclick="actualizarSubactividad()" name="B1">
            </div>
         </div>
      </div>
   </div>
</div>