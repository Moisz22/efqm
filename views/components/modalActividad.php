<div class="modal fade" id="modal-default-actividad">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div id="leyendaAgregar">
               <h4 class="modal-title" id="myModalLabel">Agregar actividad</h4>
            </div>
            <div id="leyendaEditar" style="display: none;">
               <h4 class="modal-title" id="myModalLabel">Editar actividad</h4>
            </div>
         </div>
         <div class="modal-body" id="modal_add_body">
            <div id="alta_tarjetaCredito" class="form-medium">
               <div class="form-group">
                  <input type="hidden" id="id_actividad_update">
                  <label>Orden de la actividad:</label>
                  <input type="number" maxlength="3" id="orden_actividad" class="form-control">
                  <br>
                  <label>Descripción de la actividad:</label>
                  <textarea maxlength="255" name="de_actividad" id="de_actividad" class="form-control" required></textarea>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <div id="buttonGuardar">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Guardar" onclick="agregarActividad()" name="B1">
            </div>
            <div id="buttonActualizar" style="display: none;">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Actualizar" onclick="actualizarActividad()" name="B1">
            </div>
            
         </div>
      </div>
   </div>
</div>