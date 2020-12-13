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
            <h1 class="m-0 text-dark">Withdraw Request</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Withdraw Request</li>
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example1" class="tble tble-bordered">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Username</th>
                        <th>Amount</th>
                        <th>Withdraw Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($gtWdr)): ?>
                        <?php $s =1; foreach($gtWdr as $wdr): $sl = $s++;
                            if($wdr['currency']=="btc")
                            {
                              $icn = "<i class='fab fa-btc'></i>";
                            }
                            else
                            {
                              $icn = "<i class='fab fa-ethereum'></i>";
                            }
                            if($wdr['status']=="0")
                            {
                              $action = '<a onclick="return confirm(\'Are You Sure? amount has been sent to user address. Once you proceed it can not be changed. Please be sure before proceed. \')" class="text-primary" href="'.base_url('Admin/Withdraw_Request/CompleteRqst/'.$wdr['id']).'">Sent Amount</a>'.nbs(3).'<a  onclick="return confirm(\'Cancel this request? deducted amount will be added to user wallet. Once you proceed it can not be changed. Please be sure before proceed. \')"class="text-danger" href="'.base_url('Admin/Withdraw_Request/CancelRqst/'.$wdr['id']).'">Cancel</a>';
                            }
                            elseif($wdr['status']=="1")
                            {
                              $action = '<span  class="text-success">Paid</span>';
                            }
                            else
                            {
                              $action = '<span class="text-danger">Cancelled</span>';
                            }
                         ?>
                          <tr>
                            <td><?= $sl; ?></td>
                            <td><?= $wdr['user']; ?></td>
                            <td><span class="text-primary"><?= $icn; ?></span> <?= $wdr['amount']; ?></td>
                            <td><span class="text-primary"><?= $icn; ?></span> <?= $wdr['addr']; ?></td>
                            <td><?= $action; ?></td>
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
  <?php if($feed = $this->session->flashdata("Feed")): ?>
    <div class="flashd"><?= $feed; ?></div>
  <?php endif; ?>
  <?php include('inc/footer.php'); ?>
  </div>
  <?php include('inc/table_js.php'); ?>
</body>
</html>