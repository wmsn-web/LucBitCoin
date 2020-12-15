<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Rules</title>
  <?php include("inc/layout.php"); ?>
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
                <div class="col-md-7">
                    <h4>Rules</h4>
                    <small><i class="fa fa-caret-down" aria-hidden="true"></i> Follow them or GTFO!</small>
                </div>
                <div class="col-md-5">
                    <div class="sm-right">
                        <div class="row">
                            <div class="col-sm-4 unsed">
                                <span class="text-muted">Equivalent</span><h5>USD 0.00</h5>
                            </div>
                            <div class="col-sm-4 inuse">
                                <span class="text-muted">Bitcoin <small>in Use</small></span><h5>BTC 0.00000000</h5>
                            </div>
                            <div class="col-sm-4 unsed">
                              <span class="text-muted">Ethereum <<a href="javascript:void(0)">Select</a>></span><h5>ETH 0.00000000</h5></div>
                        </div>
                    </div>
                </div>
            </div>
              
          </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluiddd">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="ruleUl">
                          <?php if(!empty($data)): ?>
                            <?php $s = 1; foreach($data as $key): $sl=$s++; ?>
                              <li><span class="sl"><?= $sl; ?></span> <?= $key['rules']; ?></li>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include('inc/footer.php'); ?>
  </div>
  <?php include('inc/js.php'); ?>
</body>
</html>