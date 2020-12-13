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
            <h1 class="m-0 text-dark">All Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Products</li>
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
                        <th>DATE</th>
                        <th>BIN</th>
                        <th>EXP</th>
                        <th>CVV</th>
                        <th>TYPE</th>
                        <th>BANK</th>
                        <th>ADDRESS</th>
                        <th>SELLER</th>
                        <th>BASE</th>
                        <th>$</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      if(!empty($proData)): ?>
                        <?php $s =1; foreach($proData as $pro):  $card = strtolower($pro['brand']); $sl = $s++; ?>
                      <?php
                          
                            $endpoint = 'live';
                            $access_key = '70d19982004ef8aa2c639ae10d4c06af';
                            //$access_key = '336afadbf57caf193b6e4bb89da64dec';
                            
                              $icn = "<i class='fab fa-btc'></i>";
                              $icn2 = "<i class='fab fa-ethereum'></i>";
                              $json = file_get_contents('http://api.coinlayer.com/api/'.$endpoint.'?access_key='.$access_key.'');
                              $ex = json_decode($json);  
                              $bttc = $ex->rates->BTC;
                              $cryps = $pro['price'] / $bttc;
                              $cryp = number_format($cryps,8);
                              $etth = $ex->rates->ETH;
                              $cryps2 = $pro['price'] / $etth;
                              $cryp2 = number_format($cryps2,8);

                              if($pro['getSell'] >0 && $pro['status']=="0")
                              {
                                $btn = '<button class="btnSmall btnSmall-danger">Sold Out</button>';
                              }
                              elseif(!$pro['getSell'] > 0 && $pro['status']=="0")
                              {
                                $btn = '<a onclick="return confirm(\'Enable this Product?\')" href="'.base_url('Admin/Products/EnaleProduct/'.$pro['id']).'"> <button class="btnSmall btnSmall-warning">Disabled</button></a>';
                              }
                              else
                              {
                                $btn = '<a onclick="return confirm(\'Disable this Product?\')" href="'.base_url('Admin/Products/DisbleProduct/'.$pro['id']).'"> <button class="btnSmall btnSmall-primary">Disable</button></a>';
                              }

                            
                          ?>
                          

                          <tr>
                            <td><?= $pro['date']; ?></td>
                            <td><img src="<?= base_url('assets/cards/'.$card.".png"); ?>" width="25"> 
                              <?= nbs(5); ?><?= $pro['bin']; ?></td>
                            <td><?= $pro['exp']; ?></td>
                            <td><?= $pro['cvv']; ?></td>
                            <td><?= $pro['type']; ?></td>
                            <td style="text-align: left; width: 10%"><span class="flag-icon flag-icon-<?= $pro['cntr_cd']; ?>"></span> <?= $pro['bank']; ?></td>
                            <td style="text-align: left; width: 20%"><span class="flag-icon flag-icon-<?= $pro['cntr_cd']; ?>"></span> <?= $pro['address']; ?></td>
                            <td><?= $pro['seller']; ?></td>
                            <td><?= $pro['base']; ?></td>
                            <td><span class="text-success"><i class="fas fa-dollar-sign"></i> <?= number_format($pro['price'],2); ?></span><br>
                              <span class="text-primary"><?= $icn; ?> <?= $cryp; ?></span><br>
                              <span class="text-primary"><?= $icn2; ?> <?= $cryp2; ?></span>
                            </td>
                            <td style="text-align: center; width: 10%">
                              <?= $btn; ?>
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
  <?php if($feed = $this->session->flashdata("Feed")): ?>
    <div class="flashd"><?= $feed; ?></div>
  <?php endif; ?>
  <?php include('inc/footer.php'); ?>
  </div>
  <?php include('inc/table_js.php'); ?>
</body>
</html>