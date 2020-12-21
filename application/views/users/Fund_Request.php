<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CC4U</title>
  <?php include("inc/table_layout.php"); ?>
  <body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include("inc/top_panel.php"); ?>
		<?php include("inc/side_menu.php"); ?>
		<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-headerdd">
        <div class="card">
          <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h4>Fund Request</h4>
                    <small><i class="fa fa-caret-down" aria-hidden="true"></i> Welcome back <?= $this->session->userdata("userName"); ?></small>
                </div>
                <?php include("inc/dash_head.php"); ?>
            </div>
              
          </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <form action="<?= base_url('Fund_Request/SendRequest/'.$this->session->userdata('userName')); ?>" method="post">
                  <p class="text-danger">Please Request Fund after successfull transfer to the company BTC or ETH address. Our concern team will update your wallet after verify transaction. </p>
                  <div class="form-group">
                    <label>Choose Currency</label><br>
                    <input type="radio" name="currency" value="btc" checked> <i class="fab fa-btc"></i><?= nbs(10); ?>
                    <input type="radio" name="currency" value="eth"> <i class="fab fa-ethereum"></i>
                  </div>
                  <div class="form-group">
                    <label>Amount</label>
                    <input type="text" name="amount" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>From Address </label><br> <small class="text-danger">Write your BTC or ETH address from where you sent</small>
                    <input type="text" name="from_addr" class="form-control" placeholder="From Address">
                  </div>
                  <div class="form-group">
                    <label>Narration</label><br>
                    <small class="text-danger">Write Transaction id or other transaction details</small>
                    <input type="text" name="notes" class="form-control" placeholder="Write Transaction id or other transaction details">
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary">Send Request</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <h5>All Requests</h5>
                  <table id="example1" class="tble tble-bordered">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Date</th>
                        <th>Currency</th>
                        <th>Amount</th>
                        <th>From Address</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($fndRqst)): ?>
                        <?php $s=1; foreach ($fndRqst as $key): $sl=$s++;
                          if($key['status']=="0")
                            {
                              $status = "<b class='text-warning'>Pending</b>";
                              $del = "<a onclick=\"return confirm('Delete this Request?')\" href='".base_url('Fund_Request/DelReq/'.$key['id'])."' class='text-danger'> <i class='fa fa-trash'></i></a>";
                            }
                            elseif($key['status']=="1")
                              {
                                $status = "<b class='text-success'>Success</b>";
                                $del = "<b class='text-success'><i class='fa fa-check'></i></b>"; 
                              }
                              else
                              {
                                $status = "<b class='text-danger'>Cancelled</b>";
                                $del = "<b class='text-danger'><i class='fa fa-close'></i></b>"; 
                              }
                         ?>
                          <tr>
                            <td><?= $sl; ?></td>
                            <td><?= $key['date']; ?></td>
                            <td><?= strtoupper($key['currency']); ?></td>
                            <td><?= $key['amount']; ?></td>
                            <td><?= $key['from_addr']; ?></td>
                            <td><?= $status; ?></td>
                            <td><?= $del; ?></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <?php if($feed = $this->session->flashdata("Feed")): ?>
      <div class="flashd"><?= $feed; ?></div>
    <?php endif; ?>
  </div>
  <?php include('inc/footer.php'); ?>
  </div>
  <?php include('inc/table_js.php'); ?>
  <script type="text/javascript">
   $("#slctEth").click(function(){
        user = "<?= $this->session->userdata('userName'); ?>";
        $.post("<?= base_url('Products/ChangetoEth'); ?>",
            {
              user: user
            },
            function(response)
            {
              location.href="";
            }
          )
      });
      $("#slctBtc").click(function(){
        user = "<?= $this->session->userdata('userName'); ?>";
        $.post("<?= base_url('Products/ChangetoBtc'); ?>",
            {
              user: user
            },
            function(response)
            {
              location.href="";
            }
          )
      });
</script>
</body>
</html>