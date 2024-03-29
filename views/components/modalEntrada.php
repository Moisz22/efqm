<div class="modal fade" id="modal-default-entrada">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div id="leyendaAgregarEntrada">
               <h4 class="modal-title" id="myModalLabel">Agregar entrada</h4>
            </div>
            <div id="leyendaEditarEntrada" style="display: none;">
               <h4 class="modal-title" id="myModalLabel">Editar entrada</h4>
            </div>
         </div>
         <div class="modal-body" id="modal_add_body">
            <div id="alta_tarjetaCredito" class="form-medium">
               <div class="form-group">
                  <input type="hidden" id="id_entrada_update">
                  <label>Actividad asociada:</label>
                  <select  id="id_actividad_entrada" class="form-control cbx_actividad" title="Actividad asociada">
                     <option value="">Seleccione...</option>
                  </select>
                     <br>
                  <label>Descripción entrada:</label>
                  <textarea maxlength="255" name="descripcion_entrada" id="descripcion_entrada" class="form-control" required title="Descripción entrada"></textarea>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <div id="buttonGuardarEntrada">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Guardar" onclick="agregarEntrada()" name="B1">
            </div>
            <div id="buttonActualizarEntrada" style="display: none;">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Actualizar" onclick="actualizarEntrada()" name="B1">
            </div>
            
         </div>
      </div>
   </div>
</div>