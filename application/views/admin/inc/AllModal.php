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
                  <input type="number" name="chrg" class="form-control" required value="<?= $settings['SaleCharg']; ?>">
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

      <div class="modal fade" id="setCur">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Set Currency</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <?php
              /*
                $endpoint = 'test';
                $access_key = '70d19982004ef8aa2c639ae10d4c06af';
                $json = file_get_contents('http://api.coinlayer.com/api/'.$endpoint.'?access_key='.$access_key.'');
                $ex = json_decode($json);  
                $ccrrBtc = $ex->rates->BTC;
                $ccrrEth = $ex->rates->ETH;
                */
              ?>
              
              <form action="<?= base_url('Admin/Other_Settings/SetCureency'); ?>" method="post">
               <div class="row">
                  <div class="form-group col-sm-5">
                    <label><i class="fab fa-btc"></i> Bitcoin</label>
                    <input type="text"  class="form-control" readonly value="1">
                  </div>
                  <div class="form-group col-sm-2"><label>&nbsp;</label> <p>= </p></div>
                  <div class="form-group col-sm-5">
                    <label><i class="fab fa-dollar-sign"></i> USD</label><small class="text-danger">Curent: </small>
                    <input type="text" name="btcRate" class="form-control" required value="<?= $settings['btcRate']; ?>">
                  </div>
                  <div class="form-group col-sm-5">
                    <label><i class='fab fa-ethereum'></i> Ethereum</label>
                    <input type="number"  class="form-control" readonly value="1">
                  </div>
                  <div class="form-group col-sm-2"><label>&nbsp;</label> <p>= </p></div>
                  <div class="form-group col-sm-5">
                    <label><i class='fab fa-dollar-sign'></i> USD</label> <small class="text-danger">Curent: </small>
                    <input type="text" name="ethRate" class="form-control" required value="<?= $settings['ethRate']; ?>">
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary">Save</button>
                  </div>
                </div>
              </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="checker">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Set Checker Price</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              
              <form action="<?= base_url('Admin/Other_Settings/SetChecker'); ?>" method="post">
               
                <div class="form-group">
                  <label>Checker USD</label>
                  <input type="text" name="ck_btc" class="form-control" required value="<?= $settings['checker_price_btc']; ?>">
                </div>
                <div class="form-group">
                  
                  <input type="hidden" name="ck_eth" class="form-control"  value="<?= $settings['checker_price_eth']; ?>">
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

      <div class="modal fade" id="depAddr">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Set Deposit Address</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              
              <form action="<?= base_url('Admin/Other_Settings/SetDepAddr'); ?>" method="post">
               
                <div class="form-group">
                  <label><i class="fab fa-btc"></i> BTC Address</label>
                  <input type="text" name="addr_btc" class="form-control" required value="<?= $settings['addr_btc']; ?>">
                </div>
                <div class="form-group">
                  <label><i class="fab fa-ethereum"></i> ETH Address</label>
                  <input type="text" name="addr_eth" class="form-control"  value="<?= $settings['addr_eth']; ?>">
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