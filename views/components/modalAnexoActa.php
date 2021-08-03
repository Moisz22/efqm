<div class="modal fade" id="modal-default-anexo-acta">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Editar datos de anexo</h4>
         </div>
         <div class="modal-body" id="modal_add_body">
            <div id="alta_tarjetaCredito" class="form-medium">
               <div class="form-group">
                  <input type="hidden" id="id_anexo_acta_update">
                  <label>Descripción de documento:</label>
                  <textarea maxlength="255" name="descripcion_anexo_acta_update" id="descripcion_anexo_acta_update" class="form-control" required title="Descripción de documento"></textarea>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-success" value="Actualizar" onclick="actualizarAnexoActa()" name="B1">
         </div>
      </div>
   </div>
</div>