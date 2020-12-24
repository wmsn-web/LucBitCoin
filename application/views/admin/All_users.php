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
            <h1 class="m-0 text-dark">All Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li> 
              <li class="breadcrumb-item active">All Users</li>
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
                <table  id="example5"  class="tble tble-bordered">
                  <thead>
                    <tr>
                      <th>Username</th>
                      <th>BTC withdraw Address</th>
                      <th>ETH withdraw Address</th>
                      <th>Wallet Balance</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($userData)): ?>
                      <?php foreach($userData as $users):
                          if($users['status']=="0")
                          {
                            $button = "<a href='".base_url('Admin/All_users/UnlockUser/'.$users['user_id'])."'><button class='btnSmall btnSmall-danger'>Unblock</button></a>";
                          }
                          else
                          {
                            $button = "<a href='".base_url('Admin/All_users/BlockUser/'.$users['user_id'])."'><button class='btnSmall btnSmall-primary'>Block</button></a>";
                          }
                       ?>
                          <tr>
                              <td><?= $users['username']; ?></td>
                              <td><?= $users['withdraw_btc']; ?></td>
                              <td><?= $users['withdraw_eth']; ?></td>
                              <td>
                                <table class="tble tble-bordered">
                                  <tr>
                                    <td><i class='fab fa-btc text-primary'></i> <?= $users['balBtc']; ?></td>
                                    <td><i class='fab fa-ethereum  text-warning'></i> <?= $users['balEth']; ?></td>
                                  </tr>
                                </table>
                              </td>
                              <td><?= $button; ?>
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
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php if($feed = $this->session->flashdata("Feed")): ?>
    <div class="flashd"><?= $feed; ?></div>
  <?php endif; ?>
  <?php include("inc/AllModal.php"); ?>
  <?php include('inc/footer.php'); ?>
  </div>
  <?php include('inc/table_js.php'); ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#example5').DataTable({
        responsive: true,
        language: {
          searchPlaceholder: 'Search Everything Here',
          sSearch: '',
          lengthMenu: '_MENU_',
        }
      });

      $(".actionss").click(function(){
          ids = this.id;
          spl = ids.split("_");
          $("#UsrNm").html(spl[2]);
          $("#userId").val(spl[1]);

      });
    });
  </script>
</body>
</html>