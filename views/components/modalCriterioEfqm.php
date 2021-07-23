<div class="modal fade" id="modal-default">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div id="leyendaAgregar">
               <h4 class="modal-title" id="myModalLabel">Agregar criterio EFQM</h4>
            </div>
            <div id="leyendaEditar" style="display: none;">
               <h4 class="modal-title" id="myModalLabel">Editar criterio EFQM</h4>
            </div>
         </div>
         <div class="modal-body" id="modal_add_body">
            <div class="form-medium">
               <div class="form-group">
                  <input type="hidden" id="id_criterio_efqm_update">
                  <label>Descripción del criterio EFQM:</label>
                  <textarea maxlength="200" name="de_criterio_efqm" id="de_criterio_efqm" class="form-control" required title="Descripción del criterio EFQM"></textarea>
                  <br>
                  <label>Abreviatura del criterio EFQM:</label>
                  <input maxlength="5" type="text" class="form-control" id="abreviatura_criterio_efqm" required title="Abreviatura del criterio EFQM">
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <div id="buttonGuardar">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Guardar" onclick="agregar()" name="B1">
            </div>
            <div id="buttonActualizar" style="display: none;">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Actualizar" onclick="actualizar()" name="B1">
            </div>
            
         </div>
      </div>
   </div>
</div>