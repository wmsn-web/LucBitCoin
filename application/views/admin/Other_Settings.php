<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Other Settings</title>
  <?php include("inc/layout.php"); ?>
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
            <h1 class="m-0 text-dark">Other Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Other Settings</li>
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
            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#saleCharge">
              Set Sale Charge(%)
            </button>

            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#setCur">
              Set Currency
            </button>
            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#checker">
              Set Checker Price
            </button>
            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#depAddr">
              Set Diposit Address
            </button>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php if($feed = $this->session->flashdata("Feed")): ?>
    <div class="flashd"><?= $feed; ?></div>
  <?php endif; ?>
  <?php include('inc/AllModal.php'); ?>
  <?php include('inc/footer.php'); ?>
  </div>
  <?php include('inc/js.php'); ?>
</body>
</html>