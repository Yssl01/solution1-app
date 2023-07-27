<!-- Modal -->
<div id="{{ $id }}" class="modal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"><!-- Modal dialog-->
              <div class="modal-content"><!-- Modal content-->
                  <div class="modal-body">
                      {{$slot}}
                  </div>
                  @if ( $id == "create_modal" )
                    <div class="modal-footer"><!-- Modal footer -->
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                      <button id="add" type="button" class="btn btn-primary" data-dismiss="modal">Valider</button>
                    </div><!-- End Modal footer -->
                  @endif
                  @if( $id == "edit_modal" )
                  <div class="modal-footer"><!-- Modal footer -->
                      <button id="update" type="button" class="btn btn-primary" data-dismiss="modal">Modifier</button>
                  </div><!-- End Modal footer -->
                  @endif
            
              </div><!-- End Modal content-->
    </div><!--End Modal dialog -->
</div><!-- End Modal -->