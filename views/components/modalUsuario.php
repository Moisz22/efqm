<div class="modal fade" id="modal-default-usuario">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div id="leyendaAgregar">
               <h4 class="modal-title" id="myModalLabel">Agregar usuario</h4>
            </div>
            <div id="leyendaEditar" style="display: none;">
               <h4 class="modal-title" id="myModalLabel">Editar usuario</h4>
            </div>
         </div>
         <div class="modal-body" id="modal_add_body">
            <div class="form-medium">
               <div class="form-group">
               <input type="hidden" id="id_usuario_update">
                  <label>Persona:</label>
                  <select class="form-control" id="id_persona" name="id_persona" required title="Persona" onchange="asignaUsuario(this.value)">
                            <option value="">Seleccione...</option>
                            <?php foreach($comboPersona as $rowp): ?>
                              <option value="<?php echo $rowp->id_persona; ?>"><?php echo $rowp->nombre_persona.' '.$rowp->apellido_persona; ?></option>
                            <?php endforeach; ?>
                          </select>
                  <br>
                  <label>Username:</label>
                  <input type="text" readonly class="form-control" id="username" title="Username">
                  <br>
                  <label>Rol:</label>
                  <select class="form-control" id="id_rol" name="id_rol" required title="Rol">
                            <option value="">Seleccione...</option>
                            <?php foreach($comboRol as $rowr): ?>
                              <option value="<?php echo $rowr->id_rol; ?>"><?php echo $rowr->descripcion_rol; ?></option>
                            <?php endforeach; ?>
                          </select>
                     <br>
                     <label>Equipo de trabajo:</label>
                  <select class="form-control" id="equipo_trabajo" name="equipo_trabajo" required title="Equipo de trabajo">
                            <option value="">Seleccione...</option>
                            <?php foreach($comboEquipo as $rowe): ?>
                              <option value="<?php echo $rowe->id_equipo_trabajo; ?>"><?php echo $rowe->descripcion_equipo_trabajo; ?></option>
                            <?php endforeach; ?>
                          </select>
                  <br>
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