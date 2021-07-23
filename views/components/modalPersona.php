<div class="modal fade" id="modal-default">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div id="leyendaAgregar">
               <h4 class="modal-title" id="myModalLabel">Agregar persona</h4>
            </div>
            <div id="leyendaEditar" style="display: none;">
               <h4 class="modal-title" id="myModalLabel">Editar persona</h4>
            </div>
         </div>
         <div class="modal-body" id="modal_add_body">
            <div class="form-medium">
               <div class="form-group">
                  <input type="hidden" id="id_persona_update">
                  <label>Identificación:</label>
                  <input type="text" class="form-control" id="identificacion_persona" maxlength="11" title="Identificación">
                  <br>
                  <label>Nombres:</label>
                  <input type="text" class="form-control" id="nombre_persona" maxlength="255" title="Nombres">
                  <br>
                  <label>Apellidos:</label>
                  <input type="text" class="form-control" id="apellido_persona" maxlength="255" title="Apellidos">
                  <br>
                  <label>Nombre para impresión:</label>
                  <input type="text" class="form-control" id="impresion_persona" maxlength="255" title="Nombre para impresión">
                  <br>
                  <label>Cargo:</label>
                  <select  id="id_cargo" class="form-control" title="Cargo">
                     <option value="">Seleccione...</option>
                     <?php foreach($comboCargo as $row): ?>
                        <option value="<?php echo $row->id_cargo; ?>"><?php echo $row->descripcion_cargo; ?></option>
                        <?php endforeach; ?>
                     </select>
                     <br>
                     
                  <label>Persona externa: <input type="checkbox" id="flag_empleado"></label>
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