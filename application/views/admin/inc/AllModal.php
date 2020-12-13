<div class="modal fade" id="userAction">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="UsrNm" class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              
              <form action="<?= base_url('Admin/All_users/AddUserBalance'); ?>" method="post">
                <input type="hidden" id="userId" name="userId">
                <div class="form-group">
                  <input type="radio" name="currency" checked value="btc">
                  <label>Balance For BTC</label>
                  <input type="radio" name="currency" value="eth">
                  <label>Balance For ETH</label>
                </div>
                <div class="form-group">
                  <label>Amount</label>
                  <input type="text" name="amount" class="form-control" required>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary">Add Balance</button>
                </div>
              </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="saleCharge">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Set Sale Charge</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              
              <form action="<?= base_url('Admin/Other_Settings/SetChrge'); ?>" method="post">
               
                <div class="form-group">
                  <label>Sale Charge (%)</label>
                  <input type="number" name="chrg" class="form-control" required value="<?= $saleChrg; ?>">
                </div>
                <div class="form-group">
                  <button class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>