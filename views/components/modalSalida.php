<div class="modal fade" id="modal-default-salida">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div id="leyendaAgregarSalida">
               <h4 class="modal-title" id="myModalLabel">Agregar salida</h4>
            </div>
            <div id="leyendaEditarSalida" style="display: none;">
               <h4 class="modal-title" id="myModalLabel">Editar salida</h4>
            </div>
         </div>
         <div class="modal-body" id="modal_add_body">
            <div id="alta_tarjetaCredito" class="form-medium">
               <div class="form-group">
               <input type="hidden" id="id_salida_update">
                  <label>Actividad asociada:</label>
                  <select  id="id_actividad_salida" class="form-control cbx_actividad">
                     <option value="">Seleccione...</option>
                  </select>
                     <br>
                  <label>Descripción salida:</label>
                  <textarea maxlength="255" name="descripcion_salida" id="descripcion_salida" class="form-control" required></textarea>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <div id="buttonGuardarSalida">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Guardar" onclick="agregarSalida()" name="B1">
            </div>
            <div id="buttonActualizarSalida" style="display: none;">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Actualizar" onclick="actualizarSalida()" name="B1">
            </div>
            
         </div>
      </div>
   </div>
</div>