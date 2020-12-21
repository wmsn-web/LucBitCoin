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
            <h1 class="m-0 text-dark">Fund Request</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Fund Request </li>
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
                  <h5>All Requests</h5>
                  <table id="example1" class="tble tble-bordered">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Date</th>
                        <th>Username</th>
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
                              $del = '<a onclick="return confirm(\'Proceed to add wallet ?\')" href="'.base_url('Admin/Fund_Request/Addbal/'.$key['user_id'].'/'.$key['currency'].'/'.$key['amount'].'/'.$key['id']).'"><button class="btnSmall actionss">Add Balance</button></a>'. nbs('3').'<a onclick="return confirm(\'Cancel This Request?\')" class="text-danger" href="'.base_url('Admin/Fund_Request/DelRq/'.$key['id']).'">Cancel</a>';
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
                            <td><?= $key['username']; ?></td>
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
  <?php include("inc/AllModal.php"); ?>
  <?php include('inc/footer.php'); ?>
  </div>
  <?php include('inc/table_js.php'); ?>
  <script type="text/javascript">
    /*
    $(".actionss").click(function(){
          ids = this.id;
          spl = ids.split("_");
          $("#UsrNm").html(spl[2]);
          $("#userId").val(spl[1]);

      });
      */

  </script>
</body>
</html>