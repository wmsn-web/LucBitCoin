<div class="modal fade" id="userAction">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Primary Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline-light">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="wthdrawReq">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Withdraw Request</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Select Currency</label><br>
                    <input type="radio" name="currency" value="btc" checked >
                    <label>Bitcoin(BTC)</label><?= br(1); ?>
                    <input type="radio" name="currency" value="eth" >
                    <label>Ethereum(ETH)</label>
                  </div>
                  <div class="form-group">
                    <label>Amount</label>
                    <input type="text" id="rqAmt" name="amount" class="form-control" placeholder="0.0000000000">
                  </div>
                </div>
                <div class="col-md-8">
                  <h6>All Requests</h6>
                  <div class="wdrq"  title="Scroll Up & Down">
                    <ul>
                      <?php if(!empty($rqData)): ?>
                        <?php foreach($rqData as $rq):
                          if($rq['status']=='2')
                          {
                            $sdClass = "dan_shadow";
                            $sts = "Cancelled";
                            $stl = "text-danger";
                          }
                          elseif($rq['status']=='1')
                          {
                            $sdClass = "suc_shadow";
                            $sts = "Success";
                            $stl = "text-success";
                          }
                          else
                          {
                            $sdClass = "wrn_shadow";
                            $sts = "Pending";
                            $stl = "text-warning";
                          }

                          if($rq['currency']=="btc")
                          {
                            $icn = "<i class='fab fa-btc'></i>";
                          }
                          else
                          {
                            $icn = "<i class='fab fa-ethereum'></i>";
                          }
                         ?>
                            <li class="<?= $sdClass; ?>">
                              <span class="italic-text">
                                [<?= $rq["date"]; ?>] Request Amount <?= $icn; ?> <?= $rq['amount']; ?> <b>Status: <span class="<?= $stl; ?>"><?= $sts; ?></span></b>
                              </span> </li>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" id="reqst" class="btn btn-outline-primary">Send Request</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>