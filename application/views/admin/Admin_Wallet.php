<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Dashboard</title>
  <?php include("inc/table_layout.php"); ?>
  <body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include("inc/top_panel.php"); ?>
		<?php include("inc/side_menu.php"); ?>
		<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin Wallet</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Wallet</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <h5>Balance:</h5>
                <table class="table table-bordered">
                  <tr>
                    <th><i class="fab fa-btc"></i> BTC</th>
                    <th><i class="fab fa-ethereum"></i> ETH</th>
                  </tr>
                  <tr>
                    <td><?= $walletData['balanceBtc']; ?></td>
                    <td><?= $walletData['balanceEth']; ?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-9">&nbsp;</div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <h5>Transaction:</h5>
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Date</th>
                        <th>Narration</th>
                        <th><i class="fab fa-btc"></i> BTC</th>
                        <th><i class="fab fa-ethereum"></i> ETH</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($walletData['trData'])): ?>
                        <?php $s =1; foreach($walletData['trData'] as $trdata=>$val): $sl = $s++; ?>
                          <tr>
                            <td><?= $sl; ?></td>
                            <td><?= $val['date']; ?></td>
                            <td><?= $val['notes']; ?></td>
                            <td><?= $val['btc']; ?></td>
                            <td><?= $val['eth']; ?></td>
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
</body>
</html>