<div class="modal fade" id="chPrice">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="UsrNm" class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              
              <form action="<?= base_url('Products/ChangeCardPrice'); ?>" method="post">
                <input type="hidden" id="cardId" name="id">
                
                <div class="form-group">
                  <label>Price (<i class="fas fa-dollar-sign"></i>)</label>
                  <input type="text" name="price" id="prices" class="form-control" required>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary">Update Price</button>
                </div>
              </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>