<div class="modal fade" id="modal-default-indicador-detalle">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div id="leyendaAgregarIndicadorDetalle">
               <h4 class="modal-title" id="myModalLabel">Agregar detalle</h4>
            </div>
            <div id="leyendaEditarIndicadorDetalle" style="display: none;">
               <h4 class="modal-title" id="myModalLabel">Editar detalle</h4>
            </div>
         </div>
         <div class="modal-body" id="modal_add_body">
            <div  class="form-medium">
               <div class="form-group">
                  <input type="hidden" id="id_detalle_update">
                  <label>Descripción:</label>
                  <input type="text" class="form-control" id="anio_detalle" title="Descripción">
                  <br>
                  <label>Resultado:</label>
                  <input type="text" class="form-control" id="resultado_detalle" title="Resultado">
                  <br>
                  <label>Meta:</label>
                  <input type="text" class="form-control" id="meta_detalle" title="Meta">
                  <br>
                  <label>CODEFE: <input type="checkbox" id="flag_codefe"></label>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <div id="buttonGuardarIndicadorDetalle">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Guardar" onclick="agregarIndicadorDetalle()" name="B1">
            </div>
            <div id="buttonActualizarIndicadorDetalle" style="display: none;">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
               <input type="submit" class="btn btn-success" value="Actualizar" onclick="actualizarIndicadorDetalle()" name="B1">
            </div>
            
         </div>
      </div>
   </div>
</div>