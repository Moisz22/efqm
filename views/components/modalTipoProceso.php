<div class="modal fade" id="modal-default">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div id="leyendaAgregar">
               <h4 class="modal-title" id="myModalLabel">Agregar tipo de proceso</h4>
            </div>
            <div id="leyendaEditar" style="display: none;">
               <h4 class="modal-title" id="myModalLabel">Editar tipo de proceso</h4>
            </div>
         </div>
         <div class="modal-body" id="modal_add_body">
            <div class="form-medium">
               <div class="form-group">
                  <input type="hidden" id="id_tipo_proceso_update">
                  <label>Descripción del tipo de proceso:</label>
                  <textarea maxlength="50" name="de_tipo_proceso" id="de_tipo_proceso" class="form-control" title="Descripción del tipo de proceso" required></textarea>
                  <br>
                  <label>Abreviatura del tipo de proceso:</label>
                  <input maxlength="3" type="text" class="form-control" id="abreviatura_tipo_proceso" title="Abreviatura del tipo de proceso" required>
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