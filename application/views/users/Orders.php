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
                    <h4>Dashboard</h4>
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <h6 class="text-danger">please make sure to copy all required information, information will only stay visible for 6 months</h6>
                <div class="table-responsive">
                <table class="tble tble-bordered" id="example1">
                  <thead>
                    <tr>
                        <th>SL</th>
                        <th>NUMBER</th>
                        <th>EXP</th>
                        <th>CVV</th>
                        <th>TYPE</th>
                        <th>BANK</th>
                        <th>NAME</th>
                        <th>ADDRESS</th>
                        <th>MOBILE</th>
                        <th>EMAIL</th>
                        <th>SELLER</th>
                        <th>BASE</th>
                        <th>$</th>
                        
                      </tr>
                  </thead>
                  <tbody> 
                    <?php if(!empty($ordData)): ?>
                      <?php $s = 1; foreach($ordData as $pro): $sl = $s++; $card = strtolower($pro['brand']);
                        if($pro['currency']=="btc")
                        {
                          $icn = "<i class='fab fa-btc'></i>";
                        }
                        else
                        {
                          $icn = "<i class='fab fa-ethereum'></i>";
                        }
                       ?>
                        <tr>
                          <td><?= $sl; ?></td>
                            <td><img src="<?= base_url('assets/cards/'.$card.".png"); ?>" width="25"> 
                              <?= nbs(5); ?><?= $pro['numbers']; ?></td>
                            <td><?= $pro['exp']; ?></td>
                            <td><?= $pro['cvv']; ?></td>
                            <td><?= $pro['type']; ?></td>
                            <td style="text-align: left; width: 10%"><span class="flag-icon flag-icon-<?= $pro['cntr_cd']; ?>"></span> <?= $pro['bank']; ?></td>
                            <td><?= $pro['name']; ?></td>
                            <td style="text-align: left; width: 15%"><span class="flag-icon flag-icon-<?= $pro['cntr_cd']; ?>"></span> <?= $pro['address']; ?></td>
                            <td><?= $pro['mobile']; ?></td>
                            <td><?= $pro['email']; ?></td>
                            <td><?= $pro['seller']; ?></td>
                            <td><?= $pro['base']; ?></td>
                            <td><i class="fas fa-dollar-sign"></i> <?= $pro['price']; ?><br>
                             <span class="text-primary"><?= $pro['buyPrice']; ?></span>
                            </td>
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