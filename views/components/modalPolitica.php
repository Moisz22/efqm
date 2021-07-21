<div class="modal fade" id="modal-default-politica">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div id="leyendaAgregarPolitica">
               <h4 class="modal-title" id="myModalLabel">Agregar política</h4>
            </div>
            <div id="leyendaEditarPolitica" style="display: none;">
               <h4 class="modal-title" id="myModalLabel">Editar política</h4>
            </div>
         </div>
         <div class="modal-body" id="modal_add_body">
            <div id="alta_tarjetaCredito" class="form-medium">
               <div class="form-group">
               <input type="hidden" id="id_politica_update">
                  <label>Orden política:</label>
                  <input type="number"  id="orden_politica" class="form-control" title="Orden política">
                  <br>
                  <label>Actividad asociada:</label>
                  <select  id="id_actividad_politica" class="form-control cbx_actividad" title="Actividad asociada">
                     <option value="">Seleccione...</option>
                  </select>
                     <br>
                  <label>Descripción política:</label>
                  <textarea maxlength="255" name="descripcion_politica" id="descripcion_politica" class="form-control" required title="Descripción política"></textarea>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <div id="buttonGuardarPolitica">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Guardar" onclick="agregarPolitica()" name="B1">
            </div>
            <div id="buttonActualizarPolitica" style="display: none;">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Actualizar" onclick="actualizarPolitica()" name="B1">
            </div>
            
         </div>
      </div>
   </div>
</div>